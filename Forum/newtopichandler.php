<?php
session_start();
$userid = $_SESSION["u_id"];
$subject = $_POST["subject"];
$category = $_SESSION["forum_cat"];
$question = $_POST["question"];

require_once '../Classes/forum_class.php';
$new = new Forum();

$q1=$new->addNewTopic($subject, $category,$userid);


$new1 = new Forum();
$q2=$new1->addNewQuestion($question,$subject,$userid);



if($q1=="Success" && $q2=="Success")
{
    header("location:forum_home.php?value=success");
}



?>
