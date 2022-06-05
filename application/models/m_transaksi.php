<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    function insert($data)
    {
        $this->db->insert('transaksi_penjualan',$data);
        return $this->db->insert_id();
    }

    function totalTransaksi_bydate($date)
    {
        $this->db->like('tanggal', $date, 'after');
        $this->db->from('transaksi_penjualan');
        return $this->db->count_all_results();
    }

    function totalIncome_bydate($date)
    {
        $this->db->select_sum('total_bayar');
        $this->db->like('tanggal', $date, 'after');
        return $this->db->get('transaksi_penjualan')->row()->total_bayar;
    }

    function transaksi_detail($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('transaksi_penjualan')->row();
    }

    function laporan_penjualan()
    {
        return $this->db->order_by('tanggal','desc')->get('transaksi_penjualan')->result();
    }

    function laporan_penjualan_by_date($dari, $sampai)
    {   
        $this->db->where('tanggal >=', $dari.' 00:00:00');
        $this->db->where('tanggal <=', $sampai.' 23:59:59');
        return $this->db->order_by('tanggal','desc')->get('transaksi_penjualan')->result();
    }

    // function laporan_stok_jual()
    // {   
    //     $transaksi = $this->db->get('penjualan')->result();
    //     return $transaksi;
    // }

    // function laporan_stok_jual_by_date($dari, $sampai)
    // {   
    //     $this->db->where('tanggal_transaksi >=', $dari.' 00:00:00');
    //     $this->db->where('tanggal_transaksi <=', $sampai.' 23:59:59');
    //     $transaksi = $this->db->get('penjualan')->result();
    //     return $transaksi;
    // }

    function laporan_pembelian()
    {   
        return $this->db->order_by('tanggal_transaksi','desc')->get('pembelian')->result();
    }

    function laporan_pembelian_by_date($dari, $sampai)
    {   
        $this->db->where('tanggal_transaksi >=', $dari.' 00:00:00');
        $this->db->where('tanggal_transaksi <=', $sampai.' 23:59:59');
        return $this->db->order_by('tanggal_transaksi','desc')->get('pembelian')->result();
    }

    function hapus($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('transaksi_penjualan');
    }
}