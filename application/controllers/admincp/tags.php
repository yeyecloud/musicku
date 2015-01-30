<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tags extends CI_Controller {

    public function __construct() {

        parent::__construct();

        if ($this->ion_auth->is_admin() !== TRUE) {
            show_404();
            die();
        }
        if ($this->session->userdata('admin_login') != TRUE) {
            redirect(base_url('admincp/login'));
        }
        $this->load->model('admincp/Mtags'); //Load model
    }

    /*     * ********************ADD TAGS******************************** */

    public function add() {

        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vaddtags', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/addtags.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );

        $this->load->view('admincp/layout/body', $data);
    }

    /*     * ********************MANAGE TAGS******************************** */

    public function manage() {

        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vmanagetags', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/managetags.js"></script>
			<!-- DataTables JavaScript -->
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/jquery.dataTables.min.js"></script>
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/dataTables.bootstrap.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /**
     * 
     * @description:Check tags name
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function check_tags_name() {

        if ($this->Mtags->m_check_tags_name($this->input->post('tags_name')) == TRUE) {
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
     * @description:Ajax Add new tags name
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function add_tags() {
        $result = $this->Mtags->m_add_tags($this->input->post('TagsName'));
        $result = array(
            'status' => $result
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax datatables tags
     * @param-input:POST
     * @return:datatables format
     * 
     */
    public function datatables_tags() {

        echo $this->Mtags->show_all_tags_datatables();
    }

    /**
     * 
     * @description:Ajax check tags
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function check_tags() {
        $t_id = (int) $this->input->post('t_id');
        $t_tags = $this->input->post('t_tags');
        if ($this->Mtags->check_tags_id($t_id, $t_tags) == TRUE) {
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
     * @description:Ajax update tags
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function update_tags() {
        $t_id = (int) $this->input->post('t_id');
        $t_tags = $this->input->post('t_tags');
        $result = array(
            'status' => $this->Mtags->update_tags($t_id, $t_tags)
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax select tags
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function select_tags() {
        $t_id = (int) $this->input->post('t_id');
        $select = $this->mglobal->selectStags('t_tags', $t_id);

        $result = array(
            't_tags' => $select
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax delete tags
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function delete_tags() {
        $t_id = (int) $this->input->post('t_id');
        $del = $this->Mtags->delete_tags($t_id);
        $result = array(
            'status' => $del
        );
        echo json_encode($result);
    }

}

/* End of file tags.php */
/* Location: ./application/controllers/admincp/tags.php */