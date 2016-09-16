<?php
session_start();
$p_id = $_POST['p_id'];
$prod_name = $_POST['product_name'];
$prod_sp = $_POST['product_sp'];
$prod_mrp = $_POST['product_mrp'];
$stock_quant = $_POST['product_quantity'];
$prod_desc = $_POST['product_desc'];
$cat_id = $_POST['category_id'];
//$cat_id = $_SESSION['category_id'];


require_once 'connection_file.php';

echo "Product id ".$id. " And Category iD ".$cat_id;

$form_data = mysqli_fetch_array(mysqli_query($con,"select * from se_product_category where category_id='".$cat_id."'"),MYSQLI_BOTH);
//echo $form_data['category_id'];
$productAttributes = $form_data['Category_info'];
file_put_contents("Category_form.xml", $productAttributes);
$form_contents = simplexml_load_file('Category_form.xml');

$doc = new DOMDocument( );
        $ele = $doc->createElement('productAttributes');
        $doc->appendChild($ele);
                                    for($i=0;$i<count($form_contents->FIELDNAME);$i++)
                                    {
                                            if($form_contents->FIELDNAME[$i]->DataType=='Text_Value_Tool')
                                            {
                                                //$nm = $form_contents->FIELDNAME[$i];
                                               echo $_POST['nm'.$i]."<br>";
                                               $name= $form_contents->FIELDNAME[$i];
                                                       //echo "<br> txtBox ".$_POST['nm'.$i]."<br><Br>";
                                                       $ele1 = $doc->createElement($name);
                                                        $ele1->nodeValue = $_POST['nm'.$i];
                                                        $ele->appendChild($ele1);
                                            }
                                            else if($form_contents->FIELDNAME[$i]->DataType=='Single_Selection_Tool')
                                            {
                                                $a = $_POST[$i.'r'];
                                                       foreach ($a as $val)
                                                       {
                                                           echo "<br> Radio Val ".$val."<br>";
                                                           $name= $form_contents->FIELDNAME[$i];
                                                           $ele2 = $doc->createElement($name);
                                                            $ele2->nodeValue = $val;
                                                            $ele->appendChild($ele2);
                                                       }
                                                
                                            }
                                            else if($form_contents->FIELDNAME[$i]->DataType=='Multiple_Selection_Tool')
                                            {
                                                $a = $_POST[$i.'chck'];
                                                       foreach ($a as $val)
                                                       {
                                                           echo "<br> Check Val ".$val."<br>";
                                                           $name= $form_contents->FIELDNAME[$i];
                                                           $ele3 = $doc->createElement($name);
                                                            $ele3->nodeValue = $val;
                                                            $ele->appendChild($ele3);
                                                       }
                                            }
                                    }
                                    
                                    $doc->save('Updated.xml');
                                    $data = file_get_contents('Updated.xml');
                                    
                                    if($_FILES['img1']['tmp_name'])
                                    {
                                        $image1= "data:" . $_FILES['img1']['type'] . ";base64," . base64_encode(file_get_contents($_FILES['img1']['tmp_name']));
                                        echo "<br><Br> Img 1";
                                    }

                                    if($_FILES['img2']['tmp_name'])
                                    {
                                         echo "<br><Br> Img 2";
                                        $image2= "data:" . $_FILES['img2']['type'] . ";base64," . base64_encode(file_get_contents($_FILES['img2']['tmp_name']));
                                    //echo "<img src=".$image2.">";
                                    }
                                    
                                    include './Classes/Update_Product.php';
                                    //$sel=new Insert_Product_Class();
                                    
                                    $sel = new Update_Product_Class();
                                    
                                    if(isset($image1) && isset($image2))
                                    {
                                        $updateprod = $sel->update_product_with_both_images($p_id, $prod_name, $stock_quant, $prod_desc, $prod_mrp, $prod_sp,$image1,$image2, $data);
                                    }
                                    else if(isset($image1))
                                    {
                                        $updateprod = $sel->update_product_with_image1($p_id, $prod_name, $stock_quant, $prod_desc, $prod_mrp, $prod_sp,$image1, $data);
                                    }
                                    else if(isset($image2))
                                    {
                                        $updateprod = $sel->update_product_with_image2($p_id, $prod_name, $stock_quant, $prod_desc, $prod_mrp, $prod_sp,$image2, $data);
                                    }
                                    else
                                    {
                                        $updateprod= $sel->update_product_without_images($p_id, $prod_name, $stock_quant, $prod_desc, $prod_mrp, $prod_sp, $data);
                                        echo 'No Image';
                                    }
