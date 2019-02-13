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
$stat1 = new Statistic();

?>

<!DOCTYPE html>
<html lang="en">


  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
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


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

	<div id="wrapper">
		<div id="header"></div>
		<div id="content"></div>
		<div id="footer"></div>
	</div>
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header" style="height:80px;">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                    <h1 style="color:white; float:right;">Print It Photo</h1>
          <img src="Printlogo3-dropShadow.png" style="float:left; width:50px;height:75px; margin: -20px auto 0px;">
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="about.php">ORDERS</a></li>
            <!--<li><a href="love.story.php">LOVE STORIES</a></li>-->
            <li class="active"><a href="payments.php">STATS</a></li>
            <li><a href="logout.php?logout=true">LOG OUT</a></li>
            

            <!--<li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
      <style>
  .rectangle{


    width: 100%; 

    background: #e6e6e6; 
    
    text-align:center; 
  }
</style>
  <div class="rectangle">
    <?php
      $query = 'SELECT * FROM payments ORDER BY ID DESC';
      $customer->displayPayments($query);
      $query1 = 'SELECT * FROM current_Day';
      $stat1->getCurrentDailyUsers($query1);
    ?>


  </div>
    </div>




	<div class="container w">
		<div class="row centered">
			<br><br>

			</div><!-- col-lg-3 -->

		</div><!-- row -->
		<br>
		<br>
	</div><!-- container -->





	

	
	



	<!-- MODAL FOR CONTACT -->
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">contact us</h4>
	      </div>
	      <div class="modal-body">
		        <div class="row centered">
		        	<p>We are available 24/7, so don't hesitate to contact us.</p>
		        	<p>
		        		Somestreet Ave, 987<br/>
						London, UK.<br/>
						+44 8948-4343<br/>
						hi@blacktie.co
		        	</p>
		        	<div id="mapwrap">
		<iframe height="300" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.es/maps?t=m&amp;ie=UTF8&amp;ll=52.752693,22.791016&amp;spn=67.34552,156.972656&amp;z=2&amp;output=embed"></iframe>
					</div>	
		        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Save & Go</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
