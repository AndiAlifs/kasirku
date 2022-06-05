<?php
$data['pageName'] = 'Stok Masuk';
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
                        <h1>Data Barang</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Data Barang</a></li>
                            <li class="active">Stok Masuk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?= $this->session->flashdata('msg') ?>
            </div>
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Stok Masuk</button>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Waktu Masuk</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Stok Masuk</th>
                                            <th>Nama Supplier</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stok as $value) : ?>
                                            <tr>
                                                <td><?= $value->tanggal_transaksi ?></td>
                                                <td><?= strtoupper($value->kodebarang) ?></td>
                                                <td><?= ucwords($value->namabarang) ?></td>
                                                <td><?= $value->jumlah_masuk ?></td>
                                                <td><?= $value->nama_supplier ?></td>
                                                <td>
                                                    <a href="<?= site_url() . '/barang/hapus_stok?kode=' . $value->id ?>" class="btn btn-danger">Hapus</a>
                                                    <!-- <a href="<?= site_url() . '/barang/edit_stok?kode=' . $value->id ?>" class="btn btn-warning mr-0">Edit</a> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="<?= site_url() . '/barang/tambah_stok_proses' ?>" method="post">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Stok</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Tanggal : </label>
                            <input type="datetime-local" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi">
                        </div>
                        <div class="form-group">
                            <label for="kodebarang" class="col-form-label">Nama Barang : </label>
                            <select class="form-control" name="kodebarang" id="kodebarang">
                                <?php foreach ($barang as $value) : ?>
                                    <option value="<?= $value->kodebarang ?>"><?= $value->kodebarang ?> - <?= $value->namabarang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stok" class="col-form-label">Jumlah Stok : </label>
                            <input type="number" class="form-control" name="jumlah_masuk" id="jumlah_masuk">
                        </div>
                        <div class="form-group">
                            <label for="kodesupplier" class="col-form-label">Supplier : </label>
                            <select class="form-control" name="kodesupplier" id="kodesupplier">
                                <?php foreach ($supplier as $value) : ?>
                                    <option value="<?= $value->kode_supplier ?>"><?= $value->kode_supplier ?> - <?= $value->nama_supplier ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah Data</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>


                </form>

            </div>
        </div>
    </div>

    <?php $this->load->view('partials/footer') ?>

</body>

</html>