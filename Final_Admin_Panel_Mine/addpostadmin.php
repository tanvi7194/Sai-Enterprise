<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
	<head>
		<meta charset="utf-8">
		<title>Add Post Admin | Sai Enterprise</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" re
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet">
<!--		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">-->
		<link href="css/style_v2.css" rel="stylesheet">
<!--		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
                <script type="text/javascript">

                    function InsertPost(id,post)
                    {
                        window.location.href="http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/InsertTopicAdminHandler.php?id="+id+"&post="+post;
                    }

                </script>
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
					<span>Add Post Admin</span>
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
				<h4 class="page-header">Add Post Admin</h4>
        
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Forums</div>



  <!-- Table -->
  <table class="table">
      <thead>
      <tr>
          <th>Sr No</th>
          <th>Post Content</th>
          <th>Posted By </th>
          <th>Post Date</th>
         

      </tr>
      </thead>

  <?php
  if(isset ($_GET["id"]))
  {
      $id = $_GET["id"];
  }
require_once 'connection_file.php';
$i=1;
$sql=  mysqli_query($con,"SELECT * FROM se_forum_posts where post_topic=".$id);
if(mysqli_num_rows($sql) > 0)
        {
            while ($postarr = mysqli_fetch_array($sql,MYSQLI_BOTH)) {
                $content=$postarr['post_content'];
                $pdate=$postarr['post_date'];
                $pby=$postarr['post_by'];
                echo "<tr>";
                     echo "<td>$i</td>";
                    echo "<td>".$content."</td>";
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
                 echo "<td>".$pdate."</td>";
                    echo "<tr>";

//                 }
            }
        }

        ?>


  </table>

</div>

        
        
        
    </div>
                    
                    
			</div>

        <h3>Reply to this Topic:</h3>
        <div class="form-group  col-lg-12">
                                <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                    <label class="control-label"id="label">Post:</label>
                                </div>
                                <div class="col-sm-4 col-lg-4 col-md-4 col-xs-8">
<!--                                    <input name="subject" id="mrp" type="text" class="form-control" placeholder=" " data-toggle="tooltip" required title="Enter MRP!">-->
                                    <textarea name="post" class="form-control" rows="10" cols="8" id="post"></textarea>
                                </div>
            </div>
            <div class="form-group  col-lg-12">

                                <div class=" col-lg-offset-2 col-sm-4 col-lg-4 col-md-4 col-xs-8">
                                    <input name="buttom" id="submit" type="submit" value="submit" onclick="InsertPost(<?php echo $id;?>,post.value)" class="btn btn-success" placeholder=" " data-toggle="tooltip" required">
                                    <input name="reset" id="reset" type="reset" value="reset" class="btn btn-danger" placeholder=" " data-toggle="tooltip" required title="Enter MRP!">
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