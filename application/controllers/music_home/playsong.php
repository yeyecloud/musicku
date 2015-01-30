<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Playsong extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('music_home/Mplaysong');
    }

    public function song($s_name, $s_id) {
        $data_info_song = $this->mglobal->get_info_song($s_id);
        $is_login = $this->ion_auth->logged_in();
        if ($is_login == TRUE) {
            $data_friend = $this->mglobal->all_friend($this->ion_auth->user()->row()->user_id);
        } else {
            $data_friend = FALSE;
        }
        $body_data = array(
            //aside
            'aside' => $this->templayout->set_aside(),
            'navtop' => $this->templayout->set_nav_top(),
            'jPlayer'=>$this->parser->parse('layout/jplayer.tpl',NULL,TRUE),
            /*
              Data Song
              Data Song in cat random,
              Data Tags
             */
           
            'info_song' => $data_info_song[0],
            'data_song_in_cat' => $this->Mplaysong->song_in_category($data_info_song[0]['cat_id'], 'RANDOM', 10),
            'data_tags' => $this->globallib->TagsName($data_info_song[0]['s_tags']),
            'data_comment' => $this->mglobal->Comment('SelectCommentForSong', NULL, NULL, NULL, $s_id, NULL, NULL, 5, 0),
            'data_num_comment' => $this->mglobal->Comment('CountCommentSong', NULL, NULL, NULL, $s_id, NULL, NULL, NULL, NULL),
            'data_random_song' => $this->mglobal->random_song_video(NULL, 1, 6, 'RANDOM'),
            'data_all_follower' => count($this->mglobal->Follow('all-follower', $data_info_song[0]['u_id'], NULL)),
            'data_all_following' => count($this->mglobal->Follow('all-following', $data_info_song[0]['u_id'], NULL)),
             'data_is_login' => $is_login,
            'data_friend' => $data_friend
        );
        $body_data_send = $this->parser->parse('music_home/play-song.tpl', $body_data, TRUE);
        //Data Body
        $body = array(
            'class_style' => '',
            //Send Header to Body
            'header' => $this->templayout->set_header($data_info_song[0]['s_name'], $data_info_song[0]['s_name'], 'Song'),
            'body_data' => $body_data_send,
            'js_load' => '<script type="text/javascript" src="' . base_url('assets/js/plugins/play_song.js') . '"></script>'
        );
        $this->parser->parse('layout/body.tpl', $body);
    }

}

/* End of file playsong.php */
/* Location: ./application/controllers/playsong.php */