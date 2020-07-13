<?php
if(!defined('TEMPLATE')){
	die('Bạn không có quyền truy cập vào file này !');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="">Quản lý sản phẩm</a></li>
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
                            <form role="form">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input class="form-control" name="prod_name" placeholder="">
                                </div>
                                                                
                                <div class="form-group">
                                    <label>Tên khách hàng</label>
                                    <input type="number" name="prod_price" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email khách hàng</label>
                                    <input type="text" class="form-control">
                                </div>    
                                <div class="form-group">
                                    <label>Thời gian coment</label>
                                    <input type="text" class="form-control">
                                </div>                  
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh sản phẩm</label>
                                    
                                    <input type="file">
                                    <br>
                                    <div>
                                        <img src="img/download.jpeg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select class="form-control">
                                        <option>Danh mục 1</option>
                                        <option>Danh mục 2</option>
                                        <option>Danh mục 3</option>
                                        <option>Danh mục 4</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="form-control">
                                        <option>Hiển thị</option>
                                        <option>Ẩn</option>
                                    </select>
                                </div>
        
                                <div class="form-group">
                                        <label>Mô tả bình luận</label>
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                <button type="submit" class="btn btn-success">Thêm mới</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
    
</div>	<!--/.main-->
