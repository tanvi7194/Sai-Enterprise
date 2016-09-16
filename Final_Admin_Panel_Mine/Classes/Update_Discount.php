<?php 
class Update_Discount_Class
{
     private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "u686964567_saien";
    
    public $con;
    
    
    public function __construct() {
        $this->con = mysqli_connect($this->db_host , $this->db_username , $this->db_pass,$this->db);
                }
                
    public function update_discount($disc_id , $disc , $discfrom , $discto)
    {
       
        $update_query = mysqli_query($this->con,"UPDATE se_discount SET product_discount_percentage=$disc, valid_from='$discfrom' , valid_to='$discto' where discount_id=$disc_id") or die(mysqli_error());
        if($update_query)
        {
            header("location: ManageProductDiscount.php?stock_updated='Discount on product has been updated!!'&status=yes");
        }
        else
        {
            header("location: ManageProductDiscount.php?stock_updated='Discount on product has NOT been updated!! Try Again'&status=no");
        }
    }
    public function insert_discount($pid, $disper, $validf , $validto)
    {
        //echo $pid,$disper,$validf,$validto;
        
        $insert_query = mysqli_query($this->con,"INSERT INTO se_discount values (null ,$pid , $disper , '$validf' , '$validto' )") or die(mysqli_error());
        if($insert_query)
        {
            header("location: AddDiscount.php?stock_updated='Discount on product has been updated!!'&status=yes");
        }
        else
        {
            header("location: AddDiscount.php?stock_updated='Discount on product has NOT been updated!! Try Again'&status=no");
        }
    }
}
?>