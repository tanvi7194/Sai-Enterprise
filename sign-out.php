<?php
require_once 'connection_file_user.php';
session_start();

$uid = $_SESSION["u_id"];
$query = mysqli_query($con,"delete from carttable where u_id=$uid");

session_destroy();
header("Location:home.php");

?>
