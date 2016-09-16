<!DOCTYPE html>
<html lang="en">
    <?php
session_start();
?>
	<head>
		<meta charset="utf-8">
		<title>Bulk Upload | Sai Enterprise</title>
		<meta name="description" content="description">
                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
                <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
                <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
                <link href="css/style_v2.css" type="text/css" rel="stylesheet">
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
					<span>Bulk Upload</span>
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
	
				<?php
                                
$catid = $_POST["cat"];
$_SESSION['c_id'] = $catid;
$num = $_POST['numofprod'];
$_SESSION["num"] = $num;
require_once 'connection_file.php';

$category_info = mysqli_fetch_array(mysqli_query($con,"select * from se_product_category where category_id=".$catid),MYSQLI_BOTH);
$d = $category_info['Category_info'];
file_put_contents("A.xml", $d);
$data = simplexml_load_file("A.xml");

?>

                    <input type="hidden" value='<?php echo $catid; ?>' name='c_id'>
<div class="col-xs-12 col-sm-12">
    <div class="box">
        <div class="box-content">
            <form action="InsertBulkUpload.php" method="post" enctype="multipart/form-data">
            

<?php
$c=0;
$plus = 0;
for($i=0;$i<$num;$i++)
{
    $c = $i+1;
    echo "<div class='panel panel-default'>
            <div class='panel-heading'>
                <h3 class='panel-title'>Product - $c </h3>
                </div>
                <div class='panel-body'>
";
    
    echo "<div class='form-group has-success has-feedback'>
						<label class='col-sm-2 control-label'>Product Name-$c</label>
						<div class='col-sm-4'>
							<input type='text' name='product_name_$i' class='form-control' placeholder='Name of Product' data-toggle='tooltip' data-placement='bottom'>
						</div>
                                                </div>
                                                
					<div class='form-group has-success has-feedback'>
						<label class='col-sm-2 control-label'>Product MRP-$c</label>
						<div class='col-sm-4'>
							<input type='number' name='product_mrp_$i' class='form-control' placeholder='MRPof Product' data-toggle='tooltip' data-placement='bottom'>
						</div>
					</div>"
            . "<div class='form-group has-success has-feedback'>
						<label class='col-sm-2 control-label'>Product SP-$c</label>
						<div class='col-sm-4'>
							<input type='number' name='product_sp_$i' class='form-control' placeholder='Product Selling Price' data-toggle='tooltip' data-placement='bottom'>
						</div>
					</div>"
            . "<div class='form-group has-success has-feedback'>
						<label class='col-sm-2 control-label'>Product Stock-$c</label>
						<div class='col-sm-4'>
							<input type='text' name='product_stock_$i' class='form-control' placeholder='Product Stock' data-toggle='tooltip' data-placement='bottom'>
						</div>
					</div>"
            . "<div class='form-group has-success has-feedback'>
						<label class='col-sm-2 control-label'>Product Desc-$c</label>
						<div class='col-sm-4'>
							<input type='text' name='product_desc_$i' class='form-control' placeholder='Product Desc' data-toggle='tooltip' data-placement='bottom'>
						</div>
					</div>";
    
       echo "<div class='form-group has-success has-feedback'>
						<label class='col-sm-2 control-label'>Product Image(1)-$c</label>
						<div class='col-sm-4'>
							<input type='file' name='product_image(1)_$i' class='form-control' data-toggle='tooltip' data-placement='bottom'>
						</div>
					</div>";
    echo "<div class='form-group has-success has-feedback'>
						<label class='col-sm-2 control-label'>Product Image(2)-$c</label>
						<div class='col-sm-4'>
							<input type='file' name='product_image(2)_$i' class='form-control' data-toggle='tooltip' data-placement='bottom'>
						</div>
					</div>";
    $countfield=  count($data->FIELDNAME);
    
    //echo "<br> Count is ".$countfield."<BR>";
                                    for($j=0;$j<$countfield;$j++)
                                    {
                                        //echo "<br> J is ".$j."<br><BR>";
                                        $fieldnm=$data->FIELDNAME[$j];
                                    //echo "<br> Firldname is ".$fieldnm."<BR>";
                                    ?>
                                    <?php if($data->FIELDNAME[$j]->DataType=='Text_Value_Tool')
                                    {
                                       
                                             
                                                echo "<div class='form-group has-success has-feedback'>
                                                                            <label class='col-sm-2 control-label'>".$data->FIELDNAME[$j].'-'.$c."</label>
                                                                            <div class='col-sm-4'>
                                                                                    <input type='text' name=".$data->FIELDNAME[$j].'_'.$i." class='form-control' placeholder=".$data->FIELDNAME[$j].'_'.$c." data-toggle='tooltip' data-placement='bottom'>
                                                                            </div>
                                                                    </div>";
                                                                                  
                                            
                                    }
                                   
                                    else if($data->FIELDNAME[$j]->DataType=='Single_Selection_Tool')
                                    {
                                        
                                        
                                               echo "<div class='form-group has-success has-feedback'>
                                                                            <label class='col-sm-2 control-label'>".$data->FIELDNAME[$j].'-'.$c."</label>
                                                                            <div class='col-sm-4'>";
                                                $cou = count($data->FIELDNAME[$j]->DataType[0]->Value);
                                                $r=0;
                                                        for($k=1;$k<=$cou;$k++)
                                                        {
                                                            echo "<input type=radio name='".$i."r[]' value=".$data->FIELDNAME[$j]->DataType[0]->Value[$r].">".$data->FIELDNAME[$j]->DataType[0]->Value[$r]."<br>";
                                                        
                                                            $r++;                                                            
                                                        }
                                                        echo "<br>";
                                                        
                                         echo "</div>
                                            </div>"; 
                                    }   
                                    
                                    else if($data->FIELDNAME[$j]->DataType=='Multiple_Selection_Tool')
                                    {
                                       
                                             
                                                 echo "<div class='form-group has-success has-feedback'>
                                                                            <label class='col-sm-2 control-label'>".$data->FIELDNAME[$j].'-'.$c."</label>
                                                                            <div class='col-sm-4'>";
                                                $cou = count($data->FIELDNAME[$j]->DataType[0]->Value);
                                                        for($k=0;$k<$cou;$k++)
                                                        {
                                                            echo "<input type=checkbox name='c".$plus."[]' value=".$data->FIELDNAME[$j]->DataType[0]->Value[$k].">".$data->FIELDNAME[$j]->DataType[0]->Value[$k]."<br>";
                                                        }
                                                        echo "<br>";
                                                        echo "</div>
                                            </div>"; 
                                                        $plus+=1;
                                                        //echo "<br> Plus is ".$plus;
                                        
                                                
                                            
                                            
                                    }
                    }
    echo "</div></div>";
    
}
?>
           





			
		
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