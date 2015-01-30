<?php 
if( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Class Album (Controller)
* @datecreate: 2014-10-26
* @version:Update v1.1
* @author:Truong Nguyen
*/
class Album extends CI_Controller {
	
	 public function __construct() {
        parent::__construct();
        if ($this->ion_auth->is_admin() !== TRUE) {
            show_404();
            die();
        }
        if ($this->session->userdata('admin_login') != TRUE) {
            redirect(base_url('admincp/login'));
        }
        $this->load->model('admincp/malbum');
    }
	
	/**
	* Create album
	*/
	public function create(){
		//nav header
		$nav_send = $this->load->view('admincp/layout/nav_header',NULL,TRUE);
		$body = array(
			'nav_header'  =>$nav_send
		);
		$header_send = $this->load->view('admincp/layout/header',NULL,TRUE);
		$body_data = $this->load->view('admincp/vaddalbum',$body,TRUE);
		//Load Template
		$data = array(
			'header'   =>$header_send,
			'body_data'=>$body_data,
			'js_mode'  =>'<script src="'.base_url().'assets/admincp/js/apps/addalbum.js"></script>
			<script src="'.base_url().'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
		);

		$this->load->view('admincp/layout/body',$data);
	}
	/**
	* Auto Url
	*/
	public function AutoUrl(){
		$result=array(
			'status'=>TRUE,
			'url'=>$this->globallib->autoUrl($this->input->post('al_name'))
		);
		echo json_encode($result);
	}
	/**
	* Ajax Create Album
	* input:string
	* -al_name
	* -al_url
	* -al_description
	* -al_image
	*/
	public function ajaxcreatealbum(){
		$al_name=$this->input->post('al_name');
		$al_url=$this->input->post('al_url');
		$al_description=$this->input->post('al_description');
		$al_image=$this->input->post('al_image');
		//Array data insert
		$data=array(
			'al_name'=>$al_name,
			'al_url'=>$al_url,
			'al_description'=>$al_description,
			'al_image'=>$al_image
		);
		$create=$this->malbum->create($data);
		$result=array(
			'status'=>$create
		);
		echo json_encode($result);
	}
	/**
	* Add song to album
	* input:string
	* -al_id
	* -s_id
	* output:json
	*/
	public function addsongtoalbum(){
		$al_id=$this->input->post('al_id');
		$s_id=$this->input->post('s_id');
		//Check stype song 
		$info_song=$this->mglobal->info_song_fast_one($s_id);
		$info_song=$info_song[0];
		//Check Exist song 
		if($this->malbum->CheckExistSongInAlbum($al_id,$s_id)==TRUE){
			$result=array(
				'status'=>FALSE,
				'messages'=>lang('album_song_exist_album')
			);
		}elseif($info_song['s_type']!=1){
			$result=array(
				'status'=>FALSE,
				'messages'=>lang('album_error_song_type2')
			);
		} else{
			$this->malbum->AddSongToAlbum($al_id,$s_id);
			$result=array(
				'status'=>TRUE,
				'messages'=>lang('album_song_add_success')
			);
		}
		echo json_encode($result);
	}
	/**
	* Manage album
	*/
	public function manage(){
		
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $body = array(
            'nav_header' => $nav_send,
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/vmanagealbum', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/managealbum.js"></script>
			<!-- DataTables JavaScript -->
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/jquery.dataTables.min.js"></script>
		    <script src="' . base_url() . 'assets/admincp/js/plugins/datatables/dataTables.bootstrap.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
	}
	/**
	* Datatables category 
	*/
	public function datatables_album(){
		echo $this->malbum->show_all_album_datatables();
	}
	/**
	* Edit Album
	*/
	public function edit($al_id){
		
        //nav header
        $nav_send = $this->load->view('admincp/layout/nav_header', NULL, TRUE);
        $info_album = $this->malbum->InfoAlbum($al_id);
        $body = array(
            'nav_header' => $nav_send,
            'info_album' => $info_album[0],
        );
        $header_send = $this->load->view('admincp/layout/header', NULL, TRUE);
        $body_data = $this->load->view('admincp/veditalbum', $body, TRUE);
        //Load Template
        $data = array(
            'header' => $header_send,
            'body_data' => $body_data,
            'js_mode' => '<script src="' . base_url() . 'assets/admincp/js/apps/editalbum.js"></script>
			<script src="' . base_url() . 'assets/admincp/js/plugins/Ajaxupload/liteUploader.min.js"></script>'
        );
        $this->load->view('admincp/layout/body', $data);
	}
	/**
	* Ajax Edit Album
	* Input:string
	* -al_name
	* -al_url
	* -al_description
	* -al_image
	* -al_image_old
	*/
	public function ajaxeditalbum(){
		$al_name=$this->input->post('al_name');
		$al_url=$this->input->post('al_url');
		$al_description=$this->input->post('al_description');
		$al_image=$this->input->post('al_image');
		$al_image_old=$this->input->post('al_image_old');
		$al_id=$this->input->post('al_id');
		$data=array(
			'al_name'=>$al_name,
			'al_url'=>$al_url,
			'al_description'=>$al_description,
			'al_image'=>$al_image,
			'al_image_old'=>$al_image_old,
			'al_id'=>$al_id,
		);
		$result=array(
			'status'=>$this->malbum->EditAlbum($data)
		);
		echo json_encode($result);
	}
	/**
	* Delete album
	* input:int 
	* -al_id
	* ouput:json
	*/
	public function ajaxdeletealbum(){
		$al_id=$this->input->post('al_id');
		$result=array(
			'status'=>$this->malbum->DeleteAlbum($al_id)
		);
		echo json_encode($result);
	}
	/**
	* Ajax Manage song on album
	* input:int 
	* -al_id
	* output:json-html
	*/
	public function ajaxmanagesonginalbum(){
		$al_id=$this->input->post('al_id');
		$info=$this->malbum->InfoAlbum($al_id);
		$info=$info[0];
		if($info['al_content']==FALSE){
			$result=array(
				'status'=>FALSE
			);
		}else{
			$content=unserialize($info['al_content']);
			$html='';
			foreach ($content as $k=>$v){
				$info_song=$this->mglobal->info_song_fast_one($v);
				$info_song=$info_song[0];
				$html .='<li id="li-song-'.$info_song['s_id'].'" class="list-group-item"><i class="fa fa-music"></i>&nbsp;<span onclick="delete_song_in_album('.$info_song['s_id'].','.$al_id.',&#39;'.lang('how_to_delete').'&#39;)" class="pull-right"><i class="fa fa-times"></i></span>'.$info_song['s_name'].'</li>';
			}
			$result=array(
				'status'=>TRUE,
				'html'=>$html
			);
		}
		
		echo json_encode($result);
		
	}
	/**
	* Delete song in album
	* input:s_id,al_id
	* ouput:bool
	*/
	public function ajaxdeletesonginalbum(){
		$s_id=$this->input->post('s_id');
		$al_id=$this->input->post('al_id');
		$result=array(
			'status'=>$this->malbum->DeleteSongInAlbum($s_id,$al_id)
		);
		echo json_encode($result);
	}
}