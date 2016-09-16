<?php
session_start();
include_once './database_layer.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CheckOut Address | Sai Enterprise</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        
        
        <link href="css/Custom/main.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="engine1/style.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/component.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/style_search.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/nav_stylesheet.css" />
        <script>
            function getCity(id)
                {
                    if(id!=0)
                    {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                      } else {  // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                      }
                      xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            //alert(xmlhttp.responseText);
                            document.getElementById("cities").innerHTML = xmlhttp.responseText;
                            //document.getElementById("city").innerHTML = xmlhttp.responseText;
                        }

                      }
                      xmlhttp.open("GET","get_Cities_For_Address.php?id="+id,true);
                      xmlhttp.send();
                    }
                    else
                    {
                        document.getElementById("cities").innerHTML = "Select Valid State Name";
                    }
                  
                }
                
                
                function getCities(id)
                {
                    if(id!=0)
                    {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                      } else {  // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                      }
                      xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            //alert(xmlhttp.responseText);
                            //document.getElementById("cities").innerHTML = xmlhttp.responseText;
                            document.getElementById("city").innerHTML = xmlhttp.responseText;
                        }

                      }
                      xmlhttp.open("GET","get_Cities_For_Address.php?id="+id,true);
                      xmlhttp.send();
                    }
                    else
                    {
                        document.getElementById("cities").innerHTML = "Select Valid State Name";
                    }
                  
                }
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
    <?php
require_once 'connection_file_user.php';

    $u_add_id = mysqli_fetch_array(mysqli_query($con,"select * from se_billing_address where u_id=".$_SESSION['u_id']),MYSQLI_BOTH);
        $u_billing_add_modal = mysqli_fetch_array(mysqli_query($con,"select * from se_billing_address where billing_address_id=".$u_add_id['billing_address_id']),MYSQLI_BOTH);
        ?>
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
                
$u_data = mysqli_fetch_array(mysqli_query($con,"select * from se_user where u_id=".$_SESSION['u_id']),MYSQLI_BOTH);
$u_billing_add_view = mysqli_fetch_array(mysqli_query($con,"select * from se_billing_address where u_id=".$_SESSION['u_id']),MYSQLI_BOTH);
?>


<div class="col-md-push-9">
    <table class="table">
    <tr >
        <td width='50%' >
            <!-- BILLING ADDRESS--> 
            <table class="table" border='3px solid red'  >
                <tr>
                    <td colspan="2" align="center">
                        <b><font color="red"> Billing Address </font></b>
                    </td>
                    
                </tr>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        <center> 
                            <b>
                                <?php echo $_SESSION['nm']?>
                            </b>
                        </center>
                    </th>
                </tr>
                <tr>
                    <td>
                        Address Line 1  
                    </td>
                    <td>
                        
                        
                        
                        <?php echo $u_billing_add_view['add_line_1']?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Address Line 2
                    </td>
                    <td>
                        <?php echo $u_billing_add_view['add_line_2']?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Zip Code
                    </td>
                    <td>
                        <?php echo $u_billing_add_view['zip_code']?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        City
                    </td>
                    <td>
                        <?php $city_name = mysqli_fetch_array(mysqli_query($con,"select * from se_city where city_id=".$u_billing_add_view['city_id']),MYSQLI_BOTH); echo $city_name['city_name']; ?>
                    </td>
                </tr>
                
                <tr>
                    <?php 
//                    $state_name = mysqli_fetch_array(mysqli_query("select * from se_state where state_id=".$u_billing_add_view['state_id']));
//                    ?>
<!--                    <td><select name="state" onchange="getCity(this.value);">
                            <option value='/' selected="selected">tion>
                                                                    
