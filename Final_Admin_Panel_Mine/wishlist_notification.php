<script>
    function mail(val)
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
                        alert(xmlhttp.responseText);
                        document.getElementById("").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "wishlist_mail.php?u_id="+val, true);
                xmlhttp.send();
            
    }
</script>



<?php

$stck = $_POST['stock'];
$p_id = $_POST['id'];//$_REQUEST['Product_id'];
session_start();
require_once 'connection_file.php';


$chck_stock = mysqli_fetch_array(mysqli_query($con,"select stock_quantity from se_product where product_id=".$p_id),MYSQLI_BOTH);

if($chck_stock[0]==0)
{

            $query = mysqli_query($con,"SELECT * FROM se_wishlist");
            while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {
                        $id = $row['u_id'];
                        $data = $row['product_info'];

                    $xmlCheck = new SimpleXMLElement($data);
                    $count = count($xmlCheck->p_id);
                    echo "Count ".$count."<br>";
                    for($i=0;$i<$count;$i++)
                    {
                        //echo $xmlCheck->p_id[$i] ." == ".$p_id."<br>";
                        
                        if($xmlCheck->p_id[$i] == $p_id)
                        {
                            echo "<script>mail($id)</script>";
                            
//echo "Match Huyaaaaa";
                        }

                    }

            }

}

$updt_stck  = mysqli_query($con,"update se_product set stock_quantity = $stck where product_id=$p_id");
