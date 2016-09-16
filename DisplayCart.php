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
        <script src="js/jquery-2.1.1.js"></script>


    </head>

    <body>




        <?php
        session_start();

        require_once 'connection_file_user.php';


        $total = 0;
        $subtotal = 0;
        $fetchproduct = mysqli_query($con,"Select * from carttable where u_id=".$_SESSION['u_id']);                                                   
        if (mysqli_num_rows($fetchproduct) == 0) {
            echo '<h1>CART EMPTY</h1>';
        } else {
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Name</td>
                        <td class="description">Price</td>
                        <td class="price">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($cartproduct = mysqli_fetch_array($fetchproduct,MYSQLI_BOTH)) {
                        $uid=$cartproduct[1];
                        $id = $cartproduct[2];
                        //echo "<br> Product id is ".$id;
                        $c_id = $cartproduct[3];
                        //echo "<br> Service id is ".$c_id;
                        $qty = $cartproduct[4];
                        
                        $price = $cartproduct[5];
                        if($c_id==null)
                        {
                            
                        $productinfo = mysqli_query($con,"Select * from se_product where product_id=". $id);

                        while ($eachProductInfo = mysqli_fetch_array($productinfo,MYSQLI_BOTH)) {
                            ?>

                            <tr>
                                <td>
                                    <?php
//                                    $data1 = $eachProductInfo['product_image_path_1'];
//                                    $xml1 = new SimpleXMLElement($data1);
                                    ?>
                                    <a href = ""><img src = "<?php echo $eachProductInfo['product_image_path_1']; ?>" alt = "" height="100" width="100" class="img-responsive"></a>
                                </td>
                                <td>
                                    <h4><a href = ""><?php echo $eachProductInfo[1]; ?></a></h4>
                                    <p>Web ID: <?php echo $eachProductInfo[0]; ?></p>
                                </td>
                                <td>
                                    <p><?php echo $price; ?></p>
                                </td>
<!--                                <td>
                                    <input type="text" value="<?php echo $qty; ?>" id="Quant" onchange="alert(this.value + <?php echo $id; ?>)" /><br>
                                   
                                </td>-->
                                
                                <td>
                                    
                                    <select id="quantity" onchange="updateQty(this.value , <?php echo $id; ?>)" style="width:50px;background: transparent; border: 0px transparent; ">

                                                <?php
                                                for ($index = 1; $index <= $eachProductInfo['stock_quantity']; $index++) {
                                                    if($qty == $index)
                                                    {
                                                        echo '<option value=' . $index . ' selected = "selected">' . $index . '</option>';
                                                    }
                                                    else
                                                    {
                                                        echo '<option value=' . $index . '>' . $index . '</option>';
                                                    }
                                                    
                                                }
                                                ?>

                                                </select>
                                            
                                </td>
                                <td>
                                    <p class = "cart_total_price" id="total"><?php
                                        $total = $price * $qty;
                                        echo $total;
                                        ?></p>
                                </td>
            <!--                            <td class = "cart_delete">-->
                                <td>
                                    <a class = "cart_quantity_delete" onclick="deletecart(<?php echo $id; ?>)" ><i class = "fa fa-times"></i></a>

                                </td>
                            </tr>

                            <?php
                        }
                        $subtotal = $subtotal + $total;
                         //echo "<br> Product SubTotal is ".$subtotal;
                        }
                        else
                        {
                        $productinfo = mysqli_query($con,"Select * from se_combo_offer where combo_id =$c_id");

                        while ($eachProductInfo = mysqli_fetch_array($productinfo,MYSQLI_BOTH)) {
                            ?>

                            <tr>
                                <td>
                                    <?php
//                                    $data1 = $eachProductInfo['product_image_path_1'];
//                                    $xml1 = new SimpleXMLElement($data1);
                                    ?>
                                    <a href = ""><img src ='http://placehold.it/100x100' alt = "" class="img-responsive"></a>
                                </td>
                                <td >
                                    <h4><a href = ""><?php echo $eachProductInfo[4]; ?></a></h4>
                                    <p>Web ID: <?php echo $eachProductInfo[0]; ?></p>
                                </td>
                                <td>
                                    <p><?php echo $eachProductInfo['combo_amount']; ?></p>
                                </td>
<!--                                <td>
                                    <input type="text" value="<?php echo 1; ?>" id="Quant" onchange="alert(this.value + <?php echo $id; ?>)" /><br>
                                   
                                </td>-->
                                
                                <td>
                                    1
                                </td>
                                <td>
                                    <p class = "cart_total_price" id="total"><?php
                                       $price = $eachProductInfo['combo_amount'];
                                        echo $eachProductInfo['combo_amount'];
                                        ?></p>
                                </td>
            <!--                            <td class = "cart_delete">-->
                                <td>
                                    <a class = "cart_quantity_delete" onclick="deletecart(<?php echo $eachProductInfo[0]; ?>)" ><i class = "fa fa-times"></i></a>

                                </td>
                            </tr>

                            <?php
                        }
                        $subtotal = $subtotal + $price;
                        
                        }    
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $subtotal; ?></td>
                    </tr>          

                </tbody>
            </table>
<?php } ?>


        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="tetext/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="js/price-range.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/main.js"></script>
        
    </body>

</html>