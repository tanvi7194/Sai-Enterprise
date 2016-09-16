  <?php
 $server = "localhost";

$username="root";
$password="";
$databse="sai_enterprise";

$con = mysql_connect($server,$username,$password);
if(!$con)
{
    die("Please check your connection");
}


mysql_select_db($databse);

//$pid=$_REQUEST['pid'];
$query = mysql_query("delete from se_discount where discount_id=".$_REQUEST['pid']);
if($query)
{
    echo 0;
}
else
{
    echo mysql_error();
}