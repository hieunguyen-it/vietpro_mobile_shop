<!--	List Product	-->

<?php
    $prd_id = $_GET["prd_id"] ;
    $sql = "SELECT * FROM product 
            WHERE prd_id = $prd_id " ;
    $query = mysqli_query($conn , $sql) ;
    $row = mysqli_fetch_array($query) ;

?>
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="admin/img/products/<?php echo $row["prd_image"] ; ?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $row["prd_name"] ; ?></h1>
            <ul>
                <li><span>Bảo hành:</span><?php echo $row["prd_warranty"] ; ?></li>
                <li><span>Đi kèm:</span><?php echo $row["prd_accessories"] ; ?></li>
                <li><span>Tình trạng:</span><?php echo $row["prd_new"] ; ?></li>
                <li><span>Khuyến Mại:</span><?php echo $row["prd_promotion"] ; ?></li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?php echo number_format($row["prd_price"])  ; ?></li>
                <li id="status"><?php if($row["prd_status"]>0){echo "Còn Hàng" ;}else{echo "Hết Hàng" ;} ?></li>
            </ul>
            <div id="add-cart"><a href="module/cart/cart_add.php?prd_id=<?php echo $row["prd_id"] ; ?>">Mua ngay</a></div>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về iPhone X 64GB</h3>
            <p>
                <?php echo $row['prd_details']; ?>
            </p>
            <h3>Đánh giá của bạn</h3>
            <!-- Chức năng đánh giá sao -->
            <?php
            $select_rating = mysqli_query($conn, "SELECT * FROM rating_prd WHERE prd_id = '$prd_id'");
            $total = mysqli_num_rows($select_rating); // mysqli_num_rows trả về tất cả giá trị truyền vào biến $select_rating
            if ($total == 0) {
                
            ?>
                <p>Chưa có lượt đánh giá nào</p>
                <form method="post" action="module/product/insert_star.php?prd_id=<?php echo $prd_id; ?>">
                    <div class="rating-box">
                        <div class="ratings">
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                        </div>
                        <input type="hidden" name="rating" id="rating-value" value="">
                        <input type="submit" value="Đánh giá" name="submit_rating" style="background: yellow;">
                </form>
                    <?php } else {
                       
                    while ($row = mysqli_fetch_array($select_rating)) {
                       $rate[] = $row['rate']; // mảng tổng số sao
                    }
                    $total_sao = array_sum($rate) ; // tổng số sao

                    // hàm roud là hàm dùng để làm tròn
                    $total_rate = round( ($total_sao / $total), 2); // hàm array_sum dùng để tính tổng tất cả các phần tử trong mảng ở đây dùng để tính tổng số sao ở các lượt đánh giá 
                    ?>
                        <p>Trung bình đánh giá : (<?php echo $total_rate; ?>)</p>
                        <p id="total_votes">Số lượt đánh giá :<?php echo $total; ?></p>
                        <form method="post" action="module/product/insert_star.php?prd_id=<?php echo $prd_id; ?>">
                            <div class="rating-box">
                                <div class="ratings">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $total_rate) {
                                    ?>
                                            <span style="color:red ; font-weight: bold;" class="fa fa-star"></span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="fa fa-star-o"></span>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                                <input type="hidden" name="rating" id="rating-value" value="">
                                <input type="submit" value="Đánh giá" name="submit_rating" style="background: yellow;">
                            <?php } ?>
                            </div>
                        </form>
                    </div>
        </div>
    <?php
        // php comment add code chặn từ thô tục
        if (isset($_POST["sbm"])) {
            $comm_name = $_POST["comm_name"] ;
            $comm_mail = $_POST["comm_mail"] ;
            $comm_details = $_POST["comm_details"] ;
            // code chuyển các từ thô tục thành ***
            $arr_comm = array("#chó#i" ,"#xấu#i") ;
            $replace = "***";
            $comm_details = preg_replace($arr_comm , $replace , $comm_details  ) ;
            // end chuyển các từ thô tục thành ***
            date_default_timezone_set("Asia/Ho_Chi_Minh") ;
            $comm_date = date("Y-m-d H:i:s") ;
            $sql = "INSERT INTO comment(prd_id , comm_name , comm_mail , comm_date , comm_details)
                    VALUE('$prd_id' , '$comm_name' , '$comm_mail' , '$comm_date' , '$comm_details')
            ";
            mysqli_query($conn , $sql) ;
        }
    ?>
    <!--	Comment	-->
    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
    <!--	End Comment	-->

    <!--	Comments List	-->
    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
                // php comment list
                if (isset($_GET["page"])) {
                    $page = $_GET["page"] ;
                }else {
                    $page = 1 ;
                }
                $rows_pre_page = 5 ;
                $pre_row = $page * $rows_pre_page - $rows_pre_page ;
                $sql = "SELECT * FROM comment 
                        WHERE (prd_id = '$prd_id') AND (comm_status = 1)
                        ORDER BY comm_id DESC
                        LIMIT $pre_row , $rows_pre_page
                        ";
                $query = mysqli_query($conn , $sql) ;
                // thêm điều kiện comm_status = 1 để xuất ra các comment đã được duyệt
                $total_rows = mysqli_num_rows(mysqli_query($conn , "SELECT * FROM comment WHERE (prd_id = '$prd_id') AND (comm_status = 1)")) ;
                $total_pages = ceil($total_rows/$rows_pre_page) ;
                
                while($row = mysqli_fetch_array($query)){
            ?>
            <div class="comment-item">
                <ul>
                    <li><b><?php echo $row["comm_name"] ; ?></b></li>
                    <li><?php echo $row["comm_date"] ; ?></li>
                    <li>
                        <p><?php echo $row["comm_details"] ; ?></p>
                    </li>
                </ul>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <div id="pagination">
    <ul class="pagination">
        <?php
            $page_list = "";
            // page prev
            $page_prev = $page - 1 ;
            if ($page_prev == 0) {
                $page_prev = 1 ;
            }
            $page_list .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$page_prev.'">Trang trước</a></li>' ;
            for ($i=1; $i <= $total_pages ; $i++) { 
                if ($page == $i) {
                    $active = 'active' ;
                }else {
                    $active = "" ;
                }
                $page_list .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$i.'">'.$i.'</a></li>' ;
            }
            // page next
            $page_next = $page + 1 ;
            if ($page_next > $total_pages) {
                $page_next = $total_pages ;
            }
            $page_list .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$page_next.'">Trang sau</a></li>';
            echo $page_list ;
        ?>
        
    </ul> 
</div>
    <!--	End Comments List	-->
</div>
<!--	End Product	-->
<script>
        const stars = document.querySelector(".ratings").children;
        const ratingValue = document.querySelector("#rating-value");
        let index;

        for (let i = 0; i < stars.length; i++) {
            stars[i].addEventListener("mouseover", function() {
                // console.log(i)
                for (let j = 0; j < stars.length; j++) {
                    stars[j].classList.remove("fa-star");
                    stars[j].classList.add("fa-star-o");
                }
                for (let j = 0; j <= i; j++) {
                    stars[j].classList.remove("fa-star-o");
                    stars[j].classList.add("fa-star");
                }
            })
            stars[i].addEventListener("click", function() {
                ratingValue.value = i + 1;
                index = i;
            })
            stars[i].addEventListener("mouseout", function() {

                for (let j = 0; j < stars.length; j++) {
                    stars[j].classList.remove("fa-star");
                    stars[j].classList.add("fa-star-o");
                }
                for (let j = 0; j <= index; j++) {
                    stars[j].classList.remove("fa-star-o");
                    stars[j].classList.add("fa-star");
                }
            })
        }
    </script>
