<?php
$data['pageName'] = 'Laporan Stok';
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
                        <h1>Laporan Keuangan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= site_url() ?>">Dashboard</a></li>
                            <li class="active">Laporan Keuangan</li>
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
                                <canvas id="myChart" width="400" height="150"></canvas>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-danger float-right" onclick="downloadPDF()"> <i class="ti-printer"></i> Print PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div>

    <?php $this->load->view('partials/footer') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script>
        var canvas = document.getElementById("myChart");
        var ctx = canvas.getContext("2d");
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = "#FFFFFF";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        const labels = <?= $date ?>;
        const data = {
            labels: labels,
            datasets: [{
                label: 'Total Pendapatan',
                fill: false,
                backgroundColor: 'rgb(99, 177, 255)',
                borderColor: 'rgb(99, 177, 255)',
                data: <?= $income ?>,
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );



        function downloadPDF() {
            var canvas = document.querySelector('#myChart');
            //creates image
            var canvasImg = canvas.toDataURL("image/png", 1.0);

            //creates PDF from img
            var doc = new jsPDF('landscape');
            doc.setFontSize(20);
            doc.text(15, 15, "Total Pendapatan Mingguan");
            doc.addImage(canvasImg, 'PNG', 10, 10, 280, 150);
            doc.save('Laporan Keuangan Mingguan.pdf');
        }
    </script>

</body>

</html>