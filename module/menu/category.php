<?php
   
    $cat_id = $_GET["cat_id"];
    $cat_name = $_GET["cat_name"];
    // phan trang
    if (isset($_GET["page"])) {
        $page = $_GET["page"] ;
    }else{
        $page = 1 ;
    }
    $rows_pre_page = 6 ;
    $pre_row = $page * $rows_pre_page - $rows_pre_page ;
    $sql = "SELECT * FROM product
    WHERE cat_id = $cat_id
    ORDER BY prd_id DESC
    LIMIT $pre_row , $rows_pre_page
    ";
    $total_rows = mysqli_num_rows(mysqli_query($conn , "SELECT * FROM product WHERE cat_id = '$cat_id'")) ;
    $total_pages = ceil($total_rows / $rows_pre_page) ;
    $list_page = '<div id="pagination">';
    $list_page .= '<ul class="pagination">' ;
    // page prev
    $page_prev = $page - 1 ;
    if ($page_prev == 0) {
        $page_prev = 1 ;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$page_prev.'">Trang trước</a></li>' ;
    // su dung vong lap for de tao ra danh sach trang
    
    for ($i=1; $i <= $total_pages ; $i++) { 
        if ($i == $page) {
            $cative = 'active' ;
        }else {
            $cative = "";
        }
        $list_page .= ' <li class="page-item '.$cative.'"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$i.'">'.$i.'</a></li>' ;
    }
    // page next
    $page_next = $page + 1 ;
    if ($page_next > $total_pages) {
        $page_next = $total_pages ;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$page_next.'">Trang sau</a></li>' ;
    $list_page .= '</ul>' ;
    $list_page .= '</div>' ;
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);
?>
  
<!--	List Product	-->
                <div class="products">
                    <h3><?php echo $cat_name ;?> (hiện có <?php echo $total_rows;?> sản phẩm)</h3>
                    <?php
                        
                        $i = 0;
                        while ($row = mysqli_fetch_array($query)){
                        if($i==0){
                    ?>
                    <div class="product-list card-deck">
                    <?php
                        }
                    ?>
                        <div class="product-item card text-center">
                            <a href="index.php?page_layout=product&prd_id=<?php echo $row["prd_id"] ; ?>"><img src="admin/img/products/<?php echo $row['prd_image'] ; ?>"></a>
                            <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row["prd_id"] ; ?>"><?php echo $row["prd_name"] ;?></a></h4>
                            <p>Giá Bán: <span><?php echo number_format($row["prd_price"]) ;?></span></p> 
                        </div>
                    <?php
                        $i++;
                        if($i==3){
                            $i=0;
                    ?>
                    </div>
                    <?php
                        }
                        }
                    if($rows%3!=0){
                    ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <!--	End List Product	-->
                <?php
                        
                        
                ?>

                
                    
                        
                       <?php
                            echo $list_page ;
                       ?>
                        
                    
                



                
                
                