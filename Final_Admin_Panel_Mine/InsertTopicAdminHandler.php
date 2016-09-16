<?php
$id = $_GET["id"];
session_start();
$post_content = $_GET["post"];
$postby = $_SESSION['admin_id'];
echo $_SESSION['admin_id'];

include_once './Classes/forum_class.php';
$forums = new Forum();
$insert = $forums->InsertPost($post_content, $id, $postby);

echo $insert;
if($insert == "success")
{
    header("location:http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/addpostadmin.php?id=".$id);
}

?>
