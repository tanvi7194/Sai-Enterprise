<?php
session_start();
$comment = $_POST["comment"];
$rating = $_POST["rating"];
$uid = $_SESSION["u_id"];
$pid = $_POST["productid"];

require_once 'connection_file_user.php';

$query = mysqli_query($con,"insert into se_feedback (u_id,product_id,feedback_content,feedback_rating) values($uid,$pid,'$comment',$rating)");
if($query)
{
    header("location:products.php?val='success'");
}


?>
