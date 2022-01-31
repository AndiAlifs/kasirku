    <?php
    $data['pageName'] = 'Kasir';
    $this->load->view('partials/head', $data);
    ?>

    <body onload="getNama()">
        <?php $this->load->view('partials/left_panel') ?>


        <div id="right-panel" class="right-panel">

            <?php $this->load->view('partials/header') ?>

            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Kasir</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li class="active">Kasir</li>
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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Kode Barang</label>
                                                <div class="form-inline">
                                                    <select id="kodebarang" class="form-control select2 col-sm-6" onchange="getNama()"">
                                                        <?php foreach ($kode_barang as $value) : ?>
                                                            <option value="<?= $value->kodebarang ?>"><?= $value->kodebarang ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span class="ml-3 text-muted" id="nama_produk"></span>
                                                </div>
                                                <small class="form-text text-muted" id="sisa"></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="number" class="form-control col-sm-6" placeholder="Jumlah" id="jumlah">
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary" onclick="tambahData()">Tambah</button>
                                                <button id="bayar" class="btn btn-success" data-toggle="modal" data-target="#modalTambah" onclick="openKasir()">Bayar</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 d-flex justify-content-end text-right nota">
                                            <div>
                                                <div class="mb-0">
                                                    <b class="mr-2">Nota</b> <span id="nota"><?= $nota ?></span>
                                                </div>
                                                <span id="total" style="font-size: 80px; line-height: 1" class="text-danger">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="transaksi" class="table table-bordered w-100 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
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
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Bayar</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tanggal" class="col-form-label">Tanggal : </label>
                                <input type="datetime-local" class="form-control" name="tanggal" id="tanggal">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_uang" class="col-form-label">Jumlah uang : </label>
                                <input type="text" class="form-control" name="jumlah_uang" id="jumlah_uang" onkeyup="cekKembalian()">
                            </div>
                            <div class="form-group">
                                <label for="diskon" class="col-form-label">Diskon : </label>
                                <input type="text" class="form-control" name="diskon" id="diskon" onkeyup="cekDiskon()">
                            </div>
                            <div class="form-group">
                                <label  class="col-form-label">Total Bayar : </label>
                                <span id="total_bayar"></span>
                            </div>
                            <div class="form-group">
                                <label  class="col-form-label">Kembalian : </label>
                                <span id="kembalian"></span>
                            </div>
                            
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" onclick="submitBayar()">Bayar</button>
                            <button type="submit" class="btn btn-primary" onclick="submitBayarAndCetak()">Bayar dan Cetak</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    
                </div>
            </div>
        </div>
        <?php $this->load->view('partials/footer') ?>

        <script>
            let get_url = "<?= site_url() . '/barang/get_barang' ?>";
            let cetak_url = "<?= site_url() . '/transaksi/invoice?kode=' ?>";
            let add_url = "<?= site_url() . '/transaksi/tambah_proses' ?>";

            function reloadpage() {
                location.reload(true);
            }
            
            function getNama() {
                $.ajax({
                    url: get_url,
                    type: "get",
                    data: {
                        kode: $("#kodebarang").val()
                    },
                    success: res => {
                        var data = JSON.parse(res);
                        $("#nama_produk").html(data.namabarang);
                        $("#sisa").html(`Sisa ${data.stok}`);
                    },
                    error: res => {
                        console.log(err);
                    }
                })
            };

            function tambahData() {
                var jumlah = $("#jumlah").val();
                var totalNow = parseInt($("#total").html());
                $.ajax({
                    url: get_url,
                    type: "get",
                    data: {
                        kode: $("#kodebarang").val()
                    },
                    success: res => {
                        var data = JSON.parse(res);
                        $("#transaksi").append('<tr id='+data.kodebarang+'><td>'+data.kodebarang+'</td><td>'+data.namabarang+'</td><td>'+jumlah+'</td><td>'+data.hargajual+'</td><td>'+ '<button class="btn btn-danger btn-sm" onclick="hapusData('+String(data.kodebarang)+')">Hapus</button>'+'</td></tr>');
                        $("#total").html(totalNow + $("#jumlah").val()*parseInt(data.hargajual));
                        $("#nama_produk").html("");
                        $("#jumlah").val(0);
                        $("#sisa").html("");
                    },
                    error: res => {
                        console.log(err);
                    }
                })
            }

            function hapusData(row) {
                var totalNow = parseInt($("#total").html());
                $("#total").html(totalNow - parseInt(row.getElementsByTagName("td")[2].innerHTML)*parseInt(row.getElementsByTagName("td")[3].innerHTML));
                row.remove();
            }

            function openKasir() {
                $('#total_bayar').html($('#total').html())
                $('#kembalian').html(0)
            }

            function cekKembalian() {
                $('#kembalian').html(parseInt($('#jumlah_uang').val()) - parseInt($('#total_bayar').html()))
            }

            function cekDiskon() {
                $('#total_bayar').html(parseInt($('#total').html()) - parseInt($('#diskon').val()))
                cekKembalian()
            }

            function submitBayar() {
                var allData = $('tbody').find('tr'),
                allKode = [],
                allQty = [];

                $.each(allData, function () {
                    allKode.push($(this).find('td')[0].innerHTML);
                    allQty.push($(this).find('td')[2].innerHTML);
                })

                $.ajax({
                    url: add_url,
                    type: "post",
                    dataType: "json",
                    data: {
                        tanggal: $("#tanggal").val(),
                        kodebarang: allKode.toString(),
                        quantity: allQty.toString(),
                        total_bayar: $("#total_bayar").html(),
                        jumlah_uang: $("#jumlah_uang").val(),
                        diskon: $("#diskon").val(),
                        nota: $("#nota").html(),
                    },
                    success: res => {
                        console.log("berhasil nota " + res);
                        window.location.reload();
                    },
                    error: err => {
                        console.log(err);
                    }
                })
            }

            function submitBayarAndCetak() {
                var allData = $('tbody').find('tr'),
                allKode = [],
                allQty = [];

                $.each(allData, function () {
                    allKode.push($(this).find('td')[0].innerHTML);
                    allQty.push($(this).find('td')[2].innerHTML);
                })

                $.ajax({
                    url: add_url,
                    type: "post",
                    dataType: "json",
                    data: {
                        tanggal: $("#tanggal").val(),
                        kodebarang: allKode.toString(),
                        quantity: allQty.toString(),
                        total_bayar: $("#total_bayar").html(),
                        jumlah_uang: $("#jumlah_uang").val(),
                        diskon: $("#diskon").val(),
                        nota: $("#nota").html(),
                    },
                    success: res => {
                        console.log("berhasil nota " + res);
                        window.location.assign(cetak_url+res);
                    },
                    error: err => {
                        console.log(err);
                    }
                })
            }
        </script>

    </body>

    </html>