<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BASENGOK | All-in-one solution for your trip to Pulang Pisau Regency</title>

  <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Datepicker -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
  <!-- Animation -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/animation/animation.css">
  <!-- JQuery UI -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/jquery-ui/jquery-ui.css">
  <!-- Selectpicker -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/plugins/bootstrap-select/css/bootstrap-select.css">

</head>

<?php
// Check if the current page is the home page
$isHomePage = ($_SERVER['REQUEST_URI'] === '/basengok/');
$bgImage = base_url('assets/img/bg.jpg');

// If it is the home page, include the style
if ($isHomePage) {
  echo '<body class="d-flex flex-column h-100">';
  echo '<style>
          body {
                background-image: url("' . $bgImage . '"); 
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
                }
          </style>';
} else {
  echo '<body class="d-flex flex-column h-100">';
}
?>

<main class="flex-shrink-0 text-white">