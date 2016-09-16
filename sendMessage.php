<?php
$message = $_GET["value"];

$userid = $_GET["id"];


require_once 'connection_file_user.php';

$query = mysqli_query($con,"insert into se_online_chat (u_id,ChatMsg) values($userid,'$message')");



?>
