<?php
session_start();
$id = $_POST['id'];
$pwd = $_POST['pwd'];

//$id ="saxenatanvi7194@gmail.com";
//$pwd = "ta";
require_once 'connection_file_user.php';

$md1 = md5($pwd);
$md2 = md5($md1);
$sel = "select * from se_user where u_emailid = '$id'";
$result=  mysqli_query($con,$sel);
$row = mysqli_fetch_array($result,MYSQLI_BOTH);
$count = mysqli_num_rows($result);

if($count!=0)
{
            if($row['u_password'] == $md2)
            {
                $_SESSION['nm']=$row['u_fname'];
                $_SESSION['u_id'] = $row['u_id'];
                header("location: home.php");
            }
            else
            {  
                
                header("location: login.php?status=unsuccess");
            }
}
else
{
    echo "Mail ID is NOT Available";
}
        









////INSERT QUERY
//
//
//
////$md1 = md5($pwd);
////$md2 = md5($md1);
//
//
//
//$q = "insert into se_user values (null , 'Jaspreet' , 'Chhabra' , 123456789 , '$id' , '$md2' , 1 , 'Gaurav' )";
//if(mysqli_query($q))
//{
//    echo "Yesssssssssssss";
//    
//}
//else
//{
//    echo "Nooooooooooo";
//}





