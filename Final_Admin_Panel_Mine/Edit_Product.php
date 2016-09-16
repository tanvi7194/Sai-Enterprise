<?php
session_start();
//echo $_REQUEST['pid']."<br><Br>".$_REQUEST['category'];
require_once 'connection_file.php';
$form_data = mysqli_fetch_array(mysqli_query($con,"select * from se_product_category where category_type='".$_REQUEST['category']."'"),MYSQLI_BOTH);
//echo $form_data['category_id'];
$productAttributes = $form_data['Category_info'];
$cid = $form_data['category_id'];
file_put_contents("Category_form.xml", $productAttributes);
$form_contents = simplexml_load_file('Category_form.xml');
//$form_contents = new SimpleXMLElement($productAttributes);

$product_data = mysqli_fetch_array(mysqli_query($con,"select * from se_product where product_id=".$_REQUEST['pid']),MYSQLI_BOTH);
$image = $product_data['product_image_path_1'];
$img2 = $product_data['product_image_path_2'];

$products = $product_data['product_attribute'];
file_put_contents("product_details.xml", $products);
$product_content = simplexml_load_file('product_details.xml');
//$product_content = new SimpleXMLElement($products);
?>
<html lang="en">
    

	<head>
		
		<meta charset="utf-8">
		<title>Edit Product | Sai Enterprise</title>
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
	</head>
        <script type="text/javascript">
        function PreviewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimg").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("img1").src = oFREvent.target.result;
                };
            }
            ;
            function PreviewImage1() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimg1").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("img2").src = oFREvent.target.result;
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
<!--			<div class="preloader">
                            
				<img src="img/devoops_getdata.gif" class="devoops-getdata" alt="preloader"/>
			</div>
                    <div id="ajax-content">-->
                        <div class="row">

<div class="col-xs-12 col-sm-12">
		<div class="box">
