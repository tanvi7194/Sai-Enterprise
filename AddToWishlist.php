
<?php
session_start();
require_once 'connection_file_user.php';


//$p_id = $_REQUEST['value'];

if(isset($_SESSION['u_id']))
{
    $user_id = $_SESSION['u_id'];
}
else
{
    echo 'User Session Not Set';
}

$flag = 0;
$productid = $_REQUEST['value'];

$query = mysqli_query($con,"SELECT product_info FROM se_wishlist WHERE u_id=$user_id");
if(mysqli_num_rows($query)==1)
{
            while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {

                $data = $row['product_info'];
            }

            $xmlCheck = new SimpleXMLElement($data);
            $count = count($xmlCheck->p_id);
            //    echo "Count : ".$count."<br>";


            if ($count == 5) {
                echo '2';
            } else {


                $x = 0;
                foreach ($xmlCheck->children() as $parent) {
                    $pid = $xmlCheck->p_id[$x];
            //        echo $pid;
            //        echo "Product id :".$productid;
                    if ($productid == $pid) {
                        $flag = 1;
                        break;
                    }
                    $x++;
                }
                if ($flag == 1)
                {
                    echo 3;
                }
                else {
                    $xml = new SimpleXMLElement($data);
                    $xml->addChild('p_id', $productid);
                    $ans = $xml->asXML();
                    $query = mysqli_query($con,"UPDATE se_wishlist SET product_info='$ans' WHERE u_id='$user_id'");

            //            file_put_contents("append.xml", $ans);

                    if ($query) {
                        echo '0';
                    } else {
                        echo '1';
                    }
                }
            }
}
else
{
    echo "<br> ELSE <br>".$productid."<br>".$user_id;
    $doc = new DOMDocument();
    $ele = $doc->createElement('Product');
    $doc->appendChild($ele);
    
        $ele1 = $doc->createElement('p_id');
        $ele1->nodeValue = $productid;
        $ele->appendChild($ele1);
        
        $doc->save('as.xml');
        $data = file_get_contents('as.xml');
        echo "Data".$data;
        $query = mysqli_query($con,"insert into se_wishlist values(null , $user_id , '$data')");
        if($query)
        {
            echo "Inserted";
        }
        else
        {
            echo mysqli_error();
        }
}
?>
