<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mtags extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    public function all_song_tags($t_id){
		return $this->db
		->like('s_tags',$t_id)
		->order_by('s_id','desc')
		->get('song')
		->result_array();
	}
	
}