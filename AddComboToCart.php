
<?php

session_start();

require_once 'connection_file_user.php';


$id = $_REQUEST['id'];
$q = mysqli_fetch_array(mysqli_query($con,"select combo_amount from se_combo_offer where combo_id=".$id));

$qty = 1;
$sp = $q[0];





$uid=$_SESSION['u_id'];
    
        $insert = "Insert INTO cartTable values(null ,$uid, null ,$id,$qty,$sp)";
        $insertResult = mysqli_query($con,$insert);
    

?>
