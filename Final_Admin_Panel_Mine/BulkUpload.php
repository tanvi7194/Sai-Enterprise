<!DOCTYPE html>
<html lang="en">
    <?php
session_start();
?>
	<head>
		<meta charset="utf-8">
		<title>Dashboard | Sai Enterprise</title>
		<meta name="description" content="description">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
//                    echo "<script>
//                        alert('Product is Added Successfully');
//                </script>";
                }
                ?>

	</head>
        
        
                <link rel="stylesheet" href="css/sweet-alert.css">

<script src="js/jquery.js"></script>
<script src="js/sweet-alert.min.js"></script>
        <?php
        if(isset($_GET['stock_updated']))
{
    if($_GET['status']=='yes')
    {
    echo "   <script> $(document).ready(
            function()
    {
        swal({   title: 'Success!', 
                text:".$_GET['stock_updated']." ,
                type: 'success', 
                confirmButtonText: 'Okay'
            });
    });        
</script>
";   
    }
    else
    {
    echo "   <script> $(document).ready(
            function()
    {
        swal({   title: 'error!', 
                text:".$_GET['stock_updated']." ,
                type: 'error', 
                confirmButtonText: 'Okay'
            });
    });        
</script>
";   
    }    
}
        
        
        ?>
        
        
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
					<span>Add New Product</span>
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
				<form id="defaultForm" method="post" action="bulkuploadhandler.php" class="form-horizontal">
					<fieldset>
						<legend>Add New Product</legend>

						<div class="form-group">
							<label class="col-sm-3 control-label">Select Product to Add</label>
							<div class="col-sm-2">
								<select class="populate placeholder" name="cat" id="cat">
                                                                    <?php
                                                                    include './Classes/Insert_Product.php';
                                                                    $sel=new Insert_Product_Class();
                                                                    $select_query1=$sel->get_categories();
                                                                    while($data = mysqli_fetch_array($select_query1,MYSQLI_BOTH))
                                                                    {
                                                                        echo "<option value=".$data['category_id'].">".$data['category_type']."</option>";
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
                                                            <label class="col-sm-3 control-label">Number of products</label>
                                                        <div class="col-sm-2">
                                                            <select name="numofprod">
                                                                <option value='2'>2
                                                                <option value="3">3
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
    include './scripts_to_add.php';
        ?>
