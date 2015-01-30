<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mhome extends CI_Model{
    public function __construct(){
        parent::__construct();
        //$this->load->database();
    }
    
    public function top_views_week($limit){
		$this->db->select('*');
		$this->db->from('views_song');
		$this->db->join('song', 'song.v_id = views_song.v_id');
		$this->db->join('singer_song', 'singer_song.si_id = song.si_id');
		$this->db->order_by('v_views_week','decs');
		$this->db->limit($limit);
		$result = $this->db->get();
		return $result->result_array();
	}
}