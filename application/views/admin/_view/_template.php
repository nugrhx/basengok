<!DOCTYPE html>
<html>

<head>
  <title>BASENGOK ADMIN | <?php echo @$judul; ?></title>
  <link href='<?= base_url("assets/upload/image/icon.png"); ?>' rel='shortcut icon' type='image/x-icon' />
  <!-- Tell the browser to be responsive to screen width -->
  <!-- meta -->
  <?php echo @$_meta; ?>

  <!-- css -->
  <?php echo @$_css; ?>

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url('assets'); ?>/vendor/plugins/jQuery/jquery.min.js"></script>

</head>

<body class="sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- nav -->
    <?php echo @$_nav; ?>

    <!-- sidebar -->
    <?php echo @$_sidebar; ?>

    <!-- Content -->
    <?php echo @$_content; ?>


  </div>

  <!-- footer -->
  <?php echo @$_footer; ?>
  <!-- js -->
  <?php echo @$_js; ?>
</body>

</html>