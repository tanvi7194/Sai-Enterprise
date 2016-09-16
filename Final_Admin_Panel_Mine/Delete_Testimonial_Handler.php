<?php

$feedback_id = $_REQUEST['fid'];

include_once './Classes/feedback.php';
//

$sel=new Feedback_Class();
$q = $sel->delete_feedback($feedback_id);
