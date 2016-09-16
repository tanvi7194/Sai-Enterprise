<?php
session_start();
$brand_name = $_POST['product_name'];
$prod_sp = $_POST['product_sp'];
$prod_mrp = $_POST['product_mrp'];
$stock_quant = $_POST['product_quantity'];
$prod_desc = $_POST['product_desc'];

$cat_id = $_SESSION['category_id'];


require_once 'connection_file.php';
//echo "<br><Br>Session ".$_SESSION['category_id']."<br><Br>";
$q = "select * from se_product_category where category_id=".$_SESSION['category_id'];
$info = mysqli_fetch_array(mysqli_query($con,$q),MYSQLI_BOTH);
//echo "Error ".mysqli_error();

$productAttributes = $info['Category_info'];
file_put_contents("productAttributeCount.xml", $productAttributes);
$contents = simplexml_load_file('productAttributeCount.xml');    


//echo "Count is ".  count($contents->FIELDNAME);
$doc = new DOMDocument( );
        $ele = $doc->createElement('productAttributes');
        $doc->appendChild($ele);


        
for($i=0;$i<count($contents->FIELDNAME);$i++)
{
    




?>
<?php 

                                                    if($contents->FIELDNAME[$i]->DataType=='Text_Value_Tool')
                                                    {
                                                        $name= $contents->FIELDNAME[$i];
                                                       //echo "<br> txtBox ".$_POST['nm'.$i]."<br><Br>";
                                                       $ele1 = $doc->createElement($name);
                                                        $ele1->nodeValue = $_POST['nam'.$i];
                                                        $ele->appendChild($ele1);
                                                    }
                                                   else if($contents->FIELDNAME[$i]->DataType=='Single_Selection_Tool')
                                                   {
                                                       //echo "<br> Radio ".$_REQUEST[$i.'r'];
                                                       $a = $_POST[$i.'r'];
                                                       foreach ($a as $val)
                                                       {
                                                           //echo "<br><Br> Radio Val = ".$val."<br><Br>";
                                                           $name= $contents->FIELDNAME[$i];
                                                           $ele2 = $doc->createElement($name);
                                                            $ele2->nodeValue = $val;
                                                            $ele->appendChild($ele2);
                                                            
                                                            
                                                       }
                                                       
                                                   }
                                                   else if($contents->FIELDNAME[$i]->DataType=='Multiple_Selection_Tool')
                                                   {
                                                       
                                                       //echo "<br> CheckBox ".$_REQUEST[$i.'chck']."<br>";
                                                       $a = $_POST[$i.'chck'];
//                                                       $name= $contents->FIELDNAME[$i];
//                                                       $ele3 = $doc->createElement($name);
//                                                       $ele->appendChild($ele3);
//                                                       
//                                                       foreach ($a as $val)
//                                                       {
//                                                           //echo "<br><Br> Check Val = ".$val."<br><Br>";
//                                                            $item=$doc->createElement($val);
//                                                            $item->nodeValue="yes";
//                                                            $ele3->appendChild($item);
//                                                       }
                                                       
                                                       foreach ($a as $val)
                                                       {
                                                           //echo "<br><Br> Radio Val = ".$val."<br><Br>";
                                                           $name= $contents->FIELDNAME[$i];
                                                           $ele3 = $doc->createElement($name);
                                                            $ele3->nodeValue = $val;
                                                            $ele->appendChild($ele3);
                                                            
                                                            
                                                       }
        
                                                   }


}
$doc->save('abcd.xml');
$data = file_get_contents('abcd.xml');

include './Classes/Insert_Product.php';

if($_FILES['img1']['tmp_name'])
{
    $image1= "data:" . $_FILES['img1']['type'] . ";base64," . base64_encode(file_get_contents($_FILES['img1']['tmp_name']));

}

if($_FILES['img2']['tmp_name'])
{
    $image2= "data:" . $_FILES['img2']['type'] . ";base64," . base64_encode(file_get_contents($_FILES['img2']['tmp_name']));
//echo "<img src=".$image2.">";
}
$sel=new Insert_Product_Class();
        $insertprod=$sel->insert_product($brand_name, $cat_id, $stock_quant, $prod_desc, $prod_mrp, $prod_sp, $image1, $image2, $prod_last_update,$data);
 if($insertprod)
 {
     //echo $insertprod;
     header("location:AddNewProduct.php?product_added='Product Has been added Successfully!'&status=yes");
 }
 else 
 {
     //echo mysql_error();
     header("location:AddNewProduct.php?product_added='There is An error while inserting the product!!!'&status=no");
 }