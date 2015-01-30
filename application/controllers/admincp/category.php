<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Category extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('admincp/Mcategory'); //Load model
    }

    /*     * *******************ADD NEW CATEGORY******************** */

    public function addnew() {
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
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vaddcategory', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/addcategory.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /*     * *******************MANAGE CATEGORY******************** */

    public function manage() {
        if ($this->ion_auth->is_admin() !== TRUE) {
            show_404();
            die();
        }
        if ($this->session->userdata('admin_login') != TRUE) {
            redirect(base_url('admincp/login'));
        }
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send,
            'all_category' => $this->mglobal->select_all_category()
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vmanagecategory', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/managecategory.js"></script>
			<!-- DataTables JavaScript -->
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/jquery.dataTables.min.js"></script>
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/dataTables.bootstrap.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /*     * *******************EDIT CATEGORY******************** */

    public function edit($cat_id) {
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
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $info_cat = $this->mglobal->get_info_category($cat_id);
        $tags_id = explode(',', $info_cat[0]['cat_tag']);
        foreach ($tags_id as $val) {
            $tags_name[] = trim($this->mglobal->selectStags('t_tags', $val));
        }
        $tags_name = implode(",", $tags_name);
        $body = array(
            'nav_header' => $nav_send,
            'info_cat' => $info_cat[0],
            'tags_name' => $tags_name,
            'cat_id' => $cat_id
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/veditcategory', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/editcategory.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /**
     * 
     * @description:Ajax auto url
     * @method:post
     * @param-input:get method
     * @return:JSON format
     * 
     */
    public function url_category() {
        $song_name = $this->input->post('category_name');
        $result = array(
            'result' => url_title($song_name)
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax add new category
     * @method:post
     * @param-input:get method
     * @return:JSON format
     * 
     */
    public function insert_category() {
        $CategoryName = $this->input->post('CategoryName');
        $CategoryUrl = $this->input->post('CategoryUrl');
        $CategoryImg = $this->input->post('CategoryImg');
        $CategoryTags = $this->input->post('CategoryTags');
        $CategoryType = (int) $this->input->post('CategoryType');
        $CategoryDescription = $this->input->post('CategoryDescription');
        $result = $this->Mcategory->m_add_update_category('insert', $CategoryName, $CategoryUrl, $CategoryTags, $CategoryImg, $CategoryType, $CategoryDescription);
        $result = array(
            'result' => $result
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax update category
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function update_category() {
        $cat_id = (int) $this->input->post('cat_id');
        $CategoryName = $this->input->post('CategoryName');
        $CategoryUrl = $this->input->post('CategoryUrl');
        $CategoryImg = $this->input->post('CategoryImg');
        $CategoryTags = $this->input->post('CategoryTags');
        $CategoryType = (int) $this->input->post('CategoryType');
        $CategoryDescription = $this->input->post('CategoryDescription');
        $result = $this->Mcategory->m_add_update_category('update', $CategoryName, $CategoryUrl, $CategoryTags, $CategoryImg, $CategoryType, $CategoryDescription, $cat_id);
        $result = array(
            'result' => $result
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax all database category
     * @param-input:Ajax datatbles
     * @return:datatables format
     * 
     */
    public function datatables_category() {
        echo $this->Mcategory->show_all_category_datatables();
    }

    /**
     * 
     * @description:Ajax Delete category
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function count_category() {
        $cat_id = (int) $this->input->post('cat_id');
        $count = (int) $this->mglobal->count_song_category($cat_id);
        $result = array(
            'result' => $count
        );
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax Delete category
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function delete_category() {
        $CategoryDel = (int) $this->input->post('CategoryDel');
        $CategoryConvert = (int) $this->input->post('CategoryConvert');
        $result = $this->Mcategory->m_delete_category($CategoryDel, $CategoryConvert);
        $result = array(
            'result' => $result
        );
        echo json_encode($result);
    }

}

/* End of file category.php */
/* Location: ./application/controllers/admincp/category.php */