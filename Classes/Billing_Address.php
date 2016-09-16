<?php

require_once 'Database.php';
class Billing_Address
{

    private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "sai_enterprise";
            public $con;

            public function __construct()
            {
                $this->con=Database::connect($this->db_host, $this->db_username, $this->db_pass, $this->db);
            }

            public function setAddress($userid,$add_line_1,$add_line_2,$city_id,$state_id,$country,$zipcode)
            {
                
                 
                 $setaddr = mysqli_query($this->con,"insert into se_billing_address (u_id,add_line_1,add_line_2,city_id,state_id,country,zip_code) values($userid,'$add_line_1','$add_line_2',$city_id,$state_id,'$country',$zipcode)");
                 if($setaddr)
                 {
                     return "Success";
                     Database::disconnect();
                 }
                 else
                 {
                     return "Fail".  mysqli_error($this->con);
                     Database::disconnect();
                 }
            }

            public function getBillAddID()
            {

                $getbillID = mysqli_query($this->con,"select MAX(billing_address_id) from se_billing_address");
                if($getbillID)
                {
                    while($row=mysqli_fetch_array($getbillID,MYSQLI_BOTH))
                    {
                        return $row[0];
                    }
                    Database::disconnect();
                }
                else
                {
                    return "fail ".mysqli_error($this->con);
                    Database::disconnect();
                }
            }
}


?>
