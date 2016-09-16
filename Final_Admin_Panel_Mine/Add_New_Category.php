<!DOCTYPE html>
<html lang="en">
    
<?php
session_start();
?>
	<head>
		<meta charset="utf-8">
		<title>Home | Sai Enterprise</title>
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
                
                <script>
                    
                    function fields(val,nm)
                    {
                            
                            if (window.XMLHttpRequest) {
                            // code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                            } 
                            else 
                            {  // code for IE6, IE5
                                 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            xmlhttp.onreadystatechange = function () {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById("fields").innerHTML = xmlhttp.responseText;
                                }
                            }
                        xmlhttp.open("GET", "AddFields.php?num="+val+"&name="+nm, true);
                        xmlhttp.send();
                    }
                    
                    
                    function values(val,val2)
                    {
                            //alert(val+" AND "+val2);
                            if(val!='Text_Value_Tool')
                            {
                            if (window.XMLHttpRequest) {
                            // code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                            } 
                            else 
                            {  // code for IE6, IE5
                                 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            xmlhttp.onreadystatechange = function () {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById("txt"+val2).innerHTML = xmlhttp.responseText;
                                }
                            }
                        xmlhttp.open("GET", "NumOfFields.php?num="+val2, true);
                        xmlhttp.send();
                    }
                    document.getElementById("txt"+val2).innerHTML = " ";
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
            setInterval(function(){getMessage(<?php echo $_SESSION["u_id"];?>)},5000);



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
				<form id="defaultForm" method="post" action="AddCategoryHandler.php" class="form-horizontal">
					<fieldset>
						<legend>Add New Product</legend>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Existing Categories</label>
							<div class="col-sm-5">
								<select class="populate placeholder" name="product" id="product">
                                                                    <?php
                                                                    include './Classes/Insert_Product.php';
                                                                    $sel=new Insert_Product_Class();
                                                                    $select_query1=$sel->get_categories();
                                                                    while($data = mysqli_fetch_array($select_query1,MYSQLI_BOTH))
                                                                    {
                                                                        echo "<option value=".$data['category_type'].">".$data['category_type']."</option>";
                                                                    }
                                                                    ?>
									
									
								</select>
							</div>
                                                        
                                                        
                                               </div>
                                                <div class="form-group">
							<label class="col-sm-3 control-label">New Category Name</label>
                                                        <div class="col-sm-2">
                                                            <input type="text" name="cat2" id="nm">
                                                            
                                                        </div>   
                                                        
                                                        <label class="col-sm-3 control-label">Number of fields</label>
                                                        <div class="col-sm-2">
                                                            <input type="number" name="numoffields" id="numoffields">
                                                            
                                                        </div>
                                                        </div>
                                                        
						
                                                
                                                
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-2">
                                                    <button type="reset" class="btn btn-default btn-label-left">
							<span><i class="fa fa-clock-o txt-danger"></i></span>
								Reset
							</button>
						</div>
						
						<div class="col-sm-2">
                                                    <button type="button" class="btn btn-primary btn-label-left" onclick="fields(numoffields.value , cat2.value)">
							<span><i class="fa fa-clock-o"></i></span>
								Submit
							</button>
						</div>
					</div>
                                                <span id="fields"></span>
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
        include_once './scripts_to_add.php';
?>
