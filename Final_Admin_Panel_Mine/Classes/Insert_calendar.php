<?php

class Insert_Calendar_Class
{
   private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "u686964567_saien";
    public $con;
    
    
    public function __construct() {
        $this->con = mysqli_connect($this->db_host , $this->db_username , $this->db_pass, $this->db);
                }
    
    public function insert_calendar($event_name , $event_desc , $event_date)
    {
        $insert_query = mysqli_query($this->con,"INSERT INTO se_calendar values (null ,'$event_name', $event_date )") or die(mysqli_error());
            
    }
    
}



