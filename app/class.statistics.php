<?php

class Statistic
{
    private $conn;

    public function __construct()
    {
        $database = new OrderTable();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function addDailyUser($udate)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO current_Day(date) 
		                                  VALUES(:udate)');

            $stmt->bindparam(':udate', $udate);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function newSupportTicket($support)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO supportTickets(number) 
		                                  VALUES(:support)');

            $stmt->bindparam(':support', $support);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentDailyUsers($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $daily;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ++$daily;
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
        } else {
            ?>
		    	                <div style="position: absolute; left: 29%; top: 15%">
                                    <font size="2"style = "line-height: 200px;">DAILY USERS</font>
                                    <div style="position: absolute; left: 31%; top: 20%;  width: 30%; margin: 0;">
                                        <font size="6"style = "line-height: 200px;">0</font>
                                    </div>
                                </div>
                                <?php
        }
    }

    public function getCurrentSupportTickets($query1)
    {
        $stmt = $this->conn->prepare($query1);
        $stmt->execute();
        $daily;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ++$daily;
                if ($daily == $stmt->rowCount()) {
                    ?>
                                            
                        <font size="3"style = "color:red; line-height: 40px; float:right;"><?php echo $daily; ?></font>
                                            
                                <?php
                }
            }
        }
    }

    public function loadStatisticsGraph($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // $labelArray;
        // $dataArray;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //array_push($labelArray, $row[""]);
            }
        } ?>
                    <script src="js/Chart.min.js"></script>
                    <script>
                    
                    var someVarName = window.localStorage.getItem("CurrentDataView");
console.log("Got here" + someVarName);
                    
                    if (someVarName === "Daily"){
                        
                	  var c1 = document.getElementById("c1");
                    var parent = document.getElementById("p1");
                    c1.width = parent.offsetWidth - 40;
                    c1.height = parent.offsetHeight - 40;
                    var array = [150,100,500,200,290,600,1200];
                    var largest = Math.max.apply(Math, array);


                    var data1 = {
                        labels : ["M","T","W","T","F","S","S"],
                        datasets : [
                            {
                            fillColor : "rgba(255,255,255,.1)",
                            strokeColor : "rgba(255,255,255,1)",
                            pointColor : "#123",
                            pointStrokeColor : "rgba(255,255,255,1)",
                            data : array
                            }
                        ]
                    }

                            var div = Math.floor(largest/6);
                                        var options1 = {
                        scaleFontColor : "rgba(255,255,255,1)",
                        scaleLineColor : "rgba(255,255,255,1)",
                        scaleGridLineColor : "rgba(77,77,77,1)",
                        bezierCurve : false,
                        scaleOverride : true,
                        scaleSteps : 6,
                        scaleStepWidth : div,
                        scaleStartValue : 0
                    

                         }
                    

                    new Chart(c1.getContext("2d")).Line(data1,options1)

                }
                
                if (someVarName === "Weekly"){
                        
                	  var c1 = document.getElementById("c1");
                    var parent = document.getElementById("p1");
                    c1.width = parent.offsetWidth - 40;
                    c1.height = parent.offsetHeight - 40;
                    var array = [800,1000,500,1200];
                    var largest = Math.max.apply(Math, array);
                    console.log(largest);
                    var data1 = {
                        labels : ["Week 1","Week 2","Week 3","Week4"],
                        datasets : [
                            {
                            fillColor : "rgba(255,255,255,.1)",
                            strokeColor : "rgba(255,255,255,1)",
                            pointColor : "#123",
                            pointStrokeColor : "rgba(255,255,255,1)",
                            data : array
                            }
                        ]
                    }
                    var div = Math.floor(largest/6);
                    console.log(div);
                    var options1 = {
                        scaleFontColor : "rgba(255,255,255,1)",
                        scaleLineColor : "rgba(255,255,255,1)",
                        scaleGridLineColor : "rgba(77,77,77,1)",
                        bezierCurve : false,
                        scaleOverride : true,
                        scaleSteps : 6,
                        scaleStepWidth : div,
                        scaleStartValue : 0
                    }

                    new Chart(c1.getContext("2d")).Line(data1,options1)

                }
                
                if (someVarName === "Monthly"){
                        
                	  var c1 = document.getElementById("c1");
                    var parent = document.getElementById("p1");
                    c1.width = parent.offsetWidth - 40;
                    c1.height = parent.offsetHeight - 40;
                    var array = [150,100,500,200,290,600,700];
                    var largest = Math.max.apply(Math, array);
                    var data1 = {
                        labels : ["Janurary","Feburary","March","April","May","June","July"],
                        datasets : [
                            {
                            fillColor : "rgba(255,255,255,.1)",
                            strokeColor : "rgba(255,255,255,1)",
                            pointColor : "#123",
                            pointStrokeColor : "rgba(255,255,255,1)",
                            data : array
                            }
                        ]
                    }
                    var div = Math.floor(largest/6);
                    var options1 = {
                        scaleFontColor : "rgba(255,255,255,1)",
                        scaleLineColor : "rgba(255,255,255,1)",
                        scaleGridLineColor : "rgba(77,77,77,1)",
                        bezierCurve : false,
                        scaleOverride : true,
                        scaleSteps : 6,
                        scaleStepWidth : div,
                        scaleStartValue : 0
                    }

                    new Chart(c1.getContext("2d")).Line(data1,options1)

                }
                
                if (someVarName === "Yearly"){
                        
                	  var c1 = document.getElementById("c1");
                    var parent = document.getElementById("p1");
                    c1.width = parent.offsetWidth - 40;
                    c1.height = parent.offsetHeight - 40;
                    var array = [10000,20000,17000,23000,24000,26000,20000];
                    var largest = Math.max.apply(Math, array);
                    var data1 = {
                        labels : ["2016","2017","2018","2019","2020","2021","2022"],
                        datasets : [
                            {
                            fillColor : "rgba(255,255,255,.1)",
                            strokeColor : "rgba(255,255,255,1)",
                            pointColor : "#123",
                            pointStrokeColor : "rgba(255,255,255,1)",
                            data : array
                            }
                        ]
                    }
                    var div = Math.floor(largest/6);
                    var options1 = {
                        scaleFontColor : "rgba(255,255,255,1)",
                        scaleLineColor : "rgba(255,255,255,1)",
                        scaleGridLineColor : "rgba(77,77,77,1)",
                        bezierCurve : false,
                        scaleOverride : true,
                        scaleSteps : 6,
                        scaleStepWidth : div,
                        scaleStartValue : 0
                    }

                    new Chart(c1.getContext("2d")).Line(data1,options1)

                }
                    </script>
<?php
    }
}
    ?>