<?php
class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('islogin')!=TRUE) redirect('/');
        $this->load->library('korbit_library');
    }
    public function index()
    {
        $this->load->view('header');
        $this->load->view('dashboard/dashboard');
        $this->load->view('footer');
    }
}