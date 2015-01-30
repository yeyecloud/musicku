<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Tesst
$route['test-xml.xml']='cglobal/creat_xml';
/**
* 
* @version v1.1
* @description:url seo album + id 
* @param:any +number
* 
*/
$route['album/(:any)-(:num)']='music_home/album/AlbumIndex/$1/$2';
/**
* 
* @description:url seo song + video
* @param-input:any + number
* 
*/
$route['song/(:any)-(:num)']='music_home/playsong/song/$1/$2';
$route['video/(:any)-(:num)']='music_home/playvideo/video/$1/$2';

/**
* 
* @description:url seo playlist
* @param-input:any + number
* 
*/
$route['play-list/(:any)-(:num)']='music_home/playlist/pllist/$1/$2';
/**
* 
* @description:url seo profile
* @param-input:any + number
* 
*/
$route['profile/(:any)-(:num)']='music_home/profile/user/$1/$2';
/**
* 
* @description:XML play to jPlayer
* @param-input:number
* @return:XML format
* 
*/
$route['xml-play-song-(:num).xml']='cglobal/xml_play_song_now/$1';
/**
* 
* @description:XML play to jPlayer
* @param-input:number
* @return:XML format
* 
*/
$route['xml-play-playlist-(:num).xml']='cglobal/xml_play_playlist_now/$1';
/**
* 
* @description:XML play to jPlayer
* @param-input:number
* @return:XML format
* 
*/
$route['xml-play-album-(:num).xml']='cglobal/xml_play_album_now/$1';
/**
* 
* @description:XML play to jPlayer
* @param-input:number
* @return:XML format
* 
*/
$route['xml-play-video-(:num).xml']='cglobal/xml_play_video/$1';
/**
* 
* @description:Pages show all category
* @param-input:any + number
* @return:HTML format
* 
*/
$route['video/(:num)']='cat/cvideo/index/$1';
$route['video']='cat/cvideo/index/0';
$route['song/(:num)']='cat/csong/index/$1';
$route['song']='cat/csong/index/0';
$route['category/(:any)-(:num)/(:num)']='cat/ccat/index/$1/$2/$3';
$route['category/(:any)-(:num)']='cat/ccat/index/$1/$2/0';
//Update v1.1
$route['list-album/(:num)']='album/palbum/index/$1';
$route['list-album']='album/palbum/index/0';
/**
* 
* @description:Singer pages
* @param-input:any+number
* @return:HTML format
* 
*/
$route['singer/(:any)-(:num)']='singer/singer/index/$1/$2';
/**
* 
* @description:Tags Search Pages
* @param-input:any
* @return:HTML format
* 
*/
$route['tags/(:any)']='tags/tags/index/$1';
/**
* 
* @description:Login + Reg user
* @method:post
* @param-input:get from method
* @return:href
* 
*/
$route['sign-up'] = "user/register/index";
$route['sign-in'] = "user/login/index";
/**
* 
* @description:Show all singer from database
* @method:get
* @param-input:get from @method
* @return:JSON format
* 
*/
$route['collection-singer.json'] = "cglobal/collection_singer_json";
/**
* 
* @description:Home pages
* @param-input:none
* @return:HTML format
* 
*/
$route['default_controller'] = "music_home/home/index";
$route['index.html'] = "music_home/home/index";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */