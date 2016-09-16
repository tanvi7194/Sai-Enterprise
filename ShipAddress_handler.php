<?php
session_start();
$user_id = $_SESSION["uid"];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$stateid = $_POST['state'];
$cityid = $_POST['city'];
$country = $_POST['country'];
$zipcode = $_POST['zipcode'];

include 'Classes/Shipping_Address.php';

$ship = new Shipping_Address();
$shipaddr = $ship->setAddress($user_id,$add1, $add2, $cityid, $stateid, $country, $zipcode);
$shipid = $ship->getShipAddID();
    mysqli_query($con,"insert into se_user_shipping_address(u_id,shipping_id) values($user_id,$shipid)");
header("location:home.php?status=success");

?>
