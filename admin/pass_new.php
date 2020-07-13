<?php
    include_once("connect.php") ; 
    include "../PHPMailer-master/src/PHPMailer.php";
    include "../PHPMailer-master/src/Exception.php";
    include "../PHPMailer-master/src/OAuth.php";
    include "../PHPMailer-master/src/POP3.php";
    include "../PHPMailer-master/src/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
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
        
        if (isset($_POST["mail"])) {
            $user_mail = $_POST["mail"] ;
            // tạo câu truy vấn 
            $sql = "SELECT * FROM user WHERE user_mail = '$user_mail'" ;
            $query = mysqli_query($conn , $sql ) ;
            $row = mysqli_fetch_array($query) ;
           // $email = $row["user_mail"] ;
            if (mysqli_num_rows($query) > 0) {
                // function randomString($length){
                    //     $arrCharacter = array_merge(range('A' , 'Z'), range('a' , 'z') , range(0 , 9)) ;
                    //     $arrCharacter = implode('' , $arrCharacter) ;
                    //     $arrCharacter = str_shuffle($arrCharacter) ;
                    //     $result = substr($arrCharacter , 0 , $length) ;
                    //     return $result ;
                    // }
                    // hàm tạo mật khẩu kiểu chuỗi ngẫu nhiên
                function randomString($length){
                    $arrCharacter = array_merge(range('A' , 'Z'), range('a' , 'z') , range(0 , 9)) ; // hàm array_merge dùng để gộp các mảng con thành mảng cha, hàm range dùng để tạo một mảng ví dụ từ a đến z , A đến Z, 0 đến 9 .....
                    $arrCharacter = implode('' , $arrCharacter) ; // hàm dùng để chuyển mảng thành chuỗi
                    $arrCharacter = str_shuffle($arrCharacter) ; // hàm dùng để sắp sếp ngẫu nhiên các kí tự bất kì trong chuỗi
                    $result = substr($arrCharacter , 0 , $length) ; // hàm dùng để lấy một chuỗi con trong chuỗi cha
                    return $result ;
                }
                // gọi hàm 
                $str_random = randomString(10) ;
                $str_body = 'Email của bạn là: '.$user_mail.'<br> Mật khẩu mới của bạn là: '.$str_random;
                // viết câu truy vấn UPDATE pass
                $sql = "UPDATE user SET user_pass = '$str_random' WHERE user_mail = '$user_mail'  " ;
                // thực hiện câu truy vấn
                mysqli_query($conn , $sql) ;
///////////////////////////////////thực hiện quá trình gửi mật khẩu mới  vào mail khách hàng////////////////////////////////////////////

                $mail = new PHPMailer(true);                              // Passing 'true' enables exceptions
                try {
                    //Server settings (0 là không hiển thi lỗi , 2 là hiển thị lỗi)
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'anhnhatdev2504@gmail.com';                 // SMTP username
                    // $mail->Password = 'vietpr0sh0p';                           // SMTP password
                    $mail->Password = 'aooetapcleuuisun';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, 'ssl' also accepted
                    $mail->Port = 465;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom('lamthieu0@gmail.com', 'Vietpro Mobile Shop');				// Gửi mail tới Mail Server
                    $mail->addAddress($user_mail);               // Gửi mail tới mail người nhận
                    //$mail->addReplyTo('ceo.vietpro@gmail.com', 'Information');
                    $mail->addCC('lamthieu0@gmail.com');
                    //$mail->addBCC('bcc@example.com');
                
                    //Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Xác nhận mật khẩu mới từ Vietpro Mobile Shop';
                    $mail->Body    = $str_body;
                    $mail->AltBody = 'Quên mật khẩu';
                
                    $mail->send();
                    //header('location:index.php?page_layout=success');
                    header("location:success.php") ;
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }else {
                echo "Email không hợp lệ" ;
            }
    
        }
                        
    ?>

	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">From lấy lại mật khẩu !</div>
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
							</div>
							<button type="submit" class="btn btn-primary" name="sbm">Xác nhận lấy lại mật khẩu </button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>
