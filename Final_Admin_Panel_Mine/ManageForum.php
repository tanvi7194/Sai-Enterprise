<!DOCTYPE html>
<html lang="en">
    <?php
session_start();
if(isset ($_GET['delStatus']))
{
    if($_GET['delStatus'] == "success")
    {
    echo "<script>alert('Successfully deleted the topic!');</script>";
    }
    else
    {
        echo "<script>alert('Error in deleting the topic!');</script>";
    }
}
if(isset ($_GET['delpost']))
{
    if($_GET['delpost'] == "success")
    {
    echo "<script>alert('Successfully deleted the topic!');</script>";
    }
    else
    {
        echo "<script>alert('Error in deleting the topic!');</script>";
    }
}


?>
	<head>
		<meta charset="utf-8">
		<title>Manage Forum | Sai Enterprise</title>
		<meta name="description" content="description">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" re
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!--		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">-->
		<link href="css/style_v2.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
                <?php
                if(isset($_GET['status']))
                {
                    echo "<script>
                        alert('Product is Added Successfully');
                </script>";
                }
                ?>

                <script type="text/javascript">
            function SendMessage(userid,msg)
            {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

//                        document.getElementById("displayItems").innerHTML = xmlhttp.responseText;
                            alert(xmlhttp.responseText);
                    }

                }
                xmlhttp.open("GET", "sendMessage.php?value=" + msg+"&id="+userid, true);
                xmlhttp.send();

            }

            function getMessage(userid)
            {
//                var objDiv = document.getElementById("message");
//                objDiv.scrollTop = objDiv.scrollHeight;
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        document.getElementById("message").innerHTML = xmlhttp.responseText;

                    }

                }
                xmlhttp.open("GET", "getMessage.php?value="+userid, true);
                xmlhttp.send();

            }
        </script>
        <script>
            setInterval(function(){getMessage(<?php echo $_SESSION["admin_id"];?>)},5000);



        </script>
	</head>
<body>
<?php 
                include_once './half_nav_file.php';
?>

        <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Choose Action</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<form id="defaultForm" method="post" action="ManageForumAction.php" class="form-horizontal">
					<fieldset>
						<legend>Choose Action</legend>

						
						<div class="form-group">
						<div class="col-sm-2">
                                                    <select name="action">
                                                    <option value="1">Add Post</option>
                                                    <option value="2">Delete Post</option>
                                                    <option value="3">Delete Topic</option>
                                                </select>
						</div>
                                                

<!--						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary btn-label-left">
							<span><i class="fa fa-clock-o"></i></span>
								Delete Post
							</button>
						</div>-->
                                                    <div class="col-sm-2">
							<button type="submit" class="btn btn-primary btn-label-left">
							<span><i class="fa fa-clock-o"></i></span>
								Submit
							</button>
						</div>
					</div>
                                        </fieldset>

				</form>
                        </div>
			</div>
		</div>
	</div>

</div>
                </div>
        </div>
</div>

    </body>
</html>
<?php 
include_once './scripts_to_add.php';
?>
