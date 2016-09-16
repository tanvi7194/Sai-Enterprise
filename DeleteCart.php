
        <?php
        session_start();

        require_once 'connection_file_user.php';

        $select = $_REQUEST['value'];
        

       
        
        $delete = "Delete from carttable where product_id='$select'";
            $deleteResult = mysqli_query($con,$delete);
            
           
            
            if($deleteResult)
            {
                echo '0';
            }
            else
            {
                echo '1';
            }

        ?>
