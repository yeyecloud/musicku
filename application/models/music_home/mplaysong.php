<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mplaysong extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    public function song_in_category($cat_id,$order_by,$limit){
		$this->db->select('s_id,s_name,s_url');
		$this->db->from('song');
		$this->db->where('cat_id',$cat_id);
		$this->db->order_by('s_id',$order_by);
		$this->db->limit($limit);
		$result = $this->db->get();
		return $result->result_array();
	}
}