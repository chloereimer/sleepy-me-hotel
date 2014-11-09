<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="stylesheet" href="<?php echo stylesheets_url('master.css') ?>">
  <link rel="stylesheet" href="<?php echo javascripts_url('jquery-ui/jquery-ui.min.css') ?>">
  <title><?php echo isset($title) ? "$title – Sleepy-Me Hotel" : "Sleepy-Me Hotel"; ?></title>
  <script src="<?php echo javascripts_url('modernizr/modernizr.js'); ?>"></script> <!-- yes yes this should be a custom modernizr eventually -->
  <script src="<?php echo javascripts_url('jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo javascripts_url('jquery-ui/jquery-ui.min.js') ?>"></script>
  <script src="<?php echo javascripts_url('application.js'); ?>"></script>
  <script>
    $(document).ready(function(){
      SleepyMe.initializeStickyFooter();
    });
  </script>
</head>
<body>
<nav class="site-navigation">
  <ul>
    <li><a href="<?php echo site_url('/') ?>">Home</a></li>
    <li><a href="<?php echo site_url('/rooms') ?>">Rooms & Rates</a></li>
    <li><a href="<?php echo site_url('/reservations') ?>">Reservations</a></li>
    <li><a href="<?php echo site_url('/contact') ?>">Contact Us</a></li>
    <li class="admin"><a href="<?php echo site_url('/admin') ?>">Admin</a></li>
  </ul>
</nav>
<header class="site-header">
  <h1 class="brand">
    <div class="logo-container">
      <div class="sleepy-me">Sleepy-Me</div>
      <div class="hotel">Hotel</div>
    </div>
  </h1>
</header>
<main class="site-main">

  <?php $message = $this->session->flashdata('message'); ?>
  <?php if ( !empty( $message ) ) : ?>
    <div class="alert page-alert <?php echo $this->session->flashdata('messageType') ?>">
      <?= $this->session->flashdata('message'); ?>
    </div>
  <? endif; ?>
