<?php
class Auth extends CI_Controller {
    public function index()
    {
        $this->load->library('korbit_library');
        $email=$this->input->post('username');
        $pw=$this->input->post('password');
        $result=$this->korbit_library->get_access_token($email,$pw);
        if(!isset($result->access_token)) redirect('/');
        $user=$this->korbit_library->get_user_information($result->access_token);
        $this->session->set_userdata(array(
            'access_token'=>$result->access_token,
            'refresh_token'=>$result->refresh_token,
            'email'=>$user->email,
            'name'=>$user->name,
            'islogin'=>TRUE
        ));
        redirect('dashboard');
    }
    public function logout()
    {
        if($this->session->userdata('islogin')==TRUE)
        {
            $this->session->sess_destroy();
        }
        redirect('/');
    }
}