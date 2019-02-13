<?php
session_start();
require('app/dbconfig.php');
require_once('app/class.user.php');
require 'vendor/autoload.php';
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('users.php');
}

if(isset($_POST['btn-signup']))
{
    if(is_numeric($_GET['customerID'])){
        $email = $_GET['email'];
    \Stripe\Stripe::setApiKey(sk_test_gbTLQukKCbf32YaWJxE7wtVS);
$stripeparams = \Stripe\Account::create(
  array(
    "email" => $email,
    "country" => "US",
    "managed" => true
  )
);

	$id = $stripeparams['id'];
	$array = $stripeparams['keys'];
	$secret = $array['secret'];
	$publishable = $array['publishable'];	
	

		try
		{
		      if(is_numeric($_GET['customerID'])){
                    $customerID = $_GET['customerID'];

		            if($user->addStripeInfo($customerID, $id,$secret,$publishable)){	
				        $user->redirect('createStripeAccount.php');
			         }
		      }
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDO + CRUD</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css"  />
</head>

<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Sign up</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <!--<div class="form-group">-->
            <!--<input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />-->
            <!--</div>-->
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;NEXT
                </button>
            </div>
            <br />
            <!--<label>have an account ! <a href="index.php">Sign In</a></label>-->
        </form>
       </div>
</div>

</div>

<?php require_once('technical_stuffs/footer.php'); ?>