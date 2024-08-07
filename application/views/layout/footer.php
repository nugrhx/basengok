</main>
<footer class="footer mt-auto py-3 text-center">
  <div class="container">
    <?php
    // Check if the current page is the home page
    $isHomePage = ($this->uri->segment(1) == "");
    $tahun = date('Y');

    // If it is the home page, include the style
    if ($isHomePage) {
      echo '<span class="text-white font-weight-normal" style="font-size: 12px;">Copyright &copy; "' . $tahun . '" Dinas Kebudayaan, Kepemudaan dan Olahraga,<br /> dan Pariwisata Kabupaten Pulang Pisau</span>';
    } else {
      echo '';
    }
    ?>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src=<?= base_url('assets/js/bootstrap.js') ?>></script>
<script src=<?= base_url('assets/js/feather.js') ?>></script>
<script>
  feather.replace();
</script>

<!-- jQuery v3.6.0-->
<script src="<?= base_url('assets'); ?>/vendor/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets'); ?>/vendor/plugins/jquery-ui/jquery-ui.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  function dismiss() {
    this.dismissed = this.dismissed ? true : false;
  };
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets'); ?>/vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets'); ?>/vendor/plugins/moment/moment.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets'); ?>/vendor/dist/js/adminlte.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Bootstrap DatePicker -->
<script src="<?= base_url('assets'); ?>/vendor/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap DatePicker -->
<script src="<?= base_url('assets'); ?>/vendor/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<!-- Bootstrap Selectpicker -->
<script src="<?= base_url('assets'); ?>/vendor/plugins/bootstrap-select/js/bootstrap-select.js"></script>

</body>

</html>