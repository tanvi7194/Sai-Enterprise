<?php
session_start();
$post_content = $_POST["post"];
$topicid = $_SESSION["topic_id"];
$postby = $_SESSION["u_id"];

require_once '../Classes/forum_class.php';
$forums = new Forum();
$insert = $forums->InsertPost($post_content, $topicid, $postby);


if($insert == "success")
{
    header("location:viewPost.php?id=".$topicid);
}

?>
