<?php
session_start();
require('app/dbconfig.php');
require_once("app/class.user.php");
require_once('technical_stuffs/footer.php');
require_once('StripeOAuth2Client.class.php');
require_once('StripeOAuth.class.php');
require_once('OAuth2Client.php');


$login = new USER();


  if(isset($_GET['code'])){

    // from the callback, after a person has linked their Stripe account with your Stripe application
    $oauth = (new StripeOAuth(
        'ca_8WINMiQvrQja2KXmFkvmzQnrlsTMGT6e',
        'sk_test_gbTLQukKCbf32YaWJxE7wtVS'
    ));
    $code = $_GET['code'];
    $access_token = $oauth->getAccessToken($code);

    $stripeID = $oauth->getUserId($code);
    $key = $oauth->getPublishableKey($code);
    $refresh_token = $oauth->getRefreshToken($code, $refresh = true);

  
    $query = "SELECT * 
              FROM users
              ORDER BY user_id DESC
              LIMIT 1";       
    $user_ID = $login->getUserID($query);
    
    
  $login->CreateStripeTable($user_ID, $stripeID, $key, $refresh_token,$access_token);
  header("Location: https://print-it-photo-stevens-apps.c9users.io/index.php"); /* Redirect browser */
    exit();
    //exit(0);
  }
  
?>