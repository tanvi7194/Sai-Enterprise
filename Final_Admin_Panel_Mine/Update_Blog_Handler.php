<?php
//$id = $_REQUEST['b_id'];
$content = $_POST['content'];
echo $content;

require_once 'connection_file.php';
$query = mysqli_query($con,"update se_blog set blog_content='".$content."' where blog_id=1");
if($query)
        {
            header("location: Manage_Blog.php?stock_updated='Blog has been updated!!'&status=yes");
        }
        else
        {
            header("location: Manage_Blog.php?stock_updated='Blog is NOT updated!! Try Again'&status=no");
        }
//header("location:Manage_Blog.php");
