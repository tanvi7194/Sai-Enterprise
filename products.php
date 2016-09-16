<?php
session_start();
require_once 'connection_file_user.php';

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products | Sai Enterprise</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        
       
        <link rel="stylesheet" type="text/css" href="css/Custom/jquery.range.css">
        <link rel="stylesheet" type="text/css" href="css/Custom/nav_stylesheet.css" />
            <script type="text/javascript">
                function selectCategory()
                {
                    alert("hello");
                    var categoryarr = new Array();
                i = 0;
                if (document.getElementById('type1').checked == true)
                {
                    
                    categoryarr[i] = document.getElementById('type1').value;

                    i++;
                }
                if (document.getElementById('type2').checked == true)
                {
                    categoryarr[i] = document.getElementById('type2').value;

                    i++;
                }
                if (document.getElementById('type3').checked == true)
                {
                    categoryarr[i] = document.getElementById('type3').value;

                    i++;
                }
                if (document.getElementById('type4').checked == true)
                {
                    categoryarr[i] = document.getElementById('type4').value;
                    i++;

                }
                if (document.getElementById('type5').checked == true)
                {
                    categoryarr[i] = document.getElementById('type5').value;
                    i++;

                }
                if (document.getElementById('type6').checked == true)
                {
                    categoryarr[i] = document.getElementById('type6').value;
                    i++;

                }
                if (document.getElementById('type7').checked == true)
                {
                    categoryarr[i] = document.getElementById('type7').value;
                    

                }

                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                       
                        document.getElementById("displayItems").innerHTML = xmlhttp.responseText;

                    }

                }
                xmlhttp.open("GET", "getFilterTypeCategory.php?value=" + JSON.stringify(categoryarr), true);
                xmlhttp.send();

                }

                


                function ExcludeOutOfStock()
                {
                    if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        document.getElementById("displayItems").innerHTML = xmlhttp.responseText;

                    }

                }
                xmlhttp.open("GET", "getFilterExcludeOutOfStock.php", true);
                xmlhttp.send();

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
    <body background="white_wall_hash.png">
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
<!--Main header ends-->

        <div class="container">
	<div class="row"><!--Main Row-->
            <div class="col-lg-3 col-sm-3">
                <!--Categories-->
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>CATEGORIES</h5>
                        </div>
                          <div class="panel-body">
                              <?php 
                         
                              if(isset ($_GET["id"]))
                              {
                                 $pid = $_GET["id"];
                                if($pid == 1)
                                {
                              ?>
                              <input type="checkbox" name="type1" id="type1" value="1" checked="checked" onclick="selectCategory()"> AntiVirus<br>
                              <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                              <script>
                              
                                          $(document).find(":checkbox").each(function(){
                                                if ($(this).prop('checked')==true){
                                                    selectCategory();
                                                }
                                            });

                              </script>
                                        <input type="checkbox" name="type2" id="type2" value="2" onclick="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" onclick="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" onclick="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5" onclick="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" onclick="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" onclick="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" onclick="selectCategory()"> UPS<br>
                          <?php }
                                else if($pid == 2)
                                {
                          ?>
                              <input type="checkbox" name="type1" id="type1" value="1" onchange="selectCategory()"> AntiVirus<br>
                              <input type="checkbox" name="type2" id="type2" checked="checked" value="2" onchange="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" onchange="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" onchange="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5" onchange="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" onchange="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" onchange="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" onchange="selectCategory()"> UPS<br>
                         <?php }
                              else if($pid == 3)
                              {
                         ?>
                            <input type="checkbox" name="type1" id="type1" value="1" onchange="selectCategory()"> AntiVirus<br>
                                        <input type="checkbox" name="type2" id="type2" value="2" onchange="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" checked="checked" onchange="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" onchange="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5" onchange="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" onchange="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" onchange="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" onchange="selectCategory()"> UPS<br>
                        <?php } 
                              else if($pid == 4)
                              {
                        ?>
                               <input type="checkbox" name="type1" id="type1" value="1" onchange="selectCategory()"> AntiVirus<br>
                                        <input type="checkbox" name="type2" id="type2" value="2" onchange="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" onchange="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" checked="checked" onchange="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5" onchange="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" onchange="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" onchange="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" onchange="selectCategory()"> UPS<br>
                            <?php }
                                else if($pid == 5)
                                {
                            ?>
                                         <input type="checkbox" name="type1" id="type1" value="1" onchange="selectCategory()"> AntiVirus<br>
                                        <input type="checkbox" name="type2" id="type2" value="2" onchange="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" onchange="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" onchange="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5" checked="checked" onchange="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" onchange="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" onchange="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" onchange="selectCategory()"> UPS<br>
                          <?php }
                                else if($pid == 6)
                                {
                          ?>
                                        <input type="checkbox" name="type1" id="type1" value="1" onchange="selectCategory()"> AntiVirus<br>
                                        <input type="checkbox" name="type2" id="type2" value="2" onchange="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" onchange="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" onchange="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5"  onchange="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" checked="checked" onchange="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" onchange="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" onchange="selectCategory()"> UPS<br>

                         <?php } 
                                else if($pid == 7)
                                {
                         ?>
                                        <input type="checkbox" name="type1" id="type1" value="1" onchange="selectCategory()"> AntiVirus<br>
                                        <input type="checkbox" name="type2" id="type2" value="2" onchange="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" onchange="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" onchange="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5" onchange="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" onchange="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" checked="checked" onchange="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" onchange="selectCategory()"> UPS<br>

                              <?php }
                                    else if($pid == 8)
                                    {
                              ?>
                                    <input type="checkbox" name="type1" id="type1" value="1" onchange="selectCategory()"> AntiVirus<br>
                                        <input type="checkbox" name="type2" id="type2" value="2" onchange="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" onchange="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" onchange="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5" onchange="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" onchange="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" onchange="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" checked="checked" onchange="selectCategory()"> UPS<br>
                              <?php } ?>


           <?php } ?>


                                        <?php

                                        if(isset($_GET["val"]))
                                        {
                                        ?>
                                        <input type="checkbox" name="type1" id="type1" value="1" onchange="selectCategory()"> AntiVirus<br>
                                        <input type="checkbox" name="type2" id="type2" value="2" onchange="selectCategory()"> Router<br>
                                        <input type="checkbox" name="type3" id="type3" value="3" onchange="selectCategory()"> Pendrive<br>
                                        <input type="checkbox" name="type4" id="type4" value="4" onchange="selectCategory()"> MotherBoard<br>
                                        <input type="checkbox" name="type5" id="type5" value="5" onchange="selectCategory()"> External_HDD<br>
                                        <input type="checkbox" name="type6" id="type6" value="6" onchange="selectCategory()"> Laptop<br>
                                        <input type="checkbox" name="type7" id="type7" value="7" onchange="selectCategory()"> Printer<br>
                                        <input type="checkbox" name="type7" id="type8" value="8" onchange="selectCategory()"> UPS<br>
                                        <?php
                                        }
                                        ?>
                          </div>
                        </div>

                    </div>
                </div>
            <!--/Categories-->
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h4>Price Range</h4>
                        <br>
                        <input type="hidden" id="range" class="slider-input" value="40000"/>
                        <div id="mydiv"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h4>Availability</h4>
                        <br>
                        <input type="checkbox" name="exc_stock" id="type7" value="Exclude Stock" onchange="ExcludeOutOfStock()"> Exclude Out-of Stock<br>
                        <div id="mydiv"></div>
                    </div>
                </div>

            </div>

            <div class="col-lg-9 col-sm-9" id="displayItems">
		

                <div class="row"><!--main row for grid-->
