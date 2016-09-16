<?php

session_start();
$orig_code = $_SESSION['code'];
$u_entered_code = $_REQUEST['code'];

if($orig_code == $u_entered_code)
{
    //echo 'yes';
    echo 'yes';
}
else
{
    echo 'no';
}