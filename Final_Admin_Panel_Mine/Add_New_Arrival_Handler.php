<?php
$id = $_REQUEST['pid'];

include_once './Classes/New_Arrivals.php';
//
//echo "INSERT INTO se_new_arrivals values (null ,$id)";
$sel=new New_Arrival_Class();
$q = $sel->insert_new_arrival($id);
//echo 0;
