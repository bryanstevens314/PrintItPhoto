<?php
require_once('app/class.order.php');
include_once 'app/orderconfig.php';
require_once('app/class.customer.php');

require_once( 'sendpulseInterface.php' );
require_once( 'sendpulse.php' );
include_once 'app/customerConfig.php';
require 'vendor/autoload.php';
$order = new ORDER();
$customer1 = new CUSTOMER();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
        $jsonstring = file_get_contents("php://input");
        $data = json_decode($jsonstring, true);

    if ($data['key'] != null){
            $key = $data['key'];
            if ($key === "8w0eF7uBgx5e2azW0714p5IQVKuF8c95") {
                $length = 12;
                $token = '269C877DCFFB2533DA41A97CAAB91';
                $json = array('status' => 'success', 'token' => $token);
                
                echo json_encode($json);
            }
    }
    
    
}
?>