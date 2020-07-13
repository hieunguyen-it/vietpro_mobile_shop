<?php
if(!defined('TEMPLATE')){
	die('Bạn không có quyền truy cập vào file này !');
}
// hưỡng dẫn  làm phân trang
if (isset($_GET["page"])) {
    $page = $_GET["page"] ;
 }else {
     $page = 1 ;
 }
 $rows_pre_page = 5 ; // số sản phẩm trong một trang
 $pre_row = $page * $rows_pre_page - $rows_pre_page ; // vị trí bắt đầu lấy sản phẩm
 // tìm số lượng trang.
 $total_rows = mysqli_num_rows(mysqli_query($conn , "SELECT * FROM comment ORDER BY prd_id DESC   ")) ;// đây là số lượng sản phẩm
 $total_pages = ceil($total_rows / $rows_pre_page) ; // ceil dùng để làm tròn lên số lượng trang
 // sử dụng vòng lặp for để in ra danh sách trang
 $result ="" ;
 // page prev
 $page_prev = $page -1 ;
 if ($page_prev == 0) {
    $page_prev = 1 ;
 }
 $result .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page='.$page_prev.'">&laquo;</a></li>';
 for ($i=1; $i < $total_pages  ; $i++) { 
     if ($i == $page) {
        $active = 'active' ;
     }else {
         $active = "";
     }
     $result .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=comment&page='.$i.'">'.$i.'</a></li>';
 }
 // page next
 $page_next = $page + 1 ;
 if ($page_next > $total_pages) {
    $page_next = $total_pages ;
 }
$result .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page='.$page_next.'">&raquo;</a></li>';
$sql = "SELECT * FROM comment ORDER BY comm_status ASC LIMIT $pre_row , $rows_pre_page " ;
$query = mysqli_query($conn , $sql) ;

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Danh sách comment</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách comment</h1>
        </div>
    </div><!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_comment" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm comment
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
                            <th>Tên khách hàng</th>
                            <th>Email khách hàng</th>
                            <th>Thời gian comment</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Bình Luận</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($query)) {
                                $prd_id = $row["prd_id"] ;
                                $row_prd = mysqli_fetch_array(mysqli_query($conn , "SELECT * FROM product WHERE prd_id = '$prd_id'")) ;
                                
                                
                                

                                    
                        ?>
                                <tr>
                                    <td style=""><?php echo $row["comm_id"] ; ?></td>
                                    <td style=""><?php echo $row_prd["prd_name"] ; ?></td>
                                    <td style=""><?php echo $row["comm_name"] ; ?></td>
                                    <td style=""><?php echo $row["comm_mail"] ; ?></td>
                                    <td><?php echo $row["comm_date"] ; ?></td>
                                    <td style="text-align: center"><img width="130" height="180" src="img/products/<?php echo $row_prd["prd_image"] ; ?>" /></td>
                                    <td><span class="label label-<?php if($row["comm_status"] == 1){echo "success" ;}else{echo "danger" ;} ?>"><?php if($row["comm_status"] == 1){echo "Hiển thị" ;}else{echo "Ẩn" ;} ?></span></td>
                                    <td><?php echo $row["comm_details"] ; ?></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_comment&page_comm=<?php echo $row["comm_id"] ; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="dell_comment.php?page_comm=<?php echo $row["comm_id"] ; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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
                        <ul class="pagination">
                            
                            
                            <?php
                                echo $result ;
                            ?>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div><!--/.row-->	
</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>

