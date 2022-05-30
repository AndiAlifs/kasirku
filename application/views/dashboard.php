<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="css/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="css/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="css/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="css/vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="css/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <?php $this->load->view('partials/left_panel') ?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <?php $this->load->view('partials/header') ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
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
            
            <div class="row">
                <div class="col-sm-6 col-lg-4">

                    <div class="card">

                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-shopping-cart-full text-primary border-primary"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Transaksi Hari Ini</div>
                                    <div class="stat-digit"><?= $transaksi_hari_ini ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?= site_url('transaksi/laporan_penjualan') ?>">More Information</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Pemasukan Hari Ini</div>
                                    <div class="stat-digit">Rp. <?= number_format($income_hari_ini, 0, ',', '.') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?= site_url('transaksi') ?>">More Information</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-package text-danger border-danger"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Stok Masuk Hari Ini</div>
                                    <div class="stat-digit"><?= $stok_hari_ini ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?= site_url('barang/stok_masuk') ?>">More Information</a>
                        </div>
                    </div>
                </div>
            </div>



        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="css/vendors/jquery/dist/jquery.min.js"></script>
    <script src="css/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="css/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="css/assets/js/main.js"></script>


    <script src="css/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="css/assets/js/dashboard.js"></script>
    <script src="css/assets/js/widgets.js"></script>
    <script src="css/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="css/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="css/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>