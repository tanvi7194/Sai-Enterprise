<?php

$action = $_POST["action"];
echo $action;
if($action == "1")
{

?>

<!DOCTYPE html>
<html lang="en">
    <?php
session_start();
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
					<span>Add New Post</span>
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
				<form id="defaultForm" method="post" action="getTopicHandler.php" class="form-horizontal">
					<fieldset>
						<legend>Add New Post</legend>

						<div class="form-group">
							<label class="col-sm-3 control-label">Select Topic in which you want to Add Post</label>
							<div class="col-sm-5">
								<select class="populate placeholder" name="topic" id="topic">
                                                                    <?php
require_once 'connection_file.php';
                                                                    $query = mysqli_query($con,"select * from se_forum_topic");

                                                                    
                                                                    while($data = mysqli_fetch_array($query,MYSQLI_BOTH))
                                                                    {
                                                                        echo "<option value=".$data['forum_topic_id'].">".$data['subject']."</option>";
                                                                    }
                                                                    ?>

<!--									<option value='Graphic Card'>Graphic Card</option>
									<option value='External Harddisk'>External Harddisk</option>
									<option value='Internal Harddisk'>Internal Harddisk</option>
									<option value='Laptop'>Laptop</option>
									<option value='Mother Board'>Mother Board</option>
									<option value='Processor'>Processor</option>
                                                                        <option value='Router'>Router</option>-->
								</select>
							</div>

						</div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-2">
							<button type="cancel" class="btn btn-default btn-label-left">
							<span><i class="fa fa-clock-o txt-danger"></i></span>
								Reset
							</button>
						</div>

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

    </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>




<?php
}
 elseif ($action == "2")
 {
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sai Enterprise | Manage Forum</title>
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
					<span>Delete Post</span>
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
				<form id="defaultForm" method="post" action="DeleteTopicHandler.php" class="form-horizontal">
					<fieldset>
						<legend>Choose a Topic</legend>

						<div class="form-group">
							<label class="col-sm-3 control-label">Select Topic</label>
							<div class="col-sm-5">
								<select class="populate placeholder" name="topic" id="topic">
                                                                    <?php
require_once 'connection_file.php';
                                                                    $query = mysqli_query($con,"select * from se_forum_topic");


                                                                    while($data = mysqli_fetch_array($query,MYSQLI_BOTH))
                                                                    {
                                                                        echo "<option value=".$data['forum_topic_id'].">".$data['subject']."</option>";
                                                                    }
                                                                    ?>

<!--									<option value='Graphic Card'>Graphic Card</option>
									<option value='External Harddisk'>External Harddisk</option>
									<option value='Internal Harddisk'>Internal Harddisk</option>
									<option value='Laptop'>Laptop</option>
									<option value='Mother Board'>Mother Board</option>
									<option value='Processor'>Processor</option>
                                                                        <option value='Router'>Router</option>-->
								</select>
							</div>

						</div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-2">
							<button type="cancel" class="btn btn-default btn-label-left">
							<span><i class="fa fa-clock-o txt-danger"></i></span>
								Reset
							</button>
						</div>

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

    </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>

<?php
 }
 else if($action == 3)
 {
     
?>
<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
	<head>
		<meta charset="utf-8">
		<title>Sai Enterprise | Manage Forum</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" re
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet">
<!--		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">-->
		<link href="css/style_v2.css" rel="stylesheet">
<!--		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">-->
                <script type="text/javascript">
                function deleteTopic(id)
                {
                    window.location.href="http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/DeleteTopic.php?id="+id;
                }



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
					<span>Delete Topic</span>
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
				<h4 class="page-header">Delete Topic</h4>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Forums</div>



  <!-- Table -->
  <table class="table">
      <thead>
      <tr>
          <th>Sr No</th>
          <th>Subject</th>
          <th>Topic Category</th>
          <th>Topic By </th>
          
          <th></th>

      </tr>
      </thead>

  <?php
  if(isset ($_GET["id"]))
  {
      $id = $_GET["id"];
  }
  require_once 'connection_file.php';
$i=1;

$sql=  mysqli_query($con,"SELECT * FROM se_forum_topic");
if(mysqli_num_rows($sql) > 0)
        {
            while ($postarr = mysqli_fetch_array($sql)) {
                $id = $postarr["forum_topic_id"];
                $content=$postarr['subject'];
                $pcatid=$postarr['topic_cat'];
                $pby=$postarr['topic_by'];
                echo "<tr>";
                     echo "<td>$i</td>";
                     echo "<td>".$content."</td>";
                     $query5 = mysqli_query($con,"select * from se_forum_category where forum_cat_id=".$pcatid);
                     while($row8 = mysqli_fetch_array($query5,MYSQLI_BOTH))
                     {
                        echo "<td>".$row8["forum_cat_name"]."</td>";
                     }
                   
                if($pby == 1001)
                {

                    echo "<td>Admin</td>";

                }
                else
                {
                    $query4 = mysqli_query($con,"select * from se_user where u_id=".$pby);
                    while($row4=mysqli_fetch_array($query4,MYSQLI_BOTH))
                    {
                        $uname = $row4["u_fname"];
                    }

                    echo "<td>".$uname."</td>";

                }
                 
                 echo "<td><button class='btn btn-success' name='delete' id='delete' onclick='deleteTopic($id)'>Delete</button></td>";
                    echo "<tr>";

//                 }
            }
        }

        ?>


  </table>

</div>




    </div>


			</div>




            
		</div>
	</div>
<!--                    </div>-->
		</div>

		<!--End Content-->
	</div>
</div>




    </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>

<?php
 }
?>