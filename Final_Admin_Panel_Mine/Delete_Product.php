  <?php
require_once 'connection_file.php';


$query = mysqli_query($con,"delete from se_product where product_id=".$_REQUEST['pid']);
if($query)
{
    echo 0;
}
else
{
    echo mysqli_error();
}