<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Song extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('admincp/Msong');
        /**
         * 
         * @description:Check login admin
         * @param-input:session
         * @return:var
         * 
         */
        if ($this->ion_auth->is_admin() !== TRUE) {
            show_404();
            die();
        }
        if ($this->session->userdata('admin_login') != TRUE) {
            redirect(base_url('admincp/login'));
        }
    }

    /*     * ******************************* ADD SONG************************************ */

    public function add() {

        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send,
            'all_category' => $this->mglobal->select_all_category()
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vaddsong', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/addsong.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );

        $this->load->view('admincp/layout/body', $data);
    }

    /*     * *******************************EDIT SONG************************************ */

    public function edit($s_id) {
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $info_song = $this->mglobal->get_info_song($s_id);
        $tags_id = explode(',', $info_song[0]['s_tags']);
        foreach ($tags_id as $val) {
            $tags_name[] = trim($this->mglobal->selectStags('t_tags', $val));
        }
        $tags_name = implode(",", $tags_name);
        $body = array(
            'nav_header' => $nav_send,
            'all_category' => $this->mglobal->select_all_category(),
            'info_song' => $info_song[0],
            'tags_name' => $tags_name,
            's_id' => $s_id
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/veditsong', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/editsong.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /*     * *******************************MANAGE SONG************************************ */

    public function manage() {
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        //Load dataalbum
        $this->load->model('admincp/Malbum');
        $body = array(
            'nav_header' => $nav_send,
            'album'=>$this->Malbum->showalbum()
        );
        
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vmanagesong', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/managesong.js"></script>
			<!-- DataTables JavaScript -->
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/jquery.dataTables.min.js"></script>
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/dataTables.bootstrap.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /**
     * 
     * @description:Ajax auto url song
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function url_song() {

        $result = array(
            'result' => $this->globallib->autoUrl($this->input->post('song_name'))
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax check link song or video
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function link_song_video() {
        $link_song = prep_url($this->input->post('link_song'));
        $type = $this->input->post('type_link');
        if ($type == 2) {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link_song, $match)) {
                @$id = $match[1];
            } elseif (preg_match('#' . base_url('uploads/mp4/') . '(.*)#') == TRUE) {
                @$id = $match[1];
            }
        } elseif ($type == 1) {
            if (preg_match('%(?:soundcloud.com)/(.*)/(.*)%i', $link_song, $match)) {
                @$id = $match[2];
            } elseif (preg_match('#' . base_url('uploads/mp3/') . '(.*)#') == TRUE) {
                @$id = $match[1];
            }
        }
        if (@$id == '' || @$id == FALSE) {
            $result = FALSE;
        } else {
            $result = TRUE;
        }

        $result = array(
            'result' => (bool) $result
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax datatables
     * @param-input:POST
     * @return:datatables format
     * 
     */
    public function datatables_song() {

        echo $this->Msong->show_all_song_datatables();
    }

}

/* End of file song.php */
/* Location: ./application/controllers/admincp/song.php */