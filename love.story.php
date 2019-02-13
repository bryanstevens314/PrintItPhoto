<?php
require('app/dbconfig.php');
require_once("app/session.php");
include_once 'app/class.crud.php';
include_once 'app/orderconfig.php';
include_once 'app/customerConfig.php';
include_once 'app/class.order.php';
include_once 'app/class.customer.php';
$crud = new crud();
$neworder = new ORDER();
$customer = new CUSTOMER();

?>





<html lang="en">


  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>DASHBOARD</title>

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

    <script src="https://da189i1jfloii.cloudfront.net/js/kinvey-html5-1.6.8.min.js"></script>
    <script type="text/javascript" src="app.js"></script>

	<div id="wrapper">
		<div id="header"></div>
		<div id="content"></div>
		<div id="footer"></div>
	</div>
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="about.php">DASHBOARD</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="about.php">PRINT ORDERS</a></li>
            <li class="active"><a href="love.story.php">LOVE STORIES</a></li>
            <li><a href="payments.php">STATISTICS</a></li>
            <li><a href="logout.php?logout=true">LOG OUT</a></li>
            

            <!--<li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<div>
  
  <div class="table" align="center">
  <table class="responstable" id="myTableData" style="margin-top:120px;" align="center">
<tr>

        <th width="20%">Date</th>
        <th width="35%">Name</th>
        <th width="45%">Email</th>
        
    </tr>
</table>
&nbsp;<br/>
</div>

</body>

<script>

         
             var promise = Kinvey.init({
        appKey    : 'kid_b13tntvgyZ',
        appSecret : '6e7f45c88031402fac2143b6f2dbe6ac'
    });

    promise.then(function(activeUser) {

    console.log ('Success initializing');
var promise = Kinvey.User.login('username', 'password');
promise.then(function(user) {

}, function(error) {

});
        var promise = Kinvey.ping();
        promise.then(function(response) {
        console.log('Kinvey Ping Success. Kinvey Service is alive, version: ' + response.version + ', response: ' + response.kinvey);

      var promise = Kinvey.DataStore.find('Lovers', null);
      promise.then(function(entities) {
      var arrayLength = entities.length;
console.log ('Hello1');
      for (var i = 0; i < arrayLength; i++) {
        var object = entities[i];
        var name = object.name;
        var email = object.email;
        var date = object.date;

    var table = document.getElementById("myTableData");

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    row.insertCell(0).innerHTML= date ;
    row.insertCell(1).innerHTML= name ;
    row.insertCell(2).innerHTML= email;
      }
        }, function(error) {
console.log(error.description);
        });




        }, function(error) {
            console.log('Kinvey Ping Failed. Response: ' + error.description);
        });

    }, function(error) {
        console.log ('error initializing');
    });



function deleteRow(obj) {
     
    var index = obj.parentNode.parentNode.rowIndex;
    var table = document.getElementById("myTableData");
    table.deleteRow(index);
   
}

function addTable() {
     
    var myTableDiv = document.getElementById("myDynamicTable");
     
    var table = document.createElement('TABLE');
    table.border='1';
   
    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);
     
    for (var i=0; i<3; i++){
       var tr = document.createElement('TR');
       tableBody.appendChild(tr);
      
       for (var j=0; j<4; j++){
           var td = document.createElement('TD');
           td.width='75';
           td.appendChild(document.createTextNode("Cell " + i + "," + j));
           tr.appendChild(td);
       }
    }
    myTableDiv.appendChild(table);
   
}

function load() {
   
    console.log("Page load finished");

}
</script>


 
</html>



