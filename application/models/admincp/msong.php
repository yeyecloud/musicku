<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msong extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
//Show Datatables Song
    public function show_all_song_datatables() {
        $this->load->library('Datatables');
        $this->datatables
                ->select('s_id,s_name,s_url,s_type')
                ->from('song')
                ->join('category', 'category.cat_id = song.cat_id')
                ->select('cat_name')
                ->join('users', 'users.id = song.u_id')
                ->select('email')
                ->add_column('actions', '<button type="button" onclick="edit_song($1)" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i>&nbsp;'.lang('edit').'</button>&nbsp;<button type="button" onclick="delete_song($1,&#39;'.lang('how_to_delete').'&#39;)" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i>&nbsp;'.lang('delete').'</button>&nbsp;<button type="button" onclick="addToAlbum($1)" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>&nbsp;'.lang('album_add_song').'</button>', 's_id');
        ;
        return $this->datatables->generate();
    }

}
