<!DOCTYPE html>
<html lang="en">
    <?php
session_start();
?>
	<head>
		<meta charset="utf-8">
		<title>Add New Product | Sai Enterprise</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet">
<!--		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">-->
<!--		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">-->
<!--		<link href="plugins/select2/select2.css" rel="stylesheet">
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
                 

                <?php
                if(isset($_GET['status']))
                {
                    echo "<script>
                        alert('Product is Added Successfully');
                </script>";
                }
                ?>
                <style>
                    .form-control {
    border-radius:0;
    box-shadow:none;
    height:auto;
}
.float-label{
    font-size:10px;
}
input[type="text"].form-control,
input[type="search"].form-control{
    border:none;
    border-bottom:1px dotted #CFCFCF;
}
textarea {
    border:1px dotted #CFCFCF!important;
    height:130px!important;
}
/*Content Container*/
.content-container {
    background-color:#fff;
    padding:35px 20px;
    margin-bottom:20px;
}
h1.content-title{
    font-size:32px;
    font-weight:300;
    text-align:center;
    margin-top:0;
    margin-bottom:20px;
    font-family: 'Open Sans', sans-serif!important;
}
/*Compose*/
.btn-send{
    text-align:center;
    margin-top:20px;
}
/*mail list*/

ul.mail-list{
    padding:0;
    margin:0;
    list-style:none;
    margin-top:30px;
}
ul.mail-list li a{
    display:block;
    border-bottom:1px dotted #CFCFCF;
    padding:20px;
    text-decoration:none;
}
ul.mail-list li:last-child a{
    border-bottom:none;
}
ul.mail-list li a:hover{
    background-color:#DBF9FF;
}
ul.mail-list li span{
    display:block;
}
ul.mail-list li span.mail-sender{
    font-weight:600;
    color:#8F8F8F;
}
ul.mail-list li span.mail-subject{
    color:#8C8C8C;
}
ul.mail-list li span.mail-message-preview{
    display:block;
    color:#A8A8A8;
}
.mail-search{
    border-bottom-color:#7FBCC9!important;
}
                </style>

	</head>
<body>
<?php 
include './half_nav_file.php';
    ?>

        <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Notifications</span>
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
				<div class="tab-content">
  <div class="tab-pane active" id="inbox">

     
      <div class="content-container clearfix" id="inbox">
               <div class="col-md-12">
                   <h1 class="content-title">Inbox<a class="pull-right fa fa-refresh" onclick="window.location.reload();"></a></h1>
                   <ul class="mail-list">
                   <?php
                    require_once './connection_file.php';

                    $query = mysqli_query($con,"select * from se_orders where order_status='Cancelled'");
                    while($row = mysqli_fetch_array($query,MYSQLI_BOTH))
                    {
                        $uid = $row["u_id"];
                        $query2 = mysqli_query($con,"select * from se_user where u_id=".$uid);
                        while($row2 = mysqli_fetch_array($query2,MYSQLI_BOTH))
                        {
                            $username = $row2["u_fname"];
                        }
                    
                   ?>
                      

                   
                       <li>
                           <a>
                               <span class="mail-sender"><?php echo $username; ?></span>
                               <span class="mail-subject">Order Cancellation!</span>
                               <span class="mail-message-preview">This user has cancelled the order no: <?php echo $row["order_id"]; ?></span>
                           </a>
                       </li>
                       <?php
                        
                    }
                    $query = mysqli_query($con,"select * from se_service_user where service_status='Sent'");
                    while($row = mysqli_fetch_array($query,MYSQLI_BOTH))
                    {
                        $uid = $row["u_id"];
                        $sid = $row["service_id"];
                        $query2 = mysqli_query($con,"select * from se_user where u_id=".$uid);
                        while($row2 = mysqli_fetch_array($query2,MYSQLI_BOTH))
                        {
                            $username = $row2["u_fname"];
                        }
                        $query3 = mysqli_query($con, "select * from se_service where service_id=".$sid);
                        while($row3=  mysqli_fetch_array($query3,MYSQLI_BOTH))
                        {
                            $servicename = $row3["service_name"];
                        }

                   ?>



                       <li>
                           <a>
                               <span class="mail-sender"><?php echo $username; ?></span>
                               <span class="mail-subject">Service Request!</span>
                               <span class="mail-message-preview">This user has request for the service name: <?php echo $servicename; ?></span>
                           </a>
                       </li>
                       <?php

                    }
                    $query = mysqli_query($con,"select * from se_service_user where service_status='cancelled'");
                    while($row = mysqli_fetch_array($query,MYSQLI_BOTH))
                    {
                        $uid = $row["u_id"];
                        $sid = $row["service_id"];
                        $query2 = mysqli_query($con,"select * from se_user where u_id=".$uid);
                        while($row2 = mysqli_fetch_array($query2,MYSQLI_BOTH))
                        {
                            $username = $row2["u_fname"];
                        }
                        $query3 = mysqli_query($con,"select * from se_service where service_id=".$sid);
                        while($row3=  mysqli_fetch_array($query3,MYSQLI_BOTH))
                        {
                            $servicename = $row3["service_name"];
                        }

                   ?>



                       <li>
                           <a>
                               <span class="mail-sender"><?php echo $username; ?></span>
                               <span class="mail-subject">Service Request Cancellation!</span>
                               <span class="mail-message-preview">This user has cancelled the request for the service name: <?php echo $servicename; ?></span>
                           </a>
                       </li>
                       <?php

                    }



                       ?>
                   </ul>
               </div>
           </div>
       </div>

  </div>
                               
			</div>
		</div>
	</div>

</div>
             </div>
        </div>
</div>

<?php 
        include_once './scripts_to_add.php';
?>


    </body>
</html>
