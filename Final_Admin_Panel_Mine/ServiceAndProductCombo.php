<?php

session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
		<title>Service and product combo | Sai Enterprise</title>
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
        function combo_product(val)
        {
            alert("hii" + val);
            if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        alert("Product Added ".xmlhttp.responseText);
                        //document.getElementById("submitinfo").innerHTML = "Product Added";
                    }
                }
                xmlhttp.open("GET", "ServiceAndProductComboHandler.php?value=" + val, true);
                xmlhttp.send();
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
    
    <body>
        <?php 
        include_once './half_nav_file.php';
        ?>
        
        <div>
            <form action="ServiceAndProductComboHandler.php" method="POST">
        
<div class="panel panel-default col-lg-5" >
    
  <!-- Default panel contents -->
  <div class="panel-heading">SELECT PRODUCT FOR COMBO</div>
  

  <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Selection</th>
                                                
                                                <th>Product Image</th>
                                                <th>Product Name</th>
                                              


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!--Product Report-->

                                            <?php
                                            require_once 'connection_file.php';
                                           echo "<tr>";
                                           $q1=mysqli_query($con,"SELECT * FROM se_product");
                                           while ($row = mysqli_fetch_array($q1,MYSQLI_BOTH)) {
                                               $pid=$row['product_id'];
                                               $name=$row['product_name'];
                                               //$img=$row['product_img_path_1'];?>
                                            
                                                   
                                            <tr>
                                                <td><input type="checkbox" id="type1" name="type1[]" value="<?php echo $pid;?>"></td>
                                        
                                                
                                                <td><img height=100 width=100 src='<?php echo $row['product_image_path_1']; ?>' /></td>
                                                <td><?php echo $name;?></td>
                                                
                                            </tr>
                                            
                                            
                                                   
                                                   
                                                   <?php } ?>
                                            

                                        <!--Product Report-->
                                        </tbody>
                                        
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                                

                                </div>
        
        
        
        <div class="col-lg-1"></div>
        
        
        <div class="panel panel-default col-lg-6" >
    
  <!-- Default panel contents -->
  <div class="panel-heading">SELECT SERVICE FOR COMBO</div>
  

  <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Selection</th>
                                                <th>Service ID </th>
                                                <th>Service Features</th>
                                                <th>Service Name</th>
                                              


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!--Product Report-->

                                            <?php
                                            require_once 'connection_file.php';
                                           echo "<tr>";
                                           $q1=mysqli_query($con,"SELECT * FROM se_service");
                                           while ($row = mysqli_fetch_array($q1,MYSQLI_BOTH)) {
                                               $sid=$row['service_id'];
                                               $sname=$row['service_name'];
                                               $sfec=$row['service_features'];
                                               //$img=$row['product_img_path_1'];?>
                                            
                                                   
                                            <tr>
                                                <td><input type="checkbox" id="type2" name="type2[]" value="<?php echo $sid;?>"></td>
                                        
                                                <td><?php echo $sid;?></td>
                                                <td><?php echo $sfec;?></td>
                                                <td><?php echo $sname;?></td>
                                                
                                            </tr>
                                            
                                            
                                                   
                                                   
                                                   <?php } ?>
                                            

                                        <!--Product Report-->
                                        </tbody>
                                        
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                               

                                </div>
                                    <div class="form-group col-lg-12">
						<div class="col-sm-offset-2 col-sm-5">
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

  
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
                 $('#rep').addClass("active");
            });


        </script>

  </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>