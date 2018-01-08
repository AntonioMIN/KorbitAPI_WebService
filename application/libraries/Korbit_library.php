<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Korbit_library {
    
    protected $CI;
    protected $client_id=NULL; // !! Need Korbit API client id !!
    protected $client_secret=NULL; // !! Need Korbit API client secret !!

    public function __construct()
    {
        $this->CI=&get_instance();
        $this->CI->load->library('curl_library');
    }

    public function get_access_token($username,$password)
    {
        $data=array();
        $data['client_id']=$this->client_id;
        $data['client_secret']=$this->client_secret;
        $data['username']=$username;
        $data['password']=$password;
        $data['grant_type']="password";
        $result=$this->CI->curl_library->curl("https://api.korbit.co.kr/v1/oauth2/access_token",$data,TRUE);
        return $result;
    }

    public function refresh_access_token($refresh_token)
    {
        $data=array();
        $data['client_id']=$this->client_id;
        $data['client_secret']=$this->client_secret;
        $data['refresh_token']=$refresh_token;
        $data['grant_type']="refresh_token";
        $result=$this->CI->curl_library->curl("https://api.korbit.co.kr/v1/oauth2/access_token",$data,TRUE);
        return $result;
    }

    public function get_user_information($access_token)
    {
        return $this->CI->curl_library->curl("https://api.korbit.co.kr/v1/user/info",NULL,FALSE,array("Authorization: Bearer ".$access_token));
    }

    public function get_user_exchange_orders($access_token)
    {
        return $this->CI->curl_library->curl("https://api.korbit.co.kr/v1/user/orders",NULL,FALSE,array("Authorization: Bearer ".$access_token));
    }

    public function get_ticker($currency_pair)
    {
        return $this->CI->curl_library->curl("https://api.korbit.co.kr/v1/ticker?currency_pair=".$currency_pair,NULL,FALSE);
    }

    public function get_user_balance($access_token)
    {
        return $this->CI->curl_library->curl("https://api.korbit.co.kr/v1/user/balances",NULL,FALSE,array("Authorization: Bearer ".$access_token));
    }

    public function get_transactions($currency_pair,$time)
    {
        return $this->CI->curl_library->curl("https://api.korbit.co.kr/v1/transactions?currency_pair=".$currency_pair."&time=".$time,NULL,FALSE);
    }

    public function get_orderbook($currency_pair)
    {
        return $this->CI->curl_library->curl("https://api.korbit.co.kr/v1/orderbook?currency_pair=".$currency_pair,NULL,FALSE);
    }

    public function get_user_volume($access_token,$currency_pair)
    {
        return $this->CI->curl_library->curl("https://api.korbit.co.kr/v1/user/volume?currency_pair=".$currency_pair,NULL,FALSE,array("Authorization: Bearer ".$access_token));
    }

    public function get_user_orders($access_token,$currency_pair)
    {
        return $this->CI->curl_library->curl("https://api.korbit.co.kr/v1/user/orders?currency_pair=".$currency_pair."&limit=10",NULL,FALSE,array("Authorization: Bearer ".$access_token));
    }
}