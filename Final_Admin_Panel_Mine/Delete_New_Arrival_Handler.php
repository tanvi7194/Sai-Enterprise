<?php

$id = $_REQUEST['pid'];

include_once './Classes/New_Arrivals.php';
//

$sel=new New_Arrival_Class();
$q = $sel->delete_new_arrival($id);
