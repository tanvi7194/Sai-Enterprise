<?php session_start();
require_once 'connection_file_user.php';?>
<html>
    <head>
    <title>Services | Sai Enterprise</title>
<link href="css1/style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="./css/sweet-alert.css" rel="stylesheet">
<link href="css/Custom/nav_stylesheet.css" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="./js/sweet-alert.min.js"></script>
        <script type="text/javascript">

//        function applyservice(id)
//        {
//            window.location.href="";
//        }
    </script>
<style>
                    #___gcse_0
                    {
                        width: 300px;
                    }
                    .gsc-control-cse gsc-control-cse-en
                    {
                        background: transparent;
                        border: transparent;
                    }

                </style>

        <script type="text/javascript">

             function count(count)
             {

                 document.getElementById('crt').innerHTML='Cart ('+count+')';
             }

             function wishcount(count)
             {

                 document.getElementById('wish').innerHTML='Wishlist ('+count+')';
             }

            function addToCart(id , qty , price)
            {

                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
               xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        <?php
                             $c = mysqli_fetch_array(mysqli_query($con,"select count(sr_no) from carttable where u_id=".$_SESSION['u_id']),MYSQLI_BOTH);
                            ?>
                            count('<?php echo $c[0]+1 ?>');


                        document.getElementById("submitinfo").innerHTML = "Product added to the cart";
                        $("#submitproduct").prop("disabled", true);
                        $("#wishlistbtn").prop("disabled", true);


                    }

                }
                xmlhttp.open("GET", "AddCart.php?id="+id+"&qty="+qty+"&price="+price, true);
                xmlhttp.send();
            }

        function displayCart()
            {
                //alert("Display");
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("displaycart").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "DisplayCart.php", true);
                xmlhttp.send();
            }

            function deletecart(deleteid)
            {
                //alert("delete");
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//                        alert(xmlhttp.responseText);
                        if (xmlhttp.responseText == 0)
                        {
//                            alert("enable");
                            $(document).ready(function () {
                                //$("#submitproduct").prop("disabled", false);
                                $("#submitproduct").prop("disabled", false);
                                 $("#wishlistbtn").prop("disabled", false);
                                document.getElementById("submitinfo").innerHTML = "";
                                <?php
                                    $c = mysqli_fetch_array(mysqli_query($con ,"select count(sr_no) from carttable where u_id=".$_SESSION['u_id']), MYSQLI_BOTH);
                                    if($c[0]==0)
                                    {
                                        $c[0]=0;
                                    }
                                    else
                                    {
                                        $c[0]-=1;
                                    }
                            ?>
                            count('<?php echo $c[0] ?>');


                            });

                            displayCart();
                        }
                        else
                        {
                            //alert("disable");
                            $(document).ready(function () {
                                //$("#submitproduct").prop("disabled", true);
                                document.getElementById("submitinfo").innerHTML = "Error in deleting the product";
                            });

                        }

                    }
                }
                xmlhttp.open("GET", "DeleteCart.php?value=" + deleteid, true);
                xmlhttp.send();

            }

            function updateQty(val, id)
            {

                //alert(val + " " + id);
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        displayCart();

                        //document.getElementById("total").innerHTML = parseInt(xmlhttp.responseText)
                        //alert(xmlhttp.responseText);
//                        if (xmlhttp.responseText == 0)
//                        {
//                            alert("updated");
//                            displayCart();
//                        }
//                        else if (xmlhttp.responseText == 2)
//                        {
//                            alert("Not enough Stock");
//                        }
//                        else
//                        {
//                            alert("not updated");
//
//                        }

                    }
                }
                xmlhttp.open("GET", "updateQuantityInCart.php?value=" + val + "&id=" + id, true);
                xmlhttp.send();

            }

            function addToWishlist(val)
                            {

                               if (window.XMLHttpRequest) {
                                    // code for IE7+, Firefox, Chrome, Opera, Safari
                                    xmlhttp = new XMLHttpRequest();
                                } else {  // code for IE6, IE5
                                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                }
                                xmlhttp.onreadystatechange = function () {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById("submitinfo").innerHTML = "Product added to the WishList";
                                       $("#wishlistbtn").prop("disabled", true);
                            <?php
                            $qu = mysqli_query($con , "select product_info from se_wishlist where u_id=".$_SESSION['u_id']);
                            //echo "select product_info from se_wishlist where u_id=".$_SESSION['u_id'];
                            $w = mysqli_num_rows($qu);
                            if($w==1)
                            {
                                while($row = mysqli_fetch_array($qu, MYSQLI_BOTH))
                                {
                                    $data = $row['product_info'];
                                    file_put_contents("wishlistt.xml", $data);
                                    $xml = simplexml_load_file('wishlistt.xml');
                                    $wish = count($xml->p_id)+1;
                                }
                            }
                            else
                            {
                                $wish = 0;
                            }

                            ?>

                            wishcount('<?php echo $wish ?>');

//
                                    }
                                }
                                xmlhttp.open("GET", "AddToWishlist.php?value=" + val, true);
                                xmlhttp.send();

                            }

            function displayWishlist()
            {


                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("displaywishlist").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "DisplayWishlist.php", true);
                xmlhttp.send();
            }

