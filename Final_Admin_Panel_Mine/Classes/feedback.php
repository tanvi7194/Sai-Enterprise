<?php
class Feedback_Class
{
   private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "u686964567_saien";
    public $con;
    
    
    public function __construct() {
        $this->con = mysqli_connect($this->db_host , $this->db_username , $this->db_pass,  $this->db);
                }
    
public function delete_feedback($feedback_id)
    {
        $insert_query = mysqli_query($this->con,"DELETE FROM se_feedback WHERE feedback_id=$feedback_id") or die(mysqli_error());
    }

}