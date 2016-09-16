<!DOCTYPE html>
<html lang="en">
    
<?php
session_start();
?>
	<head>
		<meta charset="utf-8">
		<title>Sai Enterprise | Manage Order</title>
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
    include_once './half_nav_file.php';
        ?>
        <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Manage Order</span>
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
				
                            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Genral Order Information
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Product ID</th>
                                            <th>Order Date</th>
                                            <th>Order Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>    
                                    <tbody> 
                                        <?php
                                        
                                            require_once 'connection_file.php';

                                        $query = mysqli_query($con,"Select * from se_orders");
                                         
                                        while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {
                                            //echo $row['order_id'];
                                            echo "<tr><form  id=form name=form action=orderhistory.php method=POST>";
                                            
                                            echo '<td>' . $row['order_id'] . '</td>';
                                           $data=$row['product_info'];
                                           
                                           
                                           
                                           if ($data != 'null') {
//                                                        echo $data;
                                                        file_put_contents("productinfo.xml", $data);
                                                        $xml = new SimpleXMLElement($data);

                                                        $x = 0;
                                                        echo '<td>' ;
                                                        foreach ($xml as $parent) {
                                                            $pro_id[$x] = $xml->pid[$x];
                                                            echo $pro_id[$x]."<br/>";
                                                            $x++; 

                                                         }
                                                         echo '</td>';
                                                    }
                                           
                                           
                                           
//                                           file_put_contents("productInfo.xml", $data);
//                                           $xml = new SimpleXMLElement($data);
//                                                
//                                                $x=0;
//                                                echo '<td>' ;
//                                                foreach ($xml as $parent) {
//                                                $pro_id[$x] = $xml->pid[$x];
//                                                echo $pro_id[$x]."<br/>";
//                                                $x++; 
//                                                    
//                                                }
//                                                
//                                                 echo '</td>';

                                            
                                            
                                            
                                            
                                            echo '<td>' . $row['order_date'] . '</td>';
                                            echo '<td>' . $row['order_status'] . '</td>';
                                            echo '<td><input type="submit" class="btn btn-primary"  btn-block=""   value="View And Edit" />
                                                 </td>';
                                           
                                        ?>
                                                
                                                
                                    <input type="hidden"  name='delid' value=<?php echo $row['order_id']; ?> />
                                        <?php
                                            echo "</form></tr>";
                                            $x++;
                                        }
                                        ?>
                                   
                               </tbody> 
                               </table>
                            </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                            
                            
                            
                            
                            
                            
			</div>
		</div>
	</div>
	
</div>
        </div>
        </div>
</div>

    
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
        $('#dataTables-example_filter').hide();
        $('#manorder').addClass("active");

    });
    
    
    
    </script>

    
    </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>


