<?php
session_start();
$prod_cat=$_POST['product'];
$_SESSION['category_id'] = $prod_cat;
require_once 'connection_file.php';

$st = "select * from se_product_category where category_id=$prod_cat";
$q = mysqli_fetch_array(mysqli_query($con,$st),MYSQLI_BOTH);

$productAttributes = $q['Category_info'];
file_put_contents("productAttribute.xml", $productAttributes);
$contents = simplexml_load_file('productAttribute.xml');    
$_SESSION['category'] = $q['category_type'];
//file_put_contents("Categorykanaamjohogawoh.xml", $productAttributes);
//$contents = simplexml_load_file("Dynamic Category-2.xml");    

$countfield=  count($contents->FIELDNAME);

?>


<!DOCTYPE html>

<html lang="en">
    

	<head>
		
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="css/style_v2.css" rel="stylesheet">
		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">
		<meta charset="utf-8">
		<title>Product Form | Sai Enterprise</title>
		
		
                <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">
		
                
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
        <script type="text/javascript">
        function PreviewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image1").src = oFREvent.target.result;
                };
            }
            ;
            function PreviewImage1() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage1").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image2").src = oFREvent.target.result;
                };
            }
            ;
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
					<span><?php echo "Add ".$_SESSION['category'] ?></span>
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
				<h4 class="page-header"><?php echo "Add ".$_SESSION['category'] ?></h4>
                                <form method="post" action="AAAAddNewProductHandler.php" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Product Name</label>
						<div class="col-sm-4">
							<input type="text" id="bname" name="product_name" class="form-control" placeholder='<?php echo "Name of  ".$_SESSION['category'] ?>' data-toggle="tooltip" data-placement="bottom">
						</div>
					</div>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Selling Price</label>
						<div class="col-sm-4">
                                                    <input type="text" id="sp" name="product_sp" class="form-control" placeholder="Selling Price">
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">MRP</label>
						<div class="col-sm-4">
                                                    <input type="text" id="mrp" name="product_mrp" class="form-control" placeholder="MRP">
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Stock Quantity</label>
						<div class="col-sm-4">
							<input type="text" id="quant" name="product_quantity" class="form-control" placeholder="Stock Quantity">
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Product Description</label>
						<div class="col-sm-4">
							<input type="text" id="desc" name="product_desc" class="form-control" placeholder="Product Description">
						</div>
                                    </div>
                                    
                                    
                                    <?php
                                     for($i=0;$i<$countfield;$i++)
                                    {
                                        $fieldnm=$contents->FIELDNAME[$i];
                                    
                                    ?>
                                   <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label"><?php echo $fieldnm;?></label>
						<div class="col-sm-4">
                                                    <?php if($contents->FIELDNAME[$i]->DataType=='Text_Value_Tool')
                                                    {?>
                                                       <input type="text" id='<?php echo $fieldnm;?>' name='<?php echo 'nam'.$i;?>' class="form-control" placeholder='<?php echo $fieldnm;?>'> 
                                                   <?php }
                                                   else if($contents->FIELDNAME[$i]->DataType=='Single_Selection_Tool')
                                                   {
                                                       $cou = count($contents->FIELDNAME[$i]->DataType[0]->Value);
                                                        for($j=0;$j<$cou;$j++)
                                                        {
                                                            echo "<input type=radio name='".$i."r[]' value=".$contents->FIELDNAME[$i]->DataType[0]->Value[$j].">".$contents->FIELDNAME[$i]->DataType[0]->Value[$j]."<br>";
                                                        }
                                                       
                                                   }
                                                   else if($contents->FIELDNAME[$i]->DataType=='Multiple_Selection_Tool')
                                                   {
                                                       $cou = count($contents->FIELDNAME[$i]->DataType[0]->Value);
                                                        for($j=0;$j<$cou;$j++)
                                                        {
                                                            echo "<input type=checkbox  name='".$i."chck[]' value=".$contents->FIELDNAME[$i]->DataType[0]->Value[$j].">".$contents->FIELDNAME[$i]->DataType[0]->Value[$j]."<br>";
                                                        }
                                                       
                                                   }
?>
							
						</div>
					</div>
                                    <?php } ?>
                                   
                                   
                                    
                                    
                            <div class="form-group has-success has-feedback">
                                <label class="col-sm-2 control-label">Image</label>
                                
                                <div class="col-sm-4">
                                    <input name="img1" type="file" id="getimage" data-toggle="tooltip" title="Select Image!"  onchange="PreviewImage()" />
                                </div>
                                <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3">
                                    <br/>
                                 <img class="img-responsive" id='image1'  height="200" width="200" src=''>
                                
                                </div>
                                
                            </div>
                                    
                                      <div class="form-group has-success has-feedback">
                                 <label class="col-sm-2 control-label">Second Image</label>
                                <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3">
                                    <input name="img2" type="file" id="getimage1" data-toggle="tooltip" title="Select 2nd Image!" onchange="PreviewImage1()"/>
                                </div>
                                <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3" id="image">
                                <br/>
                                    <img class="img-responsive" id="image2" height="200" width="200" src=''>
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

    </body>
</html>
<?php 
        include_once './scripts_to_add.php';?>
        <script>

$(document).ready(function() {
    var $submit = $("input[type=submit], button[type=submit]"),
        $inputs = $('input[type=file]');
       
    function checkEmpty() {

        // filter over the empty inputs

        return $inputs.filter(function() {
            return !$.trim(this.value);
        }).length === 0;
    }

    $inputs.on('change', function() {
        $submit.prop("disabled", !checkEmpty());
    }).change(); 
});


        </script>
