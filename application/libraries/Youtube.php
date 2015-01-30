<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once ('youtube/config.php');
class Youtube
{
	public function GetVideo($id)
	{

		$my_id         = $id;
		$url           = parse_url($my_id);
		$my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $my_id.'&asv=3&el=detailpage&hl=en_US'; //video details fix * 1
		$my_video_info = curlGet($my_video_info);
		parse_str($my_video_info);
		@$my_formats_array = explode(',',$url_encoded_fmt_stream_map);
		/* create an array of available download formats */
		$avail_formats[] = '';
		$i      = 0;
		$ipbits = $ip     = $itag   = $sig    = $quality= '';
		$expire = time();

		foreach($my_formats_array as $format){
			parse_str($format);
			$avail_formats[$i]['itag'] = $itag;
			$avail_formats[$i]['quality'] = $quality;
			$type = explode(';',$type);
			$avail_formats[$i]['type'] = $type[0];
			$avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
			parse_str(urldecode($url));
			$avail_formats[$i]['expires'] = date("G:i:s T", $expire);
			$avail_formats[$i]['ipbits'] = $ipbits;
			$avail_formats[$i]['ip'] = $ip;
			$i++;
		}

		return $avail_formats;
	}
}

/* End of file Youtube.php */