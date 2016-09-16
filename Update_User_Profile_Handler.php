<?php

require_once 'connection_file_user.php';
$u_id = $_POST['user_id'];
$u_fnm = $_POST['user_first_name'];
$u_lnm = $_POST['user_last_name'];
$u_mail = $_POST['user_mail'];
$u_contact = $_POST['user_contact'];
$u_ques = 1;//$_POST['user_ques'];
$u_ans = $_POST['user_ans'];

$u_ship_id = $_POST['ship_id'];
$u_s_add_line_1 = $_POST['s_add_line_1'];
$u_s_add_line_2 = $_POST['s_add_line_2'];
$u_s_zip_code = $_POST['s_zip_code'];
$u_s_city = $_POST['b_city'];
$u_s_state = $_POST['s_state'];
//echo $u_id."<br><br>".$u_fnm."<br><br>".$u_lnm."<br><br>".$u_contact."<br><br>".$u_ques."<br><br>".$u_ans."<br><br>";

$u_bill_id = $_POST['bill_id'];
$u_b_add_line_1 = $_POST['b_add_line_1'];
$u_b_add_line_2 = $_POST['b_add_line_2'];
$u_b_zip_code = $_POST['b_zip_code'];
$u_b_city = $_POST['b_city'];
$u_b_state = $_POST['b_state'];
include './Classes/Update_User_Profile.php';

$adm = new UserProfile();
if($_POST['new_passwd'])
{
    $md1 = md5($_POST['new_passwd']);
    $password = md5($md1);
    $adm->update_user_profile_with_password($u_id ,$u_fnm, $u_lnm, $u_mail,$password, $u_contact, $u_ques, $u_ans);
    $adm->update_user_billing_address($u_bill_id, $u_b_add_line_1, $u_b_add_line_2, $u_b_city, $u_b_state, $u_b_zip_code);
    $adm->update_user_shipping_address($u_ship_id, $u_s_add_line_1, $u_s_add_line_2, $u_s_city, $u_s_state, $u_s_zip_code);
}
else
{
    $adm->update_user_profile_without_password($u_id ,$u_fnm, $u_lnm, $u_mail, $u_contact, $u_ques, $u_ans);       
    $adm->update_user_billing_address($u_bill_id, $u_b_add_line_1, $u_b_add_line_2, $u_b_city, $u_b_state, $u_b_zip_code);
    $adm->update_user_shipping_address($u_ship_id, $u_s_add_line_1, $u_s_add_line_2, $u_s_city, $u_s_state, $u_s_zip_code);
    
}
if($adm)
{
    //header("location:User_Profile.php");
    //echo $adm;
}
else
{
    mysqli_error($con);
}


/* 
 * 
 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

