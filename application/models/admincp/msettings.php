<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msettings extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	//Show Datatables Song
	public function update_settings($set_title_song,$set_description_song,$set_analytics,$set_title_home,$set_description_home,$set_title_category,$set_description_category,$set_title_playlist,$set_description_playlist,$set_title_profile,$set_description_profile,$set_title_singer,$set_description_singer,$set_title_tags,$set_description_tags)
	{
		$data=array(
			'set_title_song'=>$set_title_song,
			'set_description_song'=>$set_description_song,
			'set_analytics'=>$set_analytics,
			'set_title_home'=>$set_title_home,
			'set_description_home'=>$set_description_home,
			'set_title_category'=>$set_title_category,
			'set_description_category'=>$set_description_category,
			'set_title_playlist'=>$set_title_playlist,
			'set_description_playlist'=>$set_description_playlist,
			'set_title_profile'=>$set_title_profile,
			'set_description_profile'=>$set_description_profile,
			'set_title_singer'=>$set_title_singer,
			'set_description_singer'=>$set_description_singer,
			'set_title_tags'=>$set_title_tags,
			'set_description_tags'=>$set_description_tags
		);
		return $this->db->update('settings',$data);
	}
	//Add new Admin notify
	public function add_admin_notify($content){
		$data=array(
			'set_notify_id'=>NULL,
			'set_notify_content'=>$content,
			'set_notify_datecreat'=>now()
		);		
		return $this->db->insert('admin_notify',$data);;
	}
	//Manage admin notify
	public function show_all_admin_notify_datatables()
	{

		$this->load->library('Datatables');
		$this->datatables
		->select('set_notify_id,set_notify_content')
		->from('admin_notify')
		->add_column('actions', '<button type="button" onclick="delete_notify($1,&#39;'.lang('how_to_delete').'&#39;)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>&nbsp;'.$this->lang->line('delete').'</button>', 'set_notify_id');
		;
		return $this->datatables->generate();
	}
	//Delete admin notify
	public function delete_notify($notify_id){
		return $this->db->delete('admin_notify',array('set_notify_id'=>$notify_id));
	}

}
