<?php
session_start();
$userid = $_SESSION['u_id'];
require_once 'connection_file_user.php';

$q = mysqli_query($con,"insert into se_online_chat_users (userid,status) values ($userid,'online')");
echo "You are connected with admin! Start Typing below!";



?>
