<?php

$userid = $_REQUEST["value"];

require_once 'connection_file.php';




$query = mysqli_query($con,"select * from se_online_chat") or die (mysqli_error());
//$query1 = mysqli_query("select * from user_details where UserID='$userid'");


//if($userid == 1001)
//{
//
//}

while($row= mysqli_fetch_array($query,MYSQLI_BOTH))
{
    $uid = $row["u_id"];
    if($uid == 1001)
    {
        $query1 = mysqli_query($con,"select * from se_administration where admin_id='$uid'") or die (mysqli_error());
        while($row1 = mysqli_fetch_array($query1,MYSQLI_BOTH))
        {

?>
<div class="row msg_container base_receive">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive" height="100" width="100" style="display: block;width: 100%;">
                            
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <?php echo "Admin".":";?>
                                <p><?php echo $row["ChatMsg"]; ?></p>
                                
                            </div>
                        </div>
                    </div>


<?php
}
    }
    else
    {
        $query2 = mysqli_query($con,"select * from se_user where u_id='$uid'") or die (mysqli_error());
        while($row3 = mysqli_fetch_array($query2,MYSQLI_BOTH))
        {?>
        <div class="row msg_container base_receive">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive" style="display: block;width: 100%;">

                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <?php echo $row3["u_emailid"].":";?>
                                <p><?php echo $row["ChatMsg"]; ?></p>

                            </div>
                        </div>
                    </div>


        <?php }
}
}
?>
