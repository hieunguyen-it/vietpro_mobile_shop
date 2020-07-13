<?php
	include_once("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<?php
		if (isset($_POST["sbm"])){
			$mail = $_POST["mail"];
			$pass = $_POST["pass"];
			// b1  Viết 1 câu truy vấn với điều kiện
			$sql = "SELECT * FROM user 
					-- Lọc file có trường user có điều kiện
					WHERE user_mail = '$mail'
					-- Điều kiện ở cột user_mail = mail nhập vào
					AND user_pass = '$pass'";
					// Và cột user_pass = pass trùng với người dùng nhập vào
			// b2: thực hiện truy vấn trên vào CSDL MYSQL
			$query = mysqli_query($conn, $sql); // Kết nối đến CSDL MYSQL
			//hàm mysqli_num_rows() trả về số lượng hàng trong một tập kết quả.
			if(mysqli_num_rows($query) > 0) { // Nếu người dùng nhập giá trị > 0 thì đăng nhập thành công
					$_SESSION["mail"] = $mail; // Sau khi người dùng đăng nhập thành công thì đến trang admin thì sẽ dùng session để cấp quyền truy cập vào trang
					$_SESSION["pass"] = $pass; // Sau khi người dùng đăng nhập thành công thì đến trang admin thì sẽ dùng session để cấp quyền truy cập vào trang

					header("location: index.php");
			}else{
				$error = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
			}
		}
		
	?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Vietpro Mobile Shop - Administrator</div>
				<div class="panel-body">
					<?php
						if(isset($error)){
							echo $error ;
						}
					?>
					
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button type="submit" class="btn btn-primary" name="sbm">Đăng nhập</button>

							<a href="pass_new.php" style="padding: 10px ; margin-left:80px ;">Quên mật khẩu</a>
						</fieldset>
					</form>
					<span class="align-middle"> Hoặc Đăng nhập Bằng Tài Khoản Có Sẵn </span>
					<hr>
					<?php
						require_once('define_google.php');
					
						/**
						 * SET CONNECT
						 */
						// $conn = mysqli_connect(
						//     "localhost",
						//     "root",
						//     "",
						//     "vietpro_mobile_shop"
						
						
						
						// );
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
							
						//    print_r($google_account_info);
						/**
							* CHECK EMAIL AND NAME IN DATABASE
							*/
							$check = "SELECT * FROM user WHERE `user_mail`='".$email."' and `user_full`='".$name."'";
							
							$result = mysqli_query($conn,$check);
							$rowcount=mysqli_num_rows($result);
									if($rowcount>0){
						/**
								 * USER EXITS
								 */
							
									$_SESSION['mail'] = $email;
									$_SESSION['name'] = $name;
								
								header('location:index.php');
							
							}
							else{
								/**
							 * INSERT USER TO DATABASE
							 * AFTER INSERT, YOU CAN HEADER TO HOME
							 */
							$sql = "INSERT INTO user(user_mail,user_full)
									VALUE ('$email','$name')
							
							";
							$query = mysqli_query($conn,$sql);
						
							// if(isset($email)&& isset($name)){
								$_SESSION['mail'] = $email;
								$_SESSION['name'] = $name;
							// }
							header('location:index.php');
							}
							
						} else {
						
							/**
							 * IF YOU DON'T LOGIN GOOGLE
							 * YOU CAN SEEN AGAIN GOOGLE_APP_ID, GOOGLE_APP_SECRET, GOOGLE_APP_CALLBACK_URL
							 */
						
							echo "<a  href='".$client->createAuthUrl()."'><span class='btn btn-danger' 'align-middle'>Google Login</span></a>";
						}
				?>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>
