<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if($this->ion_auth->is_admin() !== TRUE){
			show_404();
			die();
		}
		if($this->session->userdata('admin_login') != TRUE){
			redirect(base_url('admincp/login'));
		}
		$this->load->model('admincp/Msettings');
	}
	/**************MAIN SETTING********************/
	public function index()
	{
		
		//nav header
		$nav_send = $this->load->view('admincp/layout/nav_header',NULL,TRUE);
		$settings=$this->mglobal->LoadSettings();
		$body = array(
			'nav_header'  =>$nav_send,
			'all_category'=>$this->mglobal->select_all_category(),
			'data_settings'=>$settings[0],
		);
		$header_send = $this->load->view('admincp/layout/header',NULL,TRUE);
		$body_data = $this->load->view('admincp/vsettings',$body,TRUE);
		//Load Template
		$data = array(
			'header'   =>$header_send,
			'body_data'=>$body_data,
			'js_mode'  =>'<script src="'.base_url().'assets/admincp/js/apps/settings.js"></script>
			<script src="'.base_url().'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
		);

		$this->load->view('admincp/layout/body',$data);

	}
	/**************ADD NOTIFY SETTING********************/
	public function notify()
	{
		
		//nav header
		$nav_send = $this->load->view('admincp/layout/nav_header',NULL,TRUE);
		$body = array(
			'nav_header'  =>$nav_send
		);
		$header_send = $this->load->view('admincp/layout/header',NULL,TRUE);
		$body_data = $this->load->view('admincp/vadminnotify',$body,TRUE);
		//Load Template
		$data = array(
			'header'   =>$header_send,
			'body_data'=>$body_data,
			'js_mode'  =>'<script src="'.base_url().'assets/admincp/js/apps/adminnotify.js"></script>
			<script src="'.base_url().'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
		);

		$this->load->view('admincp/layout/body',$data);

	}
	/**************MANAGE NOTIFY SETTING********************/
	public function manage_notify()
	{
		
		//nav header
		$nav_send = $this->load->view('admincp/layout/nav_header',NULL,TRUE);
		$body = array(
			'nav_header'  =>$nav_send
		);
		$header_send = $this->load->view('admincp/layout/header',NULL,TRUE);
		$body_data = $this->load->view('admincp/vadminmanagenotify',$body,TRUE);
		//Load Template
		$data = array(
			'header'   =>$header_send,
			'body_data'=>$body_data,
			'js_mode'  =>'<script src="'.base_url().'assets/admincp/js/apps/adminmanagenotify.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/datatables/jquery.dataTables.min.js"></script>
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/dataTables.bootstrap.js"></script>'
		);

		$this->load->view('admincp/layout/body',$data);

	}
	
	//Ajax Update settings
	public function update_settings(){
		$set_title_song=$this->input->post('set_title_song');
		$set_description_song=$this->input->post('set_description_song');
		$set_analytics=$this->input->post('set_analytics',FALSE);
		$set_analytics=str_replace("[removed]",'',$set_analytics);
		$set_analytics='<script>'.$set_analytics.'</script>';
		$set_title_home=$this->input->post('set_title_home');
		$set_description_home=$this->input->post('set_description_home');
		$set_title_category=$this->input->post('set_title_category');
		$set_description_category=$this->input->post('set_description_category');
		$set_title_playlist=$this->input->post('set_title_playlist');
		$set_description_playlist=$this->input->post('set_description_playlist');
		$set_title_profile=$this->input->post('set_title_profile');
		$set_description_profile=$this->input->post('set_description_profile');
		$set_title_singer=$this->input->post('set_title_singer');
		$set_description_singer=$this->input->post('set_description_singer');
		$set_title_tags=$this->input->post('set_title_tags');
		$set_description_tags=$this->input->post('set_description_tags');
		$this->Msettings->update_settings($set_title_song,$set_description_song,$set_analytics,$set_title_home,$set_description_home,$set_title_category,$set_description_category,$set_title_playlist,$set_description_playlist,$set_title_profile,$set_description_profile,$set_title_singer,$set_description_singer,$set_title_tags,$set_description_tags);
		$result=array(
			'status'=>TRUE
		);
		echo json_encode($result);
	}
	//Add new Admin Notify
	public function add_admin_notify(){
		$content=$this->input->post('content');
		$result=array(
			'status'=>$this->Msettings->add_admin_notify($content)
		);
		echo json_encode($result);
	}
	//Datatables manage notify
	public function datatables_adminmanagenotify(){
		echo $this->Msettings->show_all_admin_notify_datatables();
	}
	//Delete notify
	public function delete_notify(){
		$notify_id=(int)$this->input->post('notify_id');
		$result=array(
			'status'=>$this->Msettings->delete_notify($notify_id)
		);
		echo json_encode($result);
	}
	

}
