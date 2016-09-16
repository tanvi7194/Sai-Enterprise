<?php
session_start();
$d_id = $_SESSION['d_id'];
$discount=$_POST['disc'];
$discountfrom=$_POST['discfrom'];
$discountto=$_POST['discto'];
echo $discount.$discountfrom.$discountto;

include './Classes/Update_Discount.php';
$sel=new Update_Discount_Class();
echo "UPDATE se_discount SET product_discount_percentage=$discount, valid_from='$discountfrom' , valid_to='$discountto' where discount_id=$d_id";
$updt = $sel->update_discount($d_id, $discount, $discountfrom, $discountto); 
