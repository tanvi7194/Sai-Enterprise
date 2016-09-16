<?php
session_start();
require_once 'connection_file_user.php';

$uid=$_SESSION["u_id"];
$sid=$_SESSION["serv_id"];
$appServ=mysqli_query($con,"insert into se_service_user(u_id,service_id,service_status) values($uid,$sid,'Sent')");
if($appServ)
{
    header("location:http://saienterprise.pe.hu/SaiEnterpriseWebsite/services.php?id=".$sid."&status=success");
}

?>