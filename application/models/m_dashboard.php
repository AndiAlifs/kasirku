<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    function __construct(){
		parent::__construct();
		$this->load->model('m_barang');
        $this->load->helper('url');
	}
}