//            function deleteWishlist(deleteid)
//            {
//                //alert("delete");
//                if (window.XMLHttpRequest) {
//                    // code for IE7+, Firefox, Chrome, Opera, Safari
//                    xmlhttp = new XMLHttpRequest();
//                } else {  // code for IE6, IE5
//                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//                }
//                xmlhttp.onreadystatechange = function () {
//                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
////                        alert(xmlhttp.responseText);
//                        if (xmlhttp.responseText == 0)
//                        {
////                            alert("enable");
//                            $(document).ready(function () {
//                                //$("#submitproduct").prop("disabled", false);
//                                $("#submitproduct").prop("disabled", false);
//                                document.getElementById("submitinfo").innerHTML = "";
//
//
//                            });
//                            displayWishlist();
//                        }
//                        else
//                        {
//                            //alert("disable");
//                            $(document).ready(function () {
//                                //$("#submitproduct").prop("disabled", true);
//                                document.getElementById("submitinfo").innerHTML = "Product Added into the cart";
//                            });
//
//                        }
//
//                    }
//                }
//                xmlhttp.open("GET", "DeleteCart.php?value=" + deleteid, true);
//                xmlhttp.send();
//
//            }
//
            function wishlistCart(id, price) {
                var num = 1;
                addToCart(id , num , price);
                deleteWishlist(id,<?php echo $_SESSION['u_id'];?>);
            }

            function deleteWishlist(pid, uid)
            {

                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        //alert("1st"+xmlhttp.responseText);
                        if (xmlhttp.responseText == 1)
                        {
                            $("#wishlistbtn").prop("disabled", false);
                                document.getElementById("submitinfo").innerHTML = "";
                            displayWishlist();


                            <?php
                            $qu = mysqli_query($con , "select product_info from se_wishlist where u_id=".$_SESSION['u_id']);
                            $w = mysqli_num_rows($qu);
                            if($w==1)
                            {
                                while($row = mysqli_fetch_array($qu, MYSQLI_BOTH))
                                {
                                    $data = $row['product_info'];
                                    file_put_contents("wishlistt.xml", $data);
                                    $xml = simplexml_load_file('wishlistt.xml');
                                    $wish = count($xml->p_id);
                                }
                            }
                            else
                            {
                                $wish = 0;
                            }

                            ?>

                            wishcount('<?php echo $wish ?>');


                        }
                        else if (xmlhttp.responseText == 0)
                        {
                            alert("Problem Executing the query!");

                        }


                    }

                }
                xmlhttp.open("GET", "DeleteWhishlist.php?pid=" + pid + "&uid=" + uid, true);
                xmlhttp.send();
            }

