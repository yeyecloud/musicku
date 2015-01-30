<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Palbum extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('admincp/malbum');
    }

    public function index($pages = 0) {


        $this->load->library('pagination');

        // cấu hình phân trang 
        $config['base_url'] = base_url('list-album');
        $config['total_rows'] = count($this->malbum->showalbum());
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
            'data_album' => $this->malbum->LoadAlbumPages($config['per_page'], $this->uri->segment(2)),
        );
        $body_data_send = $this->parser->parse('album/vpalbum.tpl', $body_data, TRUE);

        //Data Body
        $body = array(
            'class_style' => '',
            //Send Header to Body
            'header' => $this->templayout->set_header('Album', 'Album', 'Album'),
            'body_data' => $body_data_send,
            'js_load' => $this->templayout->set_js_css('assets/js/plugins/home_music.js'),
        );

        $this->parser->parse('layout/body.tpl', $body);
    }

}
