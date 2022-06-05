<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
	function show_barang()
	{
		$hasil = $this->db->query("SELECT * FROM barang")->result();
		return $hasil;
	}

	public function get_data($kodebarang)
	{
		$this->db->where('kodebarang', $kodebarang);
		return $this->db->get('barang')->row();
	}

	public function get_all_kodebarang()
	{
		$hasil = $this->db->query("SELECT kodebarang FROM barang")->result();
		return $hasil;
	}

	function show_stok()
	{
		$hasil = $this->db->query("
				SELECT namabarang, kodebarang, stok as total_stok 
				FROM barang")
			->result();
		return $hasil;
	}
	

	function show_stokmasuk()
	{
		$hasil = $this->db->query("SELECT bm.id, bm.tanggal_transaksi, b.kodebarang, namabarang, jumlah_masuk, p.kode_supplier, p.nama_supplier
								FROM pembelian bm, barang b, supplier p
								WHERE bm.kodebarang = b.kodebarang AND bm.kodesupplier = p.kode_supplier")
								->result();
		return $hasil;
	}

	function show_stokmasuk_by_date($dari, $sampai)
	{
		$hasil = $this->db->query("SELECT bm.id, bm.tanggal_transaksi, b.kodebarang, namabarang, jumlah_masuk, p.kode_supplier, p.nama_supplier
								FROM pembelian bm, barang b, supplier p
								WHERE bm.kodebarang = b.kodebarang AND bm.kodesupplier = p.kode_supplier
								AND bm.tanggal_transaksi >= '$dari 00:00:00' 
								AND bm.tanggal_transaksi <= '$sampai 23:59:59' ")
								->result();
		return $hasil;
	}

	function input_stok($data)
	{
		$hasil = $this->db->insert('pembelian', $data);
		return $hasil;
	}

	function hapus_stok($kode)
	{
		$deleteStok = $this->db->where('id', $kode)->get('pembelian')->row();
		$curentBarang = $this->db->where('kodebarang', $deleteStok->kodebarang)->get('barang')->row();
		$new_stok = $curentBarang->stok - $deleteStok->jumlah_masuk;
		$this->db->query("UPDATE barang SET stok = '$new_stok' WHERE kodebarang = '$curentBarang->kodebarang'");
		$hasil = $this->db->where('id', $kode)->delete('pembelian');
		return $hasil;
	}

	function totalStok_byDate($date)
	{
		$this->db->select_sum('jumlah_masuk');
		$this->db->like('tanggal_transaksi', $date, 'after');
		return $this->db->get('pembelian')->row()->jumlah_masuk;
	}

	function input_barang($data)
	{
		$this->db->insert('barang', $data);
	}

	public function hapusData($kodebarang)
	{
		$this->db->where('kodebarang', $kodebarang);
		$this->db->delete('barang');
	}

	public function update($data)
	{
		$this->db->where('kodebarang', $data["kodebarang"]);
		$this->db->update('barang', $data);
	}

	public function jual_barang($kodebarang, $qty, $tanggal,$nota)
	{
		$barang = $this->get_data($kodebarang);
		$dataBarang = [
			'kodebarang' => $barang->kodebarang,
			'namabarang' => $barang->namabarang,
			'hargabeli' => $barang->hargabeli,
			'hargajual' => $barang->hargajual,
			'stok' => $barang->stok - $qty,
		];
		$this->update($dataBarang);
		$data = [
			'tanggal_transaksi' => $tanggal,
			'kodebarang' => $kodebarang,
			'jumlah_keluar' => $qty,
			'kodenota' => $nota
		];
		
		$this->db->insert('barangterjual',$data);
	}
}
