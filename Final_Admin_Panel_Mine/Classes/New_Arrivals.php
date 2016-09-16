<?php
class New_Arrival_Class
{
   private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "u686964567_saien";
    public $con;
    
    
    public function __construct() {
        $this->con = mysqli_connect($this->db_host , $this->db_username , $this->db_pass,  $this->db);
                }
    
    public function insert_new_arrival($prod_id)
    {
        $insert_query = mysqli_query($this->con,"INSERT INTO se_new_arrivals values (null ,$prod_id)") or die(mysqli_error());
        if($insert_query)
        {
            header("location: Manage_New_Arrival_Add.php?stock_updated='Product has been Added to New Arrivals!!'&status=yes");
        }
        else
        {
            header("location: Manage_New_Arrival_Add.php?stock_updated='Product has NOT been Added to New Arrivals!! Try Again'&status=no");
        }
            
    }
    public function delete_new_arrival($prod_id)
    {
        $insert_query = mysqli_query($this->con,"DELETE FROM se_new_arrivals WHERE product_id=$prod_id") or die(mysqli_error());
        if($insert_query)
        {
            header("location: Manage_New_Arrival_Delete.php?stock_updated='Product has been Deleted to New Arrivals!!'&status=yes");
        }
        else
        {
            header("location: Manage_New_Arrival_Delete.php?stock_updated='Product has NOT been Deleted to New Arrivals!! Try Again'&status=no");
        }    
    }

}