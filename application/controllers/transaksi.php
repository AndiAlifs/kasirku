<?php

use Dompdf\Dompdf;

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model_squrity->get_squrity();
        $this->load->model('m_transaksi');
        $this->load->model('m_barang');
        $this->load->model('m_supplier');
        $this->load->helper('url');
    }

    function randomString($len = 10)
    {
        $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $charLen = strlen($char);
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $char[rand(0, $charLen - 1)];
        }

        return $randomString;
    }

    function index()
    {
        $data['kode_barang'] = $this->m_barang->get_all_kodebarang();
        $data['nota'] = $this->randomString();
        $this->load->view('transaksi', $data);
    }

    public function tambah_proses()
    {
        $tanggal = new DateTime($this->input->post('tanggal'));
        $kodebarang = $this->input->post('kodebarang');
        $quantity = $this->input->post('quantity');
        $jumlah_uang = $this->input->post('jumlah_uang');
        $total_bayar = $this->input->post('total_bayar');
        $diskon = $this->input->post('diskon');
        $nota = $this->input->post('nota');

        $data = [
            'tanggal' => $tanggal->format('Y-m-d H:i:s'),
            'kodebarang' => $kodebarang,
            'quantity' => $quantity,
            'jumlah_uang' => $jumlah_uang,
            'total_bayar' => $total_bayar,
            'diskon' => $diskon,
            'nota' => $nota,
            'id_user' => $this->session->id_user
        ];

        $allKode = explode(',', $kodebarang);
        $allQty = explode(',', $quantity);

        for ($i = 0; $i < count($allKode); $i++) {
            $this->m_barang->jual_barang($allKode[$i], $allQty[$i], $tanggal->format('Y-m-d H:i:s'), $nota);
        }

        echo $this->m_transaksi->insert($data);
    }

    function invoice()
    {
        $data["transaksi"] = $this->m_transaksi->transaksi_detail($this->input->get('kode'));
        $data['kode'] = explode(',', $data["transaksi"]->kodebarang);
        $data['quantity'] = explode(',', $data["transaksi"]->quantity);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->load->view('invoice', $data, TRUE));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Invoice Pembayaran');
    }

    function laporan_penjualan()
    {
        if ($this->input->get('dari') && $this->input->get('sampai')) {
            $data['transaksi_all'] = $this->m_transaksi->laporan_penjualan_by_date($this->input->get('dari'), $this->input->get('sampai'));
        } else {
            $data['transaksi_all'] = $this->m_transaksi->laporan_penjualan();
        }
        foreach ($data["transaksi_all"] as $value) {
            $allKode = explode(',', $value->kodebarang);
            $namabarang = [];
            foreach ($allKode as $kode) {
                $namabarang[] = $this->m_barang->get_data($kode)->namabarang;
            }
            $value->namabarang = $namabarang;
            $value->quantity = explode(',', $value->quantity);
        };
        $this->load->view('laporan_penjualan', $data);
    }

    function laporan_penjualan_pdf()
    {
        if ($this->input->get('dari') && $this->input->get('sampai')) {
            $data['transaksi_all'] = $this->m_transaksi->laporan_penjualan_by_date($this->input->get('dari'), $this->input->get('sampai'));
        } else {
            $data['transaksi_all'] = $this->m_transaksi->laporan_penjualan();
        }
        foreach ($data["transaksi_all"] as $value) {
            $allKode = explode(',', $value->kodebarang);
            $namabarang = [];
            foreach ($allKode as $kode) {
                $namabarang[] = $this->m_barang->get_data($kode)->namabarang;
            }
            $value->namabarang = $namabarang;
            $value->quantity = explode(',', $value->quantity);
        };
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->load->view('laporan_penjualan_pdf', $data, TRUE));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan Penjualan');
    }

    function laporan_pembelian()
    {
        if ($this->input->get('dari') && $this->input->get('sampai')) {
            $data['transaksi_all'] = $this->m_transaksi->laporan_pembelian_by_date($this->input->get('dari'), $this->input->get('sampai'));
        } else {
            $data['transaksi_all'] = $this->m_transaksi->laporan_pembelian();
        }
        foreach ($data["transaksi_all"] as $value) {
            $barang = $this->m_barang->get_data($value->kodebarang);
            $supplier = $this->m_supplier->get_data($value->kodesupplier);
            $value->namasupplier = $supplier->nama_supplier;
            $value->nama_barang = $barang->namabarang;
            $value->hargabeli = $barang->hargabeli;
            $value->total_harga = $barang->hargabeli * $value->jumlah_masuk;
        };
        $this->load->view('laporan_pembelian', $data);
    }

    function laporan_pembelian_pdf()
    {
        if ($this->input->get('dari') && $this->input->get('sampai')) {
            $data['transaksi_all'] = $this->m_transaksi->laporan_pembelian_by_date($this->input->get('dari'), $this->input->get('sampai'));
        } else {
            $data['transaksi_all'] = $this->m_transaksi->laporan_pembelian();
        }
        foreach ($data["transaksi_all"] as $value) {
            $barang = $this->m_barang->get_data($value->kodebarang);
            $supplier = $this->m_supplier->get_data($value->kodesupplier);
            $value->namasupplier = $supplier->nama_supplier;
            $value->nama_barang = $barang->namabarang;
            $value->hargabeli = $barang->hargabeli;
            $value->total_harga = $barang->hargabeli * $value->jumlah_masuk;
        };
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->load->view('laporan_pembelian_pdf', $data, TRUE));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan Pembelian');
    }

    function laporan_stok()
    {
        if ($this->input->get('dari') && $this->input->get('sampai')) {
            $transaksi_keluar = $this->m_transaksi->laporan_stok_jual_by_date($this->input->get('dari'), $this->input->get('sampai'));
            $transaksi_masuk = $this->m_barang->show_stokmasuk_by_date($this->input->get('dari'), $this->input->get('sampai'));
        } else {
            $transaksi_keluar = $this->m_transaksi->laporan_stok_jual();
            $transaksi_masuk = $this->m_barang->show_stokmasuk();
        }

        foreach ($transaksi_keluar as $value) {
            $value->namabarang = $this->m_barang->get_data($value->kodebarang)->namabarang;
            $value->keterangan = "Nota Pembelian " . $value->kodenota;
            $value->quantity = $value->jumlah_keluar;
        }

        foreach ($transaksi_masuk as $value) {
            $value->keterangan = "Supplier dari " . $value->nama_supplier;
            $value->quantity = $value->jumlah_masuk;
        }

        $data["transaksi_all"] = array_merge($transaksi_keluar, $transaksi_masuk);


        usort($data["transaksi_all"], function ($a, $b) {
            if ($a->tanggal_transaksi > $b->tanggal_transaksi) {
                return -1;
            } else {
                return 1;
            }
        });
        $this->load->view('laporan_stok', $data);
    }

    function laporan_stok_pdf()
    {
        if ($this->input->get('dari') && $this->input->get('sampai')) {
            $transaksi_keluar = $this->m_transaksi->laporan_stok_jual_by_date($this->input->get('dari'), $this->input->get('sampai'));
            $transaksi_masuk = $this->m_barang->show_stokmasuk_by_date($this->input->get('dari'), $this->input->get('sampai'));
        } else {
            $transaksi_keluar = $this->m_transaksi->laporan_stok_jual();
            $transaksi_masuk = $this->m_barang->show_stokmasuk();
        }

        foreach ($transaksi_keluar as $value) {
            $value->namabarang = $this->m_barang->get_data($value->kodebarang)->namabarang;
            $value->keterangan = "Nota Pembelian " . $value->kodenota;
            $value->quantity = $value->jumlah_keluar;
        }

        foreach ($transaksi_masuk as $value) {
            $value->keterangan = "Supplier dari " . $value->nama_supplier;
            $value->quantity = $value->jumlah_masuk;
        }

        $data["transaksi_all"] = array_merge($transaksi_keluar, $transaksi_masuk);


        usort($data["transaksi_all"], function ($a, $b) {
            if ($a->tanggal_transaksi > $b->tanggal_transaksi) {
                return -1;
            } else {
                return 1;
            }
        });
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->load->view('laporan_stok_pdf', $data, TRUE));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan Stok');
    }

    public function penjualan_hapus()
    {
        $this->m_transaksi->hapus($this->input->get('kode'));
        redirect('transaksi/laporan_penjualan');
    }

    function laporan_keuangan()
    {
        $data["date"] = [];
        $data["income"] = [];
        if ($this->input->get('dari') && $this->input->get('sampai')) {
            $period = new DatePeriod(
                new DateTime($this->input->get('dari')),
                new DateInterval('P1D'),
                new DateTime($this->input->get('sampai'))
            );
            foreach ($period as $key => $value) {
                $date = $value->format('Y-m-d');
                array_push($data["date"], $date);
                $income = $this->m_transaksi->totalIncome_bydate($date);
                if ($income == null) {
                    $income = 0;
                }
                array_push($data["income"], $income);
            }
            
        } else {
            for ($i = 12; $i >= 0; $i--) {
                $day = $i . ' days ago';
                $date = new DateTime($day);
                $date = $date->format('Y-m-d');
                array_push($data["date"], $date);
                $income = $this->m_transaksi->totalIncome_bydate($date);
                if ($income == null) {
                    $income = 0;
                }
                array_push($data["income"], $income);
            }
        }
        $data["date"] = json_encode($data["date"]);
        $data["income"] = json_encode($data["income"]);
        $this->load->view('laporan_keuangan', $data);
    }
}
