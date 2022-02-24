<?php
include "principal_data.php";
$id_user = $_SESSION['id_user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Constructora CHUEN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
  <meta content="Coderthemes" name="author">
  <!-- App favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
  <link rel="manifest" href="images/site.webmanifest">
  <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->

  <!-- third party css -->
  <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
  <!-- third party css end -->
  <!-- Datatables css -->
  <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />


  <!-- App css -->
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
  <link href="assets/css/app-dark.min.css?v=1.1" rel="stylesheet" type="text/css" id="dark-style" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
  <div class="wrapper">