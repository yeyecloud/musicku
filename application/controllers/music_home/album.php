<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Album extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('admincp/malbum');
    }

    public function AlbumIndex($al_url, $al_id) {
    	$is_login = $this->ion_auth->logged_in();
        if ($is_login == TRUE) {
            $data_friend = $this->mglobal->all_friend($this->ion_auth->user()->row()->user_id);
        } else {
            $data_friend = FALSE;
        }
    	
        $this->malbum->UpdateViews($al_id);//Update view + 1
        $data_album = $this->malbum->InfoAlbum($al_id);
        $data_album=$data_album[0];
        $data_s_id_album=@unserialize($data_album['al_content']);
        if(count($data_s_id_album)>1){
			foreach ($data_s_id_album as $k=>$v){
	        	$data_song=$this->mglobal->info_song_fast_one($v);
	        	$data_song=$data_song[0];
				$data_song_array[]=$data_song;
			}
		}
        
		//Random
		$album_random=$this->malbum->AlbumRanDom(10);
		
        $body_data = array(
            //Langguage

            'aside' => $this->templayout->set_aside(), //$aside_data_send,
            'navtop' => $this->templayout->set_nav_top(),
            'jPlayer'=>$this->parser->parse('layout/jplayer.tpl',NULL,TRUE),
            
            
            'data_album' => $data_album,
           	'data_song'=>@$data_song_array,
            'data_album_random' =>$album_random,
            'data_is_login' => $is_login,
            'data_friend' => $data_friend
        );
        $body_data_send = $this->parser->parse('music_home/play-album.tpl', $body_data, TRUE);

        //Data Body
        $body = array(
            'class_style' => '',
            //Send Header to Body
            'header' => $this->templayout->set_header($data_album['al_name'], $data_album['al_description'], 'Album'),
            'body_data' => $body_data_send,
            'js_load' => $this->templayout->set_js_css('assets/js/plugins/play_album.js'),
        );

        $this->parser->parse('layout/body.tpl', $body);
    }

  
}

/* End of file playlist.php */
/* Location: ./application/controllers/album.php */