<?php
session_start();
require_once 'connection_file_user.php';

$deletechat = mysqli_query($con, "delete from se_online_chat");
if(isset ($_SESSION["u_id"]))
{
    $uid = $_SESSION["u_id"];
    $deleteuser = mysqli_query($con,"delete from se_online_chat_users where userid=$uid");
}