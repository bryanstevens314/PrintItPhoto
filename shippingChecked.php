<?php
require('app/dbconfig.php');
include_once 'app/customerConfig.php';
include_once 'app/class.customer.php';
include_once 'app/orderconfig.php';

include_once 'app/class.order.php';
$customer = new CUSTOMER();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  
        $jsonstring = file_get_contents("php://input");
        $data = json_decode($jsonstring, true);
    $id = $data['id'];
    $status = $data['status'];
    echo 'shipped' + $status;

    if ($status == "check") {
      // code...
      $customer->orderShipped($id);
    }
    if ($status == "uncheck") {
      // code...
      
      $customer->orderShippedUncheck($id);
    }
    
    
  }
?>


