<?php

require 'app/dbconfig.php';
include_once 'app/orderconfig.php';
require_once 'app/class.user.php';
include_once 'app/class.customer.php';
require 'vendor/autoload.php';
$user = new USER();
$customer = new CUSTOMER();
date_default_timezone_set('America/Los_Angeles');
\Stripe\Stripe::setApiKey('sk_test_gbTLQukKCbf32YaWJxE7wtVS');
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    //Get the credit card details submitted by the form
    $jsonstring = file_get_contents('php://input');
    $data = json_decode($jsonstring, true);

    if ('charged' == $data['type']) {
        if ('269C877DCFFB2533DA41A97CAAB91' == $data['token']) {
            if ($data['stripeToken']) {
                $token = $data['stripeToken'];
                $uamount = $data['chargeAmount'];
                $description = $data['description'];
                $orderID = $data['orderID'];
                $ufee = $data['fee'];
                $query = "SELECT * 
                          FROM stripe 
                          WHERE user_ID = '1'";
                $stripeID = $user->getStripeID($query);
                try {
                    $charge = \Stripe\Charge::create(array(
                      'amount' => $uamount, // amount in cents, again
                      'currency' => 'usd',
                      'source' => $token,
                      'description' => $description,
                      "destination" => array(
                            "account" => $stripeID,
                       ),
                      "application_fee" => $ufee,
                      "metadata" => array("order_id" => $orderID)
                      ));

                    if ($charge) {
                        $uname = $data['name'];
                        $utaxPercent = $data['tax_Percent'];
                        $utaxTotal = $data['tax_TotalCharged'];
                        $ucharge_ID = $charge['id'];
                        $date = date('m/d/Y h:i');
                        $query = 'SELECT * 
                          FROM customers
                          ORDER BY ID DESC
                          LIMIT 1';
                        $customerID = $customer->newCustomer(NULL, NULL, NULL, NULL, NULL, NULL);
                        $uamount = $uamount / 100;
                        $ufee = $ufee / 100;
                        $customer->insertPayment($uname, $uamount, $ufee, $ucharge_ID, $customerID, $utaxPercent, $utaxTotal, $date);

                        $json = array('status' => 'succeeded', 'stripeChargeID' => $ucharge_ID, 'customerID' => $customerID);
                        echo json_encode($json);
                    } else {
                        echo 'error';
                    }
                } catch (\Stripe\Error\Card $e) {
                    echo ' error';
                    echo $e;
                    // The card has been declined
                }
            }
        }
    }
}
