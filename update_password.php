<?php
session_start();
include_once './connection_file_user.php';
$p1 = $_POST['new_passwd'];
$pwd = md5(md5($p1));

$mail = $_SESSION['mail'];

$q = mysqli_query($con,"update se_user set u_password='$pwd' where u_emailid='".$mail."'");

if($q)
{
    header("location:login.php?msg='Your Password has been changed successfully'");
}