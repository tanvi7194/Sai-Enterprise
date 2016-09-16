<?php


$s_id = $_REQUEST['id'];
require_once 'connection_file_user.php';
$i=0;
$get_city_id = mysqli_query($con,"select city_id from se_state_city where state_id=$s_id");
$names =  "<label style=color:white;>City</label><br><select name=b_city id=city>";
while($c_id = mysqli_fetch_array($get_city_id,MYSQLI_BOTH))
{
    $i++;
    $q = "select city_name from se_city where city_id=".$c_id['city_id'];
    $get_city_name = mysqli_fetch_array(mysqli_query($con,$q),MYSQLI_BOTH);
    $names.="<option value=".$i.">".$get_city_name['city_name']."</option>";
    

}
$names.="</select>";
echo $names;
