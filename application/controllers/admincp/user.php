<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('admincp/Muser');
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

    /* ##################################ADD USER####################################### */

    public function add() {

        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vadduser', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/adduser.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );

        $this->load->view('admincp/layout/body', $data);
    }

    /* ##################################MANAGE USER####################################### */

    public function manage() {

        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vmanageuser', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/manageuser.js"></script>
			<!-- DataTables JavaScript -->
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/jquery.dataTables.min.js"></script>
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/dataTables.bootstrap.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
    }

    /**
     * 
     * @description:Ajax Auto user name
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function auto_user() {
        $email = $this->input->post('email');
        $check_email = $this->ion_auth->email_check($email); //Check exist email

        if ($check_email === TRUE) {
            $result = array(
                'status' => FALSE,
                'messages' => $this->lang->line('notify_email_exists'),
            );
            echo json_encode($result);
            die();
        }
        $user_auto = explode('@', $email);
        $username = $user_auto[0];
        $check_user = $this->ion_auth->username_check($username);
        if ($check_user === TRUE) {
            /**
             * 
             * @description:For loop auto user name, if check user name not exist stop loop
             * @param-input:random + user
             * @return:string
             * 
             */
            for ($i = 0; $i <= 1000; $i++) {
                $username = $user_auto[0] . random_string('alnum', rand(1, 8));
                $check_user = $this->ion_auth->username_check($username);
                if ($check_user != TRUE) {
                    $result = array(
                        'status' => TRUE,
                        'messages' => $username
                    );
                    echo json_encode($result);
                    die();
                }
            }
        } else {
            $result = array(
                'status' => TRUE,
                'messages' => $username
            );
            echo json_encode($result);
            die();
        }
    }

    /**
     * 
     * @description:Ajax check user name
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function check_username() {
        if ($this->ion_auth->username_check($this->input->post('UserName')) != TRUE) {
            $result = array(
                'result' => TRUE
            );
        } else {
            $result = array(
                'result' => FALSE
            );
        }
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax add new user
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function add_User() {
        $Email = $this->input->post('Email');
        $UserName = $this->input->post('UserName');
        $Password = $this->input->post('Password');
        $First_name = $this->input->post('First_name');
        $Last_name = $this->input->post('Last_name');
        $group[] = (int) $this->input->post('Groups');
        $additional_data = array(
            'first_name' => $First_name,
            'last_name' => $Last_name,
        );
        $result = $this->ion_auth->register($UserName, $Password, $Email, $additional_data, $group); //Add new user
        if ($result == TRUE) {
            $result = array(
                'status' => TRUE,
                'messages' => $this->lang->line('notify_success')
            );
        } else {
            $result = array(
                'status' => FALSE,
                'messages' => $this->ion_auth->errors()
            );
        }
        echo json_encode($result);
    }

    /**
     * 
     * @description:Ajax manage user table
     * @param-input:POST
     * @return:tables format
     * 
     */
    public function manage_User_Table() {
        echo $this->Muser->show_all_user_datatables();
    }

    /**
     * 
     * @description:Ajax reset password
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function reset_password() {
        $id = (int) $this->input->post('id');
        $Password = $this->input->post('Password');
        $data = array(
            'password' => $Password
        );
        if ($this->ion_auth->update($id, $data) == TRUE) {
            $result = array(
                'status' => TRUE,
                'messages' => $this->lang->line('reset_password_success') . $Password
            );
            echo json_encode($result);
        } else {
            $result = array(
                'status' => FALSE,
                'messages' => $this->ion_auth->errors()
            );
            echo json_encode($result);
        }
    }
    /**
     * 
     * @description:Ajax delete user
     * @param-input:POST
     * @return:JSON format
     * 
     */
    public function delete_user(){
		$u_id=(int)$this->input->post('u_id');
		$result=array(
			'status'=>$this->ion_auth->delete_user($u_id)
		);
		echo json_encode($result);
	}

}

/* End of file user.php */
/* Location: ./application/controllers/admincp/user.php */
