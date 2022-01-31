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
                            <h1>Supplier</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li class="active">Supplier</li>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Data</button>
                                </div>
                                <div class="card-body">
                                    <table id="table1" class="table table-striped table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th>Kode Supplier</th>
                                                <th>Nama Supplier</th>
                                                <th>No Hp Supplier</th>
                                                <th>Alamat Supplier</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($suppliers as $value) : ?>
                                                <tr>
                                                    <td><?= strtoupper($value->kode_supplier) ?></td>
                                                    <td><?= $value->nama_supplier ?></td>
                                                    <td><?= $value->nohp_supplier ?></td>
                                                    <td><?= $value->alamat_supplier ?></td>
                                                    <td>
                                                        <a href="<?=site_url().'/supplier/hapus?kode='.$value->kode_supplier?>" class="btn btn-danger">Hapus</a>
                                                        <a href="<?=site_url().'/supplier/edit?kode='.$value->kode_supplier?>" class="btn btn-warning mr-0">Edit</a>
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
                    <form action="<?= site_url() . '/supplier/tambah_proses' ?>" method="post">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_supplier" class="col-form-label">Kode Supplier : </label>
                                <input type="text" class="form-control" name="kode_supplier" id="kode_supplier">
                            </div>
                            <div class="form-group">
                                <label for="nama_supplier" class="col-form-label">Nama Supplier : </label>
                                <input type="text" class="form-control" name="nama_supplier" id="nama_supplier">
                            </div>
                            <div class="form-group">
                                <label for="nohp_supplier" class="col-form-label">Nomor HP Supplier : </label>
                                <input type="text" class="form-control" name="nohp_supplier" id="nohp_supplier">
                            </div>
                            <div class="form-group">
                                <label for="alamat_supplier" class="col-form-label">Alamat Supplier : </label>
                                <input type="text" class="form-control" name="alamat_supplier" id="alamat_supplier">
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