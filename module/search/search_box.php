<?php
    // if (isset($_POST["keyword"])) {
    //     $keyword = $_POST["keyword"] ;
    // }else{
    //     $keyword = "" ;
    // }
    
?>
<div id="search" class="col-lg-6 col-md-6 col-sm-12">
    <form class="form-inline" action="index.php?page_layout=search" method="post">
        <input name="keyword" value="" class="form-control mt-3" type="search" placeholder="Tìm kiếm" aria-label="Search">
        <button class="btn btn-danger mt-3" type="submit" name="sbm">Tìm kiếm</button>
    </form>
</div>