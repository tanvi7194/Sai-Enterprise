<?php
$status = $_REQUEST['value'];
require_once 'connection_file.php';

$updatestatus = mysqli_query($con,"update se_online_chat_users set status='$status' where userid='1001'");

$getstatus = mysqli_query($con,"select status from se_online_chat_users where userid='1001'");
while($row = mysqli_fetch_array($getstatus,MYSQLI_BOTH))
{
    echo "Status: ".$row[0];
}
?>
