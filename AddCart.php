
<?php

session_start();

require_once 'connection_file_user.php';


$id = $_REQUEST['id'];
$qty = $_REQUEST['qty'];
$sp = $_REQUEST['price'];





$uid=$_SESSION['u_id'];
    $chck = mysqli_num_rows(mysqli_query($con,"select * from carttable where product_id=".$id." and u_id=".$uid));
    echo "Check is ".$chck;
    if($chck==0)
    {
        $insert = "Insert INTO carttable values(null ,$uid, $id,NULL,$qty,$sp)";
        $insertResult = mysqli_query($con,$insert);
        echo $chck;

    }
    

?>
