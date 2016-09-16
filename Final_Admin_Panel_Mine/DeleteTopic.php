<?php
$id = $_GET["id"];
include '../Classes/forum_class.php';
$delete = new Forum();
$del = $delete->DeleteTopic($id);

if($del=="success")
{
    header("location:http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/ManageForum.php?delStatus=success");
}

?>
