<!DOCTYPE html>


<script>
//function alertfunc()
//{
//    alert("hii");
//}
</script>
    
    <?php

header('Cache-Control: no cache'); //no cache
session_cache_limiter('must-revalidate');

session_start();

require_once 'connection_file_user.php';






$cartSelect = mysqli_query($con,"Select * From carttable");
if (mysqli_num_rows($cartSelect) > 0) {

    $doc = new DOMDocument( );
    $ele = $doc->createElement('productInfo');
    $doc->appendChild($ele);


    while ($cartInfo = mysqli_fetch_array($cartSelect,MYSQLI_BOTH)) {
        $pid = $cartInfo['product_id'];
        $cid = $cartInfo['product_combo_id'];
        $qty = $cartInfo['quantity'];
        if($cid==null)
        {
            $ele1 = $doc->createElement('pid');
            $ele1->nodeValue = $pid;
            $ele->appendChild($ele1);

            $ele2 = $doc->createElement('quantity');
            $ele2->nodeValue = $qty;
            $ele->appendChild($ele2);
        }
        else
        {
            $ele1 = $doc->createElement('cid');
            $ele1->nodeValue = $cid;
            $ele->appendChild($ele1);

            $ele2 = $doc->createElement('quantity');
            $ele2->nodeValue = 1;
            $ele->appendChild($ele2);
        }
    }

    $doc->save('OrderproductInfo.xml');

    $data = file_get_contents('OrderproductInfo.xml');
} else {
    $data = 'null';
}

$bid = 2;
$uid = $_SESSION['u_id'];


date_default_timezone_set('Asia/Calcutta');
$cd = date('Y-m-d H:i:s');

$insertOrderDetails = mysqli_query($con,"INSERT INTO se_orders values(null ,'$data' , $uid , '$cd' , 'Dispatched' , 0 , 'COD' , $bid)");
if( $insertOrderDetails)
{
    //echo "Insert Huyaaaaaaaa";
}
else
{
echo "<br><br><br>Error ".mysqli_error();
}

$re=  mysqli_fetch_array(mysqli_query($con,"SELECT max(order_id) FROM se_orders"),MYSQLI_BOTH);





