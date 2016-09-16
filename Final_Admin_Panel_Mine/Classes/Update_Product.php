<?php

date_default_timezone_set('Asia/Calcutta');
 $prod_last_update = date('Y-m-d H:i:s');
 
//$data=$_SESSION['data_att'];
//echo $data;



class Update_Product_Class
{
   private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "u686964567_saien";
    
    public $con;
    
    
    public function __construct() {
        $this->con = mysqli_connect($this->db_host , $this->db_username , $this->db_pass, $this->db);
                }

                
    public function update_product_with_both_images($prod_id ,$prod_name , $stock_quant , $prod_desc , $prod_mrp , $prod_sp ,$image1, $image2,$data)
    {
        $prod_last_update = date('Y-m-d H:i:s');
        $update_query = mysqli_query($this->con,"update se_product set product_name='$prod_name', stock_quantity=$stock_quant , product_description='$prod_desc' , product_mrp=$prod_mrp , product_selling_price=$prod_sp , product_image_path_1='$image1' , product_image_path_2='$image2' , product_last_update='$prod_last_update' , product_attribute='$data' where product_id=$prod_id ") or die(mysqli_error());
        //header("location: Manage_Product.php");    
        if($update_query)
        {
            header("location: Manage_Product.php?stock_updated='Product has been updated!!'&status=yes");
        }
        else
        {
            header("location: Manage_Product.php?stock_updated='Product is NOT updated!! Try Again'&status=no");
        }
    }
    
    public function update_product_with_image1($prod_id ,$prod_name  , $stock_quant , $prod_desc , $prod_mrp , $prod_sp ,$image1, $data)
    {
        $prod_last_update = date('Y-m-d H:i:s');
        
        $update_query = mysqli_query($this->con,"update se_product set product_name='$prod_name', stock_quantity=$stock_quant , product_description='$prod_desc' , product_mrp=$prod_mrp , product_selling_price=$prod_sp , product_image_path_1='$image1' , product_last_update='$prod_last_update' , product_attribute='$data' where product_id=$prod_id ") or die(mysqli_error());
        //header("location: Manage_Product.php");
        if($update_query)
        {
            header("location: Manage_Product.php?stock_updated='Product has been updated!!'&status=yes");
        }
        else
        {
            header("location: Manage_Product.php?stock_updated='Product is NOT updated!! Try Again'&status=no");
        }
            
    }

        public function update_product_with_image2($prod_id ,$prod_name  , $stock_quant , $prod_desc , $prod_mrp , $prod_sp ,$image2, $data)
    {
        $prod_last_update = date('Y-m-d H:i:s');
        $update_query = mysqli_query("update se_product set product_name='$prod_name' , stock_quantity=$stock_quant , product_description='$prod_desc' , product_mrp=$prod_mrp , product_selling_price=$prod_sp , product_image_path_2='$image2' , product_last_update='$prod_last_update' , product_attribute='$data' where product_id=$prod_id ") or die(mysqli_error());
        //header("location: Manage_Product.php");    
        if($update_query)
        {
            header("location: Manage_Product.php?stock_updated='Product has been updated!!'&status=yes");
        }
        else
        {
            header("location: Manage_Product.php?stock_updated='Product is NOT updated!! Try Again'&status=no");
        }
    }
    
    public function update_product_without_images($prod_id ,$prod_name  , $stock_quant , $prod_desc , $prod_mrp , $prod_sp , $data)
    {
        $prod_last_update = date('Y-m-d H:i:s');
        $update_query = mysqli_query($this->con,"update se_product set product_name='$prod_name' , stock_quantity=$stock_quant , product_description='$prod_desc' , product_mrp=$prod_mrp , product_selling_price=$prod_sp , product_last_update='$prod_last_update' , product_attribute='$data' where product_id=$prod_id ") or die(mysqli_error());
        //header("location: Manage_Product.php");    
        if($update_query)
        {
            header("location: Manage_Product.php?stock_updated='Product has been updated!!'&status=yes");
        }
        else
        {
            header("location: Manage_Product.php?stock_updated='Product is NOT updated!! Try Again'&status=no");
        }
    }    
    
    public function update_product_stock($prod_id , $stock_quant)
    {
        $update_query = mysqli_query($this->con,"update se_product set stock_quantity=$stock_quant where product_id=$prod_id ") or die(mysqli_error());
        if($update_query)
        {
            header("location: Manage_Stock.php?stock_updated='Stock has been updated!!'&status=yes");
        }
        else
        {
            header("location: Manage_Stock.php?stock_updated='Stock is NOT updated!! Try Again'&status=no");
        }
    }
   
}

