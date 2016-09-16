<?php
require_once 'connection_file_user.php';
$query = mysqli_fetch_array(mysqli_query($con,"select * from se_user"),MYSQLI_BOTH);
?>


<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
	
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile | Sai Enterprise</title>
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="engine1/style.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/nav_stylesheet.css" />
        
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
                <script type="text/javascript">

             function call(val)
            {
                alert(val);
                var xmlhttp ;
                if(window.XMLHttpRequest)
                    {
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
                        {
                             xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }
                xmlhttp.onreadystatechange=function()
                {
                    
                     if(xmlhttp.readyState==4 && xmlhttp.status==200)
                         {
                                    
                         }
                            
                 }
                xmlhttp.open("GET",'Check_Old_Password.php?passwd='+val, true);
                xmlhttp.send();
            }        
        
            function match_new_password(newpasswd , confirm)
            {
                if(newpasswd && confirm)
                {
                    if(newpasswd == confirm)
                    {
                        alert("Yeah");
                    }
                    else
                    {
                        alert("Lost");
                    }
                }
            }
       
            function getShipCity(id)
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
                            document.getElementById("ship_city").innerHTML = xmlhttp.responseText;
                            //document.getElementById("city").innerHTML = xmlhttp.responseText;
                        }

                      }
                      xmlhttp.open("GET","get_Cities_For_Address.php?id="+id,true);
                      xmlhttp.send();
                    }
                    else
                    {
                        document.getElementById("city").innerHTML = "Select Valid State Name";
                    }
                  
                }
                
                
                function getBillCities(id)
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
                            document.getElementById("bill_city").innerHTML = xmlhttp.responseText;
                        }

                      }
                      xmlhttp.open("GET","get_Cities_For_Address.php?id="+id,true);
                      xmlhttp.send();
                    }
                    else
                    {
                        //document.getElementById("bill_city").innerHTML = "Select Valid State Name";
                    }
                  
                }
                
        </script>
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

    <!--Start Header-->
			<div class="box-content">
				<h4 class="page-header text-center">User Profile</h4>
                                <form class="form-horizontal" role="form" method="post" action="Update_User_Profile_Handler.php" name='profile_form'>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">User ID</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='user_id' value=".$query['u_id']." readonly>";?>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">First Name</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='user_first_name' value=".$query['u_fname'].">";?>
						</div>
					</div>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Last Name</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='user_last_name' value=".$query['u_lname'].">";?>
						</div>
					</div>
					<div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">E-Mail ID</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='user_mail' value=".$query['u_emailid'].">";?>
						</div>
					</div>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Contact Number</label>
						<div class="col-sm-4">
							<?php echo "<input type='number' class='form-control' name='user_contact' value=".$query['u_contact'].">";?>
						</div>
					</div>
                                    <?php
                                    $get_Ques = mysqli_fetch_array(mysqli_query($con,"select * from se_security_ques where security_ques_id=".$query['security_ques_id']),MYSQLI_BOTH);
                                    ?>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Security Question </label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='user_ques' value='".$get_Ques['security_ques']."'>";?>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Security Answer</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='user_ans' value=".$query['security_ans'].">";?>
						</div>
                                    </div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label"></label>
						<div class="col-sm-4">
						<label class="col-sm-8 control-label"></label>	
						</div>
                                       </div>
                                    <!--      SHIPPING ADDRESS              -->
                                    
                                    <?php
                                        $u_shipping_add_view = mysqli_fetch_array(mysqli_query($con,"select * from se_shipping_address where u_id=".$_SESSION['u_id']),MYSQLI_BOTH);
                                     ?>
                                    <input type="hidden" name="ship_id" value=<?php echo $u_shipping_add_view['shipping_id']; ?>>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label"></label>
						<div class="col-sm-4">
						<label class="col-sm-8 control-label">Shipping Address</label>	
						</div>
                                       </div>
                                                
                                        
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Address Line 1</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='s_add_line_1' value='".$u_shipping_add_view['add_line_1']."'>";?>
						</div>
					</div>
                                    
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Address Line 2</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='s_add_line_2' value='".$u_shipping_add_view['add_line_2']."'>";?>
						</div>
					</div>
                                    
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Zip Code</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='s_zip_code' value=".$u_shipping_add_view['zip_code'].">";?>
						</div>
					</div>
                                    
<?php $city_name = mysqli_fetch_array(mysqli_query($con,"select * from se_city where city_id=".$u_shipping_add_view['city_id']),MYSQLI_BOTH); ?>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">City</label>
						<div class="col-sm-4">
                                                    <span id="ship_city"><?php echo "<input type='text' class='form-control' name='s_city' value=".$city_name['city_name'].">";?> </span>
						</div>
					</div>
                                    
 <?php $state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_shipping_add_view['state_id']),MYSQLI_BOTH);  ?>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">State</label>
						<div class="col-sm-4">
							<?php include_once './database_layer.php';
