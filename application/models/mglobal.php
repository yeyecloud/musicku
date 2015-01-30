<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mglobal extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Select All Category
    public function select_all_category() {
        return $this->db
                        ->get('category')
                        ->result_array();
    }

    //collection - singer JSON
    public function mcollection_singer_json() {
        return $this->db
                        ->get('singer_song')
                        ->result_array();
    }

    //collection - tags JSON
    public function mcollection_tags_json() {
        return $this->db
                        ->get('tag_song')
                        ->result_array();
    }

    //Song New Limit
    public function all_song_new($limit, $type = NULL) {
        $this->db->select('*');
        $this->db->from('song');
        $this->db->join('category', 'category.cat_id = song.cat_id');
        $this->db->join('rating_song', 'rating_song.r_id = song.r_id');
        $this->db->join('views_song', 'views_song.v_id = song.v_id');
        $this->db->join('like_song', 'like_song.l_id = song.l_id');
        $this->db->join('lyrics_song', 'lyrics_song.ly_id = song.ly_id');
        $this->db->join('singer_song', 'singer_song.si_id = song.si_id');
        $this->db->where('s_type', $type);
        $this->db->limit($limit);
        $this->db->order_by('s_id', 'desc');
        $result = $this->db->get();
        return $result->result_array();
    }

    //AddSong
    public function addSong_Update($type, $cat_id, $u_id, $si_name, $s_name, $s_keyword, $s_url, $s_link, $s_tags, $s_img, $s_type, $s_date_creat, $s_date_update, $lyrics, $s_id = NULL, $ly_id = NULL) {
        switch ($type) {
            case 'insert':
                $tags = explode(',', $s_tags);
                $tags_insert = '';
                for ($i = 0; $i < count($tags); $i++) {
                    $tags_insert .= $this->selectStags('t_id', $tags[$i]) . ',';
                }
                $tags_insert = substr($tags_insert, 0, - 1);
                //Insert Ratting
                $id_rating = $this->Insertrating_song('insert');
                $id_views = $this->Insert_Update_View('insert');
                $id_like = $this->select_insert_like_song('insert');
                $id_ly = $this->insert_update_lyrics('insert', $lyrics, $u_id, now());
                $data = array(
                    's_id' => NULL,
                    'cat_id' => $cat_id,
                    'u_id' => $u_id,
                    'si_id' => $this->selectSsinger($si_name),
                    'r_id' => $id_rating,
                    'v_id' => $id_views,
                    'l_id' => $id_like,
                    'ly_id' => $id_ly,
                    's_name' => $s_name,
                    's_keyword' => strtolower(removesign($s_keyword)),
                    's_url' => $s_url,
                    's_link' => $s_link,
                    's_img' => $s_img,
                    's_tags' => $tags_insert,
                    's_type' => $s_type,
                    's_date_creat' => now(),
                    's_date_update' => now()
                );
                $this->db->insert('song', $data);
                $id_song = $this->db->insert_id();
                return $id_song;
                break;
            //Update Song
            case 'update':
                $tags = explode(',', $s_tags);
                $tags_insert = '';
                for ($i = 0; $i < count($tags); $i++) {
                    $tags_insert .= $this->selectStags('t_id', $tags[$i]) . ',';
                }
                $tags_insert = substr($tags_insert, 0, - 1);
                //Update Lyrics
                $this->insert_update_lyrics('update', $lyrics, $u_id, now(), $ly_id);
                $data = array(
                    'cat_id' => $cat_id,
                    'u_id' => $u_id,
                    'si_id' => $this->selectSsinger($si_name),
                    's_name' => $s_name,
                    's_keyword' => strtolower(removesign($s_keyword)),
                    's_url' => $s_url,
                    's_link' => $s_link,
                    's_img' => $s_img,
                    's_tags' => $tags_insert,
                    's_type' => $s_type,
                    's_date_update' => now()
                );
                $this->db->where('s_id', $s_id);
                $this->db->update('song', $data);
                return $s_id;
                break;
        }
    }

    //Select Stags
    public function selectStags($type, $t_tags) {
        switch ($type) {
            case 't_id':
                $this->db->select('t_id');
                $this->db->from('tag_song');
                $this->db->where('t_tags', $t_tags);
                $select = $this->db->get();
                $ret = $select->row();
                if ($select->num_rows() > 0) {
                    return $ret->t_id;
                } else {
                    $data = array(
                        't_id' => NULL,
                        't_tags' => $t_tags
                    );
                    $insert = $this->db->insert('tag_song', $data);
                    return $this->db->insert_id();
                }
                break;

            case 't_tags':
                $this->db->select('t_tags');
                $this->db->from('tag_song');
                $this->db->where('t_id', $t_tags);
                $select = $this->db->get();
                $ret = $select->row();
                return $ret->t_tags;

                break;
        }
    }

    //Select Singer ID
    public function selectSsinger($singer_name) {
        $this->db->select('si_id');
        $this->db->from('singer_song');
        $this->db->where('si_name', $singer_name);
        $select = $this->db->get();
        $rec = $select->row();
        if ($select->num_rows() > 0) {
            return $rec->si_id;
        } else {
            $data = array(
                'si_id' => NULL,
                'si_name' => $singer_name,
                'si_keyword' => strtolower(removesign($singer_name)),
                'si_url' => url_title($singer_name),
                'si_img' => 0,
                'si_birthday' => 0,
                'si_description' => 0
            );
            $this->db->insert('singer_song', $data);
            return $this->db->insert_id();
        }
    }

    //Update Ratting Song
    public function Insertrating_song($type, $r_1 = NULL, $r_2 = NULL, $r_3 = NULL, $r_4 = NULL, $r_5 = NULL, $r_id = NULL) {
        switch ($type) {
            case 'insert':
                $data = array(
                    'r_id' => NULL,
                    'r_1' => 0,
                    'r_2' => 0,
                    'r_3' => 0,
                    'r_4' => 0,
                    'r_5' => 0
                );
                $this->db->insert('rating_song', $data);
                return $this->db->insert_id();
                break;
        }
    }

    //Insert + Update View
    public function Insert_Update_View($type, $v_id = NULL) {
        switch ($type) {
            case 'insert':
                $data = array(
                    'v_id' => NULL,
                    'v_views' => 0,
                    'v_views_week' => 0,
                    'v_views_month' => 0,
                    'v_views_year' => 0
                );
                $this->db->insert('views_song', $data);
                return $this->db->insert_id();
                break;
            case 'update':
                $this->db->set('v_views', 'v_views+1', FALSE);
                $this->db->set('v_views_week', 'v_views_week+1', FALSE);
                $this->db->set('v_views_month', 'v_views_month+1', FALSE);
                $this->db->set('v_views_year', 'v_views_year+1', FALSE);
                $this->db->where('v_id', $v_id);
                return $this->db->update('views_song');
                break;
        }
    }

    //Select,Insert Like Song
    public function select_insert_like_song($type, $u_like = NULL) {
        switch ($type) {
            case 'check_u':
                $this->db->select('*');
                $this->db->from('like_song');
                $this->db->where('u_like', $u_id);
                $check_u = $this->db->get();
                if ($check_u->num_row() > 0) {
                    return TRUE;
                } else {
                    return FALSE;
                }
                break;

            case 'insert':
                $data = array(
                    'l_id' => NULL,
                    'u_like' => 0
                );
                $this->db->insert('like_song', $data);
                return $this->db->insert_id();
                break;
            case 'select_all':
                $this->db->select('*');
                $this->db->from('like_song');
                $this->db->where('s_id', $s_id);
                $select = $this->db->get();
                if ($select->num_row() > 0) {
                    return $select->result_array();
                } else {
                    return FALSE;
                }
                break;
        }
    }

    //Insert,Update lyrics
    public function insert_update_lyrics($type, $lyrics, $u_id, $date_update, $ly_id = NULL) {
        switch ($type) {
            case 'insert':
                $data = array(
                    'ly_id' => NULL,
                    'u_id' => $u_id,
                    'ly_text' => $lyrics,
                    'ly_date_creat' => now(),
                    'ly_date_update' => now(),
                );
                $this->db->insert('lyrics_song', $data);
                return $this->db->insert_id();
                break;
            //Update Lyrics
            case 'update':
                $data = array(
                    'u_id' => $u_id,
                    'ly_text' => $lyrics,
                    'ly_date_update' => now(),
                );
                $this->db->where('ly_id', $ly_id);
                return $this->db->update('lyrics_song', $data);

                break;
        }
    }

    

    //Get Info Song
    public function get_info_song($s_id) {
        $this->db->select('*');
        $this->db->from('song');
        $this->db->join('category', 'category.cat_id = song.cat_id');
        $this->db->join('rating_song', 'rating_song.r_id = song.r_id');
        $this->db->join('views_song', 'views_song.v_id = song.v_id');
        $this->db->join('like_song', 'like_song.l_id = song.l_id');
        $this->db->join('lyrics_song', 'lyrics_song.ly_id = song.ly_id');
        $this->db->join('singer_song', 'singer_song.si_id = song.si_id');
        $this->db->where('song.s_id', $s_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    //Delete Song
    public function delete_song($s_id) {
        $this->db->select('*');
        $this->db->from('song');
        $this->db->where('s_id', $s_id);
        $data = $this->db->get();
        $result = $data->result_array();
        //Delete rating_song
        $this->db->delete('rating_song', array('r_id' => $result[0]['r_id']));
        //Delete views_song
        $this->db->delete('views_song', array('v_id' => $result[0]['v_id']));
        //Delete like_song
        $this->db->delete('like_song', array('l_id' => $result[0]['l_id']));
        //Delete lyrics_song
        $this->db->delete('lyrics_song', array('ly_id' => $result[0]['ly_id']));
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        if (preg_match($reg_exUrl, $result[0]['s_link'], $match) != TRUE) {
            $ex_array = explode('.', strtolower($result[0]['s_link']));
            if ($ex_array[1] == 'mp4') {
                @unlink(FCPATH . '/uploads/mp4/' . $result[0]['s_link']);
            } elseif ($ex_array[1] == 'mp3') {
                @unlink(FCPATH . '/uploads/mp3/' . $result[0]['s_link']);
            }
        }
        if (preg_match($reg_exUrl, $result[0]['s_img'], $match) != TRUE) {
            @unlink(FCPATH . '/uploads/images/' . $result[0]['s_img']);
        }
        $this->db->delete('song', array('s_id' => $s_id));
        return TRUE;
    }

    //Count Total Song in Category
    public function count_song_category($cat_id) {
        $data = $this->db
                ->select('s_id')
                ->from('song')
                ->where('cat_id', $cat_id)
                ->get();
        return $data->num_rows();
    }

    //Get Info Category
    public function get_info_category($cat_id) {
        $data = $this->db
                ->select('*')
                ->from('category')
                ->where('cat_id', $cat_id)
                ->get();
        return $data->result_array();
    }

    //Select Singer (si_id or si_name or si_url from si_name)
    public function selectSinger($type = NULL, $si_id = NULL, $si_name = NULL, $si_url = NULL) {
        switch ($type) {
            case 'si_name':
                $this->db->select('*');
                $this->db->from('singer_song');
                $this->db->where('si_keyword', strtolower(removesign($si_name)));
                $data = $this->db->get();
                return $data->result_array();
                break;
            case 'total_song':
                $this->db->select('s_id');
                $this->db->from('song');
                $this->db->where('si_id', $si_id);
                $data = $this->db->get();
                return $data->num_rows();
                break;
            case'si_id':
                $this->db->select('*');
                $this->db->from('singer_song');
                $this->db->where('si_id', $si_id);
                $data = $this->db->get();
                return $data->result_array();
                break;
        }
    }

    //Info Song Fast One Row
    public function info_song_fast_one($s_id, $select = '*') {
        $this->db->select($select);
        $this->db->from('song');
        $this->db->join('singer_song', 'singer_song.si_id = song.si_id');
        $this->db->where('s_id', $s_id);
        $data = $this->db->get();
        return $data->result_array();
    }

    //Playlist User
    //Check Playlist

    public function playlist_user($type, $pl_id = NULL, $u_id, $s_id, $pl_name = NULL, $pl_img = NULL) {
        switch ($type) {
            case 'creat':
                $data = array(
                    'pl_id' => NULL,
                    'pl_name' => $pl_name,
                    'pl_keyword' => strtolower(removesign($pl_name)),
                    'pl_img' => $pl_img,
                    'pl_url' => url_title(removesign($pl_name)),
                    'u_id' => $u_id,
                    's_id' => $s_id,
                    'pl_datecreat' => now()
                );
                return $this->db->insert('playlist', $data);
                break;
            case 'update':
                $data = array(
                    'pl_name' => $pl_name,
                    'pl_keyword' => strtolower(removesign($pl_name)),
                    'pl_url' => url_title(removesign($pl_name)),
                    'pl_img' => $pl_img
                );
                $this->db->where('pl_id', $pl_id);
                return $this->db->update('playlist', $data);
                break;
            case 'delete':
                return $this->db->delete('playlist', array('pl_id' => $pl_id, 'u_id' => $u_id));
                break;
            case 'select-pl':
                $this->db->select('*');
                $this->db->from('playlist');
                $this->db->where('pl_id', $pl_id);
                return $this->db->get()->result_array();
                break;
            case 'select-u':
                $this->db->select('*');
                $this->db->from('playlist');
                $this->db->where('u_id', $u_id);
                return $this->db->get()->result_array();
                break;
            case 'check':
                $this->db->select('*');
                $this->db->from('playlist');
                $this->db->where('u_id', $u_id);
                $data = $this->db->get();
                return $data->num_rows();
                break;
            case 'count-song':
                $this->db->select('s_id');
                $this->db->from('playlist');
                $this->db->where('pl_id', $pl_id);
                $data = $this->db->get();
                $ret = $data->row();
                $count = unserialize($ret->s_id);
                return count($count);
                break;
            case 'delete-song':
                $data_song = $this->playlist_user('select-pl', $pl_id, NULL, NULL, NULL);
                $data_song_arr = unserialize($data_song[0]['s_id']);
				$key=array_search($s_id,$data_song_arr);
				unset($data_song_arr[$key]);
                $data = array(
                    's_id' => serialize($data_song_arr)
                );
                $this->db->where('pl_id', $pl_id);
                $this->db->where('u_id', $u_id);
                return $this->db->update('playlist', $data);
                break;
            case 'addSongToPlayList':
                $data_info = $this->playlist_user('select-pl', $pl_id, $u_id, NULL, NULL);
				$data_song=unserialize($data_info[0]['s_id']);
				$data_song[]=$s_id;
				$data = array(
                    's_id' => serialize($data_song),
                );
                $this->db->where('pl_id', $pl_id);
                $this->db->where('u_id', $u_id);
                return $this->db->update('playlist', $data);
                break;
            case 'checkSongExist':
                $data_info = $this->playlist_user('select-pl', $pl_id, $u_id, $s_id, NULL);
                $data_arr = unserialize($data_info[0]['s_id']);
                if (in_array($s_id, $data_arr) == TRUE) {
                    return TRUE;
                } else {
                    return FALSE;
                }
                break;
            case 'update-views':
                $this->db->set('pl_views', 'pl_views+1', FALSE);
                $this->db->set('pl_views_year', 'pl_views_year+1', FALSE);
                $this->db->set('pl_views_month', 'pl_views_month+1', FALSE);
                $this->db->set('pl_views_week', 'pl_views_week+1', FALSE);
                $this->db->where('pl_id', $pl_id);
                return $this->db->update('playlist');
                break;
            case 'select-random':
                //Random Limit 12
                $this->db->select('*');
                $this->db->from('playlist');
                $this->db->limit(12);
                $this->db->order_by('pl_id', 'RANDOM');
                return $this->db->get()->result_array();
                break;
            case 'check-pl-u':
                $this->db->select('*');
                $this->db->from('playlist');
                $this->db->where('pl_id', $pl_id);
                $this->db->where('u_id', $u_id);
                if ($this->db->get() != FALSE) {
                    return TRUE;
                } else {
                    return FALSE;
                }
                break;
        }
    }

    //Select Notify
    public function Notify($type, $n_id, $n_from, $n_to, $n_status, $n_type = NULL, $n_messages = NULL, $n_url = NULL) {
        switch ($type) {
            case 'check-received':
                return $this->db->select('*')
                                ->where('n_to', $n_to)
                                ->where('n_status', $n_status)
                                ->order_by('n_id', 'desc')
                                ->get('notify')
                                ->result_array();
                break;
            case 'check-all-received':
                return $this->db
                                ->select('*')
                                ->where('n_to', $n_to)
                                ->order_by('n_id', 'desc')
                                ->get('notify')
                                ->result_array();
                break;
            case 'creat-notify':
                $data = array(
                    'n_id' => NULL,
                    'n_from' => $n_from,
                    'n_to' => $n_to,
                    'n_status' => 1,
                    'n_type' => $n_type,
                    'n_messages' => $n_messages,
                    'n_datecreat' => now(),
                    'n_url' => $n_url
                );
                return $this->db->insert('notify', $data);
                break;
            case 'remove-notify-allow-friend':
                $where = "((n_from=$n_from AND n_to=$n_to AND n_type=3) OR (n_from=$n_to AND n_to=$n_from AND n_type=3))";
                return $this->db
                                ->where($where)
                                ->delete('notify');
                break;
            case 'RemoveNid':
                return $this->db
                                ->where('n_id', $n_id)
                                ->delete('notify');
                break;
            case 'disable-all-notify':
                $data = array(
                    'n_status' => 0
                );
                return $this->db
                                ->where('n_to', $n_to)
                                ->update('notify', $data);
                break;
        }
    }

    //is like song
    public function LikeSong($type, $l_id, $s_id, $u_id, $data_like) {
        switch ($type) {
            case 'CheckLike':
                if ($data_like != NULL) {
                    $data_like_arr = explode(',', $data_like);
                    if ($u_id != NULL && in_array($u_id, $data_like_arr) == TRUE) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                } else {
                    $data_like_select = $this->LikeSong('SelectLike', $l_id, NULL, NULL, NULL);
                    $data_like_arr = explode(',', $data_like_select[0]['u_like']);
                    if ($u_id != NULL && in_array($u_id, $data_like_arr) == TRUE) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                }

                break;
            case 'CountLike':
                $data_like_count = count(explode(',', $data_like));
                return $data_like_count;
                break;
            case 'AddLike':
                $data_like_select = $this->LikeSong('SelectLike', $l_id, NULL, $u_id, NULL);
                if ($data_like_select[0]['u_like'] == TRUE) {
                    $addlike = $data_like_select[0]['u_like'] . ',' . $u_id;
                } else {
                    $addlike = $u_id;
                }
                $data = array(
                    'u_like' => $addlike
                );
                $this->db->where('l_id', $l_id);
                return $this->db->update('like_song', $data);
                break;
            case 'UnLike':
                $data_like_select = $this->LikeSong('SelectLike', $l_id, NULL, NULL, NULL);
                $data_array = explode(',', $data_like_select[0]['u_like']);
                $count = count($data_array);
                $data_update = '';
                for ($i = 0; $i < $count; $i++) {
                    if ($data_array[$i] != $u_id) {
                        $data_update .= $data_array[$i] . ',';
                    }
                }
                $data_update = substr($data_update, 0, - 1);
                $data = array(
                    'u_like' => $data_update
                );
                $this->db->where('l_id', $l_id);
                return $this->db->update('like_song', $data);
                break;
            case 'SelectLike':
                $this->db->select('*');
                $this->db->from('like_song');
                $this->db->where('l_id', $l_id);
                return $this->db->get()->result_array();
                break;
        }
    }

    public function Follow($type, $u_id, $u_following) {
        switch ($type) {
            case 'follow':
                $data = array(
                    'fo_id' => NULL,
                    'u_id' => $u_id,
                    'u_following' => $u_following
                );
                return $this->db->insert('follow', $data);

                break;

            case 'check-following':
                $this->db->select('*');
                $this->db->from('follow');
                $this->db->where('u_id', $u_id);
                $this->db->where('u_following', $u_following);
                return @$this->db->get()->result_array();
                break;
            case 'unfollow':
                return $this->db->delete('follow', array('u_id' => $u_id, 'u_following' => $u_following));
                break;
            case 'all-follower':
                return $this->db
                                ->where('u_following', $u_id)
                                ->get('follow')
                                ->result_array();
                break;
            case 'all-following':
                return $this->db
                                ->where('u_id', $u_id)
                                ->get('follow')
                                ->result_array();
                break;
        }
    }

    //Friend
    public function Friend($type, $u_id, $u_fr, $fr_status) {
        switch ($type) {
            case 'AddFriend':
                $data = array(
                    'fr_id' => NULL,
                    'u_id' => $u_id,
                    'u_fr' => $u_fr,
                    'fr_status' => $fr_status
                );
                return $this->db->insert('friend', $data);
                break;
            case 'CheckStatus':
                $where = "(u_id=$u_id AND u_fr=$u_fr) OR (u_id=$u_fr AND u_fr=$u_id)";
                $this->db->select('fr_status');
                $this->db->from('friend');
                $this->db->where($where);
                return @$this->db->get()->row()->fr_status;
                break;
            case'RemoveFriend':
                $where = "(u_id=$u_id AND u_fr=$u_fr) OR (u_id=$u_fr AND u_fr=$u_id)";
                $this->db->where($where);
                return $this->db->delete('friend');
                break;
            case 'AllowFriend':
                $data = array(
                    'fr_status' => 1
                );
                return $this->db
                                ->where('u_id', $u_fr)
                                ->where('u_fr', $u_id)
                                ->update('friend', $data);
                break;
            case 'GetListFriend':
                $where = "fr_status=1 AND (u_id=$u_fr OR u_fr=$u_id)";
                return $this->db
                                ->where($where)
                                ->get('friend')
                                ->result_array();
                break;
        }
    }

    //Online or Offline
    public function online_offline($email) {
        $query = $this->db
                ->select('last_activity')
                ->like('user_data', $email)
                ->get('ci_sessions');
        return $query->num_rows();
    }

    //Load All Friend
    public function all_friend($u_id) {
        $where = "((u_id=$u_id OR u_fr=$u_id) AND fr_status=1)";
        return $this->db
                        ->select('*')
                        ->where($where)
                        ->get('friend')
                        ->result_array();
    }

    //Random Song or Video
    public function random_song_video($type, $s_type, $limit, $random) {
        return $this->db
                        ->select('*')
                        ->where('s_type', $s_type)
                        ->limit($limit)
                        ->order_by('s_id', $random)
                        ->get('song')
                        ->result_array();
    }

    //Comment
    public function Comment($type, $cm_id, $cm_type, $cm_uid, $cm_to, $cm_text, $cm_datecreat = NULL, $limit = NULL, $offset) {
        switch ($type) {
            case 'AddComment':
                $data = array(
                    'cm_id' => NULL,
                    'cm_type' => $cm_type,
                    'cm_uid' => $cm_uid,
                    'cm_to' => $cm_to,
                    'cm_text' => $cm_text,
                    'cm_datecreat' => now()
                );
                $this->db->insert('comment', $data);
                return $this->db->insert_id();
                break;
            case 'CountTotalCommentForSong':
                return $this->db
                                ->where('cm_to', $cm_to)
                                ->get('comment')
                                ->num_rows();
                break;
            case 'SelectCommentForSong':
                $this->db->where('cm_to', $cm_to);
                $this->db->limit($limit, $offset);
                $this->db->order_by('cm_id', 'desc');
                return $this->db->get('comment')->result_array();
                break;
            case 'CountCommentSong':
                return $this->db
                                ->where('cm_to', $cm_to)
                                ->get('comment')
                                ->num_rows();
                break;
            case 'DeleteComment':
                return $this->db->delete('comment', array('cm_id' => $cm_id, 'cm_uid' => $cm_uid));
                break;
            default:
                break;
        }
    }
	//Song in Cate
	public function song_in_cat($type,$cat_id,$number=NULL,$offset=NULL){
		switch($type){
			case 'CountVideo':
				return $this->db
						->where('s_type',2)
						->get('song')	
						->num_rows();
				break;
			case 'CountSong':
				return $this->db
						->where('s_type',1)
						->get('song')
						->num_rows();
				break;
			case 'LimitVideo':
				return  $this->db
					    ->where('s_type',2)
					    ->order_by('s_id','desc')	
					    ->get('song',$number,$offset)
		            	->result_array(); 
				break;
			case 'LimitSong':
				return  $this->db
					    ->where('s_type',1)
					   	->order_by('s_id','desc')
					    ->get('song',$number,$offset)
		            	->result_array(); 
				break;
			case 'CountSongInCat':
				return $this->db
					->where('cat_id',$cat_id)
					->order_by('s_id','desc')
					->get('song')
					->num_rows();
				break;
			case 'LimitSongInCat':
				return  $this->db
					    ->where('cat_id',$cat_id)
					   	->order_by('s_id','desc')
					    ->get('song',$number,$offset)
		            	->result_array(); 
				break;
		}
	}
	//Search
	public function search_song($keyword){
		return $this->db
				->like('s_keyword', $keyword)
				->limit(5)
				->order_by('s_id','desc')
				->get('song')
				->result_array();	
	}
	public function search_singer($keyword){
		return $this->db
				->like('si_keyword', $keyword)
				->limit(5)
				->order_by('si_id','desc')
				->get('singer_song')
				->result_array();	
	}
	public function search_playlist($keyword){
		return $this->db
				->like('pl_keyword', $keyword)
				->limit(5)
				->order_by('pl_id','desc')
				->get('playlist')
				->result_array();	
	}
    //Load Setting on Cache
    public function LoadSettings() {
        return $this->db->get('settings')->result_array();
    }
    //Load Admin Notify
    public function LoadAdminNotify(){
		return $this->db->get('admin_notify')->result_array();
	}
	//Update + Download
	public function update_download_song($s_id){
		$this->db->set('s_download', 's_download+1', FALSE);
		$this->db->where('s_id', $s_id);
		return $this->db->update('song');
	}

}
