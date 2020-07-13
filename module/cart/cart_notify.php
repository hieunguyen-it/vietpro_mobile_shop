<div id="cart" class="col-lg-3 col-md-3 col-sm-12">
    <a class="mt-4 mr-2" href="index.php?page_layout=cart">giỏ hàng</a><span class="mt-3">
        <?php
        if (isset($_SESSION["cart"])) {
            // cập nhật lại số lượng sản phẩm trong rỏ hàng
            if (isset($_POST["qtt"])) { // cần chú ý phải là qtt không thể sbm đc vì nếu sbm thì search cùng có name là sbm lúc này hệ thống sẽ báo lỗi 
                foreach($_POST["qtt"] as $prd_id =>$qtt){
                    $_SESSION["cart"][$prd_id] = $qtt ;
                }
            }
            // kết thúc cập nhật rỏ hàng
            // xuất ra số lượng sản  phẩm trong rỏ hàng
            $totals = 0;
            foreach ($_SESSION["cart"] as $prd_id => $qtt) {
                $totals += $qtt;
            }
            echo $totals;
        } else {
            echo 0;
        }
        // kết thúc việc xuất ra sản phẩm trong rỏ hàng
        ?>

    </span>
</div>