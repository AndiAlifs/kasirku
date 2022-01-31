<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('css/vendors/') ?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('css/vendors/') ?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('css/vendors/chart.js/dist/Chart.bundle.min.js')?>"></script>
<script src="<?php echo base_url('css/vendors/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?php echo base_url('css/vendors/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?php echo base_url('css/vendors/select2/js/select2.min.js') ?>"></script>
<script src="<?php echo base_url('css/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?php echo base_url('css/vendors/moment/moment.min.js') ?>"></script>
<script src="<?= site_url() ?>css/assets/js/init-scripts/data-table/datatables-init.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable();
    });
</script>