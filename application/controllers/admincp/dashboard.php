<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

	}

	public function index()
	{
		if($this->ion_auth->is_admin() !== TRUE)
		{
			show_404();
			die();
		}
		if($this->session->userdata('admin_login') != TRUE)
		{
			redirect(base_url('admincp/login'));
		}
		//nav header 
		$nav_send=$this->load->view('admincp/layout/nav_header',NULL,TRUE);
		$body=array(
			'nav_header'=>$nav_send
		);
		$header_send = $this->load->view('admincp/layout/header',NULL,TRUE);
		$body_data = $this->load->view('admincp/vdashboard',$body,TRUE);
		//Load Template
		$data = array(
			'header'   =>$header_send,
			'body_data'=>$body_data,
			'js_mode'  =>'<script src="'.base_url().'assets/admincp/js/apps/login.js"></script>'
		);
		$this->load->view('admincp/layout/body',$data);

	}
}