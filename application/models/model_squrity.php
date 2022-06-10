<?php

class Model_squrity Extends CI_Model{
    public function get_squrity()
    {
        $user = $this->session->userdata('username');
        $pass = $this->session->userdata('password');

        if (empty($user) && empty($pass)) {
            $this->session->sess_destroy();
            redirect('login');
        }

        $segmen = $this->uri->segment(2);

        if ($this->session->role != 'pemilik' && ($segmen == 'laporan_penjualan' || 
                                                    $segmen == 'laporan_pembelian'  || 
                                                    $segmen == 'laporan_keuangan'  || 
                                                    $segmen == 'pegawai')){
            $this->session->set_flashdata('msg',strtoupper("Hak akses tidak diberikan"));
            $this->session->set_flashdata('kind',"warning");
            redirect('dashboard');
        }
    }
}