
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách Email</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách Email</h1>
			</div>
		</div><!--/.row-->
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
						        <th data-field="name"  data-sortable="true">Họ & Tên</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="phone" data-sortable="true">Phone</th>
                                <th data-field="address" data-sortable="true">Address</th>
                                <th>Hành động</th>
						    </tr>
                            </thead>
                            <tbody>
                            <?php 
                                // Nếu người dùng click vào trang nào sẽ điều hướng đến trang số đó , ngược lại ở trang 1
                                if(isset($_GET['pages'])){
                                    $page = $_GET['pages'];
                                }
                                else{
                                    $page = 1;
                                }
                                $row_per_page = 2; // Số trang muốn hiện thị
                                // công thức tính luôn đúng:
                                $per_row = $page * $row_per_page - $row_per_page;
                                // tìm số lượng trang.
                                    $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mail_server"));
                                    $total_pages = ceil($total_rows/ $row_per_page);
                                $list_pages = '<ul class="pagination">';
                                //page prewiew
                                $page_prev = $page - 1; // Khi người dùng click vào trang ban đầu lùi lại 1 trang so với giá trị trang hiện tại
                                if ($page_prev == 0){
                                    $page_prev = 1;
                                }
                                $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=mail&pages='.$page_prev.'">&laquo;</a></li>' ;
                                for ($i=1; $i <= $total_pages ; $i++) { 
                                    $list_pages .= ' <li class="page-item"><a class="page-link" href="index.php?page_layout=mail&pages='.$i.'">'.$i.'</a></li>' ;
                                }
                                $page_next = $page + 1 ;
                                if ($page_next > $total_pages) {
                                    $page_next = $total_pages ;
                                }
                                $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=mail&pages='.$page_next.'">&raquo;</a></li>' ;
                                $list_pages .= '</ul>' ;
                                echo "$list_pages";
                                $sql = "SELECT * FROM mail_server
                                        LIMIT $per_row, $row_per_page " ;
                                $query = mysqli_query($conn , $sql) ;
                                while($row = mysqli_fetch_array($query)){
                            ?>
                                <tr>
                                    <td style=""><?php echo $row["id_mail"] ; ?></td>
                                    <td style=""><?php echo $row["name"] ; ?></td>
                                    <td style=""><?php echo $row["email"] ; ?></td>
                                    <td style=""><?php echo $row["phone"] ; ?></td>
                                    <td style=""><?php echo $row["address"] ; ?></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_mail&id_mail=<?php echo $row["id_mail"] ; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
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
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
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
