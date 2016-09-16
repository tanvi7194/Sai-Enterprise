<?php
$topic_id = $_POST["topic"];

?>
<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
	<head>
		<meta charset="utf-8">
		<title>Delete Topic | Sai Enterprise</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
                <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="css/style_v2.css" rel="stylesheet">
		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">
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

                <script type="text/javascript">
                    function deletePost(id,topic_id)
                    {
                        window.location.href="http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/DeletePostHandler.php?id="+id+"&topicID="+topic_id;
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
					<span>Manage Post</span>
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
				<h4 class="page-header">Manage Post</h4>

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

$sql=  mysqli_query($con,"SELECT * FROM se_forum_posts where post_topic=".$topic_id);
if(mysqli_num_rows($sql) > 0)
        {
            while ($postarr = mysqli_fetch_array($sql,MYSQLI_BOTH)) {
                $id = $postarr["post_id"];
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
                 echo "<td><button class='btn btn-success' name='deletepost' id='deletepost' onclick='deletePost($id,$topic_id)'>Delete</button></td>";
                    echo "<tr>";

//                 }
            }
        }

        ?>


  </table>

</div>




    </div>


			</div>

        


            <script src="js/bootstrap.min.js"></script>
		</div>
	</div>
<!--                    </div>-->
		</div>
                </div>
        </div>
</div>

    </body>
</html>
<?php 
include_once './scripts_to_add.php';
?>
