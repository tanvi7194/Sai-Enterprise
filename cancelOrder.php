<?php
require_once 'connection_file_user.php';
if(isset ($_GET["order_id"]) && isset ($_GET["uid"]))
{
    $oid = $_GET["order_id"];
    $uid = $_GET["uid"];

    $query = mysqli_query($con,"update se_orders set order_status='Cancelled' where order_id=$oid and u_id=$uid");
    if($query)
    {
        header("location:http://localhost/SaiEnterpriseWebsite/viewOrder.php?order_id=".$oid."&status=success");
    }
}

?>