<!--            <div class="ib-container" id="ib-container">-->
<?php
                require_once 'connection_file_user.php';

                $query = mysqli_query($con,"select * from se_product");
                $count = mysqli_num_rows($query);
                if($count > 0)
                {
while($data = mysqli_fetch_array($query,MYSQLI_BOTH))
                                {
                    


?>
            


			<div class="productbox col-sm-4">
                            
				<div class="imgthumb img-responsive">
                                    <img class="img" src="<?php echo $data['product_image_path_1']; ?>" height="300" width="250">
				</div>
				<div class="caption">
					<h5><?php echo $data["product_name"]; ?></h5>
                  	<s class="text-muted">&#8377; <?php echo $data["product_mrp"]; ?></s> <b class="finalprice">&#8377; <?php echo $data["product_selling_price"]; ?></b>
                  
                   
                        <form method="POST" action="product_details.php">
                            <input type="hidden" value='<?php echo $data['product_id']; ?>' name='pid' id='pid'/>
                            <input type="submit" value="Buy Now" class="btn btn-success btn-md btn-block">
                      
                        </form>
                    
                                </div>
              	</div>
                            <?php
                                //$query2 = mysqli_query($con,"select * from se_discount");
                            ?>
<!--              	<div class="saleoffrate">
                  <b>90%</b><br>OFF
              	</div>
			</div>
		</div>-->
                <?php
                                }
                }
                else
                {
                    ?>
                <span id="nopro">NO PRODUCT AVAILABLE FOR THIS CATEGORY</span>
                <?php
                }
                
                ?>

                        </div><!--col for catalog-->
                        
	</div><!--/Main row-->
</div><!--/container -->
</div>
       
<br>
<?php include 'footer.php'; ?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="tetext/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

 <script type="text/javascript" src="js/classie.js"></script>
 <script type="text/javascript" src="js/jquery.range.js"></script>
 <script type="text/javascript">
 $('.slider-input').jRange({
    from: 0,
    to: 50000,
    step: 1,
    scale: [0,50000],
    format: '%s',
    width: 258,
    showLabels: true,
    isRange : true,
    theme: "theme-blue",
    onstatechange: function()
    {
        var a=document.getElementById("range").value;
//        $(document).ready(function(){
////    $("button").click(function(){
//        $("#displayItems").load("getFilterPrice.php?value=" + a);
////    });
//});


//    $("button").click(function(){
//               $('#stage').load('getFilterPrice.php?value=' + a);
//            });
//
//

                    var a=document.getElementById("range").value;

                    if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        document.getElementById("displayItems").innerHTML = xmlhttp.responseText;

                    }

                }
                xmlhttp.open("GET", "getFilterPrice.php?value=" + a, true);
                xmlhttp.send();

    }
   
});

 </script>
        <script type="text/javascript" src="js/uisearch.js"></script>
        <script>
			new UISearch( document.getElementById( 'sb-search' ) );
		</script>

		<script type="text/javascript">
			$(function() {

				var $container	= $('#ib-container'),
					$articles	= $container.closest('div'),
					timeout;

				$articles.on( 'mouseenter', function( event ) {

					var $article	= $(this);
					clearTimeout( timeout );
					timeout = setTimeout( function() {

						if( $article.hasClass('active') ) return false;

						$articles.not( $article.removeClass('blur').addClass('active') )
								 .removeClass('active')
								 .addClass('blur');

					}, 65 );

				});

				$container.on( 'mouseleave', function( event ) {

					clearTimeout( timeout );
					$articles.removeClass('active blur');

				});

			});
		</script>
    </body>
</html>