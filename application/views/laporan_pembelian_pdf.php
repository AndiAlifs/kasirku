<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Pembelian</h2>
    <table id="table">
        <thead>
            <tr>
                <th>Waktu Transaksi</th>
                <th>Supplier</th>
                <th>Barang</th>
                <th>Kuantitas</th>
                <th>Harga Beli</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi_all as $value) : ?>
                <tr>
                    <td><?= $value->tanggal_transaksi ?></td>
                    <td><?= $value->namasupplier ?></td>
                    <td><?= $value->nama_barang ?></td>
                    <td><?= $value->jumlah_masuk ?></td>
                    <td>Rp. <?= $value->hargabeli ?></td>
                    <td>Rp. <?= $value->total_harga ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>