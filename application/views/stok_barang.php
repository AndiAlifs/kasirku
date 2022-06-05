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
                                                    <a href="<?= site_url() . '/barang/edit?kode=' . $value->kodebarang ?>" class="btn btn-warning mr-0">Edit</a>

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

    <?php $this->load->view('partials/footer') ?>

</body>

</html>