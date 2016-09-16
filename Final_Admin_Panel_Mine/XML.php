
<?php
        $xml = simplexml_load_file('Laptop.xml');
        echo "RAM is ".$xml->Model_no;
        $server = "localhost";
$username="root";
$password="";
$databse="sai_enterprise";

$con = mysql_connect($server,$username,$password);
if(!$con)
{
    die("Please check your connection");
}
mysql_select_db($databse);


//if(mysql_query("insert into se_product (Product_attribute) values ('$xml')"))
//{
//    echo "Yes";
//        
//}
//else
//{
//    mysql_error();
//}


        $doc = new DOMDocument( );
        $ele = $doc->createElement('productAttributes');
        $doc->appendChild($ele);


        $ele1 = $doc->createElement('occasion');
        $ele1->nodeValue = "Gaurav";
        $ele->appendChild($ele1);

        $ele2 = $doc->createElement('material');
        $ele2->nodeValue = "material";
        $ele->appendChild($ele2);

        $ele3 = $doc->createElement('color');
        $ele3->nodeValue = "color";
        $ele->appendChild($ele3);

        $ele4 = $doc->createElement('updateBy');
        $ele4->nodeValue = "lastupdated";
        $ele->appendChild($ele4);

        $ele5 = $doc->createElement('stoneType');
        $ele5->nodeValue = "stonetype";
        $ele->appendChild($ele5);

        $ele6 = $doc->createElement('weight');
        $ele6->nodeValue = "weight";
        $ele->appendChild($ele6);



        $doc->save('productAttribute.xml');


        $data = file_get_contents('productAttribute.xml');
        
        echo "<br><Br>Wait".$data;





// put your code here
?>




$productAttributes = $_SESSION['productAttribute'];

                            file_put_contents("proattri.xml", $productAttributes);
                            $contents = simplexml_load_file("proattri.xml");
                            ?>
                            <div class="form-group">
                                <div class="col-sm-4 col-lg-2 col-md-2 col-xs-4">
                                    <label class="control-label"id="label">Occasion</label>
                                </div>
                                <div class="col-sm-4 col-lg-4 col-md-4 col-xs-8">
                                    <select name="occasion" placeholder="<?php echo "<b>" . $contents->occasion[0] . "</b>"; ?>" class="form-control placeholder" >
                                        <option id="tag1" selected="selected"><?php echo $contents->occasion[0]; ?></option>
                                        <option value="Traditional">Traditional</option>
                                        <option value="Casual">Casual</option>
                                        <option value="Party Wear">Party Wear</option>

                                    </select>
                                </div>
                            </div>



