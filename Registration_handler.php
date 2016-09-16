<?php
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$confirmpass = $_POST["confirmpass"];
$contact = $_POST["contact"];
$sec_ques = $_POST["sec_ques"];
$ans = $_POST["ans"];
$userid;
session_start();
$pass = md5($confirmpass);
$mainpass = md5($pass);
require_once 'Classes/User.php';
$user = new User();
$register = $user ->Register($fname, $lname, $contact, $email, $mainpass, $sec_ques, $ans);
echo $register;
                require_once 'connection_file_user.php';
                $getuserID = mysqli_query($con,"select u_id from se_user where u_fname='$fname' and u_lname='$lname'");
                if($getuserID)
                {
                while($row =mysqli_fetch_array($getuserID,MYSQLI_BOTH))
                {
                    $userid = $row[0];
                }
                
                    $_SESSION["uid"]=$userid;
                }
if($register == "Success")
{
    header("location:BillingAddress.php");
}
else if($register == "Fail")
{
    header("location:sign_up.php");
}


?>
