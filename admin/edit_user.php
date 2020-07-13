<?php
    // buoc 1 lay du lieu gan vao value o cac o input
    $user_id = $_GET["page_id"] ;
    $row = mysqli_fetch_array(mysqli_query($conn , "SELECT * FROM user WHERE user_id = '$user_id'")) ;
    // buoc 2 update
    if (isset($_POST["sbm"])) {
        $user_full = $_POST["user_full"] ;
        $user_mail = $_POST["user_mail"] ;
        $user_pass = $_POST["user_pass"] ;
        $user_re_pass = $_POST["user_re_pass"] ;
        $user_level = $_POST["user_level"] ;
    // viet cau truy van update
        $sql ="UPDATE user SET 
                user_full = '$user_full' ,
                user_mail = '$user_mail' ,
                user_pass = '$user_pass' ,
                user_level = '$user_level'
                WHERE user_id = '$user_id'
                " ;
    // kiem tra xem mail co bi trung voi co so du lieu hay khong va kiem tra xem mat khau nhap 2 lan co khop nhau khong
        // kiểm tra nếu mail trùng nhau thì thực hiện 
    if ($user_mail == $row["user_mail"]) {
        // dùng if để kiểm tra xem pass có nhập vào trùng nhau hay không
        if ($user_pass == $user_re_pass) {
            mysqli_query($conn , $sql) ;
            header("location: index.php?page_layout=user") ;
        }else {
            $error = "Mat khau khong khop !" ;
        }
        // nếu mail không trùng nhau thực hiện các lệnh sau
    }else if (mysqli_num_rows(mysqli_query($conn , "SELECT * FROM user WHERE user_mail = '$user_mail'")) > 0) {
        $error = "Email da duoc su dung !" ;
    }else if ($user_pass == $user_re_pass) { // dùng if kiểm tra xem pass nhập vào có trùng nhau không
        mysqli_query($conn , $sql) ;
        header("location: index.php?page_layout=user") ;
    }else {
        $error = "Mat khau khong khop !" ;
    }
        
    }
    
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="?page_layout=user">Quản lý thành viên</a></li>
				<li class="active"><?php echo $row["user_full"] ;  ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thành viên: <?php echo $row["user_full"] ;  ?></h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                                <div class="alert alert-danger"><?php if(isset($error)){echo $error ;}else{echo "Moi ban UPDAET du lieu !" ;} ?></div>
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Họ & Tên</label>
                                    <input type="text" name="user_full" required class="form-control" value="<?php echo $row["user_full"] ; ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="user_mail" required value="<?php echo $row["user_mail"] ; ?>" class="form-control">
                                </div>                       
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" name="user_pass" required  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" name="user_re_pass" required  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quyền</label>
                                    <select name="user_level" class="form-control">
                                        <option <?php if($row["user_level"] == 1){echo "selected" ;} ?> value=1>Admin</option>
                                        <option <?php if($row["user_level"] == 2){echo "selected" ;} ?> value=2 >Member</option>
                                    </select>
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
