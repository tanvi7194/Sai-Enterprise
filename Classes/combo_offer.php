<?php

require_once 'Database.php';
class combo_offer
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

            public function getProductCombo()
            {
                $query = mysqli_query($this->con,"select * from se_combo_offer where product_combo_id IS NOT NULL");
                if($query)
                {
                    return $query;
                    Database::disconnect();
                }
                else
                {
                    return mysqli_error();
                    Database::disconnect();
                }
            }

            public function getProductServiceCombo()
            {
                $query4 = mysqli_query($this->con,"select * from se_combo_offer where product_service_combo_id IS NOT NULL");
                if($query4)
                {
                    return $query4;
                    Database::disconnect();
                }
                else
                {
                    return mysqli_error();
                    Database::disconnect();
                }
            }

            public function getpcombodetails($pcid)
            {
               $query1=mysqli_query($this->con,"select * from se_product_combo where product_combo_id=".$pcid);
               if($query1)
               {
                   return $query1;
                   Database::disconnect();
               }
               else
               {
                  return mysqli_error();
                  Database::disconnect();
               }
            }
            public function getpservicecombodetails($pscid)
            {
               $query5=mysqli_query($this->con,"select * from se_product_service_combo where product_service_combo_id=".$pscid);
               if($query5)
               {
                   return $query5;
                   Database::disconnect();
               }
               else
               {
                  return mysqli_error();
                  Database::disconnect();
               }
            }
            public function getProducts($psid)
            {
                $query2= mysqli_query($this->con,"select * from se_product where product_id=".$psid);
                if($query2)
                {
                    return $query2;
                    Database::disconnect();
                }
                else
                {
                    return mysqli_error();
                    Database::disconnect();
                }
            }
            public function getServices($sid)
            {
                $query3= mysqli_query($this->con,"select * from se_service where service_id=".$sid);
                if($query3)
                {
                    return $query3;
                    Database::disconnect();
                }
                else
                {
                    return mysqli_error();
                    Database::disconnect();
                }
            }
}
?>
