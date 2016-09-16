<?php
session_start();

$pid = $_SESSION['p_id'];
$discount=$_POST['disc'];
$discountfrom=$_POST['discfrom'];
$discountto=$_POST['discto'];
//echo $pid.$discount.$discountfrom.$discountto;

include './Classes/Update_Discount.php';
$sel=new Update_Discount_Class();
//echo "UPDATE se_discount SET product_discount_percentage=$discount, valid_from='$discountfrom' , valid_to='$discountto' where product_id=$pid";
$updt = $sel->insert_discount($pid, $discount, $discountfrom, $discountto); 
