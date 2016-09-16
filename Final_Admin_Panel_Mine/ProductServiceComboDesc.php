<?php 
session_start();
?>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Service and product combo Description | Sai Enterprise</title>
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
					<span>Product Service combo Description</span>
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
				<h4 class="page-header">Product Service combo Description</h4>
                                <form class="form-horizontal" role="form" method="post" action="ProductServiceComboDescHandler.php">
                                    
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Combo Amount</label>
						<div class="col-sm-4">
							<?php echo "<input type='number' class='form-control' name='cost'>";?>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Combo Description</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='desc'>";?>
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
                                        
					
                                    
				</form>
                        </div>
			</div>
		</div>
	</div>
<!--                    </div>-->
		</div>
        </div>
</div>

    
        <script>
            $(document).ready(
            function()
    {
        $('#chng_password').hide();
    }        
            
            )
    $('#chck').change(function (){
        if($(this).prop('checked'))
        {
            $('#chng_password').show();
        }
        else
        {
            $('#chng_password').hide();
        }
    })
    
        
        
        </script>
        </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>