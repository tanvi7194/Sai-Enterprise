<?php 
session_start();

if(isset($_SESSION["admin_id"]))
{
   
}
else
{
     header("location:Admin_Login.php?status=no");
}

?>

<!DOCTYPE html>
<html lang="en">
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

                <script type="text/javascript">
            function SendMessage(userid)
            {
              
                var messge =document.getElementById("msg").value;
                
                document.getElementById("msg").value;
                
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

//                        document.getElementById("displayItems").innerHTML = xmlhttp.responseText;
                            
                    }

                }
                xmlhttp.open("GET", "sendMessage.php?value=" + messge+"&id="+userid, true);
                xmlhttp.send();

            }
            
            function deleteChatHistory()
            {
                 if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        

                    }

                }
                xmlhttp.open("GET", "DeleteChatHistory.php", true);
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
        <script>
            function changestatus(msg)
            {
                
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        document.getElementById("status").innerHTML = xmlhttp.responseText;

                    }

                }
                xmlhttp.open("GET", "ChangeChatStatus.php?value="+msg, true);
                xmlhttp.send();
            }

        </script>

                
<body>

     <!--chat-->
                        <div class="container">
    <div class="row chat-window col-xs-12 col-md-3 col-lg-4" id="chat_window_1" style="margin-left:10px;position:fixed;left:5px;bottom:-20px;z-index: 100;">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span>Chat Box <br><span id="status"></span></h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    </div>
                </div>
                        <div class="panel-body msg_container_base" id="message" onload="getMessage(<?php echo $_SESSION["admin_id"];?>)">
                       
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                            <div class="col-lg-9 col-xs-9 col-md-9 col-sm-9">
                                <input type="text" name="msg" id="msg" style="width: 250px; height: 40px;" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                            </div>
                            <div class="col-lg-3 col-xs-3 col-md-3 col-sm-3">
<!--                        <span class="input-group-btn">-->
                                <input class="btn btn-primary" type="button" style="width: 70px; height: 30px; " id="send" value="Send" onclick="SendMessage(<?php echo $_SESSION["admin_id"];?>)">
                                <input class="btn btn-danger" type="button" style="width: 75px; height: 30px;" id="end" value="End Chat" onclick="deleteChatHistory()">
<!--                        </span>-->
                            </div>
                        
                    </div>
                </div>
    		</div>
        </div>
    </div>

    <div class="btn-group dropup">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-cog"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a onclick="changestatus(this.name)" name ="online" id="new_chat"><span class="glyphicon glyphicon-plus"></span>Go Online</a></li>
            <li><a onclick="changestatus(this.name)" name="offline"><span class="glyphicon glyphicon-minus-sign"></span> Go Offline</a></li>
            
        </ul>
    </div>
</div>
                        <!--/chat-->


<!--Start Header-->
<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Basic table</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div>
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="home_sai_enterprise.php">Sai Enterprise</a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					
					<div class="col-xs-12 col-sm-12 top-panel-right">
						<a href="#" class="about">about</a>
                                                
                                                <div id="about">
				<div class="about-inner">
					<h4 class="page-header">ABOUT US</h4>
					<p>SAI ENTERPRISE is a firm, which provides Services regarding Computer Hardware & Networking solutions</p>
					<p>Owner Name - <a href="#" target="">Uday Mori</a></p>
					<p>Email - <a href=" # "> udaymori@gmail.com </a></p>
					<p>Office Address - <a href="#">211,Vraj Sidhi Tower, Nr. Khanderao Market, Cross Road , Vadodara</a></p>
                                        <p>Contact Info - <a href="#" target="">Tel : 3010607</a>
                                            <br><a href="#" target=""> Mob : 98240 47232</a></p>
				</div>
			</div>
                                                
                                                
						<a href="" class="style1"></a>
						<ul class="nav navbar-nav pull-right panel-menu row">
							<li class="col-xs-2">
                                                            <a href="notifications_admin.php" class="modal-link">
									<i class="fa fa-bell"></i>
                                                            </a>
							</li>
							
                                                        
                                                        
                                                         <?php
                        require_once 'connection_file.php';
                                            $sql="SELECT * FROM se_administration";
                                            $result=  mysqli_query($con,$sql);
                                           
                                            while ($row = mysqli_fetch_array($result,MYSQLI_BOTH))
                                            {
                                                
                                                $img=$row['admin_photo'];
                                            }
                                                ?>
							<li class="dropdown pull-right">
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<div class="avatar">
										<img src='<?php echo $img; ?>' class="img-circle" alt="avatar" />
									</div>
                                                                    
									<i class="fa fa-angle-down pull-right"></i>
									<div class="user-mini pull-right">
										<span class="welcome">Welcome,</span>
                                                                                <span>
                                                                                    <?php
                                                                                    
                                                                                    echo $_SESSION['nm'];
                                                                                    
                                                                                    
                                                                                    ?>
                                                                                    
                                                                                    
                                                                                </span>
									</div>
								</a>
								<ul class="dropdown-menu">
									<li>
                                                                            <a href="Admin_Profile.php">
											
                                                                                        <span><a href="Admin_Profile.php">Profile</a></span>
										</a>
									</li>
									
									<li>
                                                                            <a href="Log_Out.php">
											<i class="fa fa-power-off"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-12 col-sm-2">
			<ul class="nav main-menu">
				<li>
                                    <a href="home_sai_enterprise.php">
						<i class="fa fa-dashboard"></i>
						<span class="">Dashboard</span>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-fw fa-table" ></i>
						<span class="">Catalog</span>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-fw fa-table" ></i>
						<span class="">Add New Product</span>
					</a>
					<ul class="dropdown-menu">
                                            <li><a  href="AddNewProduct.php">Single Upload</a></li>
                                            <li><a  href="BulkUpload.php">Bulk Upload</a></li>
						
					</ul>
				</li>
                                
                                <li><a  href="Manage_Product.php">Manage Products</a></li>
                                
                                <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-fw fa-table" ></i>
						<span class="">Product Discount</span>
					</a>
					<ul class="dropdown-menu">
                                            <li><a  href="AddDiscount.php">Add Product Discount</a></li>
                                            <li><a  href="ManageProductDiscount.php">Manage Product Discount</a></li>
						
					</ul>
				</li>
                                
                                
                                <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-fw fa-table" ></i>
						<span class="">Manage Combo Offers</span>
					</a>
					<ul class="dropdown-menu">
                                            <li><a  href="ManageComboOffer.php">Add Offer</a></li>
                                            <li><a  href="DisplayComboOffer.php">Delete Offer</a></li>
						
					</ul>
				</li>
					</ul>
				</li>
                                <li>
                                    <a href="Add_New_Category.php">
						<i class="fa fa-dashboard"></i>
						<span class=" ">Category</span>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-map-marker"></i>
						<span class=" ">Reports</span>
					</a>
					<ul class="dropdown-menu">
                                            <li><a  href="Manage_Stock.php">Stock Report</a></li>
                                            <li><a  href="ProductReport.php">Product Report</a></li>
						
					</ul>
				</li>
        		 <li>
                             <a  href="ManageOrder.php">
						 <i class="fa fa-calendar"></i>
						 <span class=" ">Manage Orders</span>
					</a>
				 </li>    
                                 
                                 <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-map-marker"></i>
						<span class=" ">Manage Site Data</span>
					</a>
					<ul class="dropdown-menu">
                                            <li><a  href="ManageSlider.php">Manage Slider</a></li>
                                                <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-map-marker"></i>
						<span class=" ">Manage New Arrivals</span>
					</a>
					<ul class="dropdown-menu">
                                            <li><a  href="Manage_New_Arrival_Add.php">Add New Arivals</a></li>
                                            <li><a  href="Manage_New_Arrival_Delete.php">Delete New Arrivals</a></li>
						
					</ul>
				</li>
                                <li><a  href="ManageTestimonials.php">Manage Testimonials</a></li>
                                <li><a  href="Manage_Blog.php">Manage Blog</a></li>
						
					</ul>
				</li>
                                
                                <li>
                                    <a  href="ManageForum.php">
						 <i class="fa fa-calendar"></i>
						 <span class=" ">Manage Forum</span>
					</a>
				 </li>
                                 
                                 <li>
                                     <a  href="ManageServices.php">
						 <i class="fa fa-calendar"></i>
						 <span class=" ">Manage Service</span>
					</a>
				 </li>
				 
				
			</ul>
		</div>
            
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
			<div id="about">
				<div class="about-inner">
