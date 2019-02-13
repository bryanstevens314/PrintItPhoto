<?php
require 'app/dbconfig.php';
require_once 'app/session.php';
include_once 'app/class.crud.php';
include_once 'app/orderconfig.php';
include_once 'app/class.order.php';
$neworder = new ORDER();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet">
	<script src="css/Chart.js"></script>

  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header" style="height:80px;">

          <a class="navbar-brand" href="about.php" style="width:315px; height:50px;">
                      <h1 style="color:white; float:right;">Print It Photo</h1>
          <img src="Printlogo3-dropShadow.png" style="float:left; width:50px;height:75px; margin: -20px auto 0px;">
          </a>
          
        </div>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="about.php">ORDERS</a></li>
            <!--<li><a href="payments.php">STATS</a></li>-->
            <!--<li><a href="logout.php?logout=true">LOG OUT</a></li>-->

          </ul>
          
        </div>

    </div>



  <div class="table" align="center">
  <table class="responstable" id="responstable2" align="center" style="margin-top:80px; margin-bottom:100px; width:100%;">
       <?php
  if (is_numeric($_GET['customer_ID'])) {
      $customer_ID = $_GET['customer_ID'];

      $query = "SELECT * FROM order_Details WHERE customer_ID = '$customer_ID'";
      $records_per_page = 100;
      $newquery = $neworder->paging($query, $records_per_page);
      $neworder->ViewOrderItems($query);
  }
  ?>

  

  
</table>
</div>

	<!-- FOOTER -->
	<div id="f">
		<div class="container">
			<div class="row centered">

		
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- Footer -->