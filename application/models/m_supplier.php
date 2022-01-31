<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model {

    function kelolasupp(){
		$hasil=$this->db->query("SELECT * FROM supplier");
		return $hasil;
	}

	public function hapusData($kode_supplier){
		$this->db->where('kode_supplier',$kode_supplier);
        $this->db->delete('supplier');
    }

	public function get_data($kode_supplier){
		$this->db->where('kode_supplier',$kode_supplier);
        return $this->db->get('supplier')->row();
    }

	public function update($data){
        $this->db->where('kode_supplier', $data['kode_supplier']);
        $this->db->update('supplier', $data);
    }

	function tampil_data()
    {
		return $this->db->get('supplier')->result();
	}

    function input_data($data)
    {
        $this->db->insert('supplier',$data);
    }   
}