<!--	List Product	-->
<?php   
        if (isset($_POST["sbm"])) {
            $keyword = $_POST['keyword'];
        }else {
            $keyword = $_GET['keyword'];
        }
        $arr_keyword = explode(" ", $keyword);
        $new_keyword = "%" . implode("%", $arr_keyword) . "%";
        if (isset($_GET["page"])) {
            $page = $_GET["page"] ;
        }else{
            $page = 1 ;
        }
        $rows_pre_page = 6 ;
        $pre_row = $page * $rows_pre_page - $rows_pre_page ;
        $sql = "SELECT * FROM product
                        WHERE prd_name LIKE '$new_keyword'
                        LIMIT $pre_row , $rows_pre_page
                         ";
        $query = mysqli_query($conn , $sql) ;
        $rows = mysqli_num_rows($query) ;
        $total_row = mysqli_num_rows(mysqli_query($conn , " SELECT * FROM product WHERE prd_name LIKE '$new_keyword' ")) ;
        $total_pages = ceil($total_row / $rows_pre_page) ;
        $page_id = $row["cat_id"] ;
        $list_page = "" ;
        // page prev
        $page_prev = $page - 1 ;
        if ($page_prev == 0) {
            $page_prev = 1 ;
        }
        $list_page .= '<li class="page-item "><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$page_prev.'">Trang trước</a></li>' ;
        for ($i=1; $i <= $total_pages ; $i++) { 
            if ($page == $i) {
                $active = 'active' ;
            }else {
                $active = "" ;
            }
            $list_page .= ' <li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$i.'">'.$i.'</a></li> ' ;
        }
        // page next
        $page_next = $page + 1 ;
        if ($page_next > $total_pages) {
            $page_next = $total_pages ;
        }
        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$page_next.'">Trang sau</a></li>' ;
       





?>
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        if ($i == 0) {


    ?>
            <div class="product-list card-deck">
            <?php
        }
            ?>
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&prd_id=<?php echo $row["prd_id"]; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
                <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row["prd_id"]; ?>"><?php echo $row["prd_name"]; ?></a></h4>
                <p>Giá Bán: <span><?php echo number_format($row["prd_price"])  ; ?></span></p>

            </div>
            <?php
            $i++;
            if ($i == 3) {
                $i = 0

            ?>
            </div>
        <?php
            }
        }
        if ($rows % 3 != 0) {


        ?>
</div>
<?php
        }
?>
</div>
<!--	End List Product	-->


<div id="pagination">
    <ul class="pagination">
        
        <?php
            echo $list_page ;
        ?>
        
    </ul>
</div>