<?php

require_once 'connection_file_user.php';
$admin_nm = $_POST['admin_name'];
$admin_mail = $_POST['admin_mail'];
$contact = $_POST['admin_contact'];

 if($_FILES['img1']['tmp_name'])
{
    $image1= "data:" . $_FILES['img1']['type'] . ";base64," . base64_encode(file_get_contents($_FILES['img1']['tmp_name']));
    echo "<br><Br> Img 1";
}


include './Classes/Update_Admin_Profile.php';

$adm = new Administration();

if(isset($image1))
{
        if($_POST['new_passwd'])
        {
            $md1 = md5($_POST['new_passwd']);
            $password = md5($md1);
            $adm->update_admin_profile_with_password_and_image($admin_nm, $admin_mail, $contact, $password , $image1);    
        }
        else
        {
            $adm->update_admin_profile_with_only_image($admin_nm, $admin_mail, $contact , $image1);        
        }
}
else
{
        if($_POST['new_passwd'])
        {
            $md1 = md5($_POST['new_passwd']);
            $password = md5($md1);
            $adm->update_admin_profile_with_password($admin_nm, $admin_mail, $contact, $password);    
        }
        else
        {
            $adm->update_admin_profile_without_password($admin_nm, $admin_mail, $contact);        
        }
}
if($adm)
{
    //echo mysqli_error();
    header("location:Admin_Profile.php");
}
else
{
    mysqli_error();
}


/* 
 * 
 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

