<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require_once './fpdf17/fpdf.php';

$pdf = new FPDF();
//var_dump(get_class_methods($pdf));


?>
<html>
    <head>
        <meta charset="utf-8">
		<title>Manage Stock | Sai Enterprise</title>
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
        <script>
            
        
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
                        xmlhttp.open("GET","Manage_Stock_Data.php?id="+id,true);
                        xmlhttp.send();
        }    
        function chck_id(p_id,qty)
        {
            //alert(qty);
            if(qty)
            {
                if(qty>=0)
                {
                   window.location.href="Update_Product_Stock_Handler.php?delid="+p_id+"&quant="+qty;
                }
                else
                {

                }
            }
            else
            {
                alert("Blank");
            }
                
        }
        
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
        <link rel="stylesheet" href="css/sweet-alert.css">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
					<span>Manage Stock</span>
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
				
					<table class='table'>
      <tr>
          <th>Sr No</th> <th>Product Name</th><th>Image </th> <th>Category </th><th>Stock Quantity</th><th></th>
      </tr>
      
      <?php 
  

require_once 'connection_file.php';
$q = mysqli_query($con,"select * from se_product order by category_id ASC");
        while($data = mysqli_fetch_array($q,MYSQLI_BOTH))
        {
            $img = $data["product_image_path_1"];
            echo  "<tr><form name='edit_product' method='post' action='Update_Product_Stock_Handler.php'><td><input type='hidden' name='id' value=".$data['product_id'].">".$data['product_id']."</td><td>".$data['product_name']."</td><td><img src=$img height=100 width=100></td>";
            
            $d = "select category_type from se_product_category where category_id=".$data['category_id'];
            
            $get_category = mysqli_fetch_array(mysqli_query($con,$d),MYSQLI_BOTH);
            $val = $get_category['category_type'];
            echo "<td>".$val."</td><td><div class='form-group has-success has-feedback'><div class='col-sm-5'><input type='Number' class='form-control' name='quant' value=".$data['stock_quantity']." required></div></div></td>";
            echo "<td><input type='submit' class='btn btn-primary' value='Save' ></td></form></tr>";
            
            
        }

?>
                                        </table>					
				
			</div>
                                            <input type='submit' class='btn btn-primary pull-right' value='Create PDF' onclick="window.location.replace('http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/Final_Stock_Report.php')">
        </div>
</div>
                    
                </div>
        </div>
</div>

    </body>
</html>
<?php 
//$pdf->AddPage();    
//$pdf->Output();
        include_once './scripts_to_add.php';
?>