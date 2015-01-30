<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Singer extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('singer/Msinger');

	}

	public function index($si_name,$si_id)
	{
		$audio=$this->Msinger->all_song_singer($si_id,1);
		$video=$this->Msinger->all_song_singer($si_id,2);
		$singer=$this->Msinger->info_singer($si_id);
		$body_data = array(
			'aside'        =>$this->templayout->set_aside(),//$aside_data_send,
			'navtop'=>$this->templayout->set_nav_top(),
			/*
			Data
			*/
			'data_singer'=>$singer[0],
			'count_song_audio'=>count($audio),
			'count_song_video'=>count($video),
			'data_song_audio'=>$audio,
			'data_song_video'=>$video,
		);
		
		$body_data_send = $this->parser->parse('singer/vsinger.tpl',$body_data,TRUE);
		//Data Body
		$body = array(
			'class_style'=>'',
			//Send Header to Body
			'header'=>$this->templayout->set_header($singer[0]['si_name'],$singer[0]['si_name'],'Profile'),
			'body_data'  =>$body_data_send,
			'js_load'    =>'',
		);

		$this->parser->parse('layout/body.tpl',$body);
	}
	
}
