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
                                <li><a href="#">Supplier</a></li>
                                <li class="active">Edit Supplier</li>
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
                                    Edit Data
                                </div>
                                <div class="card-body">
                                    <form action="<?= site_url() . '/supplier/edit_proses' ?>" method="post">
                                        <div class="form-group">
                                            <label for="kode_supplier" class="col-form-label">Kode Supplier : </label>
                                            <input type="text" class="form-control" name="kode_supplier" id="kode_supplier" value="<?= $supplier->kode_supplier ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_supplier" class="col-form-label">Nama Supplier : </label>
                                            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" value="<?= $supplier->nama_supplier ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nohp_supplier" class="col-form-label">Nomor HP Supplier : </label>
                                            <input type="text" class="form-control" name="nohp_supplier" id="nohp_supplier" value="<?= $supplier->nohp_supplier ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_supplier" class="col-form-label">Alamat Supplier : </label>
                                            <input type="text" class="form-control" name="alamat_supplier" id="alamat_supplier" value="<?= $supplier->alamat_supplier ?>">
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    <button type="" class="btn btn-danger">Batal</button>
                                </div>
                                </form>
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


                </div>
            </div>
        </div>
        <?php $this->load->view('partials/footer') ?>

    </body>

    </html>