<?php
$data['pageName'] = 'Supplier';
$this->load->view('partials/head', $data);
?>

<body>
    <?php $this->load->view('partials/left_panel') ?>


    <div id="right-panel" class="right-panel">

        <?php $this->load->view('partials/header') ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Laporan Pembelian</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= site_url() ?>">Dashboard</a></li>
                            <li class="active">Laporan Pembelian</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="col-5 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Dari</div>
                                            </div>
                                            <input type="date" class="form-control" name="dari" id="dari">
                                        </div>
                                        <div class="col-5 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Sampai</div>
                                            </div>
                                            <input type="date" class="form-control" name="sampai" id="sampai">
                                        </div>
                                        <div class="col-2 input-group">
                                            <button type="submit" class="form-control btn btn-primary btn-block">Filter</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="card-body">
                                <table id="table1" class="table table-striped table-bordered" style="width:100%">
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
                            </div>
                            <div class="card-footer">
                                <?php if (isset($_GET['dari']) && isset($_GET['sampai'])) : ?>
                                    <a href="<?= site_url('transaksi/laporan_pembelian_pdf') . '?dari=' . $_GET['dari'] . '&sampai=' . $_GET['sampai'] ?>" class="btn btn-danger float-right"> <i class="ti-printer"></i> Print PDF</a>
                                <?php else : ?>
                                    <a href="<?= site_url('transaksi/laporan_pembelian_pdf') ?>" class="btn btn-danger float-right"> <i class="ti-printer"></i> Print PDF</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div>

    <?php $this->load->view('partials/footer') ?>
    <script>
        $('#table1').dataTable({
            "order": [
                [0, 'desc']
            ]
        });
    </script>

</body>

</html>