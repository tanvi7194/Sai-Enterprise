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
                    