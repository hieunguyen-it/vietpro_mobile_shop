<?php
if (!defined('TEMPLATE')) {
    die('Bạn không có quyền truy cập vào file này !');
}
$comm_id = $_GET["page_comm"] ;
$sql = "SELECT * FROM comment WHERE comm_id = $comm_id" ;
$query = mysqli_query($conn , $sql) ;
$row = mysqli_fetch_array($query) ;
// code UP DATE
if (isset($_POST["sbm"])) {
   $comm_name = $_POST["comm_name"] ;
   $comm_mail = $_POST["comm_mail"] ;
   $comm_date = $_POST["comm_date"] ;
   $comm_details = $_POST["comm_details"] ;
  echo $comm_status = $_POST["comm_status"] ;
   // viết câu truy vấn update
   $sql = "UPDATE comment
                SET comm_name = '$comm_name' ,
                    comm_mail = '$comm_mail' ,
                    comm_date = '$comm_date' ,
                    comm_details = '$comm_details' ,
                    comm_status = '$comm_status'
                WHERE comm_id = '$comm_id'";
    // thực hiện câu truy vấn
    mysqli_query($conn , $sql) ;
    // khi thực hiện câu truy vấn xong thì chuyền về trang comment
    header("location:index.php?page_layout=comment") ;
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý comment</a></li>
            <li class="active">comment số 1 </li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Comment: comment số 1</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên người bình luận</label>
                                <input type="text" name="comm_name" required class="form-control" value="<?php echo $row["comm_name"] ; ?>" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Mail bình luận</label>
                                <input type="text" name="comm_mail" required value="<?php echo $row["comm_mail"] ; ?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Thời gian bình luận</label>
                                <input type="text" name="comm_date" required value="<?php echo $row["comm_date"] ; ?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea name="comm_details" required class="form-control" rows="3"><?php if(isset($row["comm_details"])){echo $row["comm_details"] ;} ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="comm_status" class="form-control">
                                    <option <?php if($row["comm_status"] == 0){echo "selected" ;} ?> value=0>Ẩn</option>
                                    <option <?php if($row["comm_status"] == 1){echo "selected" ;} ?>  value=1>Hiển thị</option>
                                    
                                </select>
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->

</div>
<!--/.main-->