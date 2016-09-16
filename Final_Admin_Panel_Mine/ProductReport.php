<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
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
					<span>Product Report</span>
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
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Product ID </th>

                                                <th>Product Image</th>
                                                <th>Product Name</th>
                                                <th>Total Purchases</th>
                                                <th>Stock Quantity</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!--Product Report-->

                                            <?php
                                            require_once 'connection_file.php';
                                            $tablename = "se_productReportTable";
                                            
                                            
                                            
                                            
                                            if(mysqli_num_rows(mysqli_query($con,"Show tables LIKE 'se_productReportTable'"))==1)
{
                                        $countProduct = mysqli_query($con,"select count(serial_no) from se_productReportTable");
    //        echo $countProduct;
                                        $count = mysqli_fetch_array($countProduct,MYSQLI_BOTH);
                                        if ($count > 0) {
//                                                echo ' Product Table Existing';
                                                $dropTaable = mysqli_query($con,"DROP TABLE se_productReportTable");
//                                                echo $dropTaable;
                                            }
                                        }

                                            $query = "CREATE TABLE se_productReportTable (
                                            serial_no INT AUTO_INCREMENT PRIMARY KEY,
                                            product_id INT
                                            )";

                                            $result = mysqli_query($con,$query);
//                                            if($result)
//                                            {
//                                                echo "<br> Bannn Gayaaa";
//                                            }
//                                            else
//                                            {
//                                                echo mysqli_error();
//                                            }
                                            $selectOrders = mysqli_query($con,"Select * from se_orders");

                                            if (mysqli_num_rows($selectOrders) > 0) {

                                                while ($row = mysqli_fetch_array($selectOrders,MYSQLI_BOTH)) {


                                                    $data = $row['product_info'];
                                                    if ($data != 'null') {
//                                                        echo $data;
                                                        file_put_contents("my.xml", $data);
                                                        $xml1 = new SimpleXMLElement($data);

                                                        $x = 0;
                                                        foreach ($xml1->children() as $value) {
                                                            $pid = $xml1->pid[$x];
//                                                            echo '<br>id :'.$pid;
                                                            $x++;
                                                            $insertproductReport = mysqli_query($con,"INSERT INTO se_productReportTable values(null , $pid)");
                                                        }
                                                    }
                                                }
                                            }

                                            $productReport1 = mysqli_query($con,"Select product_id from se_productReportTable group by product_id");
//                                            echo $productReport1;

                                            while ($row2 = mysqli_fetch_array($productReport1,MYSQLI_BOTH)) {
//                                                echo "<br>value".$row2[0];
                                            }

                                            $productReport = mysqli_query($con,"Select count(product_id) , product_id  from se_productReportTable group by product_id order by count(product_id) DESC");
//                                            echo $productReport;
                                            $y=0;
                                            while ($row1 = mysqli_fetch_array($productReport,MYSQLI_BOTH)) {
//                                                echo "<br>value".$row1[0];
//                                                echo "<br>value".$row1[1];
                                                   $array[$y]=$row1[1];
                                                   $y++;
                                                $query = mysqli_query($con,"Select * from se_product where product_id='$row1[1]'");
                                                while ($rowdisplay = mysqli_fetch_array($query,MYSQLI_BOTH)) {
                                                    $img=$rowdisplay['product_image_path_1'];
                                                    echo "<tr>";

                                                    //$data = $rowdisplay['product_img_path_1'];
                                                    //$xml = new SimpleXMLElement($data);

//                                                $x=0;
//                                                foreach ($xml->children() as $parent) {
//                                                
//                                                    echo $xml->p_name[$x]."<br/>";
//                                                    $x++;
//                                                }
//                                                


                                                    $x = 1;
                                                    echo '<td>' . $rowdisplay['product_id'] . '</td>';

                                                    echo '<td>';
                                                    ?>
                                                <img height=100 width=100 src='<?php echo $img; ?>' />
                                                <?php
                                                echo '</td>';
                                                echo '<td>' . $rowdisplay['product_name'] . '</td>';
                                                echo '<td>' . $row1[0] . '</td>';
                                                echo '<td>'. $rowdisplay['stock_quantity'] . 
                                                 '</td>';
                                            }
                                        }
                                        $xx=0;
                                        foreach ($array as $value) {
                                            if($xx !=5)
                                            {
                                                 $insertRecommendedItems = mysqli_query($con,"INSERT INTO se_recommended_items values(null , $value)");
                                                 
                                            }
                                            $xx++;
                                           
                                        }
                                        
                                        ?>

                                        <!--Product Report-->
                                        </tbody>
                                    </table>
                            
                                </div>
                    <input type='submit' class='btn btn-primary pull-right' value='Create PDF' onclick="window.location.replace('http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/Product_Report_PDF.php')">
		</div>
	</div>
	
</div>
                </div>
        </div>
</div>

    
<!--        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
                 $('#rep').addClass("active");
            });


        </script>-->




   </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>


 
