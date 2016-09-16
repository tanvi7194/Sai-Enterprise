<?php
session_start();
$user_id = $_SESSION["uid"];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$stateid = $_POST['state'];
$cityid = $_POST['b_city'];
$country = $_POST['country'];
$zipcode = $_POST['zipcode'];
require_once 'connection_file_user.php';
require_once 'Classes/Billing_Address.php';
require_once 'Classes/Shipping_Address.php';
if(isset ($_POST['same']))
{
    $bill = new Billing_Address();
$setaddr = $bill->setAddress($user_id,$add1, $add2, $cityid, $stateid, $country, $zipcode);

    $ship = new Shipping_Address();
    $setshipaddr = $ship->setAddress($user_id,$add1, $add2, $cityid, $stateid, $country, $zipcode);

    $getBillid = new Billing_Address();
    $billid=$getBillid->getBillAddID();
    mysqli_query($con,"insert into se_user_billing_address(u_id,billing_address_id) values($user_id,$billid)");

    $getShipid = new Shipping_Address();
    $shipid = $getShipid->getShipAddID();
    mysqli_query($con,"insert into se_user_shipping_address(u_id,shipping_id) values($user_id,$shipid)");
    
    header("location:home.php?status=success");

}
else
{
    $bill = new Billing_Address();
$setaddr = $bill->setAddress($user_id,$add1, $add2, $cityid, $stateid, $country, $zipcode);

$getBillid = new Billing_Address();
 $billid=$getBillid->getBillAddID($add1, $add2);
    mysqli_query($con,"insert into se_user_billing_address(u_id,billing_address_id) values($user_id,$billid)");

    header("location:ShippingAddressForm.php");

}

?>
