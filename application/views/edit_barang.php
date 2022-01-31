    <?php
    $data['pageName'] = 'Edit Barang';
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
                            <h1>Barang</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Barang</a></li>
                                <li class="active">Edit Barang</li>
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
                                    <form action="<?= site_url() . '/barang/edit_proses' ?>" method="post">
                                        <div class="form-group">
                                            <label for="kodebarang" class="col-form-label">Kode Barang : </label>
                                            <input type="text" class="form-control" name="kodebarang" id="kodebarang" value="<?=$barang->kodebarang?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="namabarang" class="col-form-label">Nama Barang : </label>
                                            <input type="text" class="form-control" name="namabarang" id="namabarang" value="<?=$barang->namabarang?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="hargabeli" class="col-form-label">Harga Beli : </label>
                                            <input type="text" class="form-control" name="hargabeli" id="hargabeli" value="<?=$barang->hargabeli?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="hargajual" class="col-form-label">Harga Jual : </label>
                                            <input type="text" class="form-control" name="hargajual" id="hargajual" value="<?=$barang->hargajual?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="stok" class="col-form-label">Stok : </label>
                                            <input type="number" class="form-control" name="stok" id="stok" value="<?=$barang->stok?>">
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