$updateStockSelect = mysqli_query($con,"Select * from carttable");
//echo "<br> select * from CartTable";
if(mysqli_num_rows($updateStockSelect) > 0)
{
    while ($productID = mysqli_fetch_array($updateStockSelect,MYSQLI_BOTH)) {
        $pid = $productID['product_id'];
        $cid = $productID['product_combo_id'];
        $qty = $productID['quantity'];



        $_SESSION['prod'] = $pid;

        $_SESSION['qty']=$qty;

       



        if($cid==NULL)
        {
            //echo "<br> CID is NULL";
            $productStock = mysqli_query($con,"Select * from se_product where product_id=$pid");
            while ($getStock = mysqli_fetch_array($productStock,MYSQLI_BOTH)) {
                $stock = $getStock['stock_quantity'];
                //echo 'Stock '.$stock;
                $pname=$getStock['product_name'];
                $stock = $stock-$qty;
//        echo 'Updated Stock :'.$stock;
            $updateStock = mysqli_query($con,"UPDATE se_product SET stock_quantity=$stock where product_id=$pid");
            }
        }
        else
        {
            //echo "<br> PID is NULL";
            $productStock = mysqli_query($con,"Select * from se_combo_offer where combo_id=$cid");
            while ($getcombo_id = mysqli_fetch_array($productStock,MYSQLI_BOTH)) {
               
                $pid=$getcombo_id['product_combo_id'];
                if($pid==null)
                {
                    $pid=$getcombo_id['product_service_combo_id'];
                    //echo "<br> product_service_combo";
                    $query = mysqli_fetch_array(mysqli_query($con,"select * from se_product_service_combo where product_service_combo_id=".$pid),MYSQLI_BOTH);
                    $comboAttributes = $query['product_service_ids'];
                    
                    file_put_contents("product_service_combo.xml", $comboAttributes);
                    $combo_ids = simplexml_load_file('product_service_combo.xml');
                    $p_id_count = count($combo_ids->p_id);
                    for($i=0;$i<$p_id_count;$i++)
                    {
                        $p_id = $combo_ids->p_id[$i];
                        $productquery = mysqli_fetch_array(mysqli_query($con,"select stock_quantity from se_product where product_id = ".$p_id),MYSQLI_BOTH);
                        $stck = $productquery['stock_quantity'];
                        $stck = $stck-$qty;
                        //echo "<br><Br>Yeah";
                        $updateStock = mysqli_query($con,"UPDATE se_product SET stock_quantity=$stck where product_id=$p_id");
                    }
                    
                }
                else
                {
                    //echo "<br> product_combo";
                    $query = mysqli_fetch_array(mysqli_query($con,"select * from se_product_combo where product_combo_id=".$pid),MYSQLI_BOTH);
                    $comboAttributes = $query['product_info'];
                    
                    file_put_contents("product_combo.xml", $comboAttributes);
                    $combo_ids = simplexml_load_file('product_combo.xml');
                    $p_id_count = count($combo_ids->pid);
                    //echo "<br> pid Cpunt is ".$p_id_count;
                    for($i=0;$i<$p_id_count;$i++)
                    {
                        $p_id = $combo_ids->pid[$i];
                        $productquery = mysqli_fetch_array(mysqli_query($con,"select stock_quantity from se_product where product_id = ".$p_id),MYSQLI_BOTH);
                        $stck = $productquery['stock_quantity'];
                        $stck = $stck-$qty;
                        echo "<br><Br>Yeah";
                        $updateStock = mysqli_query($con,"UPDATE se_product SET stock_quantity=$stck where product_id=$p_id");
                    }
                    
                }
                
                
            
            }
        }
//        echo $updateStock;
    }
}
else
{
    echo 'No Stock To Update';
}


























$uid=$_SESSION['u_id'];

$selectqueryID = mysqli_query($con,"Select * from se_user where u_id=".$uid);

if (mysqli_num_rows($selectqueryID) > 0) {
    while ($row11 = mysqli_fetch_array($selectqueryID,MYSQLI_BOTH)) {

        $email=$row11['u_emailid'];
    }
}
$_SESSION['email']=$email;



//$billIdSelect = mysqli_query("Select bill_id from se_bill_details where u_id = '$uid'");
$selectquery = mysqli_query($con,"Select * from se_orders where u_id=".$uid);

while ($billIdFetch = mysqli_fetch_array($selectquery,MYSQLI_BOTH)) {
    $oid = $billIdFetch['order_id'];
}


$_SESSION['order_id']=$oid;
$_SESSION['u_id']=$uid;
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome-4.0.3/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/nav_stylesheet.css" />
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <style>
    
        .paypal-button
        {
            padding-top: 10px;
            padding-left: 1000px;
        }
    
    </style>
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
<div class="container">

<div class="page-header">
    <h1><center>Invoice</center></h1>
</div>

