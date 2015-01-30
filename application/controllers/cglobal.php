<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cglobal extends CI_Controller {

    public function __construct() {

        parent::__construct();

    }

    //Singer Json
    public function collection_singer_json() {
        $data = $this->mglobal->mcollection_singer_json();
        $result = '';
        foreach ($data as $k => $v) {
            $result .= '' . trim($v['si_name']) . '' . '%';
        }

        $result = substr($result, 0, - 1);
        $result_ar = explode('%', $result);
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result_ar));
    }

    //Tags Json
    public function collection_tags_json() {
        $data = $this->mglobal->mcollection_tags_json();
        $result = '';
        foreach ($data as $k => $v) {
            $result .= '' . trim($v['t_tags']) . '' . '%';
        }

        $result = substr($result, 0, - 1);
        $result_ar = explode('%', $result);
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result_ar));
    }

    /*
      Uploads
      Upload Local Images
     */

    public function do_upload() {
        $type = $this->input->post('type');
        if ($type == 'img') {
            $config['upload_path'] = FCPATH . 'uploads/images';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $name_field = 'file_upload_images';
            $config['file_name'] = $this->input->cookie('song_name');
        } elseif ($type == 'audio') {
            $config['upload_path'] = FCPATH . 'uploads/mp3';
            $config['allowed_types'] = 'mp3';
            $name_field = 'file_upload_audio';
            $config['file_name'] = $this->input->cookie('song_name');
        } elseif ($type == 'video') {
            $config['upload_path'] = FCPATH . 'uploads/mp4';
            $config['allowed_types'] = 'mp4';
            $name_field = 'file_upload_video';
            $config['file_name'] = $this->input->cookie('song_name');
        } elseif ($type == 'img_category') {
            $config['upload_path'] = FCPATH . 'uploads/img_category';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $name_field = 'file_upload_img_category';
            $config['file_name'] = $this->input->cookie('category_name');
        } elseif ($type == 'img_singer') {
            $config['upload_path'] = FCPATH . 'uploads/img_singer';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $name_field = 'file_upload_img_singer';
            $config['file_name'] = $this->input->cookie('singer_name');
        } elseif ($type == 'img_playlist') {
            $config['upload_path'] = FCPATH . 'uploads/img_playlist';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $name_field = 'file_upload_img_playlist';
            $config['file_name'] = $this->input->cookie('playlist_name');
        } elseif ($type == 'img_avatar') {
            $config['upload_path'] = FCPATH . 'uploads/img_avatar';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $name_field = 'file_upload_img_avatar';
            $config['file_name'] = $this->session->userdata('username');
        } elseif ($type=='img_album'){
			$config['upload_path'] = FCPATH . 'uploads/img_album';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $name_field = 'file_upload_img_album';
            $config['file_name'] = $this->input->cookie('album_name');
		}


        $this->load->library("upload", $config);
        if (!$this->upload->do_upload($name_field)) {
            $image_data = array($this->upload->display_errors());
            $result = array(
                "file_name" => FALSE,
                "error" => $image_data
            );
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($result));
        } else {
            $image_data = $this->upload->data();
            if ($type == 'img_playlist') {
                $this->load->library('image_lib');
                $config_resize['image_library'] = 'gd2';
                $config_resize['source_image'] = FCPATH . '/uploads/img_playlist/' . $image_data['file_name'];
                $config_resize['create_thumb'] = FALSE;
                $config_resize['maintain_ratio'] = FALSE;
                $config_resize['width'] = 400;
                $config_resize['height'] = 200;
                $config_resize['quality'] = '100%';
                $this->image_lib->clear();
                $this->image_lib->initialize($config_resize);
                $result = $this->image_lib->resize();
                $result = array(
                    'file_name' => $image_data['file_name'],
                    'error' => FALSE
                );
            } elseif ($type == 'img_avatar') {
                $this->load->library('image_lib');
                $config_resize['image_library'] = 'gd2';
                $config_resize['source_image'] = FCPATH . '/uploads/img_avatar/' . $image_data['file_name'];
                $config_resize['create_thumb'] = FALSE;
                $config_resize['maintain_ratio'] = FALSE;
                $config_resize['width'] = 128;
                $config_resize['height'] = 128;
                $config_resize['quality'] = '100%';
                $this->image_lib->clear();
                $this->image_lib->initialize($config_resize);
                $result = $this->image_lib->resize();
                $result = array(
                    'file_name' => $image_data['file_name'],
                    'error' => FALSE
                );
            }elseif($type=='img_album'){
            	$this->load->library('image_lib');
                $config_resize['image_library'] = 'gd2';
                $config_resize['source_image'] = FCPATH . '/uploads/img_album/' . $image_data['file_name'];
                $config_resize['create_thumb'] = FALSE;
                $config_resize['maintain_ratio'] = FALSE;
                $config_resize['width'] = 286;
                $config_resize['height'] = 290;
                $config_resize['quality'] = '100%';
                $this->image_lib->clear();
                $this->image_lib->initialize($config_resize);
                $result = $this->image_lib->resize();
                $result = array(
                    'file_name' => $image_data['file_name'],
                    'error' => FALSE
                );
            } else {
                $result = array(
                    'file_name' => $image_data['file_name'],
                    'error' => FALSE
                );
            }

            echo json_encode($result);
        }
    }

    //Ajax Add Song
    public function addSong() {
        $song_name = $this->input->post('song_name');
        $song_img = $this->input->post('song_img');
        $song_link = $this->input->post('song_link');
        $song_url = $this->input->post('song_url');
        $song_singer = $this->input->post('song_singer');
        $song_tags = $this->input->post('song_tags');
        $song_type = (int) $this->input->post('song_type');
        $song_cat = (int) $this->input->post('song_cat');
        $song_lyrics = $this->input->post('song_lyrics');
        $u_id = $this->session->userdata('user_id');
        $result = $this->mglobal->addSong_Update('insert', $song_cat, $u_id, $song_singer, $song_name, $song_name, $song_url, $song_link, $song_tags, $song_img, $song_type, now(), now(), $song_lyrics);
        if ($song_type == 1) {
            $type = 'song';
        } else {
            $type = 'video';
        }
        $result = array(
            'status' => TRUE,
            'link' => base_url($type . '/' . $song_url . '/' . $result)
        );
        echo json_encode($result);
    }

    //Ajax Update Song
    public function updateSong() {
        $song_name = $this->input->post('song_name');
        $song_img = $this->input->post('song_img');
        $song_link = $this->input->post('song_link');
        $song_url = $this->input->post('song_url');
        $song_singer = $this->input->post('song_singer');
        $song_tags = $this->input->post('song_tags');
        $song_type = (int) $this->input->post('song_type');
        $song_cat = (int) $this->input->post('song_cat');
        $song_lyrics = $this->input->post('song_lyrics');
        $u_id = $this->session->userdata('user_id');
        $s_id = (int) $this->input->post('s_id');
        $ly_id = (int) $this->input->post('ly_id');
        $result = $this->mglobal->addSong_Update('update', $song_cat, $u_id, $song_singer, $song_name, $song_name, $song_url, $song_link, $song_tags, $song_img, $song_type, now(), now(), $song_lyrics, $s_id, $ly_id);
        if ($song_type == 1) {
            $type = 'song';
        } else {
            $type = 'video';
        }
        $result = array(
            'status' => TRUE,
            'link' => base_url($type . '/' . $song_url . '/' . $result)
        );
        echo json_encode($result);
    }

    //Delete Song
    public function delete_song() {
        $s_id = (int) $this->input->post('s_id');
        if ($this->mglobal->delete_song($s_id) != FALSE) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }
        $result = array(
            'result' => $result
        );
        echo json_encode($result);
    }

    //Play One Song Now
    public function xml_play_song_now($s_id) {
        //Info Song
        $data_song = $this->mglobal->info_song_fast_one($s_id, '*');
        //Update View
        $this->mglobal->Insert_Update_View('update', $data_song[0]['v_id']);
        $xml_result = $this->creat_xml($data_song);
        $this->output
                ->set_content_type('application/xml')
                ->set_output($xml_result);
    }

    //Play Playlist 
    public function xml_play_playlist_now($pl_id) {
        //Play List
        $data_playlist = $this->mglobal->playlist_user('select-pl', $pl_id, NULL, NULL, NULL, NULL);
        $s_id_arr = unserialize($data_playlist[0]['s_id']);
        krsort($s_id_arr);
        $xml = '';
        foreach ($s_id_arr as $key => $val) {
            $data_song = $this->mglobal->info_song_fast_one($val, '*');
            $this->mglobal->Insert_Update_View('update', $data_song[0]['v_id']);
            $xml .=$this->creat_xml($data_song, TRUE);
        }
        $xml = $this->slit_join_xml_play_song('join', $xml);
        $this->output
                ->set_content_type('application/xml')
                ->set_output($xml);
    }
    //Play Album
    public function xml_play_album_now($al_id) {
        $this->load->model('admincp/malbum');
        $data_album = $this->malbum->InfoAlbum($al_id);
        $data_album=$data_album[0];
        $s_id_arr = unserialize($data_album['al_content']);
        
        $xml = '';
        foreach ($s_id_arr as $key => $val) {
            $data_song = $this->mglobal->info_song_fast_one($val, '*');
            $this->mglobal->Insert_Update_View('update', $data_song[0]['v_id']);
            $xml .=$this->creat_xml($data_song, TRUE);
        }
        $xml = $this->slit_join_xml_play_song('join', $xml);
        $this->output
                ->set_content_type('application/xml')
                ->set_output($xml);
    }

    //Play Video
    public function xml_play_video($s_id) {
        //Info Song
        $data_song = $this->mglobal->info_song_fast_one($s_id, '*');
        //Update View
        $this->mglobal->Insert_Update_View('update', $data_song[0]['v_id']);
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $data_song[0]['s_link'], $match)) {
            $video_id = $match[1];
            $this->load->library('youtube');
            $mp4 = '';
            $webm = '';
            $poster = "https://i.ytimg.com/vi/$video_id/hqdefault.jpg";
            $source=$this->youtube->GetVideo($video_id);
            foreach ($source as $k => $v) {
               if($v['type']=='video/webm'){
			   		$webm = $v['url'];
			   }
			   if($v['type']=='video/mp4'){
			   		$mp4 = $v['url'];
			   }
            }  
           
            $xml = array(
                $data_song[0]['s_name'],
                $poster,
                urlencode($mp4),
                urlencode($webm)
            );
            $xml_result = $this->creat_xml_video($xml);
            $xml_result = $this->slit_join_xml_play_video('join', $xml_result);
        }

        $this->output
                ->set_content_type('application/xml')
                ->set_output($xml_result);
    }

    //Creat Playlist Xml
    public function creat_xml($data, $playlist = FALSE) {
        switch ($playlist) {
            case FALSE:
                $xml = $this->slit_join_xml_play_song('slit', NULL);
                //array string replace
                $replace = array('{title}', '{artist}', '{mp3-link}');
                $content = '';
                foreach ($data as $val) {
                    if (strpos($val['s_link'], 'http') === 0) {
                        $this->load->library('NC_CURL');
                        $encode = urlencode($val['s_link']);
                        $urlAPI = 'https://api.soundcloud.com/resolve?url=' . $encode . '&_status_code_map%5B302%5D=200&_status_format=json&client_id=638fc4999600eff25637efea958f1513';
                        $curl = new NC_CURL;
                        $sourceFoundID = $curl->views_source($urlAPI);
                        $jsonID = json_decode($sourceFoundID);
                        $urlInfoTrack = preg_replace("/[0-9?]client_id/", "$1.json?client_id", $jsonID->location);
                        $sourceTrack = $curl->views_source($urlInfoTrack);
                        $jsonTrack = json_decode($sourceTrack);
                        $xdtag = $jsonTrack->title;
                        $id = $jsonTrack->id;
                        //URL
                        $urlInfoTrack = 'https://api.soundcloud.com/tracks/' . $id . '.json?client_id=638fc4999600eff25637efea958f1513';
                        $sourceTrack = $curl->views_source($urlInfoTrack);
                        $jsonTrack = json_decode($sourceTrack);
                        $url = $jsonTrack->stream_url . '?client_id=638fc4999600eff25637efea958f1513';

                        $link = $url;
                    } else {
                        $link = base_url('uploads/mp3/' . $val['s_link']);
                    }
                    $data_replace = array($val['s_name'], $val['si_name'], $link);
                    $content .=str_replace($replace, $data_replace, $xml[1]);
                }
                $xml_data = $this->slit_join_xml_play_song('join', $content);
                break;
            default:
                $xml = $this->slit_join_xml_play_song('slit', NULL);
                //array string replace
                $replace = array('{title}', '{artist}', '{mp3-link}');
                $content = '';
                foreach ($data as $val) {
                    if (strpos($val['s_link'], 'http') === 0) {
                        $this->load->library('NC_CURL');
                        $encode = urlencode($val['s_link']);
                        $urlAPI = 'https://api.soundcloud.com/resolve?url=' . $encode . '&_status_code_map%5B302%5D=200&_status_format=json&client_id=638fc4999600eff25637efea958f1513';
                        $curl = new NC_CURL;
                        $sourceFoundID = $curl->views_source($urlAPI);
                        $jsonID = json_decode($sourceFoundID);
                        $urlInfoTrack = preg_replace("/[0-9?]client_id/", "$1.json?client_id", $jsonID->location);
                        $sourceTrack = $curl->views_source($urlInfoTrack);
                        $jsonTrack = json_decode($sourceTrack);
                        $xdtag = $jsonTrack->title;
                        $id = $jsonTrack->id;
                        //URL
                        $urlInfoTrack = 'https://api.soundcloud.com/tracks/' . $id . '.json?client_id=638fc4999600eff25637efea958f1513';
                        $sourceTrack = $curl->views_source($urlInfoTrack);
                        $jsonTrack = json_decode($sourceTrack);
                        $url = $jsonTrack->stream_url . '?client_id=638fc4999600eff25637efea958f1513';

                        $link = $url;
                    } else {
                        $link = base_url('uploads/mp3/' . $val['s_link']);
                    }
                    $data_replace = array($val['s_name'], $val['si_name'], $link);
                    $content .=str_replace($replace, $data_replace, $xml[1]);
                }

                $xml_data = $content;
                break;
        }

        return $xml_data;
    }

    //Creat xml Video
    public function creat_xml_video($data) {

        $xml = $this->slit_join_xml_play_video('slit', NULL);
        //array string replace
        $replace = array('{title}', '{poster}', '{mp4-link}', '{webm-link}');

        $data_replace = array($data[0], $data[1], $data[2], $data[3]);
        $xml_data = str_replace($replace, $data_replace, $xml[1]);

        return $xml_data;
    }

    //slit_join_xml_play_song
    public function slit_join_xml_play_song($type, $content = NULL) {
        switch ($type) {
            case 'slit':
                $data = file_get_contents(base_url('xml/play-song.xml'));
                $data = explode('{slit}', $data);
                return $data; //array (3)

                break;

            case 'join':
                $data = file_get_contents(base_url('xml/play-song.xml'));
                $data = explode('{slit}', $data);
                $data = $data[0] . $content . $data[2];
                return $data;
                break;
        }
    }

    //Slit_join_xml_play_video
    public function slit_join_xml_play_video($type, $content = NULL) {
        switch ($type) {
            case 'slit':
                $data = file_get_contents(base_url('xml/play-video.xml'));
                $data = explode('{slit}', $data);
                return $data; //array (3)

                break;

            case 'join':
                $data = file_get_contents(base_url('xml/play-video.xml'));
                $data = explode('{slit}', $data);
                $data = $data[0] . $content . $data[2];
                return $data;
                break;
        }
    }

    //Logout
    public function logout() {
        $this->ion_auth->logout();
        $this->session->sess_destroy();
        $result = array(
            'status' => TRUE
        );
        echo json_encode($result);
    }

    //Creat Playlist
    public function creat_playlist() {
        $pl_name = $this->input->post('pl_name');
        $pl_img = $this->input->post('pl_img');
        if ($this->ion_auth->logged_in() == FALSE || $pl_name == '') {
            $result = array(
                'status' => FALSE,
                'messages' => $this->lang->line('please_log_in')
            );
            echo json_encode($result);
            die();
        }
        $u_id = $this->session->userdata('user_id');
        $count_playlist = $this->mglobal->playlist_user('check', NULL, 1, NULL, NULL, NULL);
        if ($count_playlist > 5) {
            $result = array(
                'status' => FALSE,
                'messages' => $this->lang->line('is_playlist_5')
            );
        } else {

            $creat = $this->mglobal->playlist_user('creat', NULL, $u_id, NULL, $pl_name, $pl_img);
            $messages = $this->lang->line('notify_success_creat_playlist');
            $messages = str_replace('{name}', $pl_name, $messages);
            $result = array(
                'status' => TRUE,
                'messages' => $messages
            );
        }
        echo json_encode($result);
    }

    //Add Song to Playlist
    public function addSongToPlayList() {
        $pl_id = (int) $this->input->post('pl_id');
        $s_id = (int) $this->input->cookie('s_id');
        if ($this->ion_auth->logged_in() == FALSE || $pl_id == '') {
            $result = array(
                'status' => FALSE,
                'messages' => $this->lang->line('please_log_in')
            );
            echo json_encode($result);
            die();
        }
        $checkSong = $this->mglobal->playlist_user('checkSongExist', $pl_id, $this->session->userdata('user_id'), $s_id, NULL);
        if ($checkSong == TRUE) {
            $result = array(
                'status' => FALSE,
                'messages' => $this->lang->line('notify_song_exist_playlist')
            );
            echo json_encode($result);
            die();
        }
        $addToPlaylist = $this->mglobal->playlist_user('addSongToPlayList', $pl_id, $this->session->userdata('user_id'), $s_id, NULL);

        $result = array(
            'status' => TRUE,
            'messages' => $this->lang->line('notify_add_song_to_playlist')
        );
        echo json_encode($result);
    }

    //Like Song
    public function LikeSong() {
        $l_id = $this->input->post('l_id');
        $u_id = $this->session->userdata('user_id');
        if ($u_id != FALSE && $l_id != FALSE) {
            if ($this->mglobal->LikeSong('CheckLike', $l_id, NULL, $u_id, NULL) == TRUE) {
                $this->mglobal->LikeSong('UnLike', $l_id, NULL, $u_id, NULL);
                $result = array(
                    'status' => TRUE,
                    'type' => 1,
                    'messages' => $this->lang->line('notify_unlike')
                );
            } else {
                $this->mglobal->LikeSong('AddLike', $l_id, NULL, $u_id, NULL);
                $result = array(
                    'status' => TRUE,
                    'type' => 2,
                    'messages' => $this->lang->line('notify_like')
                );
            }
        } else {
            $result = array(
                'status' => FALSE,
                'messages' => $this->lang->line('please_log_in')
            );
        }
        echo json_encode($result);
    }

    //Download Song
    public function creat_link_download($s_id) {
        $this->mglobal->update_download_song($s_id);
        $data_song = $this->mglobal->info_song_fast_one($s_id, '*');
        if (strpos($data_song[0]['s_link'], 'http') === 0) {
            $this->load->library('NC_CURL');
            $encode = urlencode($data_song[0]['s_link']);
            $urlAPI = 'https://api.soundcloud.com/resolve?url=' . $encode . '&_status_code_map%5B302%5D=200&_status_format=json&client_id=638fc4999600eff25637efea958f1513';
            $curl = new NC_CURL;
            $sourceFoundID = $curl->views_source($urlAPI);
            $jsonID = json_decode($sourceFoundID);
            $urlInfoTrack = preg_replace("/[0-9?]client_id/", "$1.json?client_id", $jsonID->location);
            $sourceTrack = $curl->views_source($urlInfoTrack);
            $jsonTrack = json_decode($sourceTrack);
            $xdtag = $jsonTrack->title;
            $id = $jsonTrack->id;
            //URL
            $urlInfoTrack = 'https://api.soundcloud.com/tracks/' . $id . '.json?client_id=638fc4999600eff25637efea958f1513';
            $sourceTrack = $curl->views_source($urlInfoTrack);
            $jsonTrack = json_decode($sourceTrack);
            $url = $jsonTrack->stream_url . '?client_id=638fc4999600eff25637efea958f1513';

            $link = $url;
            redirect($link);
        } else {
            $link = FCPATH . '/uploads/mp3/' . $data_song[0]['s_link'];
        }
        $name = $data_song[0]['s_name'];
        $this->_push_file($link, $name);
    }

    public function _push_file($path, $name) {
        // make sure it's a file before doing anything!
        if (is_file($path)) {
            // required for IE
            if (ini_get('zlib.output_compression')) {
                ini_set('zlib.output_compression', 'Off');
            }

            // get the file mime type using the file extension
            $this->load->helper('file');

            $mime = get_mime_by_extension($path);

            // Build the headers to push out the file properly.
            header('Pragma: public');     // required
            header('Expires: 0');         // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
            header('Content-Disposition: attachment; filename="' . basename($name) . '"');  // Add the file name
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($path)); // provide file size
            header('Connection: close');
            readfile($path); // push it out
            exit();
        }
    }

    //Add Comment
    public function addComment() {
        $type = $this->input->post('type');
        $user = $this->ion_auth->user()->row();
        $cm_text = $this->input->post('cm_text');
        switch ($type) {
            case 'CommentSong':
                $id_comment = $this->mglobal->Comment('AddComment', NULL, 1, $user->user_id, $this->input->post('s_id'), $cm_text, NULL, NULL, NULL);
                $data_song = $this->mglobal->info_song_fast_one($this->input->post('s_id'), '*');
                $messages = $this->lang->line('comment_notify');
                $messages = str_replace('{name}', $data_song[0]['s_name'], $messages);
                $url = '../song/' . $data_song[0]['s_url'] . '-' . $data_song[0]['s_id'];
                break;
            case 'CommentVideo':
                $id_comment = $this->mglobal->Comment('AddComment', NULL, 2, $user->user_id, $this->input->post('s_id'), $cm_text, NULL, NULL, NULL);
                $data_song = $this->mglobal->info_song_fast_one($this->input->post('s_id'), '*');
                $messages = $this->lang->line('comment_notify');
                $messages = str_replace('{name}', $data_song[0]['s_name'], $messages);
                $url = '../video/' . $data_song[0]['s_url'] . '-' . $data_song[0]['s_id'];
                break;
        }

        $this->globallib->SendNotifyListFriend('Friend', $user->user_id, $user->first_name . '&nbsp' . $user->last_name . '&nbsp;' . $messages, 2, $url);
        $gr = $this->ion_auth->get_users_groups($user->user_id)->result();
        if ($gr[0]->id == 1) {
            $gr = '<label class="label bg-danger m-l-xs">' . $gr[0]->name . '</label> ';
        } else {
            $gr = '<label class="label bg-info m-l-xs">' . $gr[0]->name . '</label> ';
        }
        $result = array(
            'status' => TRUE,
            'messages' => $this->lang->line('success'),
            'add_html' => '<article id="comment-id-' . $id_comment . '" class="comment-item">
		                      <a class="pull-left thumb-sm">
		                        <img src="' . $this->globallib->avatar($user->user_id) . '" class="img-circle">
		                      </a>
		                      <section class="comment-body m-b">
		                        <header>
		                          <a href="' . base_url('profile/' . $user->username . '-' . $user->user_id) . '"><strong>' . $user->first_name . '&nbsp;' . $user->last_name . '</strong></a>
		                          	' . $gr . '
		                          <i class="fa icon-close" onclick="delete_comment(' . $id_comment . ',&#39;' . $this->lang->line('how_to_delete') . '&#39;)"></i>
		                          	<span class="text-muted text-xs block m-t-xs">
		                            ' . timespan(now(), now()) . '
		                         	 </span>
		                        </header>
		                        <div class="m-t-sm">' . $cm_text . '</div>
		                      </section>
		                    </article>',
        );
        echo json_encode($result);
    }

    //Delete Comment
    public function DeleteComment() {
        $cm_id = (int) $this->input->post('cm_id');
        $this->mglobal->Comment('DeleteComment', $cm_id, NULL, $this->session->userdata('user_id'), NULL, NULL, NULL, NULL, NULL);
        $result = array(
            'status' => TRUE,
            'messages' => $this->lang->line('success')
        );
        echo json_encode($result);
    }

    //Search 
    public function search() {
        $keyword = strtolower(removesign($this->input->post('keyword')));
        $actions = $this->input->cookie('actions_search');
        switch ($actions) {
            case 'song':
                $result = $this->mglobal->search_song($keyword);

                break;
            case 'singer':
                $result = $this->mglobal->search_singer($keyword);

                break;

            case 'playlist':
                $result = $this->mglobal->search_playlist($keyword);
                break;
            case 'album':
            	$this->load->model('admincp/malbum');
            	$result=$this->malbum->search_album($keyword);
            break;
            default:
                $result = $this->mglobal->search_song($keyword);
                break;
        }

        $result = array(
            'result' => $result,
            'count_result' => count($result),
        );
        echo json_encode($result);
    }
	//Allow Friend
	public function allow_add_friend(){
		$u_send_id=(int)$this->input->post('u_id');
		$result=array(
			'status'=>$this->mglobal->Friend('AllowFriend', $this->session->userdata('user_id'), $u_send_id, 1)
		);
		echo json_encode($result);
	}
	//Denny Friend
	public function deny_add_friend(){
		$u_send_id=(int)$this->input->post('u_id');
		$result=array(
			'status'=>$this->mglobal->Friend('RemoveFriend', $this->session->userdata('user_id'), $u_send_id, 0)
		);
		echo json_encode($result);
	}
    //GET Img Song
    public function GetImgSong($img_song) {
        $result = $this->globallib->images_song($img_song);
        $result = array(
            'Img' => $result
        );
        echo json_encode($result);
    }

    
    //Admin logout
    public function logout_admin() {
        $this->session->set_userdata('admin_login', FALSE);
        return TRUE;
    }

}

/* End of file tags.php */
/* Location: ./application/controllers/admincp/tags.php */