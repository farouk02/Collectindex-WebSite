<?php
session_start();

// redirect user to login page if they're not logged in
if (!isset($_SESSION['id'])) {
  header("location: adminLogin.php");
}
?>

<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap Styles-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FontAwesome Styles-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- Morris Chart Styles-->
  <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
  <!-- Custom Styles-->
  <link href="assets/css/custom-styles.css" rel="stylesheet" />
  <!-- main Styles-->
  <link href="main.css" rel="stylesheet" type="text/css" />
  <!-- Google Fonts-->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css" />
  <!-- TABLE STYLES-->
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

  <title>ADE - Admin Login</title>
</head>

<body>
  <div id="wrapper">
    <?php
    include "nav_bar.php";
    ?>
    <!--/. NAV TOP  -->
    <?php
    include "side_bar.php";
    ?>
    <!-- /. NAV SIDE  -->




    <div id="page-wrapper">