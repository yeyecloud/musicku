<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Globallib {

    public function __construct() {
        $this->CI = & get_instance();
    }

    //Check Like
    public function CheckLike($l_id, $u_id, $data_like) {
        return $this->CI->mglobal->LikeSong('CheckLike', $l_id, NULL, $this->CI->session->userdata('user_id'), $data_like);
    }

    //Count Like
    public function CountLike($data_like) {
        return $this->CI->mglobal->LikeSong('CountLike', NULL, NULL, NULL, $data_like);
    }

    //Follow
    public function Follow($type, $u_id, $u_following) {
        $user = $this->CI->ion_auth->user()->row();
        switch ($type) {
            case 'check-following':
                return $this->CI->mglobal->Follow($type, $user->user_id, $u_following);
                break;
            default:
                break;
        }
    }

    //Friend
    public function Friend($type, $u_id, $u_fr, $fr_status) {
        $user = $this->CI->ion_auth->user()->row();
        switch ($type) {
            case 'CheckStatus':
                return $this->CI->mglobal->Friend($type, $user->user_id, $u_fr, NULL);
                break;

            default:
                break;
        }
    }

    //Check Online or Offline
    public function online($user_id) {
        $user = $this->CI->ion_auth->user($user_id)->row();
        $data = $this->CI->mglobal->online_offline($user->email);
        if ($data > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Auto Url
    public function autoUrl($url) {
        return url_title(removesign($url));
    }

    //Auto Avatar
    public function avatar($u_id) {
        $user = $this->CI->ion_auth->user($u_id)->row();
        if ($user->avatar == TRUE) {
            return base_url('uploads/img_avatar/' . $user->avatar);
        } else {
            return base_url('uploads/img_avatar/default-avatar.png');
        }
    }

    //Auto Images Song 
    public function images_song($img_song) {
        if (strpos($img_song, 'http') === 0) {
            return $img_song;
        } else {
            return base_url('uploads/images/' . $img_song);
        }
    }

    //Url profile
    public function UrlProfile($u_id, $username) {
        if (!is_null($username)) {
            return base_url('profile/' . $this->autoUrl($username) . '-' . $u_id);
        } else {
            $user = $this->CI->ion_auth->user($u_id)->row();
            return base_url('profile/' . $this->autoUrl($user->username) . '-' . $u_id);
        }
    }

    //Url Song
    public function UrlSong($s_id, $s_type = NULL, $s_url = NULL) {
        if (!is_null($s_type) && !is_null($s_url)) {
            if ($s_type == 2) {
                return base_url('video/' . $s_url . '-' . $s_id);
            } else {
                return base_url('song/' . $s_url . '-' . $s_id);
            }
        } else {
            $data_info_song = $this->CI->mglobal->info_song_fast_one($s_id, '*');
            if ($data_info_song[0]['s_type'] == 2) {
                return base_url('video/' . $data_info_song[0]['s_url'] . '-' . $s_id);
            } else {
                return base_url('song/' . $data_info_song[0]['s_url'] . '-' . $s_id);
            }
        }
    }

    //Url Playlist 
    public function UrlPlayList($pl_id, $pl_url) {
        return base_url('play-list/' . $pl_url . '-' . $pl_id);
    }
	//Url Category
	public function UrlCategory($cat_id,$cat_url){
		return base_url('category/'.$cat_url.'-'.$cat_id);
	}
	//Img Singer
	public function ImgSinger($si_img){
		return base_url('uploads/img_singer/'.$si_img);
	}
	//Url Singer 
	public function UrlSinger($si_id,$si_url){
		return base_url('singer/'.$si_url.'-'.$si_id);
	}
	//Img Album 
	public function ImgAlbum($al_image){
		return base_url('uploads/img_album/'.$al_image);
	}
	//Url Album 
	public function UrlAlbum($al_url,$al_id){
		return base_url('album/'.$al_url.'-'.$al_id);
	}
    //Tags Name Array
    public function TagsName($tags_name) {
        $tags_array = explode(',', $tags_name);
        $tags_result = array();
        foreach ($tags_array as $k => $v) {
            array_push($tags_result, $this->CI->mglobal->selectStags('t_tags', $v));
        }
        return $tags_result;
    }

    //Send All Notify List Friend
    public function SendNotifyListFriend($type, $u_id, $messages, $n_type, $n_url = NULL) {
        switch ($type) {
            case 'Friend':
                $list_friend = $this->GetListFriend($u_id);
                foreach ($list_friend as $k => $v) {
                    $this->CI->mglobal->Notify('creat-notify', NULL, 0, $v, 0, $n_type, $messages, $n_url);
                }
                break;
        }

        return TRUE;
    }

    //Get List Friend
    public function GetListFriend($u_id) {
        $all_friend = $this->CI->mglobal->all_friend($u_id);
        $list_friend = array();
        foreach ($all_friend as $k => $v) {
            if ($v['u_id'] == $u_id) {
                array_push($list_friend, $v['u_fr']);
            } else {
                array_push($list_friend, $v['u_id']);
            }
        }
        return $list_friend;
    }

}
