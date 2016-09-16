<?php

$id = $_REQUEST['id'];
$cartQty = $_REQUEST['value'];


require_once 'connection_file_user.php';

$update_qty = mysqli_query($con,"update carttable set quantity=$cartQty where product_id=$id");
if($update_qty)
{
    //echo $cartQty;
    echo '0';
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

