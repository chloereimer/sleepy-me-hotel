<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,700,800">
  <link rel="stylesheet" href="<?php echo assets_url('style.php?p=_master.scss') ?>">
  <title><?php echo isset($title) ? "$title – Sleepy-Me Hotel" : "Sleepy-Me Hotel"; ?></title>
</head>
<body>
<header class="site-header">
  <h1 class="brand">Sleepy-Me Hotel</h1>
  <nav class="navigation">
    <ul>
      <li><a href="<?php echo base_url('/') ?>">Home</a></li>
      <li><a href="<?php echo base_url('/rooms') ?>">Rooms & Rates</a></li>
      <li><a href="<?php echo base_url('/reservations') ?>">Reservations</a></li>
      <li><a href="<?php echo base_url('/contact') ?>">Contact Us</a></li>
      <li><a href="<?php echo base_url('/admin') ?>">Admin</a></li>
    </ul>
  </nav>
</header>
<main class="site-main">
