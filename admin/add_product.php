<!-- $str_type = strtolower(substr($prd_type , -3 , 3))  ; // hàm strtolower dùng để cho chuyển cac kí tự sang sạng thường 
, hàm substr dùng để lấy 3 kí tự cuối cùng của file
        $prd_image = $_FILES["prd_image"]["name"] ;
        $prd_tmp_name = $_FILES["prd_image"]["tmp_name"] ;
        $array_type = array("jmg" , "png");
        if (in_array($str_type , $array_type) == true) { // hàm in_array dùng để kiểm tra xem trong chuỗi có
         kí tự cần kiểm tra không -->

<?php
    if(isset($_POST['sbm'])){
        // basic
        $prd_name = $_POST['prd_name'];
        $prd_price = $_POST['prd_price'];
        $prd_warranty = $_POST['prd_warranty'];
        $prd_accessories = $_POST['prd_accessories'];
        $prd_promotion = $_POST['prd_promotion'];
        $prd_new = $_POST['prd_new'];
        // upload file
        $prd_type = $_FILES["prd_image"]["type"] ;
        $str_type = strtolower(substr($prd_type , -3 , 3))  ;
        $prd_image = $_FILES["prd_image"]["name"] ;
        $prd_tmp_name = $_FILES["prd_image"]["tmp_name"] ;
        $array_type = array("img" , "png"); // nhận 2 định dạng ảnh có đuôi là img và png
        if (in_array($str_type , $array_type) == true) {
            move_uploaded_file($prd_tmp_name , "img/products/".$prd_image) ;
            // end upload file
            // danh muc
            $cat_id = $_POST['cat_id'];
            // trang thai
            $prd_status = $_POST['prd_status'];
            // san pham noi bat
            if(isset($_POST['prd_featured'])){
                $prd_featured = $_POST['prd_featured'];
            }      
            else{
                $prd_featured = 0;
            }
            // mo ta san pham
            $prd_details = $_POST['prd_details'];
            // viết câu truy vấn thêm sản phần trong product
            $sql = "INSERT INTO product(
                    prd_name, 
                    prd_price,
                    prd_warranty, 
                    prd_accessories, 
                    prd_promotion, 
                    prd_new,
                    prd_image,
                    cat_id,
                    prd_status,
                    prd_featured,
                    prd_details)
                    VALUES(
                    '$prd_name',
                    '$prd_price',
                    '$prd_warranty', 
                    '$prd_accessories', 
                    '$prd_promotion', 
                    '$prd_new',
                    '$prd_image',
                    '$cat_id',
                    '$prd_status',
                    '$prd_featured',
                    '$prd_details'
                    )
                    ";
                // thực thi câu truy vấn
                mysqli_query($conn , $sql) ;
                // sau khi thự thi xong ta chuyển về trang product
                header("location:index.php?page_layout=product") ;
        }else {
            $error = "file khong dung dinh dang" ;
        }
        
    }

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="?page_layout=product">Quản lý sản phẩm</a></li>
            <li class="active">Thêm sản phẩm</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <form role="form" method="post" enctype="multipart/form-data"> <!-- can chu y-->
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input required name="prd_name" class="form-control" placeholder="">
                                </div>
                                                                
                                <div class="form-group">
                                    <label>Giá sản phẩm</label>
                                    <input required name="prd_price" type="number" min="0" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Bảo hành</label>
                                    <input required name="prd_warranty" type="text" class="form-control">
                                </div>    
                                <div class="form-group">
                                    <label>Phụ kiện</label>
                                    <input required name="prd_accessories" type="text" class="form-control">
                                </div>                  
                                <div class="form-group">
                                    <label>Khuyến mãi</label>
                                    <input required name="prd_promotion" type="text" class="form-control">
                                </div>  
                                <div class="form-group">
                                    <label>Tình trạng</label>
                                    <input required name="prd_new" type="text" class="form-control">
                                </div>  
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh sản phẩm</label>
                                    <p><?php if(isset($error)){echo $error ;} ?></p>
                                    <input required name="prd_image" type="file">
                                    <br>
                                    <div>
                                        <img src="img/download.jpeg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    
                                    <select name="cat_id" class="form-control">
                                    <?php
                                        $sql = "SELECT * FROM category " ;
                                        $query = mysqli_query($conn , $sql) ;
                                        while($row = mysqli_fetch_array($query)){
                                    ?> 
                                        <option value="<?php echo $row["cat_id"] ; ?>"><?php echo $row["cat_name"] ; ?></option>
                                    <?php
                                        }
                                    ?>   
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="prd_status" class="form-control">
                                        <option value=1 selected>Còn hàng</option>
                                        <option value=0>Hết hàng</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Sản phẩm nổi bật</label>
                                    <div class="checkbox">
                                        <label>
                                            <input name="prd_featured" type="checkbox" value=1>Nổi bật
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label>Mô tả sản phẩm</label>
                                        <textarea id="prd_details" required name="prd_details" class="form-control" rows="3"></textarea>
                                        <script>
                                             CKEDITOR.replace( "prd_details" );
                                        </script>
                                    </div>
                                <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
    
</div>	<!--/.main-->
