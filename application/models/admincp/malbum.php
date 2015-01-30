<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Album (Model)
 * @datecreate: 2014-10-26
 * @version:Update v1.1
 * @author:Truong Nguyen
 */
class Malbum extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Create album
     * input:array();
     * -al_name
     * -al_url
     * -al_description
     * -al_image
     * ouput:bool
     */
    public function create($info) {
        $data = array(
            'al_id' => NULL,
            'al_name' => $info['al_name'],
            'al_keyword' => strtolower(removesign($info['al_name'])),
            'al_url' => $info['al_url'],
            'al_description' => $info['al_description'],
            'al_image' => $info['al_image'],
            'al_content' => 0,
            'al_date_create' => now(),
            'al_date_update' => now()
        );
        if ($this->db->insert('album', $data) == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Show All Album
     */
    public function showalbum($limit = NULL) {
        if ($limit == NULL) {
            $sql = $this->db
                    ->select('*')
                    ->order_by('al_id', 'desc')
                    ->get('album')
                    ->result_array();
        } else {
            $sql = $this->db
                    ->select('*')
                    ->order_by('al_id', 'desc')
                    ->limit(5)
                    ->get('album')
                    ->result_array();
        }

        return $sql;
    }

    /**
     * Check exist song in album
     * input:int
     * -al_id
     * -s_id
     * output:bool
     */
    public function CheckExistSongInAlbum($al_id, $s_id) {
        $al_content = $this->db
                        ->select('al_content')
                        ->where('al_id', $al_id)
                        ->get('album')
                        ->row()
                ->al_content;
        if ($al_content === 0) { //Song not exist
            return FALSE;
        } else {
            @$al_content = unserialize($al_content);
            if (@in_array($s_id, $al_content) == TRUE) {//Song exist
                return TRUE;
            } else {
                return FALSE; //Song not exist
            }
        }
    }

    /**
     * Add song to album
     * input:int
     * -al_id
     * -s_id
     * output:bool
     */
    public function AddSongToAlbum($al_id, $s_id) {
        $al_content = $this->db
                        ->select('al_content')
                        ->where('al_id', $al_id)
                        ->get('album')
                        ->row()
                ->al_content;
        if ($al_content === 0) {
            $al_content[] = $s_id;
        } else {
            @$al_content = unserialize($al_content);
            $al_content[] = $s_id;
        }

        //Update
        $data = array(
            'al_content' => serialize($al_content)
        );
        return $this->db->where('al_id', $al_id)->update('album', $data);
    }

    /**
     * datatables plugin
     */
    //Show Datatables Song
    public function show_all_album_datatables() {
        $this->load->library('Datatables');
        $this->datatables
                ->select('al_id,al_name,al_url,al_description')
                ->from('album')
                ->add_column('actions', '<button type="button" onclick="edit_album($1)" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i>&nbsp;' . $this->lang->line('edit') . '</button>&nbsp;<button type="button" onclick="delete_album($1,&#39;' . lang('how_to_delete') . '&#39;)" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i>&nbsp;' . $this->lang->line('delete') . '</button>&nbsp;<button type="button" onclick="manage_song_in_album($1)" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-plus"></i>&nbsp;' . $this->lang->line('album_manage_song') . '</button>', 'al_id');
        ;
        return $this->datatables->generate();
    }

    /**
     * Info album
     * input:int
     * -al_id
     * output:array
     */
    public function InfoAlbum($al_id) {
        $sql = $this->db
                ->select('*')
                ->where('al_id', $al_id)
                ->get('album')
                ->result_array();
        return $sql;
    }

    /**
     * Edit Album
     * input:array
     * -al_id
     * -al_name
     * -al_url
     * -al_description
     * -al_image
     * -al_image_old
     * output:bool
     */
    public function EditAlbum($info) {
        //Remove Images Album if change
        if ($info['al_image'] != $info['al_image_old']) {
            @unlink(FCPATH . 'uploads/img_album/' . $info['al_image_old']);
        }
        $data = array(
            'al_name' => $info['al_name'],
            'al_url' => $info['al_url'],
            'al_keyword' => strtolower(removesign($info['al_name'])),
            'al_description' => $info['al_description'],
            'al_image' => $info['al_image'],
            'al_date_update' => now()
        );
        return $this->db->where('al_id', $info['al_id'])->update('album', $data);
    }

    /**
     * Delete Album
     * input:int
     * -al_id
     * output:bool
     */
    public function DeleteAlbum($al_id) {
        return $this->db->delete('album', array('al_id' => $al_id));
    }

    /**
     * Delete song in album
     * input:s_id,al_id
     * ouput:bool
     */
    public function DeleteSongInAlbum($s_id, $al_id) {
        $info_album = $this->InfoAlbum($al_id);
        $info_album = $info_album[0];
        $content = @unserialize($info_album['al_content']); //array
        $key = array_search($s_id, $content);
        unset($content[$key]);
        $data = array(
            'al_content' => @serialize($content)
        );
        return $this->db->where('al_id', $al_id)->update('album', $data);
    }

    /**
     * Update views
     * input:al_id
     * Output:none
     */
    public function UpdateViews($al_id) {
        $this->db->set('al_views', 'al_views+1', FALSE);
        $this->db->where('al_id', $al_id);
        $this->db->update('album');
    }

    /**
     * Album random
     */
    public function AlbumRanDom($limit) {
        return $this->db
                        ->select('*')
                        ->order_by('al_id', 'RANDOM')
                        ->limit($limit)
                        ->get('album')
                        ->result_array();
    }

    /**
     * Album pages
     */
    public function LoadAlbumPages($number, $offset) {
        return $this->db
                        ->order_by('al_id', 'desc')
                        ->get('album', $number, $offset)
                        ->result_array();
    }

    /**
     * Search Album
     */
    public function search_album($keyword) {
        return $this->db
                        ->like('al_keyword', $keyword)
                        ->limit(5)
                        ->order_by('al_id', 'desc')
                        ->get('album')
                        ->result_array();
    }

}
