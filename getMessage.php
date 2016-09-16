

<?php
session_start();
$userid = $_REQUEST["value"];
$mainuid = $_SESSION["u_id"];
require_once 'connection_file_user.php';

$qu = mysqli_query($con,"select * from se_online_chat_users where userid=1001") or mysqli_error();
while($rows = mysqli_fetch_array($qu,MYSQLI_BOTH))
{
    $stat = $rows['status'];
}

$quer = mysqli_query($con,"select count(*) from se_online_chat_users");
while($r = mysqli_fetch_array($quer,MYSQLI_BOTH))
{
    $c = $r[0];
    
}

if($stat == "online" && $c==1)
{

    $que = mysqli_query($con,"select count(*) from se_online_chat where u_id=$mainuid");
    $arr = mysqli_fetch_array($que,MYSQLI_BOTH);
    $count = $arr[0];
    if($count == 0)
    {
        echo "Start a conversation by clicking here! <a onclick='enterChat()'>Click Me.</a>";
        echo "<div id='main'></div>";
    }
    else if($count > 0)
    {
$query = mysqli_query($con,"select * from se_online_chat");
//$query1 = mysqli_query("select * from user_details where UserID='$userid'");
while($row= mysqli_fetch_array($query,MYSQLI_BOTH))
{
    $uid = $row["u_id"];

    $query1 = mysqli_query($con,"select * from se_user where u_id='$uid'");
    while($row1 = mysqli_fetch_array($query1,MYSQLI_BOTH))
    {

?>
<div class="row msg_container base_receive">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive" style="display: block;width: 100%;">

                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <?php echo $row1["u_emailid"].":";?>
                                <p><?php echo $row["ChatMsg"]; ?></p>

                            </div>
                        </div>
                    </div>


<?php
}
}
}
}//main if close


else if($stat == "online" && $c == 2)
{
    $queries = mysqli_query($con,"select count(*) from se_online_chat_users where userid=$mainuid");
    $re = mysqli_fetch_array($queries,MYSQLI_BOTH);
    $avail = $re[0];
    if($avail > 0)
    {
        echo "Connected with the admin. Start the chat!";
        $query = mysqli_query($con,"select * from se_online_chat");
//$query1 = mysqli_query("select * from user_details where UserID='$userid'");
while($row= mysqli_fetch_array($query,MYSQLI_BOTH))
{
    $uid = $row["u_id"];
    if($uid == 1001)
    {
       $yes = mysqli_query($con,"select * from se_administration");
       while(mysqli_fetch_array($yes,MYSQLI_BOTH))
       {?>
       <div class="row msg_container base_receive">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive" style="display: block;width: 100%;">

                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <?php echo "Admin:";?>
                                <p><?php echo $row["ChatMsg"]; ?></p>

                            </div>
                        </div>
                    </div>


       <?php

       }
    }
    else
    {
    $query1 = mysqli_query($con,"select * from se_user where u_id='$uid'");
    while($row1 = mysqli_fetch_array($query1,MYSQLI_BOTH))
    {

?>
<div class="row msg_container base_receive">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive" style="display: block;width: 100%;">

                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <?php echo $row1["u_emailid"].":";?>
                                <p><?php echo $row["ChatMsg"]; ?></p>

                            </div>
                        </div>
                    </div>


<?php
}
}
}
    }
    else
    {
    echo "Admin is currently offline<br><a href='leavemsgchat.php'>Leave a message.</a>";
    }


}

else if($stat == "offline")
{
    echo "Admin is currently offline<br><a href='leavemsgchat.php'>Leave a message.</a>";
    ?>
<!--<div class="form-group">
  <label for="m">Message:</label>
  <textarea class="form-control" rows="5" id="comment"></textarea>
</div>-->

<?php
}
?>


