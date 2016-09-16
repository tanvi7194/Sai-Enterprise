<!DOCTYPE html>
<?php
    session_start();
?>

<html>
    <head>
        
		<meta charset="utf-8">
		<title>Manage Product Discount | Sai Enterprise</title>
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
        
        <script>
        function chck_id(p_id,cat)
        {
           
            window.location.href="AddNewDiscount.php?pid="+p_id+"&category="+cat;
        }

        function getdata(id)
        {
            if (window.XMLHttpRequest)
                                {
                                    xmlhttp=new XMLHttpRequest();
                                } 
                          else 
                                {  
                                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                 }
                          xmlhttp.onreadystatechange=function() {
                          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById('data').innerHTML=xmlhttp.responseText;
                          }
                        }
                        xmlhttp.open("GET","AddDiscountHandler.php?id="+id,true);
                        xmlhttp.send();
        }
    function delpro(p_id)
    {
        alert(p_id);
         if (window.XMLHttpRequest)
                                {
                                    xmlhttp=new XMLHttpRequest();
                                } 
                          else 
                                {  
                                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                 }
                          xmlhttp.onreadystatechange=function() {
                          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            if(xmlhttp.responseText==0)
                            {
                                //alert(xmlhttp.responseText);
                                window.location.href="Manage_Product.php";
                            }
                            else
                            {
                                    alert(xmlhttp.responseText);
                            }
                          }
                        }
                        xmlhttp.open("GET","Delete_Product.php?pid="+p_id,true);
                        xmlhttp.send();
    }

        
        </script>
        
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
include_once './half_nav_file.php';
    ?>
                    
        <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Manage Products</span>
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

                        <fieldset>
                                <legend>Manage Products</legend>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Select Product to Add Discount</label>
							<div class="col-sm-5">
                                                            <select class="populate placeholder" name="product" id="product" onchange="getdata(product.value)">>
                                                                    <option disabled="disabled" selected="selected">Select</option>
                                                                    <option value="0">All Products</option>
                                                                    <?php
                                                                    include './Classes/Insert_Product.php';
                                                                    $sel=new Insert_Product_Class();
                                                                    $select_query1=$sel->get_categories();
                                                                    while($data = mysql_fetch_array($select_query1))
                                                                    {
                                                                        echo "<option value=".$data['category_id'].">".$data['category_type']."</option>";
                                                                    }
                                                                    ?>
									
																</select>
							</div>
                                                        
						</div>
						 
					</fieldset>
                        <span id="data"></span>
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

 
