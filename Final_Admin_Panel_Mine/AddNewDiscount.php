<html lang="en">
    <?php
    session_start();
     $pid=$_REQUEST['pid'];
$cat=$_REQUEST['category'];
    ?>
	<head>
		<meta charset="utf-8">
		<title>Add Product Discount | Sai Enterprise</title>
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
                <script>
                function updateText(text)
                {
                    var x = document.getElementById("sp").value;
                    //alert("x :"+x);
                    text=(parseInt(text)*x)/100;
                    y=x-text;
                    //alert(y);
                    document.getElementById("slide1").value=y;
                }
                
                </script>
	</head>
    <body>
    <?php 
include './half_nav_file.php';
    ?>
      
<?php
    require_once 'connection_file.php';

$_SESSION['p_id']=$pid;
$query = mysqli_fetch_array(mysqli_query($con,"select * from se_product where product_id=$pid"),MYSQLI_BOTH);
$sp=$query['product_selling_price'];

?>
                    
                    <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Update Discount</span>
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
				<h4 class="page-header">Update Discount</h4>
                                <form class="form-horizontal" role="form" method="post" action="AddDiscountData.php" name='profile_form'>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Product ID</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='pid' value=".$query['product_id']." readonly>";?>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='product_name' value=".$query['product_name']." readonly>";?>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Initial Selling Price</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' id='sp' class='form-control' name='sp' value=".$query['product_selling_price']." readonly>";?>
						</div>
					</div>
                                    
					<div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Discount %</label>
						<div class="col-sm-4">
                                                    
                                                    <input id="slide" type="Double" class="form-control" name="disc" value="" onchange="updateText(this.value);">
						</div>
					</div>
                                    <div id="result" class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Discounted Selling Price</label>
						<div class="col-sm-4">
                                                    
                                                    <input id="slide1" type="Double" class="form-control" name="disc1" value="" readonly>
						</div>
					</div>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Discount From</label>
						<div class="col-sm-4">
                                                    <input type='Date' class='form-control' name='discfrom'>
						</div>
					</div>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Discount Upto</label>
						<div class="col-sm-4">
                                                    <input type='Date' class='form-control' name='discto'>
						</div>
					</div>
                                     <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-9">
							<button type="submit" class="btn btn-primary btn-label-left">
							<span><i class="fa fa-clock-o"></i></span>
								Submit
							</button>
						</div>
                                     </div>
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