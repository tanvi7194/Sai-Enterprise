<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sai Enterprise | Add New Product</title>
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
        

        <style>

            @media screen and (max-width: 320px){
                #altimg{
                    font-size:x-small;
                }
            }
        </style>
        <script src="../js/jquery.js"></script>
        <script type="text/javascript">
            
            function goBack() {
                location.replace("index.php");
            }
            
            
            function PreviewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image1").src = oFREvent.target.result;
                };
            }
            
            function PreviewImage2() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage2").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image2").src = oFREvent.target.result;
                };
            }
            function PreviewImage3() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage3").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image3").src = oFREvent.target.result;
                };
            }
            function PreviewImage4() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage4").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image4").src = oFREvent.target.result;
                };
            }
            function PreviewImage5() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage5").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image5").src = oFREvent.target.result;
                };
            }
            
        </script>
        
    </head>
    
    
    <link rel="stylesheet" href="css/sweet-alert.css">


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/sweet-alert.min.js"></script>
        <?php
        if(isset($_GET['Img_data']))
{
    if($_GET['status']=='yes')
    {
    echo "   <script> $(document).ready(
            function()
    {
        swal({   title: 'Success!', 
                text:".$_GET['Img_data']." ,
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
                text:".$_GET['Img_data']." ,
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
					<span>Manage Slider</span>
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
				<h4 class="page-header">Manage Slider</h4>
                                <form class="form-horizontal" role="form" action="ManageSliderHandler.php" method="post" enctype="multipart/form-data">

                                        
                                            <?php
                                            require_once 'connection_file.php';
                                            $sql="SELECT * FROM se_home_slider";
                                            $result=  mysqli_query($con,$sql);
                                            $x=1;
                                            while ($row = mysqli_fetch_array($result,MYSQLI_BOTH))
                                            {
                                                
                                                $img=$row['image_path'];
                                                $data=$row['description'];
                                                //$x++;
                                            
                                            
                                            ?>
                                    <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label class="control-label"id="label">Image <?php echo $x; ?></label>
                                            </div>
                                            <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3">
                                                <input name="img1" type="file" id="getimage"  onchange="PreviewImage()" value="<?php echo $img; ?>" />
                                            </div>
                                            <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3">
                                                <br/>
                                                <img class="img-responsive" id='image1'  src="<?php echo $img; ?>">

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image <?php echo $x;?> Description</label>
                                            </div>
                                            <div class="col-sm-5 col-lg-8 col-md-8 col-xs-3">
                                                
                                                <input type="text" class="form-control" value='<?php echo $data; ?>' size="500" id="desc1" name="desc1">
                                                    
                                                
                                                
                                            </div>
                                            

                                        </div>
                                            <?php $x++; } ?>


<!--                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image 2</label>
                                            </div>
                                            <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3">
                                                <input name="img2" type="file" id="getimage2" onchange="PreviewImage2()" value="<?php echo $img[1]; ?>"/>
                                            </div>
                                            <div class="col-sm-8 col-lg-10 col-md-8 col-xs-3" id="image">
                                                <br/>
                                                <img class="img-responsive" id="image2"  src="<?php //echo $img[1]; ?>">
                                            </div>


                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image 2 Description</label>
                                            </div>
                                            <div class="col-sm-5 col-lg-8 col-md-8 col-xs-3">
                                                
                                                <input type="text" size="500" class="form-control" value='<?php //echo $data[1]; ?>'  id="desc2" name="desc2">
                                                   
                                                
                                            </div>
                                            
                                            

                                        </div>-->
                                        
                                        
<!--                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image 2</label>
                                            </div>
                                            <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3">
                                                <input name="img3" type="file" id="getimage3" onchange="PreviewImage3()" value="<?php echo $img[2]; ?>"/>
                                            </div>
                                            <div class="col-sm-8 col-lg-10 col-md-8 col-xs-3" id="image">
                                                <br/>
                                                <img class="img-responsive" id="image3"  src="<?php //echo $img[2]; ?>">
                                            </div>


                                        </div>-->
<!--                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image 2 Description</label>
                                            </div>
                                            <div class="col-sm-5 col-lg-8 col-md-8 col-xs-3">
                                                
                                                <input type="text" size="500" class="form-control" value='<?php //echo $data[2]; ?>' id="desc3" name="desc3">
                                                  
                                            </div>
                                            
                                            

                                        </div>-->
                                        
                                        
                                                                              
<!--                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image 3</label>
                                            </div>
                                            <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3">
                                                <input name="img4" type="file" id="getimage4" onchange="PreviewImage4()" value="<?php echo $img[3]; ?>"/>
                                            </div>
                                            <div class="col-sm-8 col-lg-10 col-md-8 col-xs-3" id="image">
                                                <br/>
                                                <img class="img-responsive" id="image4"  src="<?php //echo $img[3]; ?>">
                                            </div>


                                        </div>-->
<!--                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image 3 Description</label>
                                            </div>
                                            <div class="col-sm-5 col-lg-8 col-md-8 col-xs-3">
                                                
                                                <input type="text" class="form-control" value='<?php //echo $data[3]; ?>' size="500" id="desc4" name="desc4">
                                                  
                                            </div>
                                            
                                            

                                        </div>-->
                                        
                                                                      
<!--                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image 4</label>
                                            </div>
                                            <div class="col-sm-3 col-lg-8 col-md-8 col-xs-3">
                                                <input name="img5" type="file" id="getimage5" onchange="PreviewImage5()" value="<?php echo $img[4]; ?>"/>
                                            </div>
                                            <div class="col-sm-8 col-lg-10 col-md-8 col-xs-3" id="image">
                                                <br/>
                                                <img class="img-responsive" id="image5"  src="<?php //echo $img[4]; ?>">
                                            </div>


                                        </div>-->
                                        
<!--                                        <div class="form-group">
                                            <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                                <label  class="control-label"id="label">Image 4 Description</label>
                                            </div>
                                            <div class="col-sm-5 col-lg-8 col-md-8 col-xs-3">
                                                
                                                <input type="text" class="form-control" value='<?php //echo $data[4]; ?>' size="500" id="desc5" name="desc5">
                                                 
                                            </div>
                                            
                                            

                                        </div>-->
                       <div class="row">
                                <div class="col-sm-3 col-xs-4 col-lg-2 col-md-4 col-lg-offset-2 col-sm-offset-1">
                                    <button type="submit" id="fnbtn" class="btn btn-default">Save</button>

                                </div>
    <div class="col-sm-8 col-xs-8 col-md-8 col-lg-5 col-lg-offset-0 col-md-offset-5">
                                    <button type="button" id="fnbtn" class="btn btn-default" onclick="goBack()">Cancel</button>
                                </div>

                            </div>                         
                                        
                                        
                                        
                                        
                                        
                                    </form>
                                    
                        </div>
			</div>
		</div>
	</div>
<!--                    </div>-->
		</div>
		<!--End Content-->
	</div>
</div>
    
    


 <script>
            $(document).ready(function () {
               
                 $('#mandata').addClass("active");
            });


        </script>
    </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>

