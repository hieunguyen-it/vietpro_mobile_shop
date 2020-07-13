<script src="ckeditor/ckeditor.js"></script>
<?php
ob_start() ;
include_once("connect.php"); 
include_once("function.php") ;
session_start();
define("TEMPLATE" , true ) ;//dung de tao hang so khoa khong cho nguoi dung truy cap linh tinh
if(isset($_SESSION["mail"]) && isset($_SESSION["pass"])){
    include_once("admin.php");
}
else if(isset( $_SESSION['mail']) && isset($_SESSION['name']) ){
    include_once("admin.php");
}
else{
    include_once("login.php");
}
