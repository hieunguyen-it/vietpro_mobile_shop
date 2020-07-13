<?php
    $mail_id = $_GET["page_id"];
    $sql = "SELECT * FROM config_mail
            WHERE  mail_id = $mail_id ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    // Update
    // Kiểm tra người dùng submit form
    // Sử dụng phương thức post vì thao tác với form
    if(isset($_POST['sbm'])){
        $mail_host = $_POST["mail_host"];
        $mail_username = $_POST['mail_username'];
        $mail_password = $_POST['mail_password'];
        $mail_smtpsecure = $_POST['mail_smtpsecure'];
        $mail_port = $_POST['mail_port'];
        $mail_setform = $_POST['mail_setform'];
        $mail_addcc = $_POST['mail_addcc'];
        $mail_subject = $_POST['mail_subject'];
        $mail_altbody = $_POST['mail_altbody'];
    $sql = "UPDATE config_mail SET
                mail_host = '$mail_host',
                mail_username = '$mail_username',
                mail_password = '$mail_password',
                mail_smtpsecure = '$mail_smtpsecure',
                mail_port = '$mail_port',
                mail_setform = '$mail_setform',
                mail_addcc = '$mail_addcc',
                mail_subject = '$mail_subject',
                mail_altbody = '$mail_altbody'
                WHERE mail_id = '$mail_id'
                ";
     mysqli_query($conn,$sql);
     header("location:index.php?page_layout=mailserver");
    }
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="?page_layout=mailserver">Quản lý Mail Server</a></li>
				<li class="active"><?php echo $row["mail_username"] ; ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Mail Server: <?php echo $row["mail_host"] ; ?></h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                                <!-- <div class="alert alert-danger">mail_username đã tồn tại, Mật khẩu không khớp !</div> -->
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Mail Server</label>
                                    <input type="text" name="mail_host" required class="form-control" value="<?php echo $row["mail_host"] ; ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Mail Username</label>
                                    <input type="text" name="mail_username" required value="<?php echo $row["mail_username"] ; ?>" class="form-control">
                                </div>                       
                                <div class="form-group">
                                    <label>Mail Password</label>
                                    <input type="text" name="mail_password" required value="<?php echo $row["mail_password"] ; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mail stmpsecure</label>
                                    <input type="text" name="mail_smtpsecure" required value="<?php echo $row["mail_smtpsecure"] ; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>TCP port</label>
                                    <input type="text" name="mail_port" required value="<?php echo $row["mail_port"] ; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>setFrom</label>
                                    <input type="text" name="mail_setform" required value="<?php echo $row["mail_setform"] ; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>setAddcc</label>
                                    <input type="text" name="mail_addcc" required value="<?php echo $row["mail_addcc"] ; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" name="mail_subject" required value="<?php echo $row["mail_subject"] ; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Altbody</label>
                                    <input type="text" name="mail_altbody" required value="<?php echo $row["mail_altbody"] ; ?>" class="form-control">
                                </div>
                                <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
