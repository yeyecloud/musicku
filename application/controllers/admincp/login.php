<?php

if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

	}

	public function index()
	{
		if($this->session->userdata('admin_login') == TRUE)
		{
			redirect(base_url('admincp/manage'));
		}
		if($this->ion_auth->is_admin() !== TRUE)
		{
			show_404();
			die();
		}
		$header_send = $this->load->view('admincp/layout/header',NULL,TRUE);
		$body_data = $this->load->view('admincp/vlogin',NULL,TRUE);
		$data = array(
			'header'   =>$header_send,
			'body_data'=>$body_data,
			'js_mode'  =>'<script src="'.base_url().'assets/admincp/js/apps/login.js"></script>'
		);
		$this->load->view('admincp/layout/body',$data);

	}
	public function login_admin()
	{
		if($this->input->cookie('total_login_admin') > 3)
		{
			$this->ion_auth->logout();
			$result=array(
				'status'=>FALSE,
				'actions'=>'lock'
			);
			echo json_encode($result);
			die();
		}
		$email    = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = (bool)$this->input->post('remember');
		if($this->ion_auth->login($email, $password, $remember) == TRUE)
		{
			$cookie = array(
				'name'  => 'total_login_admin',
				'value' => 0,
				'expire'=> '1800'
			);
			$this->input->set_cookie($cookie);
			$this->session->set_userdata('admin_login', TRUE);
			$result=array(
				'status'=>TRUE
			);
			echo json_encode($result);
		}
		else
		{
			@$cookie_login = $this->input->cookie('total_login_admin');
			$cookie       = array(
				'name'  => 'total_login_admin',
				'value' => $cookie_login + 1,
				'expire'=> '1800'
			);
			$this->input->set_cookie($cookie);
			$result=array(
				'status'=>FALSE,
				'messages'=>$this->ion_auth->errors()
			);
			echo json_encode($result);
		}
		
	}
}
