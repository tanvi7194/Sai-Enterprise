<?php
$id = $_GET["id"];
$tid = $_GET["topicID"];

require_once __DIR__ .'../Classes/forum_class.php';
$delete = new Forum();

$del = $delete->DeletePost($id);
echo $del;
if($del=="success")
{
    header("location:http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/ManageForum.php?delpost=success");
}
?>
