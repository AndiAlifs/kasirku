<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model_squrity->get_squrity();
        $this->load->model('m_transaksi');
        $this->load->model('m_barang');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['transaksi_hari_ini'] =  $this->m_transaksi->totalTransaksi_bydate(date('Y-m-d'));
        $data['income_hari_ini'] =  $this->m_transaksi->totalIncome_bydate(date('Y-m-d'));
        $data['stok_hari_ini'] = intval($this->m_barang->totalStok_bydate(date('Y-m-d')));

        $this->load->view('dashboard',$data);
        
    }
}
