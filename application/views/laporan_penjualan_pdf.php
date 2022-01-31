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
    <h2 style="text-align: center;">Laporan Penjualan</h2>
    <table id="table">
    <thead>
                                        <tr>
                                            <th>Nota</th>
                                            <th>Waktu Transaksi</th>
                                            <th>Item</th>
                                            <th>Total Bayar</th>
                                            <th>Jumlah Uang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transaksi_all as $value) : ?>
                                        <tr>
                                            <td><?= $value->nota ?></td>
                                            <td><?= $value->tanggal ?></td>
                                            <td>
                                                <ul>
                                                    <?php for ($i = 0; $i < count($value->namabarang); $i++) : ?>
                                                    <li><?= $value->namabarang[$i] ?> x <?= $value->quantity[$i] ?></li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </td>
                                            <td>Rp. <?= $value->total_bayar ?></td>
                                            <td>Rp. <?= $value->jumlah_uang ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
    </table>

</body>

</html>