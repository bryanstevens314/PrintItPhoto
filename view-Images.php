

<!DOCTYPE html>
<html lang="en">


  <head>
    <title>Dashboard</title>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet">
	
  </head>

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
  

  <table align="center" style="width:100%; margin-top:85px; margin-bottom:100px;">
    <?php
          require 'vendor/autoload.php';
          
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

          $client = $s3->createS3();
          function base64_to_jpeg($base64_string, $output_file)
          {
              $ifp = fopen($output_file, 'wb');
              fwrite($ifp, base64_decode($base64_string));
              fclose($ifp);
          
              return  $output_file;
          }
            if (is_numeric($_GET['order_ID'])) {
                $order_ID = $_GET['order_ID'];
          
                $s3Client = $s3->createS3();
                $result = $client->getObject([
                  'Bucket' => 'printimages1',
                  'Key' => $order_ID,
              ]);
      ?>
<!--Table header-->
    <tr>
        <th></th>
    </tr>
    <?php
        if ($result['Body']) {
            // $img = '<img src="data:image/jpeg;base64,' . $result['Body'] . '" />';
            // $data = getimagesize($img);
            //   $width = $data[0];
            //   $height = $data[1];?>

            <tr>
            <td align="center" width="100%"> <?php echo '<img class= "resize" align="center" style="width:50%; height:50%;" src="data:image/jpeg;base64,'.$result['Body'].'"/ ></img>'; ?> </td>
            </tr>
            <?php
        }
  }
?>
</table>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="css/Chart.js"></script>
  </body>
</html>
