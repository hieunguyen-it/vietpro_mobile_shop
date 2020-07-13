<?php
	    require_once('define_google.php');
	 
	    /**
	     * SET CONNECT
	     */
	    $conn = mysqli_connect(
            "localhost",
            "root",
            "",
            "vietpromoblieshop"
        
        
        
        );
	    if (!$conn) {
	        echo "Error: Unable to connect to MySQL." . PHP_EOL;
	        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	        exit;
	    }
	    /**
	     * CALL GOOGLE API
	     */
	    require_once 'google-api-php-client-2.5.0_PHP54/vendor/autoload.php';
	    $client = new Google_Client();
	    $client->setClientId(GOOGLE_APP_ID);
	    $client->setClientSecret(GOOGLE_APP_SECRET);
	    $client->setRedirectUri(GOOGLE_APP_CALLBACK_URL);
	    $client->addScope("email");
	    $client->addScope("profile");
	    
	    if (isset($_GET['code'])) {
	        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	       // print_r($token);
        $client->setAccessToken($token['access_token']);
	 
	        // get profile info
	        $google_oauth = new Google_Service_Oauth2($client);
	        $google_account_info = $google_oauth->userinfo->get();
	        $email =  $google_account_info->email;
	        $name =  $google_account_info->name;
	       // print_r($google_account_info);
	       /**
	        * CHECK EMAIL AND NAME IN DATABASE
	        */
	        $check = "SELECT * FROM `users` WHERE `email`='".$email."' and `name`='".$name."'";
        $result = mysqli_query($conn,$sql);
	        $rowcount=mysqli_num_rows($result);
	        if($rowcount>0){
           /**
	             * USER EXITS
	             */
	            header('location:index.php');
	        }
	        else{
	            /**
             * INSERT USER TO DATABASE
             * AFTER INSERT, YOU CAN HEADER TO HOME
             */
	 
	        }
	        
	    } else {
	        /**
	         * IF YOU DON'T LOGIN GOOGLE
	         * YOU CAN SEEN AGAIN GOOGLE_APP_ID, GOOGLE_APP_SECRET, GOOGLE_APP_CALLBACK_URL
	         */
	        echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
		} 
		
