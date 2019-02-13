<?php

class MYKINVEY
{	

	private $conn;
	
	public function __construct()
	{
		?><html>
		    <script>


         
             var promise = Kinvey.init({
                appKey    : 'kid_b13tntvgyZ',
                appSecret : '6e7f45c88031402fac2143b6f2dbe6ac'
             }); 

            promise.then(function(activeUser) {

                console.log ('Success initializing');
                var promise = Kinvey.User.login('username', 'password');
                promise.then(function(user) {

            }, function(error) {

                });
            var promise = Kinvey.ping();
            promise.then(function(response) {
                console.log('Kinvey Ping Success. Kinvey Service is alive, version: ' + response.version + ', response: ' + response.kinvey);
            }
     
	
		    </script>
		</html>
		<?php
    }
    
}
?>