<?php

class Administration
{
    private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "u686964567_saien";
    public $con;
    public function __construct() {
        $this->con = mysqli_connect($this->db_host , $this->db_username , $this->db_pass,$this->db);
                }
                
                //Without IMAGE
    public function update_admin_profile_with_password($name , $email , $contact , $password)
    {
        
        $update_query = mysqli_query($this->con,"update se_administration set admin_name='$name' , admin_email='$email' , admin_contact=$contact , admin_password='$password'");
    }
    
    public function update_admin_profile_without_password($name , $email , $contact)
    {
        
        $update_query = mysqli_query($this->con,"update se_administration set admin_name='$name' , admin_email='$email' , admin_contact=$contact");
    }    
    
     public function update_admin_profile_with_password_and_image($name , $email , $contact , $password , $img)
    {
        
        $update_query = mysqli_query($this->con,"update se_administration set admin_name='$name' , admin_email='$email' , admin_contact=$contact , admin_password='$password' , admin_photo='$img'");
    }
    
    public function update_admin_profile_with_only_image($name , $email , $contact , $img)
    {
      
        $update_query = mysqli_query($this->con,"update se_administration set admin_name='$name' , admin_email='$email' , admin_contact=$contact, admin_photo='$img'");
        return $update_query;
        
        
    }
    
}