//                                                                    
//                                                                     include_once './database_layer.php';
//                                                                    $result = stateDropdown();
//                                    $i = 0;
//                                    while ($row = mysqli_fetch_array($result)) {
//                                        $i++;
//                                        echo "<option value='$i'>$row[0]</option>";
//                                    }
//
//                                                                    ?>
                                                                </select>
                    </td>-->
                    <td>
                        State
                    </td>
                    <td>
                        <?php
                        $state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_billing_add_view['state_id']),MYSQLI_BOTH);
                        echo $state_name['state_name'];
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Country
                    </td>
                    <td>
                        <?php echo $u_billing_add_view['country']?>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="button" value="Edit" data-toggle="modal" data-target='#billingModal'>
                        
                    </td>
                </tr>
                
            </table>
        </td>
        <!-- BILLING ADDRESS END--> 
        <?php
        $u_shipping_add_view = mysqli_fetch_array(mysqli_query($con,"select * from se_shipping_address where u_id=".$_SESSION['u_id']),MYSQLI_BOTH);
        ?>
        <td>
            <!-- SHIPPING ADDRESS--> 
            <table class="table" border='3px solid red'  width='50%' >
                <tr>
                    <td colspan="2" align="center">
                        <b><font color="red"> Shipping Address </font></b>
                    </td>
                    
                </tr>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        <center> 
                            <b>
                                <?php echo $_SESSION['nm']?>
                            </b>
                        </center>
                    </th>
                </tr>
                <tr>
                    <td>
                        Address Line 1
                    </td>
                    <td>
                        <?php echo $u_shipping_add_view['add_line_1']?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Address Line 2
                    </td>
                    <td>
                        <?php echo $u_shipping_add_view['add_line_2']?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Zip Code
                    </td>
                    <td>
                        <?php echo $u_shipping_add_view['zip_code']?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        City
                    </td>
                    <td>
                        <?php $city_name = mysqli_fetch_array(mysqli_query($con,"select * from se_city where city_id=".$u_shipping_add_view['city_id']),MYSQLI_BOTH); echo $city_name['city_name']; ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        State
                    </td>
                    <td>
                        <?php $state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_shipping_add_view['state_id']),MYSQLI_BOTH); echo $state_name['state_name']; ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Country
                    </td>
                    <td>
                        <?php echo $u_shipping_add_view['country']?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="button" value="Edit" data-toggle="modal" data-target='#shippingModal'>
                        
                    </td>
                </tr>
            </table>
            <!-- SHIPPING ADDRESS END-->
            
            
            
        </td>
    </tr>
    
</table>
    </div>
<button type="button" id="savechanges" class="btn btn-primary" onclick="window.location.href='http://localhost/SaiEnterpriseWebsite/Invoice.php'" ><b>Save Changes</b></button>


<div class="container">
        <div class="row text-center">
        <hr>
        <div class="row text-center">
            
<!--            <a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#largeModal">Click to open Modal</a>
        --></div>

    <div class="modal fade" id="billingModal" tabindex="-1" role="dialog" aria-labelledby="billingModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <script>
                  getCity(<?php echo $u_billing_add_modal['state_id']; ?>);
              </script>
            
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Billing Address</h4>
          </div>
          
              <form method="post" action="update_billing_address.php">
                  <div class="modal-body">
           <?php
        $u_billing_add_modal = mysqli_fetch_array(mysqli_query($con,"select * from se_billing_address where billing_address_id=".$u_billing_add_view['billing_address_id']),MYSQLI_BOTH);
        ?>
        <input type="hidden" value='<?php echo $u_billing_add_modal['billing_address_id']?>' name=id>
              <table class="table">
                
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        <center> 
                            <b>
                                <?php echo $_SESSION['nm']?>
                            </b>
                        </center>
                    </th>
                </tr>
                <tr>
                    <td>
                        <b>Address Line 1 </b>  
                    </td>
                    <td>
                        <input class='form-control' name='add_line_1' type='text' value='<?php echo $u_billing_add_modal['add_line_1']?>'>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>Address Line 2</b>
                    </td>
                    <td>
                        <input class='form-control' name='add_line_2' type='text' value='<?php echo $u_billing_add_modal['add_line_2']?>'>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>Zip Code</b>
                    </td>
                    <td>
                        <input class='form-control' name='zip_code' type='number' value='<?php echo $u_billing_add_modal['zip_code']?>'>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>City</b>
                    </td>
                    <td>
                        <span id='cities'> Select State</span>
                        
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>State</b>
                    </td>
                    <?php
include_once './database_layer.php';
$state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_billing_add_modal['state_id']),MYSQLI_BOTH);
?><td>
                    <select name="state" onchange="getCity(this.value);" class=form-control>
                        <option value=<?php echo $u_billing_add_modal['state_id'];?> selected="selected"><?php echo $state_name['state_name'];?></option>
                        <option value='0'><<--Select Another-->> </option>
                        
                                                                    <?php
                                                                    $result = stateDropdown($con);
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
                                        $i++;
                                        echo "<option value='$i'>$row[0]</option>";
                                    }

                                                                    ?>
                                                                </select>
<!--                    <td>
                        <?php $state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_billing_add_modal['state_id']),MYSQLI_BOTH); echo "<input class='form-control' name='state' type='text' value=".$state_name['state_name'].">"; ?>
                    </td>-->
    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>Country</b>
                    </td>
                    <td>
                    <center> 
                            <b>
                                <?php echo $u_billing_add_modal['country']?>
                            </b>
                        </center>
                </td>
                        
                    
                </tr>
               
            </table>
                  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
            </form>
        </div>
      </div>
    </div>

    
        </div>
    </div>


<div class="container">
        <div class="row text-center">
        <hr>
        <div class="row text-center">
            
