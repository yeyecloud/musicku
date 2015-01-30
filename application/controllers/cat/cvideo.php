<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cvideo extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index($pages = 0) {

        // load thư viện cần thiết 
        $this->load->library('pagination');

        // cấu hình phân trang 
        $config['base_url'] = base_url('video'); // xác định trang phân trang
        $config['total_rows'] = $this->mglobal->song_in_cat('CountVideo', NULL, NULL, NULL);
        $config['per_page'] = 12;
        $config['uri_segment'] = 2;
        $this->pagination->initialize($config);
        $body_data = array(
            //aside
            'aside' => $this->templayout->set_aside(), //$aside_data_send,
            'navtop' => $this->templayout->set_nav_top(),
            /*
              Data
             */
            'data_pages' => $this->pagination->create_links(),
            'data_song' => $this->mglobal->song_in_cat('LimitVideo', NULL, $config['per_page'], $this->uri->segment(2)),
        );
        $body_data_send = $this->parser->parse('cat/vvideo.tpl', $body_data, TRUE);

        //Data Body
        $body = array(
            'class_style' => '',
            //Send Header to Body
            'header' => $this->templayout->set_header(lang('video'), lang('video'),'Category'),
            'body_data' => $body_data_send,
            'js_load' => $this->templayout->set_js_css('assets/js/plugins/home_music.js'),
        );

        $this->parser->parse('layout/body.tpl', $body);
    }

}
