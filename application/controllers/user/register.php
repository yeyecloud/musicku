<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

	}

	public function index()
	{
		
		//Data Header
		$header = array(
			'base_url'   =>base_url(),
			'site_url'   =>site_url(),
			'title'      =>$this->lang->line('signup'),
			'description'=>$this->lang->line('description_signup'),
		);
		$header_send = $this->parser->parse('layout/header.tpl',$header,TRUE);
		//Body Data
		$body_data = array(
		//Langguage
			'signup'                 =>$this->lang->line('signup'),
			'signin'                 =>$this->lang->line('signin'),
			'solo'=>$this->lang->line('solo_sign_up'),
			'agree_terms'=>$this->lang->line('agree_terms'),
			'terms'=>$this->lang->line('terms'),
			'close'=>$this->lang->line('close'),
			'already_account'=>$this->lang->line('already_account'),
			
			'first_name'             =>$this->lang->line('first_name'),
			'notify_first_name'      =>$this->lang->line('notify_first_name'),

			'last_name'              =>$this->lang->line('last_name'),
			'notify_last_name'       =>$this->lang->line('notify_last_name'),

			'company'                =>$this->lang->line('company'),
			'notify_company'         =>$this->lang->line('notify_company'),

			'phone'                  =>$this->lang->line('phone'),
			'notify_phone'           =>$this->lang->line('notify_phone'),

			'email'                  =>$this->lang->line('email'),
			'notify_email'           =>$this->lang->line('notify_email'),

			'password'               =>$this->lang->line('password'),
			'notify_password'        =>$this->lang->line('notify_password'),

			'password_confirm'       =>$this->lang->line('password_confirm'),
			'notify_password_confirm'=>$this->lang->line('notify_password_confirm'),
			

		);
		$body_data_send = $this->parser->parse('user/register.tpl',$body_data,TRUE);

		//Data Body
		$body = array(
			'base_url'   =>base_url(),
			'site_url'   =>site_url(),
			'class_style'=>'bg-info dker',
			//Send Header to Body
			'header'=>$header_send,
			'body_data'  =>$body_data_send,
			'js_load'    =>'<script type="text/javascript" src="'.base_url('assets/js/signup.js').'"></script>',
			'csrf'=>'<input type="hidden" value="'.$this->security->get_csrf_hash().'" name="'.$this->security->get_csrf_token_name().'"/>'
		);

		$this->parser->parse('layout/body.tpl',$body);
	}
	//Funtions Login
	public function creat_user()
	{
		$username        = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
		$email           = strtolower($this->input->post('email'));
		$password        = $this->input->post('password');
		$additional_data = array(
			'first_name'=> $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'company'   => '',
			'phone'     => '',
		);
		if($this->ion_auth->register($username, $password, $email, $additional_data)){
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			echo TRUE;
		}else{
			echo $this->ion_auth->errors();
		}
		
	}
}