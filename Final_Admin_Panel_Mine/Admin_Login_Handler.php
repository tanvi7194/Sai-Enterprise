<?php
session_start();
$id = $_POST['mail'];
$pwd = $_POST['passwd'];
require_once 'connection_file.php';

$sel = "select * from se_administration";
$result=  mysqli_query($con,$sel);
$row=  mysqli_fetch_array($result,MYSQLI_BOTH);
$md1 = md5($pwd);
$md2 = md5($md1);
if($row['admin_email'] == $id)
{
    if($row['admin_password'] == $md2)
    {
        $_SESSION['nm']=$row['admin_name'];
        $_SESSION['admin_id'] = $row['admin_id'];
        header("location:home_sai_enterprise.php");
    }
    else
    {  echo "Password";
    }
}
else
{
                   echo "Email";
            
}






