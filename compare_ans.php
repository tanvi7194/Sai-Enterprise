<?php

$u_ans = $_REQUEST['ans'];
$original = $_REQUEST['orig'];


if($u_ans == $original)
{
    echo 'yes';
}
else
{
    echo 'no';
}
