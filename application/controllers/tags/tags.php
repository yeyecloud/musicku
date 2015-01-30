<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tags extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('tags/Mtags');
	}

	public function index($tags_name)
	{
		$tags_name=urldecode($tags_name);
		$tags_id=$this->mglobal->selectStags('t_id',$tags_name);
		
		$body_data = array(
			'aside'        =>$this->templayout->set_aside(),//$aside_data_send,
			'navtop'=>$this->templayout->set_nav_top(),
			/*
			Data
			*/
			'data_song'=>$this->Mtags->all_song_tags($tags_id),
			
		);
		
		$body_data_send = $this->parser->parse('tags/vtags.tpl',$body_data,TRUE);
		//Data Body
		$body = array(
			'class_style'=>'',
			//Send Header to Body
			'header'=>$this->templayout->set_header($tags_name,$tags_name,'Tags'),
			'body_data'  =>$body_data_send,
			'js_load'    =>'',
		);

		$this->parser->parse('layout/body.tpl',$body);
	}
	
}
