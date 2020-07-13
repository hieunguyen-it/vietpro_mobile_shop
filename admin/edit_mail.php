<?php
    $id_mail = $_GET["id_mail"];
    $sql = "SELECT * FROM mail_server
            WHERE  id_mail = $id_mail ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    // Update

    if(isset($_POST['sbm'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
    $sql = "UPDATE mail_server
            SET name = '$name',
                email = '$email',
                phone = '$phone',
                address = '$address'
                WHERE id_mail = '$id_mail'";
     mysqli_query($conn, $sql);
     header("location:index.php?page_layout=mail");
    }
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="?page_layout=mail">Quản lý Email</a></li>
				<li class="active"><?php echo $row["name"] ; ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thành viên: <?php echo $row["name"] ; ?></h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                                <!-- <div class="alert alert-danger">Email đã tồn tại, Mật khẩu không khớp !</div> -->
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Họ & Tên</label>
                                    <input type="text" name="name" required class="form-control" value="<?php echo $row["name"] ; ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" required value="<?php echo $row["email"] ; ?>" class="form-control">
                                </div>                       
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" required value="<?php echo $row["phone"] ; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" name="address" required value="<?php echo $row["address"] ; ?>" class="form-control">
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
