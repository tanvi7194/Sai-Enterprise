<?php

session_start();
require_once 'connection_file.php';
$value = $_REQUEST['value'];
    echo "Value ".$value;
if (isset($_REQUEST['value'])) {
    $value = $_REQUEST['value'];
    echo "Value ".$value;
    if (isset($_SESSION['delid'])) {
        //echo $_SESSION['delid']."  ";
        $oid = $_SESSION['delid'];
        //echo 'Got value of pid as: '.$pid;
        $ans = mysqli_query($con,"UPDATE se_orders set order_status='$value' where order_id=$oid");
        //echo $ans;
        if($ans)
        {
            header("location: orderhistory.php?stock_updated='Order Status has been updated!!'&status=yes");
        }
        else
        {
            header("location: orderhistory.php?stock_updated='Order Status is NOT updated!! Try Again'&status=no");
        }
    } else {
        echo '2';
    }
} else {
    echo 0;
}
