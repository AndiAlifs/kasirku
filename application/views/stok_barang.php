<?php
$data['pageName'] = 'Stok Barang';
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
                        <h1>Stok Barang</h1>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Barang</a></li>
                            <li class="active">Stok Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content mt-3">
        <?php if($this->session->flashdata('msg')):?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?= $this->session->flashdata('msg')?>
            </div>
            <?php endif;?>
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <button type="button" class="btn btn-primary">Tambah Data</button> -->
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stok as $value) : ?>
                                            <tr>
                                                <td><?= strtoupper($value->kodebarang) ?></td>
                                                <td><?= ucwords($value->namabarang) ?></td>
                                                <td><?= $value->total_stok ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditBarang<?= $value->kodebarang?>">Edit</button>
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

    <!-- Edit Modal -->
    <?php foreach ($stok as $value) : ?>
    <div class="modal fade" id="modalEditBarang<?= $value->kodebarang?>">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <?php echo form_open_multipart('barang/update_stok'); ?>
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Barang</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kodebarang" class="col-form-label">Kode Barang : </label>
                            <input type="text" class="form-control" name="kodebarang" id="kodebarang" value="<?= $value->kodebarang ?>">
                        </div>
                        <div class="form-group">
                            <label for="namabarang" class="col-form-label">Nama Barang : </label>
                            <input type="text" class="form-control" name="namabarang" id="namabarang" value="<?= $value->namabarang ?>">
                        </div>
                        <div class="form-group">
                            <label for="total_stok" class="col-form-label">Jumlah Stok : </label>
                            <input type="number" class="form-control" name="total_stok" id="total_stok" value="<?= $value->total_stok ?>">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit Data</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php $this->load->view('partials/footer') ?>

</body>

</html>