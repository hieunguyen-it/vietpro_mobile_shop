<?php
    include_once("connect.php") ;
    $page_comm = $_GET["page_comm"] ;
    // viết câu truy vấn
    $sql = "DELETE FROM comment WHERE comm_id = '$page_comm'" ;
    // thực hiện câu truy vấn
    mysqli_query($conn , $sql) ;
    // sau khi thực hiện câu truy vấn ta chuyển về trang comment.php
    header("location:index.php?page_layout=comment") ;

?>