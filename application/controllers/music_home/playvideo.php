<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Playvideo extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('music_home/Mhome');

	}

	public function video($s_name,$s_id)
	{
		
		//Info Song
		$info_song=$this->mglobal->get_info_song($s_id);
		$body_data = array(
		
			//aside
			'aside'=>$this->templayout->set_aside(),//$aside_data_send,
			'navtop'=>$this->templayout->set_nav_top(),
			/*
			Data
			*/
			'data_is_login'=>$this->ion_auth->logged_in(),
			'data_info_song'=>$info_song,
			'data_random_song'=>$this->mglobal->random_song_video(NULL,2,7,'RANDOM'),
			'data_comment'=>$this->mglobal->Comment('SelectCommentForSong',NULL,NULL,NULL,$s_id,NULL,NULL,5,0),
			'data_num_comment'=>$this->mglobal->Comment('CountCommentSong',NULL,NULL,NULL,$s_id,NULL,NULL,NULL,NULL)
		);
		$body_data_send = $this->parser->parse('music_home/play-video.tpl',$body_data,TRUE);
		
		
		
		//Data Body
		$body = array(
			'class_style'=>'',
			//Send Header to Body
			'header'=>$this->templayout->set_header($info_song[0]['s_name'],$info_song[0]['s_name'],'Song'),
			'body_data'  =>$body_data_send,
			'js_load'    =>$this->templayout->set_js_css('assets/js/plugins/play_video.js')
		);
		$this->parser->parse('layout/body.tpl',$body);
	}
	
	public function getComment($s_id,$offset){
		$limit=5;
		$offset=$offset*$limit;
		$data=$this->mglobal->Comment('SelectCommentForSong',NULL,NULL,NULL,$s_id,NULL,NULL,$limit,$offset);
		$content='';
		foreach ($data as $k=>$v){
		$user=$this->ion_auth->user($v['cm_uid'])->row();
		$gr=$this->ion_auth->get_users_groups($v['cm_uid'])->result();
		if($gr[0]->id==1){
			$gr='<label class="label bg-danger m-l-xs">'.$gr[0]->name.'</label> ';
		}else{
			$gr='<label class="label bg-info m-l-xs">'.$gr[0]->name.'</label> ';
		}
		if($v['cm_uid']==@$this->ion_auth->user()->row()->user_id){
			$remove='<i class="fa icon-close" onclick="delete_comment('.$v['cm_uid'].',&#39;'.$this->lang->line('how_to_delete').'&#39;)"></i>';
		}else{
			$remove='';
		}
		$content .='<article id="comment-id-'.$v['cm_id'].'" class="comment-item">
                      <a class="pull-left thumb-sm">
                        <img src="'.$this->globallib->avatar($v['cm_uid']).'" class="img-circle">
                      </a>
                      <section class="comment-body m-b">
                        <header>
                          <a href="'.base_url('profile/'.$user->username.'-'.$v['cm_uid']).'"><strong>'.$user->first_name.'&nbsp;'.$user->last_name.'</strong></a>
                          '.$gr.'
                           '.$remove.'
                          <span class="text-muted text-xs block m-t-xs">
                            '.timespan($v['cm_datecreat'],now()).'
                          </span>
                        </header>
                        <div class="m-t-sm">'.$v['cm_text'].'</div>
                      </section>
                    </article>';
		}
		echo $content;
	}
	
}