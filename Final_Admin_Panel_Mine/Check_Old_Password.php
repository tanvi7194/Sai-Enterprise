<?php
$old = $_REQUEST['passwd'];
$server = "localhost";

require_once 'connection_file.php';


$md1 = md5($old);
$md2 = md5($md1);
$sel = "select * from se_administration";
$result=  mysqli_query($con,$sel);


while($row=  mysqli_fetch_array($result,MYSQLI_BOTH))
{

if($row['admin_password']==$md2)
{
    echo "Old Password Is Correct";
}
else
{
    echo "Password is Incorrect";
    //echo $md2;
}
}
