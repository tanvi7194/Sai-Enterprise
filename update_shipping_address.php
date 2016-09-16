<?php
//echo $_POST['id'];
//echo "<br>".$_POST['add_line_1'];
//echo "<br>".$_POST['add_line_2'];
//echo "<br>".$_POST['city'];
//echo "<br>".$_POST['state'];
//echo "<br>".$_POST['zip_code'];

require_once 'connection_file_user.php';
$update_billing_add = mysqli_query($con,"update se_shipping_address set add_line_1='".$_POST['add_line_1']."' ,add_line_2='".$_POST['add_line_2']."' ,city_id=".$_POST['b_city']." ,state_id=".$_POST['state']." ,zip_code=".$_POST['zip_code']." where shipping_id=".$_POST['id']);
if($update_billing_add)
{
    header("location:CheckOutAddress.php");
    //echo "<br><br> Updated...";
}
else
{
    echo "<br><br><Br>".mysqli_error();
}
                
                
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

