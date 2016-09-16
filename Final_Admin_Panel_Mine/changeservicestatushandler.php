<?php
session_start();
//$sid=$_GET["sid"];
//$uid=$_GET["uid"];
$sid=$_SESSION["service_id"];
$uid=$_SESSION["user_id"];
$status=$_POST["service_status"];
require_once 'connection_file.php';

$query=mysqli_query($con,"update se_service_user set service_status='$status' where service_id=$sid and u_id=$uid");
if($query)
{
    header("location:ManageServices.php?service_status='Status has been updated!!'&status=success");
}
 else
{
    header("location:ManageServices.php?service_status='Status is NOT updated!!'&status=failed");
}



?>