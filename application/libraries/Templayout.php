<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Templayout{
 
   public function __construct()
    {
      $this->CI =& get_instance();
    }
    //Set Modal
    public function set_modal(){
    	
    	if($this->CI->ion_auth->logged_in()!==FALSE){
    		
    		$user=$this->CI->ion_auth->user()->row();
    		//Set User Online 
    		//$userdata['username'] = $user->first_name.'&nbsp;'.$user->last_name;
			//$userdata['id'] = $user->user_id;
			//$this->CI->onlineusers->set_data($userdata);
    		$data=array(
    			'playlist'=>$this->CI->mglobal->playlist_user('select-u',NULL,$user->user_id,NULL,NULL),
    			'data_user'=>$user,
    			
    		);
			$modal_data_send = $this->CI->parser->parse('music_home/layout/modal_islogin.tpl',$data,TRUE);
		}else{
			$modal_data_send='';
		}
		return $modal_data_send;
	}
    //Aside
    public function set_aside(){
    	$this->CI->load->model('admincp/malbum');
 		//Check Login
 		if($this->CI->ion_auth->logged_in()==FALSE){
 			
			$aside_data=array(
				'all_category'=>$this->CI->mglobal->select_all_category(),
				'album_new'=>$this->CI->malbum->showalbum(5),
			);
			$aside_data_send = $this->CI->parser->parse('music_home/layout/aside.tpl',$aside_data,TRUE);
		}else{
			$user=$this->CI->ion_auth->user()->row();
			$aside_data=array(
				'all_category'=>$this->CI->mglobal->select_all_category(),
				'user'=>$user,
				'check_received'=>count($this->CI->mglobal->Notify('check-received',NULL,NULL,$user->user_id,1)),
				'playlist'=>$this->CI->mglobal->playlist_user('select-u',NULL,$user->user_id,NULL,NULL),
				'album_new'=>$this->CI->malbum->showalbum(5),
			);
			$aside_data_send = $this->CI->parser->parse('music_home/layout/aside_islogin.tpl',$aside_data,TRUE);
			
		}
		return $aside_data_send;
	}
	//Nav Top
	public function set_nav_top(){
		$settings=$this->CI->mglobal->LoadSettings();
		$nav_default=array(
			'web_name'=>$settings[0]['set_title_home']
		);
		if($this->CI->ion_auth->logged_in()==FALSE){
			
			$nav_top_data_send  = $this->CI->parser->parse('music_home/layout/nav_top.tpl',$nav_default,TRUE);
		}else{
			$user=$this->CI->ion_auth->user()->row();
			$nav_data=array(
				'user'=>$user,
				'check_received'=>count($this->CI->mglobal->Notify('check-received',NULL,NULL,$user->user_id,1))
			);
			array_merge($nav_default,$nav_data);
			$nav_top_data_send = $this->CI->parser->parse('music_home/layout/nav_top_islogin.tpl',$nav_default,TRUE);
		}
		return $nav_top_data_send;
	}
	//Header
	public function set_header($title=NULL,$description=NULL,$type=NULL){
		$settings=$this->CI->mglobal->LoadSettings();
		switch($type){
			case 'Song':
				$header = array(
					'title'      =>str_replace('{song-name}',$title,$settings[0]['set_title_song']),
					'description'=>str_replace('{song-name}',$title,$settings[0]['set_description_song'])
					
				);
			break;
			case 'Home':
				$header = array(
					'title'      =>$settings[0]['set_title_home'],
					'description'=>$settings[0]['set_description_home']
				);
			break;	
			case 'Playlist':
				$header = array(
					'title'      =>str_replace('{playlist-name}',$title,$settings[0]['set_title_playlist']),
					'description'=>str_replace('{playlist-name}',$description,$settings[0]['set_description_playlist'])
				);
			break;
			case 'Profile':
				$header = array(
					'title'      =>str_replace('{profile-name}',$title,$settings[0]['set_title_profile']),
					'description'=>str_replace('{profile-name}',$description,$settings[0]['set_description_profile'])
				);
			break;
			case 'Singer':
				$header = array(
					'title'      =>str_replace('{singer-name}',$title,$settings[0]['set_title_singer']),
					'description'=>str_replace('{singer-name}',$description,$settings[0]['set_description_singer'])
				);
			break;
			case 'Tags':
				$header = array(
					'title'      =>str_replace('{tags-name}',$title,$settings[0]['set_title_tags']),
					'description'=>str_replace('{tags-name}',$description,$settings[0]['set_description_tags'])
				);
			break;
			case 'Category':
				$header = array(
					'title'      =>str_replace('{category-name}',$title,$settings[0]['set_title_category']),
					'description'=>str_replace('{category-name}',$description,$settings[0]['set_description_category'])
				);
			break;
			default:
			$header = array(
					'title'      =>$title,
					'description'=>$description,
				);
			break;
		}
		$analytics=array(
			'analytics'=>$settings[0]['set_analytics']
		);
		array_merge($header,$analytics);
		$header_send = $this->CI->parser->parse('layout/header.tpl',$header,TRUE);
		return $header_send;
	}
	//Set Script
	public function set_js_css($url_script){
		$arr=explode('.',$url_script);
		$count=count($arr);
		if($arr[($count-1)]=='js' || $arr[($count-1)]=='JS'){
			return '<script type="text/javascript" src="'.base_url($url_script).'"></script>';
		}else{
			return 'link rel="stylesheet" href="'.base_url($url_script).'" type="text/css" />';
		}
	}
		
 
}