<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('music_home/Mhome');
    }

    public function index()
    {

        $is_login = $this->ion_auth->logged_in();
        if ($is_login == TRUE) {
            $data_friend = $this->mglobal->all_friend($this->ion_auth->user()->row()->user_id);
        } else {
            $data_friend = FALSE;
        }
        $body_data = array(
            //aside
            'aside' => $this->templayout->set_aside(), //$aside_data_send,
            'navtop' => $this->templayout->set_nav_top(),
            //Update v1.1
            'jPlayer' => $this->parser->parse('layout/jplayer.tpl', NULL, TRUE),
            /*
              Data
              Data Song New Limit 12 (default)
              Data Video New Limit 8 (default)
              Data Top Views Week Limit 5 (default)
             */
            'data_song_new' => $this->mglobal->all_song_new(12, 1),
            'data_video_new' => $this->mglobal->all_song_new(8, 2),
            'data_top_week' => $this->Mhome->top_views_week(5),
            'data_is_login' => $is_login,
            'data_friend' => $data_friend
        );
        $body_data_send = $this->parser->parse('music_home/home.tpl', $body_data, TRUE);
        //Data Body
        $body = array(
            'class_style' => '',
            //Send Header to Body
            'header' => $this->templayout->set_header(NULL, NULL, 'Home'),
            'body_data' => $body_data_send,
            'js_load' => $this->templayout->set_js_css('assets/js/plugins/home_music.js'),
        );

        $this->parser->parse('layout/body.tpl', $body);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */