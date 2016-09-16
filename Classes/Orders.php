<?php
require_once 'Database.php';
class Orders
{
      private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "u686964567_saien";
            public $con;

            public function __construct()
            {
                $this->con=  Database::connect($this->db_host, $this->db_username, $this->db_pass, $this->db);
            }

            public function viewOrders($uid)
            {
                $getOrders = mysqli_query($this->con,"select * from se_orders where u_id=".$uid);
                if($getOrders)
                {
                    return $getOrders;
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
