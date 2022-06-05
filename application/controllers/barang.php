<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function index()
    {
        $data['barang'] = $this->m_barang->show_barang();
        $this->load->view('barang', $data);
    }

    function __construct()
    {
        parent::__construct();
        $this->model_squrity->get_squrity();
        $this->load->model('m_barang');
        $this->load->model('m_supplier');
        $this->load->helper('url');
    }

    public function stok()
    {
        $data['stok'] = $this->m_barang->show_stok();
        $this->load->view('stok_barang', $data);
    }

    public function edit()
    {
        $data['barang'] = $this->m_barang->get_data($this->input->get('kode'));

        $this->load->view('edit_barang', $data);
    }

    public function stok_masuk()
    {
        $data['stok'] = $this->m_barang->show_stokmasuk();
        $data['barang'] = $this->m_barang->show_barang();
        $data['supplier'] = $this->m_supplier->tampil_data();
        $this->load->view('stokmasuk', $data);
    }

    public function hapus_stok()
    {
        $kodestok = $this->input->get('kode');
        $this->m_barang->hapus_stok($kodestok);
        redirect('barang/stok_masuk');
    }

    function tambah_stok_proses()
    {
        $tanggal_transaksi = $this->input->post('tanggal_transaksi');
        $kodebarang = $this->input->post('kodebarang');
        $jumlah_masuk = $this->input->post('jumlah_masuk');
        $kodesupplier = $this->input->post('kodesupplier');

        $data = array(
            'tanggal_transaksi' => $tanggal_transaksi,
            'kodebarang' => $kodebarang,
            'jumlah_masuk' => $jumlah_masuk,
            'kodesupplier' => $kodesupplier,
            'id_user' => $this->session->id_user
        );

        $barang = $this->m_barang->get_data($kodebarang);

        $dataBarang = [
            'kodebarang' => $barang->kodebarang,
            'namabarang' => $barang->namabarang,
            'hargabeli' => $barang->hargabeli,
            'hargajual' => $barang->hargajual,
            'stok' => $barang->stok + $jumlah_masuk,
        ];
        $this->m_barang->update($dataBarang);

        $this->m_barang->input_stok($data);

		$this->session->set_flashdata('msg',strtoupper("data berhasil ditambahkan"));
		$this->session->set_flashdata('kind',"success");


        redirect('barang/stok_masuk');
    }

    function tambah_proses()
    {
        $kodebarang = $this->input->post('kodebarang');
        $namabarang = $this->input->post('namabarang');
        $hargabeli = $this->input->post('hargabeli');
        $hargajual = $this->input->post('hargajual');
        $stok = $this->input->post('stok');

        $data = array(
            'kodebarang' => $kodebarang,
            'namabarang' => $namabarang,
            'hargabeli' => $hargabeli,
            'hargajual' => $hargajual,
            'stok' => $stok
        );
        $this->m_barang->input_barang($data);

		$this->session->set_flashdata('msg',strtoupper("data berhasil ditambahkan"));
		$this->session->set_flashdata('kind',"success");


        redirect('barang');
    }

    public function hapus()
    {
        $this->m_barang->hapusData($this->input->get('kode'));
        
        $this->session->set_flashdata('msg',strtoupper("data berhasil dihapus"));
		$this->session->set_flashdata('kind',"danger");

        redirect('barang');
    }

    function edit_proses()
    {
        $kodebarang = $this->input->post('kodebarang');
        $namabarang = $this->input->post('namabarang');
        $hargabeli = $this->input->post('hargabeli');
        $hargajual = $this->input->post('hargajual');
        $stok = $this->input->post('stok');

        $data = array(
            'kodebarang' => $kodebarang,
            'namabarang' => $namabarang,
            'hargabeli' => $hargabeli,
            'hargajual' => $hargajual,
            'stok' => $stok
        );
        $this->m_barang->update($data);

        $this->session->set_flashdata('msg',strtoupper("data berhasil diedit"));
		$this->session->set_flashdata('kind',"warning");

        redirect('barang');
    }

    function get_barang()
    {
        $kodebarang = $this->input->get('kode');
        $data['barang'] = $this->m_barang->get_data($kodebarang);
        echo json_encode($data["barang"]);
    }
}
