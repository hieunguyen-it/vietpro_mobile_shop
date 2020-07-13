<?php
include_once('connect.php');
$sql = "SELECT * FROM config_mail";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

?>