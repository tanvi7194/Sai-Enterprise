<?php
require_once 'Database.php';
class User
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

            public function Register($fname,$lname,$contact,$email_id,$password,$sec_ques_id,$sec_ques_ans)
            {
//                $database = new Database();
//                $connect = $database->connect($this->db_host, $this->db_username, $this->db_pass, $this->db);
                
                $register = mysqli_query($this->con,"insert into se_user(u_fname,u_lname,u_contact,u_emailid,u_password,security_ques_id,security_ans) values('$fname','$lname',$contact,'$email_id','$password',$sec_ques_id,'$sec_ques_ans')");
                if($register)
                {
                    return "Success";
                    Database::disconnect();

                }
                else
                {
                    return "fail".mysqli_error();
                    Database::disconnect();
                }
            }
            
            public function getUserID($fname,$lname)
            {
//                $database1 = new Database();
//                $connect = $database1->connect($this->db_host, $this->db_username, $this->db_pass, $this->db);
              
                $getuserID = mysqli_query($this->con,"select u_id from se_user where u_fname=$fname and u_lname=$lname");
//                if($getuserID)
//                {
//                    echo "success";
//                }
//                else
//                {
//                    echo mysqli_error();
//                }
                while($row =mysqli_fetch_array($getuserID,MYSQLI_BOTH))
                {
                    return $row[0];
                }
                Database::disconnect();
            }

}



?>
