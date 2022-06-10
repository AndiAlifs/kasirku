<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="<?= site_url('/') ?>css/images/casapp1.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="<?= site_url('/') ?>css/images/casapp2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?php echo site_url(); ?>dashboard"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>

                <li>
                    <a href="<?php echo site_url(); ?>supplier"> <i class="menu-icon fa fa-truck"></i>Supplier</a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Barang</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-archive"></i><a href="<?php echo site_url(); ?>barang">Data Barang</a></li>
                        <li><i class="fa fa-archive"></i><a href="<?php echo site_url() . 'barang/stok'; ?>">Stok Barang</a></li>
                        <li><i class="fa fa-archive"></i><a href="<?php echo site_url() . 'barang/stok_masuk'; ?>">Stok Masuk</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?=site_url('/transaksi')?>"> <i class="menu-icon fa fa-desktop"></i>Kasir</a>
                </li>

                <?php if($this->session->role == "pemilik"):?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file-text"></i>Laporan</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-text"></i><a href="<?=site_url('transaksi/laporan_penjualan')?>">Laporan Penjualan</a></li>
                            <li><i class="fa fa-file-text"></i><a href="<?=site_url('transaksi/laporan_pembelian')?>">Laporan Pembelian</a></li>
                            <!-- <li><i class="fa fa-file-text"></i><a href="<?=site_url('transaksi/laporan_stok')?>">Laporan Stok Barang</a></li> -->
                            <li><i class="fa fa-file-text"></i><a href="<?=site_url('transaksi/laporan_keuangan')?>">Laporan Keuangan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>pegawai"> <i class="menu-icon fa fa-user"></i>Pegawai</a>
                    </li>
                <?php endif;?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->