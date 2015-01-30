<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msinger extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//Check Singer Name
	public function m_check_singer_name($singer_name)
	{
		$this->db->select('*');
		$this->db->from('singer_song');
		$this->db->where('si_keyword',strtolower(removesign($singer_name)));
		$data = $this->db->get();
		if($data->num_rows() != 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//Check Url Singer
	public function m_check_singer_url($singer_url)
	{
		$this->db->select('*');
		$this->db->from('singer_song');
		$this->db->where('si_url',$singer_url);
		$data = $this->db->get();
		if($data->num_rows() != 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//Add Singer
	public function m_add_singer($singer_name,$singer_url,$singer_img,$singer_birthday,$singer_description)
	{
		$data = array(
			'si_id'         =>NULL,
			'si_name'       =>$singer_name,
			'si_keyword'    =>strtolower(removesign($singer_name)),
			'si_url'        =>$singer_url,
			'si_img'        =>$singer_img,
			'si_birthday'   =>$singer_birthday,
			'si_description'=>$singer_description,
		);
		if($this->db->insert('singer_song',$data) == TRUE)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	//Check Singer Name
	public function m_check_singer_name_id($singer_name,$si_id_old)
	{
		$this->db->select('*');
		$this->db->from('singer_song');
		$this->db->where('si_id !=',$si_id_old);
		$this->db->where('si_keyword',strtolower(removesign($singer_name)));
		$data = $this->db->get();
		if($data->num_rows() != 0){
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//Check Url Singer
	public function m_check_singer_url_id($singer_url,$si_id_old)
	{
		$this->db->select('*');
		$this->db->from('singer_song');
		$this->db->where('si_id !=',$si_id_old);
		$this->db->where('si_url',$singer_url);
		$data = $this->db->get();
		if($data->num_rows() != 0){
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//Update Singer
	public function m_update_singer($si_id,$si_name,$si_url,$si_img,$si_birthday,$si_description)
	{
		$info_singer_old = $this->mglobal->selectSinger('si_id',$si_id,NULL,NULL);
		if($info_singer_old[0]['si_img'] != $si_img)
		{
			@unlink(FCPATH.'/uploads/img_singer/'.$info_singer_old[0]['si_img']);
		}
		$data = array(
			'si_name'       =>$si_name,
			'si_keyword'    =>strtolower(removesign($si_name)),
			'si_url'        =>$si_url,
			'si_img'        =>$si_img,
			'si_birthday'   =>$si_birthday,
			'si_description'=>$si_description
		);
		$this->db->where('si_id',$si_id);
		$result = $this->db->update('singer_song',$data);
		return $result;
	}
	//Show Datatables Singer
	public function show_all_singer_datatables()
	{

		$this->load->library('Datatables');
		$this->datatables
		->select('si_id,si_name,si_url')
		->from('singer_song')
		->add_column('actions', '<button type="button" onclick="edit_singer($1)" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;'.$this->lang->line('edit').'</button>&nbsp;<button type="button" onclick="delete_singer($1)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>&nbsp;'.$this->lang->line('delete').'</button>', 'si_id');
		;
		return $this->datatables->generate();
	}
	//Delete Singer
	public function delete_singer($si_id_del,$si_id_convert)
	{
		$data = array(
			'si_id'=>$si_id_convert
		);
		$this->db->where('si_id',$si_id_del);
		if($this->db->update('song',$data) == TRUE)
		{
			$this->db->delete('singer_song',array('si_id'=>$si_id_del));
		}
		return TRUE;
	}


}
