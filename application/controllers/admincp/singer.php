<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Singer extends CI_Controller {

    public function __construct() {

        parent::__construct();
        if ($this->ion_auth->is_admin() !== TRUE) {
            show_404();
            die();
        }
        if ($this->session->userdata('admin_login') != TRUE) {
            redirect(base_url('admincp/login'));
        }

        $this->load->model('admincp/Msinger'); //Load model
    }

    /*     * *************ADD SINGER********************** */

    public function add() {
        /**
         * 
         * @description:Check login admin
         * @param-input:session
         * @return:var
         * 
         */
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vaddsinger', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/addsinger.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );

        $this->load->view('admincp/layout/body', $data);
    }

    /*     * *************EDIT SINGER********************** */

    public function edit($si_id) {
        /**
         * 
         * @description:Check login admin
         * @param-input:session
         * @return:var
         * 
         */
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $info_singer = $this->mglobal->selectSinger('si_id', $si_id, NULL, NULL);

        $body = array(
            'nav_header' => $nav_send,
            'info_singer' => $info_singer[0],
            'si_id' => $si_id
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/veditsinger', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/editsinger.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /*     * *************MANAGE SINGER********************** */

    public function manage() {

        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vmanagesinger', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/managesinger.js"></script>
			<!-- DataTables JavaScript -->
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/jquery.dataTables.min.js"></script>
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/dataTables.bootstrap.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /**
     * 
     * @description:Ajax check exist singer name
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function check_singer_name() {

        $singer_name = $this->input->post('singer_name');
        if ($this->Msinger->m_check_singer_name($singer_name) == TRUE) {
            $result = array(
                'status' => FALSE
            );
        } else {
            $result = array(
                'status' => TRUE
            );
        }
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax auto url singer
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function auto_url_singer() {
        $result = array(
            'url' => $this->globallib->autoUrl($this->input->post('singer_name'))
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax check exist singer url
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function check_singer_url() {

        if ($this->Msinger->m_check_singer_url($this->input->post('singer_url')) == TRUE) {
            $result = array(
                'status' => FALSE
            );
        } else {
            $result = array(
                'status' => TRUE
            );
        }
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax add new singer
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function add_singer() {
        $SingerName = $this->input->post('SingerName');
        $SingerUrl = $this->input->post('SingerUrl');
        $SingerImg = $this->input->post('SingerImg');
        $SingerBirthday = $this->input->post('SingerBirthday');
        $SingerDescription = $this->input->post('SingerDescription');
        $this->Msinger->m_add_singer($SingerName, $SingerUrl, $SingerImg, $SingerBirthday, $SingerDescription);
        $result = array(
            'status' => TRUE
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Check singer name
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function check_singer_name_id() {

        $singer_name = $this->input->post('singer_name');
        $singer_id = (int) $this->input->post('singer_id');
        if ($this->Msinger->m_check_singer_name_id($singer_name, $singer_id) == TRUE) {
            $result = array(
                'status' => FALSE
            );
        } else {
            $result = array(
                'status' => TRUE
            );
        }
        echo json_encode($result);
    }

    /**
     * 
     * @description:Check singer url
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function check_singer_url_id() {
        $singer_url = $this->input->post('singer_url');
        $singer_id = (int) $this->input->post('singer_id');
        if ($this->Msinger->m_check_singer_url_id($singer_url, $singer_id) == TRUE) {
            $result = array(
                'status' => FALSE
            );
            echo json_encode($result);
        } else {
            $result = array(
                'status' => TRUE
            );
            echo json_encode($result);
        }
    }

    //Ajax Update Singer
    public function update_singer() {
        $si_id = (int) $this->input->post('si_id');
        $SingerName = $this->input->post('SingerName');
        $SingerUrl = $this->input->post('SingerUrl');
        $SingerImg = $this->input->post('SingerImg');
        $SingerBirthday = $this->input->post('SingerBirthday');
        $SingerDescription = $this->input->post('SingerDescription');
        $result = $this->Msinger->m_update_singer($si_id, $SingerName, $SingerUrl, $SingerImg, $SingerBirthday, $SingerDescription);
        $result = array(
            'status' => $result
        );
        echo json_encode($result);
    }

    //Datatables
    public function datatables_singer() {

        echo $this->Msinger->show_all_singer_datatables();
    }

    //Ajax Delete Singer
    public function delete_singer() {
        $SingerNameConvert = $this->input->post('SingerName');
        $si_id = (int) $this->input->post('si_id');
        @$selectSinger = $this->mglobal->selectSinger('si_name', NULL, $SingerNameConvert, NULL);
        if (@$selectSinger[0]['si_id'] === $si_id || @$selectSinger[0]['si_id'] == FALSE || @$selectSinger[0]['si_id'] == NULL) {
            $result = array(
                'status' => FALSE,
                'messages' => $this->lang->line('notify_singer_delete_false')
            );
        } else {

            $this->Msinger->delete_singer($si_id, $selectSinger[0]['si_id']);
            $result = array(
                'status' => TRUE
            );
        }

        echo json_encode($result);
    }

    //Total Song From Singer
    public function total_song_from_singer() {
        $si_id = (int) $this->input->post('si_id');
        $total = $this->mglobal->selectSinger('total_song', $si_id, NULL, NULL);
        $total = str_replace('{number}', $total, $this->lang->line('all_song_from_singer'));
        $result = array(
            'total' => $total
        );
        echo json_encode($result);
    }

}

/* End of file singer.php */
/* Location: ./application/controllers/admincp/singer.php */