function button()
            {
                //alert("Button");
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
               xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        //alert("Response " +xmlhttp.responseText);
                        if(xmlhttp.responseText==1)
                        {
                            document.getElementById("submitinfo").innerHTML = "Product is already existing in the cart";
                            $("#submitproduct").prop("disabled", true);

                             <?php
                                    $c = mysqli_fetch_array(mysqli_query($con ,"select count(sr_no) from carttable where u_id=".$_SESSION['u_id']), MYSQLI_BOTH);

                            ?>
                            count('<?php echo $c[0] ?>');
                            <?php
                            $qu = mysqli_query($con , "select product_info from se_wishlist where u_id=".$_SESSION['u_id']);
                            $w = mysqli_num_rows($qu);
                            if($w==1)
                            {
                                while($row = mysqli_fetch_array($qu, MYSQLI_BOTH))
                                {
                                    $data = $row['product_info'];
                                    file_put_contents("wishlistt.xml", $data);
                                    $xml = simplexml_load_file('wishlistt.xml');
                                    $wish = count($xml->p_id);
                                }
                            }
                            else
                            {
                                $wish = 0;
                            }

                            ?>

                            wishcount('<?php echo $wish ?>');


                        }
                        else
                        {
                            $("#submitproduct").prop("disabled", false);

                            <?php
                                    $c = mysqli_fetch_array(mysqli_query($con ,"select count(sr_no) from carttable where u_id=".$_SESSION['u_id']), MYSQLI_BOTH);

                            ?>
                            count('<?php echo $c[0] ?>');
                            <?php
                            $qu = mysqli_query($con , "select product_info from se_wishlist where u_id=".$_SESSION['u_id']);
                            $w = mysqli_num_rows($qu);
                            if($w==1)
                            {
                                while($row = mysqli_fetch_array($qu, MYSQLI_BOTH))
                                {
                                    $data = $row['product_info'];
                                    file_put_contents("wishlistt.xml", $data);
                                    $xml = simplexml_load_file('wishlistt.xml');
                                    $wish = count($xml->p_id);
                                }
                            }
                            else
                            {
                                $wish = 0;
                            }

                            ?>

                            wishcount('<?php echo $wish ?>');


                        }
                    }

                }
                xmlhttp.open("GET", "CheckCart.php", true);
                xmlhttp.send();

            }
</script>

</head>

