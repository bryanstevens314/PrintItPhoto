<html>
    
    
      <div class="rectangle" id="rectangle" style="height:100%; width: 100%; margin-top:120px; background: #e6e6e6; margin: 120px auto 0px auto; text-align:center; ">
    <?php
      $query = "SELECT * FROM payments ORDER BY ID DESC";   
      $customer->displayPayments($query);
      $query1 = "SELECT * FROM current_Day"; 

	    	$stmt = $this->conn->prepare($query);
		    $stmt->execute();
		    $daily;
		    if($stmt->rowCount()>0)
		        {
			        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		    	        {
		    	            $daily++;
				            if ($daily == $stmt->rowCount()) {
								?>
								<div class="rectangle" id="rectangle" style="height:200px; width: 100%; margin-top:120px; margin: 120px auto 0px auto; text-align:center; ">
								    <div class="vertical" style="width: 1px; position:fixed; top: 180px; left: 50%; overflow: visible;">
								            <div style="margin-left: -250px;width: 100px; height: 35px;">
                                                <font size="2"style = "line-height: 35px;">DAILY USERS</font>
                                            </div>
                                            <div style="margin-left: -250px; width: 100px; height: 35px;">
                                                <font size="6"style = "line-height: 35px;"><?php echo $daily; ?></font>
                                            </div>
                                    </div>
                                </div>
                                <?php
                            }
		    	        }
                }
                else{					?>
		    	                <div style="position: absolute; left: 29%; top: 15%">
                                    <font size="2"style = "line-height: 200px;">DAILY USERS</font>
                                    <div style="position: absolute; left: 31%; top: 20%;  width: 30%; margin: 0;">
                                        <font size="6"style = "line-height: 200px;">0</font>
                                    </div>
                                </div>
                                <?php
                }
    ?>


  </div>


</html>