<!--            <a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#largeModal">Click to open Modal</a>
        --></div>

    <div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="shippingModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <form method="post" action="update_shipping_address.php">
        <div class="modal-content">
            <script>
            getCities(<?php echo $u_billing_add_modal['state_id']; ?>);
            </script>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Shipping Address</h4>
          </div>
          <div class="modal-body">
              
           <?php
        $u_shipping_add_modal = mysqli_fetch_array(mysqli_query($con,"select * from se_shipping_address where shipping_id=".$u_shipping_add_view['shipping_id']),MYSQLI_BOTH);
        ?>
             <input type="hidden" value='<?php echo $u_shipping_add_view['shipping_id']?>' name=id> 
            <table class="table">
                
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        <center> 
                            <b>
                                <?php echo $_SESSION['nm']?>
                            </b>
                        </center>
                    </th>
                </tr>
                <tr>
                    <td>
                        <b>Address Line 1  </b>  
                    </td>
                    <td>
                        <input class='form-control' name='add_line_1'  type='text' value='<?php echo $u_shipping_add_modal['add_line_1']?>'>
                    </td>
                </tr>
                
                <tr>
                    <td>
                       <b> Address Line 2</b>
                    </td>
                    <td>
                        <input class='form-control' name='add_line_2'  type='text' value='<?php echo $u_shipping_add_modal['add_line_2']?>'>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>Zip Code</b>
                    </td>
                    <td>
                        <input class='form-control' name='zip_code'  type='number' value='<?php echo $u_shipping_add_modal['zip_code']?>'>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>City</b>
                    </td>
                    <td>
                        <span id='city'> Select State</span>
                        
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>State</b>
                    </td>
                    <?php

$state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_shipping_add_modal['state_id']),MYSQLI_BOTH);
?><td>
                    <select name="state" onchange="getCities(this.value);" class=form-control>
                        <option value=<?php echo $u_billing_add_modal['state_id'];?> selected="selected"><?php echo $state_name['state_name'];?></option>
                        <option value='0'><<--Select Another-->> </option>
                        
                                                                    <?php
                                                                    $result = stateDropdown($con);
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
                                        $i++;
                                        echo "<option value='$i'>$row[0]</option>";
                                    }

                                                                    ?>
                                                                </select>
<!--                    <td>
                        <?php $state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_billing_add_modal['state_id']),MYSQLI_BOTH); echo "<input class='form-control' name='state' type='text' value=".$state_name['state_name'].">"; ?>
                    </td>-->
    </td>
                </tr>
                
                <tr>
                    <td>
                        <b> Country </b>
                    </td>
                    <td>
                        <?php echo $u_shipping_add_modal['country']?>
                    </td>
                </tr>
               
            </table>
                  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
          </form>
      </div>
    </div>

    
        </div>
    </div>


<?php include 'footer.php'; ?>
<!--</div>
	-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="tetext/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/classie.js"></script>
        <script type="text/javascript" src="js/simpleZoom.js"></script>
        <script type="text/javascript">
        $(function(){
                $("#show").simpleZoom({
                        zoomBox : "#zoom",
                        markSize : [120, 169],
                        zoomSize : [240, 338],
                        zoomImg : [480, 677]
                });
        });
        </script>
        <script type="text/javascript" src="js/uisearch.js"></script>
        <script>
			new UISearch( document.getElementById( 'sb-search' ) );
		</script>
        
        <script type="text/javascript" src="js/modernizr.js"></script>
        
        <script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        
        <script type="text/javascript">
    (function($){
	$(document).ready(function(){
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery);
</script>
        <script>
            (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

$(function(){

  $('#new-review').autosize({append: "\n"});

  var reviewBox = $('#post-review-box');
  var newReview = $('#new-review');
  var openReviewBtn = $('#open-review-box');
  var closeReviewBtn = $('#close-review-box');
  var ratingsField = $('#ratings-hidden');

  openReviewBtn.click(function(e)
  {
    reviewBox.slideDown(400, function()
      {
        $('#new-review').trigger('autosize.resize');
        newReview.focus();
      });
    openReviewBtn.fadeOut(100);
    closeReviewBtn.show();
  });

  closeReviewBtn.click(function(e)
  {
    e.preventDefault();
    reviewBox.slideUp(300, function()
      {
        newReview.focus();
        openReviewBtn.fadeIn(200);
      });
    closeReviewBtn.hide();

  });

  $('.starrr').on('starrr:change', function(e, value){
    ratingsField.val(value);
  });
});

        </script>

        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="tetext/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/classie.js"></script>
        <script type="text/javascript" src="js/uisearch.js"></script>
        <script>
			new UISearch( document.getElementById( 'sb-search' ) );
		</script>

    </body>
</html>