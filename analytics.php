<?php

require_once 'app/class.order.php';
include_once 'app/orderconfig.php';
require_once 'app/class.statistics.php';

require_once 'sendpulseInterface.php';
require_once 'sendpulse.php';
include_once 'app/customerConfig.php';
require 'vendor/autoload.php';
date_default_timezone_set('America/Los_Angeles');
$order = new ORDER();
$stat = new Statistic();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $jsonstring = file_get_contents('php://input');
    $data = json_decode($jsonstring, true);

    if ('appLaunch' == $data['type']) {
        if ('8w0eF7uBgx5e2azW0714p5IQVKuF8c95' == $data['token']) {
            $udate = date('m/d/Y h:i a');
            $stat->addDailyUser($udate);
            echo 'successfully got here';
        }
    }
    if ('support' == $data['type']) {
        if ('8w0eF7uBgx5e2azW0714p5IQVKuF8c95' == $data['token']) {
            $support = '1';
            $stat->newSupportTicket($support);
            $json = array('status' => 'success');

            echo json_encode($json);
        }
    }
    if ('orderPlaced' == $data['type']) {
        $customerInfo = $data['customer'];

        $uname = $customerInfo['name'];
        $umail = $customerInfo['email'];
        $ushipping = $customerInfo['shipping_address'];
        $udate = date('m/d/Y h:i a');
        $query1 = 'SELECT * 
                    FROM payments
                    ORDER BY ID DESC
                    LIMIT 1';
        $uchargeID = $customer1->getChargeID($query1);
        $customer1->newCustomer($uname, $umail, $ushipping, $uchargeID, $udate);
    }
}
