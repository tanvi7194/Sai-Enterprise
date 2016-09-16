
        <?php
        session_start();
        
        require_once 'connection_file_user.php';

         $uid=$_REQUEST['uid'];
         $pid=$_REQUEST['pid'];
        //echo $uid.$pid;
        
        $query=  mysqli_query($con,"SELECT product_info FROM se_wishlist WHERE u_id=$uid");
        if(mysqli_num_rows($query) > 0)
        {
            while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {
                $data=$row['product_info'];
            }
           // echo 'Product XML: '.$data."<br/>";
            $xml=new SimpleXMLElement($data);
            $x=0;
            $doc = new DOMDocument( );
        $ele = $doc->createElement('product');
        $doc->appendChild($ele);
        
            foreach($xml->children() as $value)
            {
                //echo "Product id".$xml->p_id[$x];
                
                if($xml->p_id[$x] != $pid)
                {
                    
        $ele1 = $doc->createElement('p_id');
        $ele1->nodeValue = $xml->p_id[$x];
        $ele->appendChild($ele1);
            $x++;
                }
                else
                {
                    $x++;
                }
           
            }
            $doc->save('wishlist.xml');
        $data2=file_get_contents("wishlist.xml");
        //echo $data2;
        $sql= mysqli_query($con,"UPDATE se_wishlist SET product_info='$data2' WHERE u_id=$uid");
        if($sql)
        {
//            echo 'Query successfully executed!';
        echo '1';
        }
        else{
            echo '0';
        }
        }
       
       
        
        
        ?>