<!--					<h4 class="page-header">Open-source admin theme for you</h4>
					<p>DevOOPS team</p>
					<p>Homepage - <a href="http://devoops.me" target="_blank">http://devoops.me</a></p>
					<p>Email - <a href="mailto:devoopsme@gmail.com">devoopsme@gmail.com</a></p>
					<p>Twitter - <a href="http://twitter.com/devoopsme" target="_blank">http://twitter.com/devoopsme</a></p>
					<p>Donate - BTC 123Ci1ZFK5V7gyLsyVU36yPNWSB5TDqKn3</p>-->
				</div>
			</div>
			
<!--<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-11">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> WELCOME TO SAI ENTERPRISE ADMIN PANEL</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-8 col-md-8">
                            <a href="#" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-th"></span> <br/>Apps</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Bookmarks</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Reports</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                        </div>
                        <div class="col-xs-8 col-md-8">
                          <a href="#" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Notes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Photos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a>
                        </div>
                    </div>
                    <a href="http://www.jquery2dotnet.com/" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> Website</a>
                </div>
            </div>
        </div>
    </div>
</div>

		</div>
		End Content
	</div>
</div>-->
    <div id="wrapper">

        <!-- Navigation -->
        
        <div style="min-height: 329px;" id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <br/><br/>
                    <h1>
                   
                    
                    <h2>Welcome To Sai Enterprise Admin Panel </h2>
                    
                    <hr/>
                    <!-- /.panel -->
                    <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    
                                    <div>Product Report!</div>
                                </div>
                            </div>
                        </div>
                        <a href="ProductReport.php">
                            <div class="panel-footer">
                                <span class="pull-left">Product Report</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    
                                    <div>Stocks Report!</div>
                                </div>
                            </div>
                        </div>
                        <a href="Manage_Stock.php">
                            <div class="panel-footer">
                                <span class="pull-left">Stock Report</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    
                                    <div>Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="ManageOrder.php">
                            <div class="panel-footer">
                                <span class="pull-left">Manage Orders</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    
                                    <div>Manage Products!</div>
                                </div>
                            </div>
                        </div>
                        <a href="Manage_Product.php">
                            <div class="panel-footer">
                                <span class="pull-left">Manage Products</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
                </div>
                <!-- /.col-lg-6 -->
                
                <!-- /.col-lg-6 -->
            </div>
            <div class="panel-body">
                <a onclick="window.location.replace('http://localhost/SaiEnterpriseWebsite/home.php')" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> Website</a> 
        </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        
    </div>
    <!-- /#wrapper -->
                </div>
        </div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>
<script type="text/javascript">
        $(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
//$(document).on('click', '#new_chat', function (e) {
//    var size = $( ".chat-window:last-child" ).css("margin-left");
//     size_total = parseInt(size) + 400;
//    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
//    clone.css("margin-left", size_total);
//});
$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chat_window_1" ).remove();
});


        </script>


</body>
</html>
