<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {



    public function index()
    {
        $this->load->view('login');
    } 

    public function get_login()
    {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        $this->load->model('m_login');
        $data = $this->m_login->get_login($user);
        if ($data) {
            if ($data[0]->password == $pass) {
                $this->session->set_userdata('username',$data[0]->username);
                $this->session->set_userdata('password',$data[0]->password);
                $this->session->set_userdata('id_user',$data[0]->id_user);
                $this->session->set_userdata('role',$data[0]->role);
                $this->session->set_flashdata('msg',strtoupper("anda login sebagai ".$data[0]->role."!"));
                redirect('/dashboard');
            } else {
                $this->session->set_flashdata('info',"Password yang dimasukkan salah");
                redirect('/login');
            }
        } else {
            $this->session->set_flashdata('info',"User tidak ditemukan");
            redirect('/login');
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}