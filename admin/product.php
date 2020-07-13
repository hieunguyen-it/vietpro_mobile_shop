<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm</h1>
        </div>
    </div><!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_product" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table 
                        data-toolbar="#toolbar"
                        data-toggle="table">

                        <thead>
                        <tr>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="name"  data-sortable="true">Tên sản phẩm</th>
                            <th data-field="price" data-sortable="true">Giá</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Danh mục</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            // hưỡng dẫn  làm phân trang
                            if (isset($_GET["page"])) {
                               $page = $_GET["page"] ;
                            }else {
                                $page = 1 ;
                            }
                            $rows_pre_page = 5 ; // số sản phẩm trong một trang
                            $pre_row = $page * $rows_pre_page - $rows_pre_page ; // vị trí bắt đầu lấy sản phẩm
                            // tìm số lượng trang.
                            $total_rows = mysqli_num_rows(mysqli_query($conn , "SELECT * FROM product ")) ;// đây là số lượng sản phẩm
                            $total_pages = ceil($total_rows / $rows_pre_page) ; // ceil dùng để làm tròn lên số lượng trang
                            // end tìm số lương trang
                            $list_pages = '<ul class="pagination">' ;
                            
                            // page prev
                            $page_prev = $page - 1 ;
                            if ($page_prev == 0) {
                                $page_prev = 1 ;
                            }
                             
                            $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_prev.'">&laquo;</a></li>' ;
                            // end page prev
                            // chạy vòng lặp for để tạo ra danh sách tất các các trang
                            for ($i=1; $i <= $total_pages ; $i++) { 
                            $list_pages .= ' <li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>' ;
                        
                            }
                            // end danh sách trang
                            // page next
                            $page_next = $page + 1 ;
                            if ($page_next > $total_pages) {
                                $page_next = $total_pages ;
                            }
                            $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_next.'">&raquo;</a></li>' ;
                            //end page next
                            $list_pages .= '</ul>' ;
                            echo "$list_pages" ;
                            // kết thúc phân trang
                            $sql = "SELECT * FROM product
                            INNER JOIN category
                            ON product.cat_id = category.cat_id
                            ORDER BY prd_id DESC 
                            LIMIT $pre_row , $rows_pre_page
                            ";
                            
                            $query = mysqli_query($conn , $sql) ;
                            while($row = mysqli_fetch_array($query)){
                                
                            
                                
                        ?>
                                <tr>
                                    <td style=""><?php echo $row["prd_id"] ; ?></td>
                                    <td style=""><?php echo $row["prd_name"] ; ?></td>
                                    <td style=""><?php echo $row["prd_price"] ; ?></td>
                                    <td style="text-align: center"><img width="130" height="180" src="img/products/<?php echo $row["prd_image"] ; ?>" /></td>
                                    <td><span class="label label-<?php if($row["prd_status"] == 1){echo "success" ;}else{echo "danger" ;} ?>"><?php if($row["prd_status"] == 1){echo "còn hàng" ;}else{echo "hết hàng" ;} ?></span></td>
                                    <td><?php echo $row["cat_name"] ; ?></td>
                                    <td class="form-group">
                                    <a href="index.php?page_layout=edit_product&prd_id=<?php echo $row["prd_id"] ; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="dell_prd.php?prd_id=<?php echo $row["prd_id"] ; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                                
                        <?php 
                            }
                        ?>
                                
                             </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <?php echo "$list_pages" ; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div><!--/.row-->	
</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
</script>	

