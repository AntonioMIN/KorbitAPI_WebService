<?php
class Mybitcoin extends CI_Controller {
    public function index()
    {
        if($this->session->userdata('islogin')==TRUE) redirect('dashboard');
        $this->load->view('header');
        $this->load->view('signin');
        $this->load->view('footer');
    }
}