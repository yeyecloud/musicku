<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ccat extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index($cat_url,$cat_id,$pages = 0) {

        // load thư viện cần thiết 
        $this->load->library('pagination');

        // cấu hình phân trang 
        $config['base_url'] = base_url('category/'.$cat_url.'-'.$cat_id); // xác định trang phân trang
        $config['total_rows'] = $this->mglobal->song_in_cat('CountSongInCat', $cat_id, NULL, NULL);
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $body_data = array(
            //aside
            'aside' => $this->templayout->set_aside(), //$aside_data_send,
            'navtop' => $this->templayout->set_nav_top(),
            /*
              Data
             */
            'data_pages' => $this->pagination->create_links(),
            'data_song' => $this->mglobal->song_in_cat('LimitSongInCat', $cat_id, $config['per_page'], $this->uri->segment(3)),
        );
      	if($body_data['data_song'][0]['s_type']==1){
			$body_data_send = $this->parser->parse('cat/vsong.tpl', $body_data, TRUE);
		}else{
			$body_data_send = $this->parser->parse('cat/vvideo.tpl', $body_data, TRUE);
		}
        

        //Data Body
        $body = array(
            'class_style' => '',
            //Send Header to Body
            'header' => $this->templayout->set_header($cat_url, $cat_url,'Category'),
            'body_data' => $body_data_send,
            'js_load' => $this->templayout->set_js_css('assets/js/plugins/home_music.js'),
        );

        $this->parser->parse('layout/body.tpl', $body);
    }

}
