

<?php
require 'vendor/autoload.php';
class CUSTOMER
{
    private $conn;

    public function __construct()
    {
        $database = new OrderTable();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) {
            return $min;
        } // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);

        return $min + $rnd;
    }

    public function getToken($length)
    {
        $token = '';
        $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
        $codeAlphabet .= '0123456789';
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; ++$i) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
        }

        return $token;
    }

    public function updateCustomer($uname, $umail, $ushipping, $uchargeID, $udate, $ID)
    {
        try {
            $dbhost = 'localhost';
            $dbuser = 'stevens_apps';
            $db_name = 'orders';
            $dbpass = '';
        $conn1 = new PDO("mysql:host={$dbhost};dbname={$db_name}", $dbuser, $dbpass);
        $sql1 = "UPDATE customers
                  SET name = :uname, email = :umail, shipping = :ushipping, shipped = 'NO', charge_ID = :ucharge_id, date = :udate
                  WHERE ID = :id";

        $stmt = $conn1->prepare($sql1);

        $res = $stmt->execute([
          'uname' => $uname,
          'umail' => $umail,
          'ushipping' => $ushipping,
          'ucharge_id' => $uchargeID,
          'udate' => $udate,
          'id' => $ID
        ]);
        return;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function newCustomer($uname, $umail, $ushipping, $ucharge_ID, $udate)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO customers(name,email,shipping,charge_ID,date) 
		                                  VALUES(:uname, :umail, :ushipping, :ucharge_ID, :udate)');

            $stmt->bindparam(':uname', $uname);
            $stmt->bindparam(':umail', $umail);
            $stmt->bindparam(':ushipping', $ushipping);
            $stmt->bindparam(':ucharge_ID', $ucharge_ID);
            $stmt->bindparam(':udate', $udate);

            $stmt->execute();
            $id = $this->conn->lastInsertId();

            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertPayment($uname, $uamount, $ufee, $ucharge_ID, $customerID, $utaxPercent, $utaxTotal, $date)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO payments(name,amount,fee,charge_ID,order_ID,tax_Percent,tax_TotalCharged,Date) 
		                                  VALUES(:uname, :uamount, :ufee, :uchargeID, :customerID, :utaxPercent, :utaxTotal, :date)');

            $stmt->bindparam(':uname', $uname);
            $stmt->bindparam(':uamount', $uamount);
            $stmt->bindparam(':ufee', $ufee);
            $stmt->bindparam(':uchargeID', $ucharge_ID);
            $stmt->bindparam(':customerID', $customerID);
            $stmt->bindparam(':utaxPercent', $utaxPercent);
            $stmt->bindparam(':utaxTotal', $utaxTotal);
            $stmt->bindparam(':date', $date);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getCustomerID($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $ID;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ID = $row['ID'];
            }
        }

        return $ID;
    }

    public function getChargeID($query1)
    {
        $stmt = $this->conn->prepare($query1);
        $stmt->execute();
        $ID;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ID = $row['charge_ID'];
            }
        }

        return $ID;
    }

    public function dataview($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); ?>