<div class="box-content">
				<h4 class="page-header"><?php echo "Edit  ".$product_data['product_name'] ?></h4>
                                <form method="post" action="Update_New_Product_Handler.php" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Product Name</label>
						<div class="col-sm-4">
							<input type="text" id="bname" name="product_name" class="form-control" value='<?php echo $product_data['product_name'] ?>' data-toggle="tooltip" data-placement="bottom">
						</div>
					</div>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Selling Price</label>
						<div class="col-sm-4">
                                                    <input type="text" id="sp" name="product_sp" class="form-control" value='<?php echo $product_data['product_selling_price'] ?>'>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">MRP</label>
						<div class="col-sm-4">
                                                    <input type="text" id="mrp" name="product_mrp" class="form-control" value='<?php echo $product_data['product_mrp'] ?>'>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Stock Quantity</label>
						<div class="col-sm-4">
							<input type="text" id="quant" name="product_quantity" class="form-control" value='<?php echo $product_data['stock_quantity'] ?>'>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Product Description</label>
						<div class="col-sm-4">
							<input type="text" id="desc" name="product_desc" class="form-control" value='<?php echo $product_data['product_description'] ?>'>
						</div>
                                    </div>
                                    
                                    
                                    <input type="hidden" value='<?php echo $_REQUEST['pid']; ?>' name='p_id'>
                                    <input type="hidden" value='<?php echo $cid; ?>' name='category_id'>
                                    
                                      <?php
                                    
                                    
                                    for($i=0;$i<count($form_contents->FIELDNAME);$i++)
                                    {
                                            if($form_contents->FIELDNAME[$i]->DataType=='Text_Value_Tool')
                                            {
                                                //echo "<br><br> Name ".'txt'.$i;
                                                $name= $form_contents->FIELDNAME[$i];
                                               echo "<div class='form-group has-success has-feedback'>
                                                <label class='col-sm-2 control-label'>$name</label>
                                                <div class='col-sm-4'>";
                                               ?>
                                                        <input type='text' name='<?php echo 'nm'.$i;?>' class='form-control' value='<?php echo  $product_content->$name; ?>' data-toggle='tooltip' data-placement=bottom>
                                               <?php echo " </div>
                                                </div>";
                                            }
                                            else if($form_contents->FIELDNAME[$i]->DataType=='Single_Selection_Tool')
                                            {
                                                $name= $form_contents->FIELDNAME[$i];
                                                echo "<div class='form-group has-success has-feedback'>
                                                    <label class='col-sm-2 control-label'>$name</label>
                                                    <div class='col-sm-4'>";
                                                    $cou = count($form_contents->FIELDNAME[$i]->DataType[0]->Value);
                                                       
                                                        for($j=0;$j<$cou;$j++)
                                                        {
                                                            $nm = $form_contents->FIELDNAME[$i];
                                                            //echo '<br>Name '.$nm;
                                                            
                                                            //echo $form_contents->FIELDNAME[$i]->DataType[0]->Value[$j]."<br>";
                                                            //echo "NM is".$product_content->$nm;
                                                            
                                    
                                                            //echo $product_content->$nm." == ".$form_contents->FIELDNAME[$i]->DataType[0]->Value[$j]."<br><br>";
                                                            $a = $product_content->$nm;
                                                            $a1=(String)$a;
                                                            //echo $a1;
                                                            
                                                            $b = $form_contents->FIELDNAME[$i]->DataType[0]->Value[$j];
                                                            $b1=(String)$b;
                                                            if($a1==$b1)
                                                            {
                                                               
                                                                echo "<input type=radio name='".$i."r[]' value=".$form_contents->FIELDNAME[$i]->DataType[0]->Value[$j]." checked=checked>$b1<br>";
                                                            }
                                                            else
                                                            {
                                                                echo "<input type=radio name='".$i."r[]' value=".$form_contents->FIELDNAME[$i]->DataType[0]->Value[$j].">$b1<br>";      
                                                                
                                                            }
                                                            
                                                        }
                                                        echo "</div>
                                                    </div>";
                                            }
                                            else if($form_contents->FIELDNAME[$i]->DataType=='Multiple_Selection_Tool')
                                            {
                                                $name = $form_contents->FIELDNAME[$i];
                                                echo "<div class='form-group has-success has-feedback'>
                                                    <label class='col-sm-2 control-label'>$name</label>
                                                    <div class='col-sm-4'>";
                                                
                                                
                                                $count = count($form_contents->FIELDNAME[$i]->DataType[0]->Value);
                                                //echo "<br>".$count;
                                               
//                                                
                                                
                                                foreach($form_contents->FIELDNAME[$i]->DataType[0]->Value as $v)
                                                {
                                                    $value = (String)$v;
                                                    $name = $form_contents->FIELDNAME[$i];
                                                    //echo "<br> VALUE is  ".$value;
                                                    for($k=0;$k<$count;$k++)
                                                    {
                                                        //echo "<br> FOR";
                                                        foreach($product_content->$name as $v2)
                                                        {
                                                            $value2 = (String)$v2;
                                                            
                                                            if($value == $value2)
                                                            {
                                                            //echo "<br> ZERO Huya";
                                                                $check = 0;
                                                                break;
                                                            }
                                                            else
                                                            {
                                                                $check=1;
//                                                            
                                                            }
                                                        }
//                                                    
                                                    }
                                                    if($check == 0)
                                                    {
                                                        echo "<br><input type=checkbox  name='".$i."chck[]' checked=checked value=$value>".$value;
                                                    }
                                                    else
                                                    {
                                                        echo "<br><input type=checkbox name='".$i."chck[]' value=$value>".$value;
                                                    }
                                                }
                                                
                                                echo "</div></div>";
                                                
                                            }
                                   }
                                    echo "<div class='form-group has-success has-feedback'>
                                <label class='col-sm-2 control-label'>Image</label>
                                
                                <div class='col-sm-4'>
                                    <input name='img1' type='file' id='getimg' data-toggle='tooltip' title='Select Image!'  onchange='PreviewImage()' />
                                </div>
                                <div class='col-sm-3 col-lg-8 col-md-8 col-xs-3'>
                                    <br/>
                                 <img class='img-responsive' id='img1'  src='$image' height=100 width=150>
                                
                                </div>
                                
                            </div>
                                    
                                      <div class='form-group has-success has-feedback'>
                                 <label class='col-sm-2 control-label'>Second Image</label>
                                <div class='col-sm-3 col-lg-8 col-md-8 col-xs-3'>
                                    <input name='img2' type='file' id='getimg1' data-toggle='tooltip' title='Select 2nd Image!' onchange='PreviewImage1()'/>
                                </div>
                                <div class='col-sm-3 col-lg-8 col-md-8 col-xs-3' id='image'>
                                <br/>
                                    <img class='img-responsive' id='img2' src=$img2 height=100 width=150>
                                </div>
                                    </div>
                                    <div class='form-group'>
						<div class='col-sm-offset-2 col-sm-2'>
							<button type='cancel' class='btn btn-default btn-label-left'>
							<span><i class='fa fa-clock-o txt-danger'></i></span>
								Reset
							</button>
						</div>
						
						<div class='col-sm-2'>
							<button type='submit' class='btn btn-primary btn-label-left'>
							<span><i class='fa fa-clock-o'></i></span>
								Submit
							</button>
						</div>
					</div>
";?> 
                                    
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
