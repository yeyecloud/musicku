<?php
$_soundclound=array(
   'clientID'=>'638fc4999600eff25637efea958f1513', 
);
class NC_CURL{
    var $ch;
    var $debug = false;
    var $error_msg;

    function NC_CURL($debug = false){
        $this->debug = $debug;
        $this->init();
    }

    function init(){
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_FAILONERROR, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_ENCODING , 'gzip, deflate');
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
    }
    
    function views_source($url, $ip=null, $timeout=5){
        curl_setopt($this->ch, CURLOPT_URL,$url);
        curl_setopt($this->ch, CURLOPT_HTTPGET,true);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,true);
        if($ip){
            if($this->debug){
                echo "Binding to ip $ip\n";
            }
            curl_setopt($this->ch,CURLOPT_INTERFACE,$ip);
        }
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);
        $result = curl_exec($this->ch);
        if(curl_errno($this->ch)){
            if($this->debug)
            {
                echo "Error Occured in Curl\n";
                echo "Error number: " .curl_errno($this->ch) ."\n";
                echo "Error message: " .curl_error($this->ch)."\n";
            }
            return false;
        }else{
            return $result;
        }
        $httpcode = $this->get_http_response_code();
        if($httpcode>=200 && $httpcode<300){
                return true;
        }else{
                return false;
        }
        $this->close_curl();
    }

    function close_curl(){
        curl_close($this->ch);
    }
}