<body>
    <div class="top">
    <div class="container">
        <div class="row-fluid">
            <ul class="phone-mail">
                <li><i class="fa fa-phone"></i><span>074 11 9211 00</span></li>
                <li><i class="fa fa-envelope"></i><span>udaymori@gmail.com</span></li>
            </ul>
            <ul class="loginbar">
                <?php
                if(!isset ($_SESSION["u_id"]))
                {
                ?>
                <li><a href="login.php" class="login-btn">Login</a></li>
                <li class="devider">&nbsp;</li>
                <li><a href="sign-up.php" class="login-btn">Sign-Up</a></li>



                <?php
                }
                if(isset ($_SESSION["u_id"]))
                {
                ?>
                <li><a href="#" data-toggle="modal" data-target="#largeModal" onclick="displayCart()" id="crt">Cart(<?php echo $c[0];?>)</a></li>
                <li class="devider">&nbsp;</li>
                <li><a href="#" data-toggle="modal" data-target="#WishlistModal" onclick="displayWishlist()" id="wish">Wishlist(<?php echo $wish;?>)</a></li>
                <li class="devider">&nbsp;</li>
                <li><a href="order_history.php" class="login-btn">Order History</a></li>
                <li class="devider">&nbsp;</li>
                <li><a href="servicehistory.php" class="login-btn">Service History</a></li>
                <li class="devider">&nbsp;</li>
                <li><a href="User_Profile.php" class="login-btn">Hi,<?php echo $_SESSION['nm']; ?></a></li>
                <li class="devider">&nbsp;</li>
                <li><a href="sign-out.php" class="login-btn">Sign Out</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
	</div>
<!--        <div class="navigation">-->
    <nav class ="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0px;" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-SE-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
              <img class="navbar-logo" src="new.png" height="100" width="150">

            </div>
        <div class="collapse navbar-collapse js-navbar-collapse" id="bs-SE-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" style="margin-top:38px;">
                <li><a href="home.php"><span class="glyphicon glyphicon-home lg" style="color: #428bca;"></span></a></li>
                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #428bca;"><b>Products </b><span class="caret"></span></a>

				<ul class="dropdown-menu mega-dropdown-menu row" style="width:650px;background-color: white;left: 0px;">
					<li class="col-sm-3 col-md-3">
						<ul>
<!--							<li class="dropdown-header">New in Stores</li>-->
<!--                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner">
                                <div class="item active">
                                    <a href="#"><img src="http://placehold.it/254x150/3498db/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 1"></a>
                                    <h4><small>Summer dress floral prints</small></h4>
                                    <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                                </div> End Item
                                <div class="item">
                                    <a href="#"><img src="http://placehold.it/254x150/ef5e55/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 2"></a>
                                    <h4><small>Gold sandals with shiny touch</small></h4>
                                    <button class="btn btn-primary" type="button">9,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                                </div> End Item
                                <div class="item">
                                    <a href="#"><img src="http://placehold.it/254x150/2ecc71/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 3"></a>
                                    <h4><small>Denin jacket stamped</small></h4>
                                    <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                                </div> End Item
                              </div> End Carousel Inner
                            </div> /.carousel
                            <li class="divider"></li>-->
                            <li>
                                <a href="products.php?val=all">View all <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
						</ul>
					</li>
                                        <?php
                                        $x=1;
                                        $getcategories=  mysqli_query($con,"select * from se_product_category");
                                        while($result = mysqli_fetch_array($getcategories,MYSQLI_BOTH))
                                        {

                                            $categoryid = $result["category_id"];
                                            $getProduct = mysqli_query($con,"select * from se_product where category_id=$categoryid limit 1");
                                            while($result1 = mysqli_fetch_array($getProduct,MYSQLI_BOTH))
                                            {

                                        ?>
					<li class="col-sm-3">
						<ul>

                                                        <img src="<?php echo $result1["product_image_path_1"] ?>" height="100" width="100">
                                                        <a href="http://localhost/SaiEnterpriseWebsite/products.php?id=<?php echo $x;?>"><?php echo $result["category_type"]; ?></a>

						</ul>
					</li>


                                        <?php
                                        $x++;
                                            }
                                        } ?>


				</ul>

			</li>
<!--                <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Products <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Processors</a></li>
            <li><a href="#">MotherBoards</a></li>
            <li><a href="#">Keyboard/Mice</a></li>
            <li><a href="#">UPS/Inverters</a></li>
            <li><a href="#">Storage Devices</a></li>
          </ul>
        </li>-->
                <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: #428bca;"><b>Service</b><span class="caret"></span></a>
          <ul class="dropdown-menu mega-dropdown-menu row" style="width:650px;background-color: white;left: 0px;">
					<li class="col-sm-3 col-md-3">
						<ul>
<!--							<li class="dropdown-header">New in Stores</li>-->
<!--                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner">
                                <div class="item active">
                                    <a href="#"><img src="http://placehold.it/254x150/3498db/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 1"></a>
                                    <h4><small>Summer dress floral prints</small></h4>
                                    <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                                </div> End Item
                                <div class="item">
                                    <a href="#"><img src="http://placehold.it/254x150/ef5e55/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 2"></a>
                                    <h4><small>Gold sandals with shiny touch</small></h4>
                                    <button class="btn btn-primary" type="button">9,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                                </div> End Item
                                <div class="item">
                                    <a href="#"><img src="http://placehold.it/254x150/2ecc71/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 3"></a>
                                    <h4><small>Denin jacket stamped</small></h4>
                                    <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                                </div> End Item
                              </div> End Carousel Inner
                            </div> /.carousel
                            <li class="divider"></li>-->

						</ul>
					</li>
					<li class="col-sm-3 pull-left">
                                            <ul class="pull-left">
                                                        <li class="dropdown-header"><b>Home User</b></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=1">Computer Repair</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=2">Laptop Repair</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=3">AntiVirus</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=4">Wifi Setup</a></li>
                            							<li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=5">Internet/Wifi Problem</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=6">System Service</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=7">Driver Solution</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=8">Laptop Battery</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=9">OS Installation</a></li>

						</ul>
                                        </li>
                                        <li class="col-sm-3 pull-left">
                                            <ul class="pull-left">
                                                        <li class="dropdown-header"><b>Corporate User</b></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=10">Computer Repair</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=11">Laptop Repair</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=12">Printing Management</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=13">Server Management</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=14">Networking</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=15">Wireless Networking</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=16">Data Recovery</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=17">System Maintenance</a></li>
                                                        <li><a href="http://localhost/SaiEnterpriseWebsite/services.php?id=18">Server Installation</a></li>
                                            </ul>
					</li>


				</ul>
                </li>
                <li><a href="Forum/forum_home.php" style="color: #428bca;"><b>Forum</b></a></li>
                <li><a href="combo_offer.php" style="color: #428bca;"><b>Combo Offers</b></a></li>
                <li><a href="clientele.php" style="color: #428bca;"><b>Clientele</b></a></li>
                <li><a href="About.php" style="color: #428bca;"><b>About</b></a></li>
                <li><a href="contactus.php" style="color: #428bca;"><b>Contact</b></a></li>

                <li>
<!--                    <form id="ui_element" class="sb_wrapper">
                    <p>
						<span class="sb_down"></span>
						<input class="sb_input" type="text"/>
						<input class="sb_search" type="submit" value=""/>
					</p>
					<ul class="sb_dropdown" style="display:none;">
						<li class="sb_filter">Filter your search</li>
						<li><input type="checkbox"/><label for="all"><strong>All Categories</strong></label></li>
						<li><input type="checkbox"/><label for="Automotive">Automotive</label></li>
						<li><input type="checkbox"/><label for="Baby">Baby</label></li>
						<li><input type="checkbox"/><label for="Beauty">Beautys</label></li>
						<li><input type="checkbox"/><label for="Books">Books</label></li>
						<li><input type="checkbox"/><label for="Cell">Cell Phones &amp; Service</label></li>
						<li><input type="checkbox"/><label for="Cloth">Clothing &amp; Accessories</label></li>
						<li><input type="checkbox"/><label for="Electronics">Electronics</label></li>
						<li><input type="checkbox"/><label for="Gourmet">Gourmet Food</label></li>
						<li><input type="checkbox"/><label for="Health">Health &amp; Personal Care</label></li>
						<li><input type="checkbox"/><label for="Home">Home &amp; Garden</label></li>
						<li><input type="checkbox"/><label for="Industrial">Industrial &amp; Scientific</label></li>
						<li><input type="checkbox"/><label for="Jewelry">Jewelry</label></li>
						<li><input type="checkbox"/><label for="Magazines">Magazines</label></li>
					</ul>
                </form>-->
<!--                                        <div class="container" style="width:100%">


            <form action="" class="search-form" style="margin-top: 9px;">
                <div class="form-group has-feedback">
            		<label for="search" class="sr-only">Search</label>
            		<input type="text" class="form-control" name="search" id="search" placeholder="search">
              		<span class="glyphicon glyphicon-search form-control-feedback" style="width: 13px;"></span>
            	</div>
            </form>

</div>-->

                <script>
  (function() {
    var cx = '016783658824998748384:h1-mpu4o6hc';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search enableAutoComplete="true"></gcse:search>

                </li>



<!--                <li class="navbar-right">
                    <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
                </li>-->
            </ul>
        </div>
            </div>
    </nav>
<?php

require_once 'connection_file_user.php';
if(isset($_GET["status"]))
{
    if($_GET["status"] == "success")
    {
        echo "<script>$(document).ready(function() {
swal({
title: 'Success!',
text: 'Successfully Applied for the Service.Thank You.!',
type: 'error',
confirmButtonText: 'OK'
});
});</script>";
    }
    else
    {
        echo "<script>$(document).ready(function() {
swal({
title: 'Error!',
text: 'Error Please Try Again!',
type: 'error',
confirmButtonText: 'OK'
});
});</script>";
    }
}



    $id=$_GET['id'];


$_SESSION["serv_id"]=$id;
$getservice=mysqli_query($con,"select * from se_service where service_id=$id");
while($row=mysqli_fetch_array($getservice,MYSQLI_BOTH))
{


?>


<div class="container">

 <div class="row">
    <div class="desc col-lg-12 col-sm-12 col-xs-12 col-md-12">
      <h1><?php echo $row["service_name"]; ?></h1>

      <div class="desc-left">
        <p><?php echo $row["service_description"]; ?></p>
        <p><b>This Service will include features like</b><br><?php echo $row["service_features"]; ?></p>
        
        <p>So apply for this service through Email anytime</p>
        <form action="applyForServiceHandler.php" method="post">
        <input type="submit" value="Apply to this Service"/>
        </form>

      </div>
            <div class="include-service">
        <h5>Our Services Include:</h5>
        <ul>
          <li><p>100% Guaranteed</p></li>
          <li><p>Immediate Support</p></li>
          <li><p>14/7 Assistance</p></li>
        </ul>
      </div>

      
      </div>
    </div>
  
  </div>     
     <?php
}
include 'footer.php';
?>

<script type="tetext/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>

        

</html>