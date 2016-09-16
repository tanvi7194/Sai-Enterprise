<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        include_once './connection_file_user.php';
        
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that

date_default_timezone_set('Etc/UTC');

require './PHPMailer-master/PHPMailerAutoload.php';
//$email_id=$_REQUEST["mail"];
//$a = mysql_num_rows(mysql_query("select * from se_user where u_emailid='$email_id'"));



//if($a!=0)
//{
$_SESSION["email_id"]=$_POST['email'];

if(mysqli_num_rows(mysqli_query($con,"select * from se_user where u_emailid='".$_POST['email']."'"))==1)
{
    
$pass_rec=  rand(10000, 99999);
$_SESSION['code'] =$pass_rec;
$_SESSION['mail']=$_POST['email'];
////Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';       //mx1.hostinger.in

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "gaurav.majmudar94@gmail.com";      //webmaster@bnap.url.ph

//Password to use for SMTP authentication
$mail->Password = "gaurav123456";

//Set who the message is to be sent from
$mail->setFrom('gaurav.majmudar94@gmail.com', 'Password Recovery');

//Set an alternative reply-to address
$mail->addReplyTo('gaurav.majmudar94@gmail.com', 'Gaurav Majmudar');

//Set who the message is to be sent to
$mail->addAddress($_POST['email'], 'Dishant Patel');

//Set the subject line
$mail->Subject = 'Password Recovery';
$mail->Body = "Password Recovery Code  :  ".$pass_rec." ";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//if($mail->send()){
//echo "Mail Sent";
//}
//else
//{echo "error";}
//Attach an image file

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    header("Location: Password_recovery.php?msg='E-Mail with recovery code has been sent to you!!'");

}

//}

//else
//{
//    echo "This MAIL id is NOT registered!!!!!!!!!!";
//    echo "<br><a href=login.php>go BACK";
//}

?>
    </body>
</html>

<?php

}
else
{
    //header("Location: forgotPassword_client.php?msg='This Mail ID is NOT registered with us!'");
}