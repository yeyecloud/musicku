<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mcategory extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function m_add_update_category($type = 'insert',$cat_name,$cat_url,$cat_tag,$cat_img,$cat_type,$cat_description,$cat_id = NULL)
	{
		switch($type)
		{
			//Type Insert(New) Category
			case 'insert':
			$tags        = explode(',',$cat_tag);
			$tags_insert = '';
			for($i = 0; $i < count($tags); $i++){
				$tags_insert .= $this->mglobal->selectStags('t_id',$tags[$i]).',';
			}
			$tags_insert = substr($tags_insert,0, - 1);
			$data        = array(
				'cat_id'         =>NULL,
				'cat_name '      =>$cat_name,
				'cat_keyword'    =>removesign($cat_name),
				'cat_url'        =>$cat_url,
				'cat_tag'        =>$tags_insert,
				'cat_img'        =>$cat_img,
				'cat_type'       =>$cat_type,
				'cat_description'=>$cat_description
			);
			return $this->db->insert('category',$data);
			break;
			//Update
			case 'update':
			$check_img = $this->mglobal->get_info_category($cat_id);
			if($check_img[0]['cat_img'] != $cat_img)
			{
				@unlink(FCPATH.'/uploads/img_category/'.$check_img[0]['cat_img']);
			}
			$tags        = explode(',',$cat_tag);
			$tags_insert = '';
			for($i = 0; $i < count($tags); $i++){
				$tags_insert .= $this->mglobal->selectStags('t_id',$tags[$i]).',';
			}
			$tags_insert = substr($tags_insert,0, - 1);
			$data        = array(
				'cat_name '      =>$cat_name,
				'cat_keyword'    =>removesign($cat_name),
				'cat_url'        =>$cat_url,
				'cat_tag'        =>$tags_insert,
				'cat_img'        =>$cat_img,
				'cat_type'       =>$cat_type,
				'cat_description'=>$cat_description
			);
			return $this->db
					->where('cat_id',$cat_id)
					->update('category',$data);
			
			break;
		}

	}
	//Show Datatables Song
	public function show_all_category_datatables()
	{
		$this->load->library('Datatables');
		$this->datatables
		->select('cat_id,cat_name,cat_url,cat_type')
		->from('category')
		->add_column('actions', '<button type="button" onclick="edit_category($1)" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i>&nbsp;'.$this->lang->line('edit').'</button>&nbsp;<button type="button" onclick="delete_category($1,&#39;'.lang('how_to_delete').'&#39;)" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i>&nbsp;'.$this->lang->line('delete').'</button>', 'cat_id');
		;
		return $this->datatables->generate();
	}
	//Delete Category
	public function m_delete_category($cat_del,$cat_convert){
		$data=array(
			'cat_id'=>$cat_convert
		);
		$this->db->where('cat_id',$cat_del);
		$update=$this->db->update('song',$data);
		if($update==TRUE){
			$this->db->delete('category', array('cat_id' =>$cat_del)); 
		}
		return TRUE;
	}

}