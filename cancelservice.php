<?php

$sid=$_GET["sid"];
require_once 'connection_file_user.php';

$query=mysqli_query($con,"update se_service_user set service_status='cancelled' where service_id=".$sid) or die (mysqli_error());
if($query)
{
    header("location:http://www.saienterprise.pe.hu/SaiEnterpriseWebsite/servicehistory.php");
}

?>

