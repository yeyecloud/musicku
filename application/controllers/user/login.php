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
		
		//Data Header
		$header = array(
			'base_url'   =>base_url(),
			'site_url'   =>site_url(),
			'title'      =>$this->lang->line('signin'),
			'description'=>$this->lang->line('description_signin'),
		);
		$header_send = $this->parser->parse('layout/header.tpl',$header,TRUE);
		//Body Data
		$body_data = array(
		//Langguage
			'signup'                 =>$this->lang->line('signup'),
			'signin'                 =>$this->lang->line('signin'),
			'solo'=>$this->lang->line('solo_sign_in'),
			'remember'=>$this->lang->line('remember'),
			'forgot_password'=>$this->lang->line('forgot_password'),
			'not_already_account'=>$this->lang->line('not_already_account'),
			'email'                  =>$this->lang->line('email'),
			'notify_email'           =>$this->lang->line('notify_email'),
			'password'               =>$this->lang->line('password'),
			'notify_password'        =>$this->lang->line('notify_password'),
		);
		$body_data_send = $this->parser->parse('user/login.tpl',$body_data,TRUE);

		//Data Body
		$body = array(
			'base_url'   =>base_url(),
			'site_url'   =>site_url(),
			'class_style'=>'bg-info dker',
			//Send Header to Body
			'header'=>$header_send,
			'body_data'  =>$body_data_send,
			'js_load'    =>'<script type="text/javascript" src="'.base_url('assets/js/signin.js').'"></script>',
			'csrf'=>'<input type="hidden" value="'.$this->security->get_csrf_hash().'" name="'.$this->security->get_csrf_token_name().'"/>'
		);

		$this->parser->parse('layout/body.tpl',$body);
	}
	//Funtions Login
	public function login_user()
	{
		$remember = (bool) $this->input->post('remember');
			if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				echo TRUE;
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				echo $this->ion_auth->errors();
			}
		
	}
}