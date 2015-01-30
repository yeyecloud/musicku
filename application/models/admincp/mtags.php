<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mtags extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}

	//Check Singer Name
	public function m_check_tags_name($tags_name)
	{
		$this->db->select('*');
		$this->db->from('tag_song');
		$this->db->where('t_tags',$tags_name);
		$data = $this->db->get();
		if($data->num_rows() != 0){
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//Add Tags
	public function m_add_tags($tags_name)
	{
		$data = array(
			't_id'  =>NULL,
			't_tags'=>$tags_name
		);
		return $this->db->insert('tag_song',$data);
	}
	//Show Datatables Singer
	public function show_all_tags_datatables()
	{

		$this->load->library('Datatables');
		$this->datatables
		->select('t_id,t_tags')
		->from('tag_song')
		->add_column('actions', '<button type="button" onclick="edit_tags($1)" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;'.$this->lang->line('edit').'</button>&nbsp;<button type="button" onclick="delete_tags($1)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>&nbsp;'.$this->lang->line('delete').'</button>', 't_id');
		;
		return $this->datatables->generate();
	}
	//Delete Tags
	public function delete_tags($t_id){
		$del_cat=$this->delete_tags_cat($t_id);
		$del_song=$this->delete_tags_song($t_id);
		if($del_cat==TRUE && $del_song==TRUE){
			$this->db->delete('tag_song',array('t_id'=>$t_id));
		}
		return TRUE;
	}
	//Delete tags in category
	public function delete_tags_cat($t_id)
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->like('cat_tag',$t_id);
		$data=$this->db->get();
		$tags=$data->result_array();
		for($j=0;$j<count($tags);$j++){
			$dt_tags=explode(',',$tags[$j]['cat_tag']);
			
			if(in_array($t_id,$dt_tags)==TRUE){
					$tags_ok='';
					for($i=0;$i<count($dt_tags);$i++){
						if($dt_tags[$i]!=$t_id){
							$tags_ok .=$dt_tags[$i].',';
						}
					}
					$tags_ok=substr($tags_ok,0,-1);
					$data=array(
						'cat_tag'=>$tags_ok
					);
					$this->db->where('cat_id',$tags[$j]['cat_id']);
					$this->db->update('category',$data);
				}
				
		}
		
		return TRUE;
	}
	//Delete tags in song
	public function delete_tags_song($t_id)
	{
		$this->db->select('*');
		$this->db->from('song');
		$this->db->like('s_tags',$t_id);
		$data=$this->db->get();
		$tags=$data->result_array();
		for($j=0;$j<count($tags);$j++){
			$dt_tags=explode(',',$tags[$j]['s_tags']);
				if(in_array($t_id,$dt_tags)==TRUE){
					$tags_ok='';
					for($i=0;$i<count($dt_tags);$i++){
						if($dt_tags[$i]!=$t_id){
							$tags_ok .=$dt_tags[$i].',';
						}
					}
					$tags_ok=substr($tags_ok,0,-1);
					$data=array(
						's_tags'=>$tags_ok
					);
					$this->db->where('s_id',$tags[$j]['s_id']);
					$this->db->update('song',$data);
				}
		}
		
		return TRUE;
	}
	//Check tags and id tags
	public function check_tags_id($id_old,$t_tags){
		$this->db->select('*');
		$this->db->from('tag_song');
		$this->db->where('t_id !=',$id_old);
		$this->db->where('t_tags',$t_tags);
		$data=$this->db->get();
		$num=$data->num_rows();
		if($num>0){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}
	//Update Tags
	public function update_tags($id_old,$t_tags){
		$data=array(
			't_tags'=>$t_tags
		);
		$this->db->where('t_id',$id_old);
		return $this->db->update('tag_song',$data);
	}

}
