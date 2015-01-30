<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

	}

	public function user($u_name,$u_id)
	{
		if(@$this->ion_auth->user()->row()->user_id === $u_id)
		{
			$login = TRUE;
		}
		else
		{
			$login = FALSE;
		}
		//Profile 
		$user=$this->ion_auth->user($u_id)->row();
		$body_data = array(
			'aside'        =>$this->templayout->set_aside(),//$aside_data_send,
			'navtop'=>$this->templayout->set_nav_top(),
			/*
			Data
			*/
			'user_id'=>$u_id,
			'login'        =>(bool)$login,
			'is_login'     =>$this->ion_auth->logged_in(),
			'data_user'    =>$user,
			'data_playlist'=>$this->mglobal->playlist_user('select-u',NULL,$u_id,NULL,NULL),
			'data_notify'  =>@$this->mglobal->Notify('check-all-received',NULL,NULL,$this->ion_auth->user()->row()->user_id,NULL,NULL,NULL),
			'data_admin_notify'=>$this->mglobal->LoadAdminNotify(),
			'data_all_follower' => count($this->mglobal->Follow('all-follower', $u_id, NULL)),
            'data_all_following' => count($this->mglobal->Follow('all-following', $u_id, NULL)),
		);
		$body_data_send = $this->parser->parse('music_home/profile.tpl',$body_data,TRUE);



		//Data Body
		$body = array(
			'class_style'=>'',
			//Send Header to Body
			'header'=>$this->templayout->set_header($user->first_name.' '.$user->last_name,$user->first_name.' '.$user->last_name,'Profile'),
			'body_data'  =>$body_data_send,
			'js_load'    =>$this->templayout->set_js_css('assets/js/plugins/profile.js'),
		);

		$this->parser->parse('layout/body.tpl',$body);
	}
	//Ajax Update Info User
	public function update_info_user()
	{
		$first_name = $this->input->post('first_name');
		$last_name  = $this->input->post('last_name');
		$company    = $this->input->post('company');
		$phone      = (int)$this->input->post('phone');
		$address = $this->input->post('address');
		$avatar  = $this->input->post('avatar');
		$sex     = (int)$this->input->post('sex');
		$textarea = $this->input->post('textarea');
		//Info User
		$user     = $this->ion_auth->user()->row();
		if($avatar != $user->avatar)
		{
			@unlink(FCPATH.'/uploads/img_avatar/'.$user->avatar);
		}
		$data = array(
			'first_name'=> $first_name,
			'last_name' => $last_name,
			'company'   => $company,
			'phone'     => $phone,
			'address'   => $address,
			'avatar'    => $avatar,
			'about'     =>$textarea,
			'sex'       => $sex
		);
		$this->ion_auth->update($user->user_id, $data);
		$result = array(
			'status'  =>TRUE,
			'messages'=>$this->lang->line('notify_update_profile')
		);
		echo json_encode($result);
	}
	//Ajax change password
	public function change_password()
	{
		$password_old = $this->input->post('password_old');
		$password_new = $this->input->post('password_new');
		$data         = array(
			'password'=>$password_new
		);
		$user = $this->ion_auth->user()->row();
		if($this->ion_auth->login($user->email,$password_old) == TRUE)
		{
			$this->ion_auth->update($user->user_id, $data);
			$this->ion_auth->login($user->email,$password_new);
			$messages_notify = $this->lang->line('notify_change_password_success');
			$messages_notify = str_replace('{time}',mdate("%Y/%m/%d - %h:%i %a", now()),$messages_notify);
			$this->mglobal->Notify('creat-notify',NULL,0,$user->user_id,1,2,$messages_notify);
			$result = array(
				'status'  =>TRUE,
				'messages'=>TRUE
			);
		}
		else
		{
			$result = array(
				'status'  =>FALSE,
				'messages'=>$this->lang->line('notify_not_password_old')
			);
		}
		echo json_encode($result);
	}
	//Ajjax Edit Playlist
	public function edit_playlist()
	{
		$pl_id = (int)$this->input->post('pl_id');
		$pl_img        = str_replace(base_url('/uploads/img_playlist/'),'',$this->input->post('pl_img'));
		$pl_img        = str_replace('/','',$pl_img);
		$pl_name       = $this->input->post('pl_name');
		$data_playlist = $this->mglobal->playlist_user('select-pl',$pl_id,NULL,NULL,NULL,NULL);
		if($data_playlist[0]['pl_img'] != $pl_img)
		{
			@unlink(FCPATH.'/uploads/img_playlist/'.$data_playlist[0]['pl_img']);
		}
		$this->mglobal->playlist_user('update',$pl_id,NULL,NULL,$pl_name,$pl_img);

		$messages_notify = $this->lang->line('notify_messages_edit_playlist');
		$messages_notify = str_replace('{time}',mdate("%Y/%m/%d - %h:%i %a", now()),$messages_notify);
		$messages_notify = str_replace('{name}',$pl_name,$messages_notify);
		$this->mglobal->Notify('creat-notify',NULL,0,$this->ion_auth->user()->row()->user_id,1,2,$messages_notify);

		$result = array(
			'status'=>TRUE
		);
		echo json_encode($result);

	}
	//Ajax Delete Playlist
	public function delete_playlist()
	{
		$pl_id = (int)$this->input->post('pl_id');
		if($this->mglobal->playlist_user('check-pl-u',$pl_id,$this->ion_auth->user()->row()->user_id,NULL,NULL,NULL) == TRUE)
		{
			$this->mglobal->playlist_user('delete',$pl_id,$this->ion_auth->user()->row()->user_id,NULL,NULL,NULL);
			$messages_notify = $this->lang->line('notify_messages_delete');
			$messages_notify = str_replace('{num}',$pl_id,$messages_notify);
			$this->mglobal->Notify('creat-notify',NULL,0,$this->ion_auth->user()->row()->user_id,1,2,$messages_notify);
			$result = array(
				'status'  =>TRUE,
				'messages'=>$this->lang->line('notify_delete_playlist_success')
			);
		}
		else
		{
			$result = array(
				'status'  =>FALSE,
				'messages'=>$this->lang->line('notify_not_delete_playlist')
			);
		}
		echo json_encode($result);

	}
	//Ajax Follow
	public function follow()
	{
		$u_following = $this->input->post('u_following');
		$user        = $this->ion_auth->user()->row();
		if($this->ion_auth->logged_in() == FALSE)
		{
			$result = array(
				'status'  =>FALSE,
				'messages'=>$this->lang->line('please_log_in')
			);
		}
		else
		{
			if($this->mglobal->Follow('check-following',$user->user_id,$u_following) == FALSE)
			{
				$this->mglobal->Follow('follow',$user->user_id,$u_following);
				$result = array(
					'status'  =>1,
					'messages'=>$this->lang->line('notify_follow_success')
				);
			}
			else
			{
				//UnFollow
				$this->mglobal->Follow('unfollow',$user->user_id,$u_following);
				$result = array(
					'status'  =>2,
					'messages'=>$this->lang->line('notify_unfollow_success')
				);
			}
		}
		echo json_encode($result);
	}
	//Friend
	public function friend()
	{
		if($this->ion_auth->logged_in() == FALSE)
		{
			$result = array(
				'status'  =>FALSE,
				'messages'=>$this->lang->line('please_log_in')
			);
			echo json_encode($result);
			die();
		}
		$u_fr = (int)$this->input->post('u_fr');
		$user = $this->ion_auth->user()->row();
		$check= $this->globallib->Friend('CheckStatus',NULL,$u_fr,NULL);
		if($check === NULL)
		{
			$this->mglobal->Friend('AddFriend',$user->user_id,$u_fr,0);
			$messages = str_replace('{name}',$user->first_name.'&nbsp;'.$user->last_name,$this->lang->line('notify_messages'));
			$this->mglobal->Notify('creat-notify',NULL,$user->user_id,$u_fr,NULL,3,$messages);
			$result = array(
				'status'  =>1,
				'messages'=>$this->lang->line('notify_addfriend')
			);
		}
		elseif($check == 0)
		{
			$this->mglobal->Friend('RemoveFriend',$user->user_id,$u_fr,0);
			$this->mglobal->Notify('remove-notify-allow-friend',NULL,$user->user_id,$u_fr,NULL,NULL,NULL);
			$result = array(
				'status'  =>2,
				'messages'=>$this->lang->line('notify_removefriend')
			);
		}
		else
		{
			$this->mglobal->Notify('remove-notify-allow-friend',NULL,$user->user_id,$u_fr,NULL,NULL,NULL);
			$this->mglobal->Friend('RemoveFriend',$user->user_id,$u_fr,0);
			$result = array(
				'status'  =>3,
				'messages'=>$this->lang->line('notify_removefriend')
			);
		}

		echo json_encode($result);
	}
	//GetNotify
	public function getnotify()
	{
		$user = $this->ion_auth->user()->row();
		$data = $this->mglobal->Notify('check-received',NULL,NULL,$user->user_id,1,NULL,NULL);
		$result = array(
			'count' =>count($data),
			'result'=>$data
		);
		echo json_encode($result);
	}
	//GET Avatar user
	public function GetAvatar($u_id)
	{
		$result = array(
			'avatar'=>base_url('uploads/img_avatar/'.$this->ion_auth->user($u_id)->row()->avatar)
		);
		echo json_encode($result);
	}
	//Allow Friend
	public function allowFriend()
	{
		$u_fr = $this->input->post('u_fr');
		$n_id = $this->input->post('n_id');
		$user = $this->ion_auth->user()->row();
		$this->mglobal->Friend('AllowFriend',$user->user_id,$u_fr,NULL);
		$this->mglobal->Notify('RemoveNid',$n_id,NULL,NULL,NULL,NULL,NULL);
		$result = array(
			'status'=>TRUE
		);
		echo json_encode($result);
	}
	//Deny Friend
	public function denyFriend()
	{
		$u_fr = $this->input->post('u_fr');
		$n_id = $this->input->post('n_id');
		$user = $this->ion_auth->user()->row();
		$this->mglobal->Friend('RemoveFriend',$user->user_id,$u_fr,0);
		$this->mglobal->Notify('RemoveNid',$n_id,NULL,NULL,NULL,NULL,NULL);
		$result = array(
			'status'=>TRUE
		);
		echo json_encode($result);
	}
	//Remove All Notify
	public function remove_all_notify()
	{
		$user = $this->ion_auth->user()->row();
		$this->mglobal->Notify('disable-all-notify',NULL,NULL,$user->user_id,NULL,NULL,NULL);
		$result = array(
			'status'=>TRUE
		);
		echo json_encode($result);
	}
}
