<?php

require_once 'app/class.order.php';
include_once 'app/orderconfig.php';
require_once 'app/class.customer.php';

require_once 'sendpulseInterface.php';
require_once 'sendpulse.php';
include_once 'app/customerConfig.php';
require 'vendor/autoload.php';
$order = new ORDER();
$customer1 = new CUSTOMER();
date_default_timezone_set('America/Los_Angeles');

use Aws\S3\S3Client;
$s3 = new Aws\Sdk([
    'version' => 'latest',
    'region' => 'us-west-1',
    'credentials' => [
        'key' => 'AKIAIVZSKLJBFFFEYFHQ',
        'secret' => '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',
    ],
    's3' => [
        'region' => 'us-west-1',
    ],
]);

$conn;

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $jsonstring = file_get_contents('php://input');
    $data = json_decode($jsonstring, true);

    if (null != $data['customer']) {
        $customerInfo = $data['customer'];
        $uname = $customerInfo['name'];
        $umail = $customerInfo['email'];
        $ushipping = $customerInfo['shipping_address'];
        $uchargeID = $customerInfo['stripeChargeID'];
        $ID = $customerInfo['customerID'];
        $udate = date('m/d/Y h:i a');
        $customer1->updateCustomer($uname, $umail, $ushipping, $uchargeID, $udate, $ID);
        $shoppingCart = $data['shopping_Cart'];

        foreach ($shoppingCart as $itemDict) {
            
            $uproduct = $itemDict['product'];
            $uquantity = $itemDict['quantity'];
            $uretouch = $itemDict['retouching'];
            $ualum = $itemDict['aluminumOptions'];
            $uinstructions = $itemDict['instructions'];
            $uImage = $itemDict['image'];

            $orderID = $order->neworder($ID, $uproduct, $uquantity, $uretouch, $ualum, $uinstructions);
            $s3Client = $s3->createS3();
            // Send a PutObject request.
            $s3Client->putObject([
                    'Bucket' => 'printimages1',
                    'Key' => $orderID,
                    'Body' => $uImage,
                ]);
        }
    }
}
