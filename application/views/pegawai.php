<?php
$data['pageName'] = 'User';
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
                        <h1>User</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <?php if ($this->session->flashdata('msg')) : ?>
                <div class="alert alert-<?= $this->session->flashdata('kind') ?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?= $this->session->flashdata('msg') ?>
                </div>
            <?php endif; ?>

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahProfil">Tambah Data</button>
                            </div>
                            <div class="card-body">
                                <table id="table1" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>NIP </th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user as $value) : ?>
                                            <tr>
                                                <td><?= $value->id_user ?></td>
                                                <td><?= $value->nama ?></td>
                                                <td><?= $value->username ?></td>
                                                <td><?= $value->password ?></td>
                                                <td><img src="<?= base_url() . 'uploads/' . $value->image; ?>" width="100" height="120"></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditProfil<?= $value->id_user ?>">Edit</button>
                                                    <a href="<?= site_url() . '/user/hapus?id=' . $value->id_user ?>" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalTambahProfil">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <?php echo form_open_multipart('user/tambah_proses'); ?>
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_user" class="col-form-label">NIP: </label>
                        <input type="text" class="form-control" name="id_user" id="id_user">
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama : </label>
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username : </label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password : </label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="file" class="col-form-label">Foto</label>
                        <br /><span class="text-danger">Format: jpg/jpeg/png</span>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="file">
                                <label class="custom-file-label" for="file">Choose Foto</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah Data</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <?php foreach ($user as $value) : ?>
        <div class="modal fade" id="modalEditProfil<?= $value->id_user ?>">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <?php echo form_open_multipart('user/update'); ?>
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_user" class="col-form-label">NIP : </label>
                            <input type="text" class="form-control" name="id_user" id="id_user" value="<?= $value->id_user ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama : </label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $value->nama ?>">
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username : </label>
                            <input type="text" class="form-control" name="username" id="username" value="<?= $value->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password : </label>
                            <input type="password" class="form-control" name="password" id="password" value="<?= $value->password ?>">
                        </div>
                        <div class="form-group">
                            <label for="file" class="col-form-label">Foto</label>
                            <br /><span class="text-danger">Format: jpg/jpeg/png (5Mb)</span>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="file">
                                    <label class="custom-file-label" for="file">Choose Foto</label>
                                </div>
                            </div>
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