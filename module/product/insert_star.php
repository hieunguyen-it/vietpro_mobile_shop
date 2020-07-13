<?php
if (isset($_POST['submit_rating'])) {
    include_once("../../admin/connect.php");
    $id = $_GET['prd_id'];
    $rate = $_POST['rating'];
    if (isset($_SESSION['rate'][$id])) {
        header('Location: ../../index.php?page_layout=product&prd_id=' . $id);
    } else {
        $sql = "INSERT INTO `rating_prd`( `prd_id`, `rate`) VALUES ($id,$rate)";
        $insert = mysqli_query($conn, $sql);
        $_SESSION['rate'][$id] = 1;
        header('Location: ../../index.php?page_layout=product&prd_id=' . $id);
    }
}
