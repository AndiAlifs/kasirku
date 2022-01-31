<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembelian</title>
    <style>
        th {
            border-bottom: 1pt solid black;
            border-top: 1pt solid black;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center">Invoice Pembelian</h2>
    <br>
    <table style="width: 50%;">
        <tr>
            <td colspan="2">Nomor Nota</td>
            <td> : </td>
            <td colspan="4"><?=$transaksi->nota?></td>
        </tr>
        <tr>
            <td colspan="2">Tanggal Transaksi</td>
            <td> : </td>
            <td colspan="4"><?=$transaksi->tanggal?></td>
        </tr>
    </table>
    <br><br>
    <table id="barang" style="width: 100%";>
        <tr ">
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga Satuan</th>
            <th>Harga Total</th>
        </tr>
        <?php $this->load->model('m_barang');?>
        <?php for ($i=0; $i < count($quantity); $i++) :?>
        <tr>
            <td><?=$kode[$i]?></td>
            <td><?=$this->m_barang->get_data($kode[$i])->namabarang?></td>
            <td><?=$quantity[$i]?></td>
            <td>Rp. <?=$this->m_barang->get_data($kode[$i])->hargajual?></td>
            <td>Rp. <?= intval($this->m_barang->get_data($kode[$i])->hargajual)*intval($quantity[$i]) ?></td>
        </tr>
        <?php endfor;?>
    </table>
    <br><br>
    <table style="width: 100%;";>
        <tr>
            <td style="padding-left: 50%;"><h3>Total Bayar</h3></td>
            <td style="text-align: right;"><h3>Rp. <?=$transaksi->total_bayar?></h3></td>
        </tr>
        <tr>
            <td style="padding-left: 50%;"><h3>Jumlah Bayar</h3></td>
            <td style="text-align: right;"><h3>Rp. <?=$transaksi->jumlah_uang?></h3></td>
        </tr>
        <tr>
            <td style="padding-left: 50%;"><h3>Kembalian</h3></td>
            <td style="text-align: right;"><h3>Rp. <?=intval($transaksi->jumlah_uang) - intval($transaksi->total_bayar)?></h3></td>
        </tr>
    </table>
</body>
</html>