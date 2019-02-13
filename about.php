<?php
require 'app/dbconfig.php';
require_once 'app/session.php';
include_once 'app/class.crud.php';
include_once 'app/orderconfig.php';
include_once 'app/customerConfig.php';
include_once 'app/class.order.php';
include_once 'app/class.customer.php';
require_once 'app/class.user.php';
require_once 'app/class.statistics.php';

$crud = new crud();
$neworder = new ORDER();
$customer = new CUSTOMER();
$user = new USER();
$stat = new Statistic();

?>

<!DOCTYPE html>
<html lang="en">
<style type="text/css">

.table-fill1 {
  background: white;
  border-radius: 3px;
  border-collapse: collapse;
  margin: auto;
  margin-top: 85px;
  max-width: 100%;
  padding: 5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
</style>

  <head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet">
  	<script src="css/Chart.js"></script>
  </head>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header" style="height:80px;">

          <a class="navbar-brand" href="about.php" style="width:315px; height:80px;">
                      <h1 style="color:white; float:right;">Print It Photo</h1>
          <img src="Printlogo3-dropShadow.png" style="float:left; width:50px;height:75px; margin: -20px auto 0px;">
          </a>
          
        </div>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="about.php">ORDERS</a></li>
            <!--<li><a href="payments.php">STATS</a></li>-->
            <li><a href="logout.php?logout=true">LOG OUT</a></li>

          </ul>
          
        </div>

    </div>

              <table class="table-fill1" align="center" style"margin-top:150px;" >
    <thead>
       <?php

  $query = 'SELECT * FROM customers ORDER BY ID DESC';
  $records_per_page = 5;
  $newquery = $customer->paging($query, $records_per_page);
  $customer->dataview($query);

  ?>

  

  </thead>
</table>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
