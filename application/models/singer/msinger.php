<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msinger extends CI_Model{
    public function __construct(){
        parent::__construct();
        
    }
    
    public function info_singer($si_id){
		return $this->db
		->where('si_id',$si_id)
		->get('singer_song')
		->result_array();
	}
	//All Song from singer 
	public function all_song_singer($si_id,$s_type){
		return $this->db
			->where('si_id',$si_id)
			->where('s_type',$s_type)
			->order_by('s_id','desc')
			->get('song')
			->result_array();
	}
}