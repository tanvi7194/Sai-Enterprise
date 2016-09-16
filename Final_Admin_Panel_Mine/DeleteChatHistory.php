<?php

require_once './connection_file.php';

$deletechat = mysqli_query($con, "delete from se_online_chat");