$state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_shipping_add_view['state_id']),MYSQLI_BOTH);
?>
                    <select name="s_state" onchange="getShipCity(this.value);" class=form-control>
                        <option value=<?php echo $u_shipping_add_view['state_id'];?> selected="selected"><?php echo $state_name['state_name'];?></option>
                        <option value='0' disabled="disabled"><<--Select Another-->> </option>
                        
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
    

						</div>
					</div>
                                    
                                    
                                    
                                    
                                    <!--      BILLING ADDRESS              -->
                                    
                                    <?php
                                        $u_billing_add_view = mysqli_fetch_array(mysqli_query($con,"select * from se_billing_address where u_id=".$_SESSION['u_id']),MYSQLI_BOTH);
                                     ?>
                                    <input type="hidden" name="bill_id" value=<?php echo $u_billing_add_view['billing_address_id']; ?>>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label"></label>
						<div class="col-sm-4">
						<label class="col-sm-8 control-label">Billing Address</label>	
						</div>
                                       </div>
                                    
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Address Line 1</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='b_add_line_1' value='".$u_billing_add_view['add_line_1']."'>";?>
						</div>
					</div>
                                    
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Address Line 2</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='b_add_line_2' value='".$u_billing_add_view['add_line_2']."'>";?>
						</div>
					</div>
                                    
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Zip Code</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='b_zip_code' value=".$u_billing_add_view['zip_code'].">";?>
						</div>
					</div>
                                    
<?php $city_name = mysqli_fetch_array(mysqli_query($con,"select * from se_city where city_id=".$u_billing_add_view['city_id']),MYSQLI_BOTH); ?>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">City</label>
						<div class="col-sm-4">
                                                    <input type="hidden" name='b_city' value=<?php echo $u_billing_add_view['city_id'];?>> 
                                                    <span id="bill_city"><?php echo "<input type='text' class='form-control' value=".$city_name['city_name'].">";?> </span>
						</div>
					</div>
                                    
 <?php $state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_billing_add_view['state_id']),MYSQLI_BOTH);  ?>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">State</label>
						<div class="col-sm-4">
							<?php include_once './database_layer.php';
$state_name = mysqli_fetch_array(mysqli_query($con,"select * from se_state where state_id=".$u_billing_add_view['state_id']),MYSQLI_BOTH);
?>
                    <select name="b_state" onchange="getBillCities(this.value);" class=form-control>
                        <option value=<?php echo $u_billing_add_view['state_id'];?> selected="selected"><?php echo $state_name['state_name'];?></option>
                        <option value='0' disabled="disabled"><<--Select Another-->> </option>
                        
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
    

						</div>
					</div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                                
                                    <div class="form-group">
						<div class="row form-group">
						<div class="col-sm-offset-2 col-sm-2 control-label">
							<div class="checkbox">
							<label>
                                                            <input class="col-sm-offset-2 col-sm-2 control-label" type="checkbox" id='chck'> Change Password
								<i class="fa fa-square-o small"></i>
                                                                
							</label>
						</div>
                                                </div>
                                    </div>
                                        <div id='chng_password'>
                                        <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Old Password</label>
						<div class="col-sm-4">
                                                    <input type='password' class='form-control' name='old_passwd' id='old_passwd' onchange="call(this.value)">
						</div>
                                                
					</div>
                                        <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">New Password</label>
						<div class="col-sm-4">
							<input type='password' class='form-control' name='new_passwd' id='new_passwd'>
						</div>
					</div>
                                        <div class="form-group has-success has-feedback">
						<label class="col-sm-offset-2 col-sm-2 control-label">Confirm New Password</label>
						<div class="col-sm-4">
                                                    <input type='password' class='form-control' name='confirm_passwd' id='confirm_passwd' onblur="match_new_password(new_passwd.value , this.value)">
						</div>
					</div>
                                        </div>
                                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-2">
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
                                    </div>
                                </form>
                        </div>
                </div>
        </div>
    </div>
                </div>
        </div>
</div>

<?php include 'footer.php'; ?>
        
         <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="tetext/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(
            function()
    {
        $('#chng_password').hide();
    }        
            
            );
    $('#chck').change(function (){
        if($(this).prop('checked'))
        {
            $('#chng_password').show();
        }
        else
        {
            $('#chng_password').hide();
        }
    });
    
        
        
        </script>
        
<script type="text/javascript" src="js/classie.js"></script>
        <script type="text/javascript" src="js/uisearch.js"></script>
        <script>
			new UISearch( document.getElementById( 'sb-search' ) );
		</script>
    </body>
    
</html>
        
            
