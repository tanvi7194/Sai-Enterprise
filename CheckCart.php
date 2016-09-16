<?php
session_start();

$productid = $_SESSION['cart_id'];
require_once 'connection_file_user.php';

$c = mysqli_fetch_array(mysqli_query($con,"select count(sr_no) from carttable where u_id=".$_SESSION['u_id']),MYSQLI_BOTH);
if($c[0]<3)
{
    $disable = mysqli_num_rows(mysqli_query($con,"select * from cartTable where product_id=".$productid. " and u_id=".$_SESSION['u_id']));
    if($disable>0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}
else
{
    echo $c[0];
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

