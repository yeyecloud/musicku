<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Playlist extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function pllist($pl_name, $pl_id) {
    	
    	 $is_login = $this->ion_auth->logged_in();
        if ($is_login == TRUE) {
            $data_friend = $this->mglobal->all_friend($this->ion_auth->user()->row()->user_id);
        } else {
            $data_friend = FALSE;
        }
    	
        $this->mglobal->playlist_user('update-views', $pl_id, NULL, NULL, NULL, NULL);
        $data_playlist = $this->mglobal->playlist_user('select-pl', $pl_id, NULL, NULL, NULL, NULL);
        $data_s_id_pl = '';
        $data_s_name_pl = '';
        $data_si_name_pl = '';
        $data_s_url_pl = '';

        if ($data_playlist[0]['s_id'] != FALSE) {
            $s_id_arr = unserialize($data_playlist[0]['s_id']);
            krsort($s_id_arr);
            foreach ($s_id_arr as $key => $val) {
                $data_song = $this->mglobal->info_song_fast_one($val, '*');
                $data_s_id_pl[]=$val;
                $data_s_name_pl[]=$data_song[0]['s_name'];
                $data_si_name_pl[]=$data_song[0]['si_name'];
                $data_s_url_pl[]=$data_song[0]['s_url'];
            }
        }
        if ($this->ion_auth->logged_in() === TRUE && $data_playlist[0]['u_id'] === $this->ion_auth->user()->row()->user_id) {
            $login = TRUE;
        } else {
            $login = FALSE;
        }
        $body_data = array(
            //Langguage

            'aside' => $this->templayout->set_aside(), //$aside_data_send,
            'navtop' => $this->templayout->set_nav_top(),
            'jPlayer'=>$this->parser->parse('layout/jplayer.tpl',NULL,TRUE),
            /*
              Data Playlist
             */
            'data_login' => (bool) $login,
            'data_playlist' => $data_playlist[0],
            'data_s_id_pl' => $data_s_id_pl,
            'data_s_name_pl' => $data_s_name_pl,
            'data_si_name_pl' => $data_si_name_pl,
            'data_s_url_pl' => $data_s_url_pl,
            'data_pl_random' => $this->mglobal->playlist_user('select-random', NULL, NULL, NULL, NULL, NULL),
            'data_is_login' => $is_login,
            'data_friend' => $data_friend
        );
        $body_data_send = $this->parser->parse('music_home/play-list.tpl', $body_data, TRUE);

        //Data Body
        $body = array(
            'class_style' => '',
            //Send Header to Body
            'header' => $this->templayout->set_header($data_playlist[0]['pl_name'], $data_playlist[0]['pl_name'], 'Playlist'),
            'body_data' => $body_data_send,
            'js_load' => $this->templayout->set_js_css('assets/js/plugins/play_playlist.js'),
        );

        $this->parser->parse('layout/body.tpl', $body);
    }

    public function delete_song_playlist() {
        $pl_id = $this->input->post('pl_id');
        $s_id = $this->input->post('s_id');
        $u_id = $this->ion_auth->user()->row()->user_id;
        if ($this->mglobal->playlist_user('check-pl-u', $pl_id, $u_id, NULL, NULL, NULL) == TRUE) {
            $this->mglobal->playlist_user('delete-song', $pl_id, $u_id, $s_id, NULL, NULL);
            $result = array(
                'status' => TRUE,
                'messages' => $this->lang->line('notify_success_delete_song')
            );
        } else {
            $result = array(
                'status' => FALSE,
                'messages' => $this->lang->line('notify_not_delete_song')
            );
        }
        echo json_encode($result);
    }

}

/* End of file playlist.php */
/* Location: ./application/controllers/playlist.php */