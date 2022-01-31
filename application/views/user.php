<?php
$data['pageName'] = 'User Configuration';
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
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <?=form_open_multipart('user/update')?>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <img src="<?= base_url('uploads/'.$this->m_user->get_photo($this->session->id)->image) ?>" alt="">
                                            <input type="text" name="user_id" id="user_id" value="<?=$user->id_user?>" hidden>
                                            <div>
                                                <input class="form-control" type="file" id="image" name="image">
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-success" value="upload">Submit</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div>
                                                <label for="username" class="form-label">Nama</label>
                                                <input class="form-control" type="text" name="username" id="username" value="<?=$user->username?>">
                                            </div>
                                            <div class="mt-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="password" id="password">
                                            </div>
                                            <div class="mt-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="password2" id="password2">
                                            </div>
                                        </div>
                                    </div>
                                </form>
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