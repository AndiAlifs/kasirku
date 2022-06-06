<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    public function index(){
        $data['user'] = $this->m_user->tampil_data();  
        $this->load->view('pegawai',$data);
        
    } 

    function __construct()
    {
        parent::__construct();
        $this->model_squrity->get_squrity();
        $this->load->model('m_user');
        $this->load->helper('url');
    }

    
}
