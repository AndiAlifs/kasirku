<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function index(){
		$data['suppliers'] = $this->m_supplier->tampil_data();  
        $this->load->view('supplier',$data);
    } 
	
    function __construct(){
		parent::__construct();
		$this->model_squrity->get_squrity();  
		$this->load->model('m_supplier');
        $this->load->helper('url');
	}

    public function hapus(){
        $this->m_supplier->hapusData($this->input->get('kode'));
        redirect('supplier');  
    }

    public function edit(){
        $data['supplier'] = $this->m_supplier->get_data($this->input->get('kode'));
        $this->load->view('edit_supplier', $data);
    }
    
    function tambah_proses(){
        $kode_supp = $this->input->post('kode_supplier'); 
		$nama_supp = $this->input->post('nama_supplier');
		$hp_supp = $this->input->post('nohp_supplier');
		$alamat_supp = $this->input->post('alamat_supplier');
 
		$data = array(
            'kode_supplier' => $kode_supp,
			'nama_supplier' => $nama_supp,
			'nohp_supplier' => $hp_supp,
			'alamat_supplier' => $alamat_supp
		);

		$this->m_supplier->input_data($data);
		redirect('supplier');
	}

    function edit_proses(){
        $kode_supp = $this->input->post('kode_supplier'); 
		$nama_supp = $this->input->post('nama_supplier');
		$hp_supp = $this->input->post('nohp_supplier');
		$alamat_supp = $this->input->post('alamat_supplier');

		$data = array(
            'kode_supplier' => $kode_supp,
			'nama_supplier' => $nama_supp,
			'nohp_supplier' => $hp_supp,
			'alamat_supplier' => $alamat_supp
		);

		$this->m_supplier->update($data);
		redirect('supplier');	
	}

}