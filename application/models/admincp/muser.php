<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Muser extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function show_all_user_datatables()
	{
		
		$this->load->library('Datatables');
		$this->datatables
		->select('id,username,email,first_name,last_name,phone')
		->from('users')
		->add_column('actions', '<button type="button" onclick="reset_password_user($1)" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-refresh"></span>&nbsp;'.$this->lang->line('reset_password').'</button>&nbsp;<button type="button" onclick="delete_user($1,&#39;'.lang('how_to_delete').'&#39;)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>&nbsp;'.$this->lang->line('delete').'</button>', 'id');
		;
		return $this->datatables->generate();
	}	

}