<!-- Simple Invoice - START -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <i class="fa fa-search-plus pull-left icon"></i>
                
                <h2>Invoice for purchase #100<?php echo $_SESSION['order_id'];?></h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Billing Details</div>
                        <div class="panel-body">
                            
                            <strong><?php $uname=mysqli_fetch_array(mysqli_query($con,"Select * from se_user where u_id=".$uid),MYSQLI_BOTH);echo $uname['u_fname'];?>:</strong><br>
                            <?php $address=mysqli_fetch_array(mysqli_query($con,"Select * from se_billing_address where u_id=".$uid),MYSQLI_BOTH);echo $address['add_line_1'];?><br>
                            <?php echo $address['add_line_2'];?><br>
                            <?php $city=mysqli_fetch_array(mysqli_query($con,"Select * from se_billing_address where u_id=".$uid),MYSQLI_BOTH);
                            $cityadd= $city['city_id'];
                            $cityname=mysqli_fetch_array(mysqli_query($con,"Select * from se_city where city_id=".$cityadd),MYSQLI_BOTH);
                            echo $cityname['city_name'];
                            ?><br>
                            <strong><?php echo $address['zip_code'];?></strong><br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Payment Information</div>
                        <div class="panel-body">
                            <strong>Card Name:</strong> Visa<br>
                            <strong>Card Number:</strong> ***** 332<br>
                            <strong>Exp Date:</strong> 09/2020<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Order Preferences</div>
                        <div class="panel-body">
                            <strong>Gift:</strong> No<br>
                            <strong>Coupon:</strong> No<br>
                            <strong>Refund:</strong> No<br>
                            <strong>Order Cancellation:</strong> No<br>
                            <strong>Order Date:</strong> <?php echo date('Y-m-d') ?><br>
                            <strong>Order Time:</strong> <?php
                            date_default_timezone_set('Asia/Calcutta');
                            echo date('H:i:s');?><br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Shipping Address</div>
                        <div class="panel-body">
                            <strong><?php $uname=mysqli_fetch_array(mysqli_query($con,"Select * from se_user where u_id=".$uid),MYSQLI_BOTH);echo $uname['u_fname'];?>:</strong><br>
                            <?php $address=mysqli_fetch_array(mysqli_query($con,"Select * from se_shipping_address where u_id=".$uid),MYSQLI_BOTH);echo $address['add_line_1'];?><br>
                            <?php echo $address['add_line_2'];?><br>
                            <?php $city=mysqli_fetch_array(mysqli_query($con,"Select * from se_shipping_address where u_id=".$uid),MYSQLI_BOTH);
                            $cityadd= $city['city_id']; 
                            $cityname=mysqli_fetch_array(mysqli_query($con,"Select * from se_city where city_id=".$cityadd),MYSQLI_BOTH);
                            echo $cityname['city_name'];
                            ?><br>
                            <strong><?php echo $address['zip_code'];?></strong><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                                            $total = 0;
                                            $subtotal = 0;
                                            $fetchproduct = mysqli_query($con,"Select * from carttable");
                                            if (mysqli_num_rows($fetchproduct) == 0) {
                                                echo '<h1><center>No Products Selected</center></h1>';
                                               ?>
                                    <script>
                                        $(document).ready(function(){
//                                            alert("hie");
                                            $("#placeOrder").prop("disabled", true);
                                        });
                                        </script>
                                                <?php
                                            } else {
                                                ?> 
                                                    <table class="table table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>Item</strong></td>
                                                            <td><strong>Item Name</strong></td>
                                                            <td class="text-center"><strong>Item Price</strong></td>
                                                            <td class="text-center"><strong>Item Quantity</strong></td>
                                                            <td class="text-right"><strong>Total(Rs.)</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    
                                                    <?php

                                                while ($cartproduct = mysqli_fetch_array($fetchproduct,MYSQLI_BOTH)) {
                                                    $pid = $cartproduct[2];
                                                    $cid = $cartproduct[3];
                                                    $qty = $cartproduct[4];
                                                    $price = $cartproduct[5];
                                                    if($cid==null)
                                                    {
                                                                    $productinfo = mysqli_query($con,"Select * from se_product where product_id = $pid");

                                                                while ($eachProductInfo = mysqli_fetch_array($productinfo,MYSQLI_BOTH)) {


                                                                ?>
                                                                <tr>
                                                                    <?php
                                                //$data1=$eachProductInfo['product_img_path_1'];
                                                //$xml1=new SimpleXMLElement($data1);
                                                                    $img = $eachProductInfo['product_image_path_1'];
                                            ?>
                                                                    <td><img src = "<?php echo $img?>" alt = "" height="100" width="100" class="img-responsive"></td>
                                                                    <td><?php echo $eachProductInfo[1]; ?></td>
                                                                    <td class="text-center"><?php echo $price; ?></td>
                                                                    <td class="text-center"><?php echo $qty; ?></td>
                                                                    <td class="text-right"><?php  $total = $price*$qty; 
                                                                    echo $total;?></td>
                                                                </tr>

                                                            <?php }  
                                                    }
                                                    else
                                                    {
                                                                    $productinfo = mysqli_query($con,"Select * from se_combo_offer where combo_id = $cid");

                                                                while ($eachProductInfo = mysqli_fetch_array($productinfo,MYSQLI_BOTH)) {


                                                                ?>
                                                                <tr>
                                                                    <?php
                                                //$data1=$eachProductInfo['product_img_path_1'];
                                                //$xml1=new SimpleXMLElement($data1);
                                                                    
                                            ?>
                                                                    <td><img src = 'http://placehold.it/100x100' alt = "" class="img-responsive"></td>
                                                                    <td><?php echo $eachProductInfo[4]; ?></td>
                                                                    <td class="text-center"><?php echo $price; ?></td>
                                                                    <td class="text-center"><?php echo 1; ?></td>
                                                                    <td class="text-right"><?php  $total = $price; 
                                                                    echo $total;?></td>
                                                                </tr>

                                                            <?php }  
                                                    }    ?>
        <!--                                            <tr>
                                                        <td>Samsung Galaxy S5 Extra Battery</td>
                                                        <td class="text-center">$30.00</td>
                                                        <td class="text-center">1</td>
                                                        <td class="text-right">$30.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Screen protector</td>
                                                        <td class="text-center">$7</td>
                                                        <td class="text-center">4</td>
                                                        <td class="text-right">$28</td>
                                                    </tr>-->
                                            <?php $subtotal = $subtotal + $total;}}

                                            $_SESSION['total']=$subtotal;
                                            ?>
                                                    <tr>
                                                        <td class="highrow"></td>
                                                        <td class="highrow"></td>
                                                        <td class="highrow"></td>
                                                        <td class="highrow text-center"><strong>Subtotal</strong></td>
                                                        <td class="highrow text-right"><?php echo "Rs.  ".$subtotal; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                                        <td class="emptyrow text-right">0</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow text-center"><strong>Total</strong></td>
                                                        <td class="emptyrow text-right"><?php echo "Rs.  ".$subtotal; ?></td>
                                                    </tr>
                                                </tbody>
                                            
                                            </table>
                                   <button type="button" id="placeOrder" class="btn btn-primary " onclick="window.history.go(-1)" ><b>Go Back</b></button>
                                <button type="button" id="placeOrder" class="btn btn-primary " onclick="window.location.replace('./SMTP.php')" style="float: right;"><b>Cash On Delivery</b></button>
                               <?php
                               //session_start();
//$co = $_SESSION['co'];
//echo "Count ius ".$co;


        $pid=$_SESSION['prod'];
        $qty=$_SESSION['qty'];
        $subtotal=$_SESSION['total'];

        //$con = mysqli_connect("localhost","root","","sai_enterprise") or die("connection fail");


        //echo $pid;

        $result=mysqli_query($con,"SELECT * FROM se_product where product_id=".$pid);
        while($query= mysqli_fetch_array($result,MYSQLI_BOTH))
        {
            $pname=$query['product_name'];
        $amt=$query['product_selling_price'];
            
        }
       



?>

                                <script async="async" src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=anant.lalchandani-facilitator@gmail.com"
    data-button="buynow"
   

     

                data-name="<?php echo $pname;?>"
                data-quantity="<?php echo $qty;?>"
                data-amount="<?php echo $amt;?>"

                data-env="sandbox"
   
></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
</style>

<!-- Simple Invoice - END -->

</div>
<?php include 'footer.php'; ?>
</body>
</html>