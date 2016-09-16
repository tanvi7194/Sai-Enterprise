<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Product Details | Sai Enterprise</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<!--        <link href="css/prettyPhoto.css" rel="stylesheet">
        <link href="css/price-range.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
-->        <link href="css/main.css" rel="stylesheet"><!--
        <link href="css/responsive.css" rel="stylesheet">-->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    </head>
    <body>




        <?php
        session_start();

        require_once 'connection_file_user.php';
        
        $uid = $_SESSION['u_id'];
        //echo $uid;
        $total = 0;
        $subtotal = 0;
        $fetchproduct = mysqli_query($con,"Select * from se_wishlist WHERE u_id=$uid");
        //echo $fetchproduct."<br>";
        if(mysqli_num_rows($fetchproduct)==1)
        {
            
       while ($row = mysqli_fetch_array($fetchproduct,MYSQLI_BOTH)) {
           
            $data = $row['product_info'];
        
            //echo "<br>DATA".$data;
        $xmlCheck1 = file_put_contents("d.xml",$data);
        $xmlCheck = simplexml_load_file("d.xml");
        $count = count($xmlCheck->p_id);
        //echo "COUNU is ".$count;
        }
        
       
      //  echo $count;
  
     if($count!=0)
     {
?>
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description">Name</td>
                    <td class="description">Price</td>
                    
                    <td></td>
                </tr>
            </thead>
            <tbody>
        <?php
        $wishlistProduct = mysqli_query($con,"Select * from se_wishlist WHERE u_id='$uid'");
        //echo $wishlistProduct."<br>";
        while ($wproduct = mysqli_fetch_array($wishlistProduct,MYSQLI_BOTH)) {
    
    $userid = $wproduct[1];
    // echo "user" . $userid."<br>";
    $productid = $wproduct[2];
    
    $xml=new SimpleXMLElement($productid);
    $count = count($xml->p_id);
    //echo $count;
    $x=0;
    foreach ($xml->children() as $parent)
        {
        $pid=$xml->p_id[$x];
//        echo $pid;
    
//    foreach ()
    $productinfo = mysqli_query($con,"Select * from se_product where product_id = '$pid'");

    while ($eachProductInfo = mysqli_fetch_array($productinfo,MYSQLI_BOTH)) {
        ?>

                        <tr>
                            <td>
                                <?php 
                                
                                //$data1=$eachProductInfo['product_image_path_1'];
                                
                                //$xml1=new SimpleXMLElement($data1);
                                ?>
                                <a href = ""><img src = "<?php echo $eachProductInfo['product_image_path_1'];?>" alt = "" height="50" width="100" class="img-responsive"></a>
                            </td>
                            <td>
                                <h4><a href = ""><?php echo $eachProductInfo[1]; ?></a></h4>
                                <p>Product ID: <?php echo $eachProductInfo[0]; ?></p>
                            </td>
                            <td>
                                <p><?php $selectDiscount = mysqli_query($con,"Select * from se_discount where product_id='$pid'");


                                        if (mysqli_num_rows($selectDiscount) > 0) {

                                            while ($selectDiscountvalue = mysqli_fetch_array($selectDiscount,MYSQLI_BOTH)) {
                                                date_default_timezone_set('Asia/Calcutta');
                                                $cd = date('Y-m-d');
//                                                echo "valid from " . $selectDiscountvalue['valid_from'];
//                                                echo "valid to " . $selectDiscountvalue['valid_to'];


                                                if (strtotime($cd) >= strtotime($selectDiscountvalue['valid_from'])) {

                                                    if (strtotime($selectDiscountvalue['valid_to']) >= strtotime($cd)) {
//                                                        echo '1';
                                                        //echo "<br>Discount " . $selectDiscountvalue['product_discount(%)'] . " %<br><br>";
                                                        $discount = round($eachProductInfo['product_selling_price'] - (($eachProductInfo['product_selling_price'] * $selectDiscountvalue['product_discount_percentage']) / 100), 2);
                                                        ?> <div style='color: #FF496B; font-weight: bolder;'><?php echo $discount; ?> </div>
                                <?php }
                                }
                            }
                        } else {
                        echo $eachProductInfo['product_selling_price'];
                        } ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" id="submitproduct" onclick="wishlistCart(<?php echo $pid;?>,<?php echo $eachProductInfo['product_selling_price']; ?>)">Add To Cart  </button>
                            </td>
                            <td>
                                <a class = "cart_quantity_delete" onclick="deleteWishlist(<?php echo $pid;?>,<?php echo $uid;?>)" ><i class = "fa fa-times"></i></a><br>
                                
<!--                                <a href='product-details.php?pid=<?php echo $pro_id; ?>'>Add To Cart</a>-->
                            </td>
                        </tr>
                        
        <?php }
        
        $x++;
        
    }
    
}
     }
 else {
      echo "<tr><td> Wishlist is Empty </td></tr>";   
     }
?>
                                  
                        
            </tbody>
        </table>
        
        <?php }
        else
        {
            echo "EMPTY";
        }
        
        
        
        ?> 

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="tetext/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="js/price-range.js"></script>
<!--        <script src="js/jquery.scrollUp.min.js"></script>-->
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/main.js"></script>
    </body>

</html>