<tbody class="table-hover" >
			<tr>
    <th class="text-left">Shipped</th>
    <th class="text-left" data-th="Name"><span>Name</span></th>
    <th class="text-left">Order</th>
    <th class="text-left">Shipping Address</th>
    <th class="text-left">Email</th>
    <th class="text-left">Date</th>
    
    
 </tr>
  
             <script  type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
			<script type="text/javascript" src="technical_stuffs/script.js"></script>
			
  <?php

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ('' != $row['name']) {
                    ?>
	

                <tr>
                	<td class="text-left"width="5%" class="img2"> 
                	<form role="form" id="shipped1">
                		<?php 

                            if ($row['shipped'] == $row['ID']) {
                                ?>
                    			<input id = "submit1" value="<?php echo $row['ID']; ?>" style="border:none" type="image" src="check-checked.jpg"  onclick='shippingClickedUncheck(<?php echo json_encode($row); ?>); return true;' height="25" width="25"></input>
                    	<?php
                            } else {
                                ?>
                        		<input id = "submit" value="<?php echo $row['ID']; ?>" style="border:none" type="image" src="check-unmarked.jpg"  onclick='shippingClickedCheck(<?php echo json_encode($row); ?>); return true;' height="25" width="25"></input>

                    	<?php
                            } ?>
					</form>
                </td>
                    <!--<tr><td width="1%">a:</td><td width="99%">b</td></tr>-->
                <td class="text-left" width="13%"><?php echo $row['name']; ?></td>
                <td class="text-left" width="12%" ><label > <a href="view-Order.php?customer_ID=<?php echo $row['ID']; ?>" style="color:#2b6ca3;">View Order</a></label></td>
                <td class="text-left" width="30%"><?php echo $row['shipping']; ?></td>
                
                <td class="text-left" width="25%"><?php echo $row['email']; ?></td>
                <td class="text-left" width="15%"><?php echo $row['date']; ?></td>
                </tr>
                </tbody>
                <?php
                }
            }
        } else {
            ?>
 
                <tr>
                	<td></td>
                </tr>
                </tbody>
            <?php
        }
    }

    public function displayPayments($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $totalEarned;
        $totalOrders;
        $rows;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ++$rows;
                $fee = $row['fee'];
                $amout = $row['amount'];
                $total_recieved = $amout - $fee;
                $totalEarned = $totalEarned + $total_recieved;
                ++$totalOrders;
                if ($rows == $stmt->rowCount()) {
                    $totalEarned1 = number_format($totalEarned, 2); ?>
					<div class="rectangle" id="rectangle" style="height:200px; width: 100%; margin-top:120px; margin: 120px auto 0px auto; text-align:center; ">
						<div class="vertical" style="width: 1px; position:fixed; top: 180px; left: 50%;overflow: visible;">
							<div style="margin-left: -50px; width: 100px; height: 35px;">
        						<font size="2"style = "line-height: 35px;">TOTAL ORDERS</font>
        					</div>
        					<div style="margin-left: -50px; width: 100px; height: 35px;">
        						<font size="6"style = "line-height: 35px;"><?php echo $totalOrders; ?></font>
    						</div>
    					</div>
    					<div class="vertical" style="width: 1px; position:fixed; top: 180px; left: 50%;overflow: visible;">
    						<div style="margin-left: 150px; width: 100px; height: 35px;">
        						<font size="2"style = "line-height: 35px;">TOTAL EARNED</font>
        					</div>
        					<div style="margin-left: 150px; width: 100px; height: 35px;text-align:center;">
        						<font size="6"style = "line-height: 35px;"><?php echo '$'.$totalEarned1; ?></font>
   		 					</div>
    					</div>
    					
    						
    						

   		 			</div>
									




            <?php
                }
            }
        } else {
        }

        return;
    }

    public function orderShipped($id)
    {
        try {
            
            $dbhost = 'localhost';
            $dbuser = 'stevens_apps';
            $db_name = 'orders';
            $dbpass = '';
                    $conn1 = new PDO("mysql:host={$dbhost};dbname={$db_name}", $dbuser, $dbpass);
        $query1 = "UPDATE customers
    				  SET shipped = :id
    				  WHERE ID = :id";

        $stmt = $conn1->prepare($query1);

        $res = $stmt->execute([
          'id' => $id
        ]);
        return;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function orderShippedUncheck($id)
    {
        try {
            $dbhost = 'localhost';
            $dbuser = 'stevens_apps';
            $db_name = 'orders';
            $dbpass = '';
            $conn1 = new PDO("mysql:host={$dbhost};dbname={$db_name}", $dbuser, $dbpass);
        $query1 = "UPDATE customers
    				  SET shipped = 'NULL'
    				  WHERE ID = :id";

        $stmt = $conn1->prepare($query1);

        $res = $stmt->execute([
          'id' => $id
        ]);
        return;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function Lovedataview($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); ?> 
    	
					  <tr>
    
    <th>Date</th>
    <th>Name</th>
    <th>Email</th>
    <th>Delete</th>
  </tr>
  <?php
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>


                <td align="center">
                <a href="delete.php?delete_id=<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
        }
    }

    public function ViewOrderItems($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); ?>
  <tr>
    
    <th>Images</th>
    <th>Quantity</th>
    <th>Product</th>
    <th>Aluminum Options</th>
  </tr>
  <?php
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>
                	<td><label> <a href="view-Order.php">View Image</a></label></td>
                	<td><?php echo $row['product_quantity']; ?></td>
                	<td><?php echo $row['product']; ?></td>
                
                
                	<td><?php echo $row['aluminum_Options']; ?></td>

                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
        }

        return $data;
    }

    public function paging($query, $records_per_page)
    {
        $starting_position = 0;
        if (isset($_GET['page_no'])) {
            $starting_position = ($_GET['page_no'] - 1) * $records_per_page;
        }
        $query2 = $query." limit $starting_position,$records_per_page";

        return $query2;
    }

    public function jsonview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $json = array();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $json[] = $row;
            }
        }

        return json_encode($json);
    }
}
?>

