<?php
class Api extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('islogin')!=TRUE) redirect('/');
        $this->load->library('korbit_library');
    }
    public function balance()
    {
        $result=$this->korbit_library->get_user_balance($this->session->userdata('access_token'));
        echo json_encode(array('result'=>$result));
    }
    public function ticker($currency_pair)
    {
        $result=$this->korbit_library->get_ticker($currency_pair);
        echo json_encode(array('result'=>$result));
    }
    public function transactions($currency_pair)
    {
        $result=$this->korbit_library->get_transactions($currency_pair,'minute');
        echo json_encode(array('result'=>$result));
    }
    public function orderbook($currency_pair)
    {
        $result=$this->korbit_library->get_orderbook($currency_pair);
        echo json_encode(array('result'=>$result));
    }
    public function uservolume($currency_pair)
    {
        $result=$this->korbit_library->get_user_volume($this->session->userdata('access_token'),$currency_pair);
        echo json_encode(array('result'=>$result));
    }
    public function userorders($currency_pair)
    {
        $result=$this->korbit_library->get_user_orders($this->session->userdata('access_token'),$currency_pair);
        echo json_encode(array('result'=>$result));
    }
}