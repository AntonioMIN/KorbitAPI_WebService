<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl_library {
    function curl($url,$data,$isPost,$header=array())
    {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL,$url); //접속할 URL 주소
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, $header); // 헤더 출력 여부
        if($isPost==TRUE)
        {
            curl_setopt ($ch, CURLOPT_POST, TRUE); // Post Get 접속 여부
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $this->array_to_string($data));
        }
        curl_setopt ($ch, CURLOPT_TIMEOUT, 1000); // TimeOut 값
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE); // 결과값을 받을것인지
        $result = curl_exec ($ch);
        log_message('debug','Curled.. result : '.$result);
        if(curl_errno($ch))
        {
            $ret='cURL Error occoured : '.curl_error($ch);
            log_message('error','Curled.. Error : '.$ret);
            curl_close($ch);
            return $ret;
        }
        curl_close ($ch);
        return json_decode($result);
    }

    function array_to_string($arr)
    {
        if($arr==NULL) return NULL;
        $ret='';
        foreach($arr as $key=>$val)
        {
            if(strlen($ret)>0) $ret.='&';
            $ret.=$key.'='.$val;
        }
        var_dump($ret);
        return $ret;
    }
}