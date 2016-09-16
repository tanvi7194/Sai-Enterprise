<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
//       $servername="localhost";
//        $dbuname="root";
//        $dbpass="";
//
//
//$con = mysqli_connect($servername, $dbuname, $dbpass) or die("Error connecting to server" . mysqli_error());
//$db_select = mysqli_select_db("sai_enterprise") or die("Error connecting to Database" . mysqli_error());

        
$prod_cat=$_POST['product'];

require_once './Classes/Insert_Product.php';

$sel=new Insert_Product_Class();
                $cat_id=$sel->check_category($prod_cat);

                $_SESSION['cat']=$cat_id;
               echo $prod_cat;

//echo $prod.$dimension.$std.$warranty.$memory.$g_engine.$gpu_clock.$stock_quant.$prod_mrp.$prod_sp.$brand_name;
       
            if($prod_cat=='Graphic_Card')
            {
                
                header("Location:AddNewProductGraphicCards.php");
                
            }
            else if($prod_cat=='External_Harddisk')
            {
                header("Location:AddNewProductHDD(External).php");
            }
            else if($prod_cat=='Internal_Harddisk')
            {
                header("Location:AddNewProductHDD(Internal).php");
            }
            else if($prod_cat=='Laptop')
            {
                header("Location:AddNewProductLaptop.php");
            }
            else if($prod_cat=='Mother Board')
            {
                header("Location:AddNewProductMotherBoard.php");
            }
            else if($prod_cat=='Processor')
            {
                header("Location:AddNewProductProcessors.php");
            }
            else if($prod_cat=='Router')
            {
                header("Location:AddNewProduct_Router.php");
            }
            
            
            
        
           
        ?>
    </body>
</html>
