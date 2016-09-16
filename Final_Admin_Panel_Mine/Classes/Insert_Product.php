<?php

date_default_timezone_set('Asia/Calcutta');
 $prod_last_update = date('Y-m-d H:i:s');
 
//$data=$_SESSION['data_att'];
//echo $data;

//$image1=$_SESSION['image1'];
//$image2=$_SESSION['image2'];

class Insert_Product_Class
{
     private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "u686964567_saien";
    
    public $con;
    
    
    public function __construct() {
        $this->con = mysqli_connect($this->db_host , $this->db_username , $this->db_pass,$this->db);
                }
    
    public function insert_product($prod_name , $cat_id , $stock_quant , $prod_desc , $prod_mrp , $prod_sp , $image1 , $image2 , $prod_last_update , $data)
    {
       
        $insert_query = mysqli_query($this->con,"INSERT INTO se_product values (null ,'$prod_name','$cat_id' , $stock_quant , '$prod_desc' ,  $prod_mrp , $prod_sp , '$image1' , '$image2' ,'$prod_last_update' , '$data'  )");
            
    }
    
    public function check_category($cat_type)
    {
        
        $select_query=  mysqli_query($this->con,"SELECT category_id FROM se_product_category WHERE category_type='$cat_type'");
        while ($row = mysqli_fetch_array($select_query,MYSQLI_BOTH)) {
            return $row[0];
        }
    }
    
public function get_categories()
    {
        
        $select_query1=  mysqli_query($this->con,"SELECT * FROM se_product_category");
        
        return $select_query1;
        }
    }    


