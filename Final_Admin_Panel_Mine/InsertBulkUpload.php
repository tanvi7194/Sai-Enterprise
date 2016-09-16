<html>
    
    
    <head>
        <script type="text/javascript">
        function PreviewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image1").src = oFREvent.target.result;
                };
            }
            ;
            function PreviewImage1() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage1").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image2").src = oFREvent.target.result;
                };
            }
            ;
            </script>
    </head>
<?php
session_start();
require_once 'connection_file.php';
$c = $_SESSION['c_id'];

$no = $_SESSION["num"];
   $plus = 0;
   $cons = 0;
   
for($i=0;$i<$no;$i++)
{
    $category_info = mysqli_fetch_array(mysqli_query($con,"select * from se_product_category where category_id=".$c),MYSQLI_BOTH);
$d = $category_info['Category_info'];
file_put_contents("A.xml", $d);
$data = simplexml_load_file("A.xml");
$countfield=  count($data->FIELDNAME);
    $prod_name = $_POST["product_name_".$i];
    //echo "<br>".$prod_name;
    
    $prod_mrp = $_POST["product_mrp_".$i];
    //echo "<br>".$prod_mrp;
    
    $prod_sp = $_POST["product_sp_".$i];
    //echo "<br>".$prod_sp;
    
    $prod_stock = $_POST["product_stock_".$i];
    //echo "<br>".$prod_stock;
    
    $prod_desc = $_POST["product_desc_".$i];
    //echo "<br>".$prod_desc;
    
    
    if($_FILES['product_image(1)_'.$i]['tmp_name'])
{
    $image1= "data:" . $_FILES['product_image(1)_'.$i]['type'] . ";base64," . base64_encode(file_get_contents($_FILES['product_image(1)_'.$i]['tmp_name']));
//echo "<br> Image 1";
}

if($_FILES['product_image(2)_'.$i]['tmp_name'])
{
    $image2= "data:" . $_FILES['product_image(2)_'.$i]['type'] . ";base64," . base64_encode(file_get_contents($_FILES['product_image(2)_'.$i]['tmp_name']));
//echo "<br> Image 2";
}
    
    
    $doc = new DOMDocument( );
        $ele = $doc->createElement('productAttributes');
        $doc->appendChild($ele);
    for($j=0;$j<$countfield;$j++)
                                    {
                                        //echo "<br> J is ".$j."<br><BR>";
                                        $fieldnm=$data->FIELDNAME[$j];
                                    //echo "<br> Firldname is ".$fieldnm."<BR>";
                                            if($data->FIELDNAME[$j]->DataType=='Text_Value_Tool')
                                            {
                                                 $name= $data->FIELDNAME[$j];
                                                       //echo "<br> txtBox ".$_POST['nm'.$i]."<br><Br>";
                                                       $ele1 = $doc->createElement($name);
                                                        $ele1->nodeValue = $_POST[$data->FIELDNAME[$j].'_'.$i];
                                                        $ele->appendChild($ele1);


                                                        echo $_POST[$data->FIELDNAME[$j].'_'.$i];
                                            }

                                            else if($data->FIELDNAME[$j]->DataType=='Single_Selection_Tool')
                                            {
                                                        $cou = count($data->FIELDNAME[$j]->DataType[0]->Value);
                                                        $r=0;
                                                        $ra = $_POST[$i.'r'];
                                                        foreach ($ra as $e)
                                                        {
                                                            $name= $data->FIELDNAME[$j];
                                                           $ele2 = $doc->createElement($name);
                                                            $ele2->nodeValue = $e;
                                                            $ele->appendChild($ele2);
                                                            //echo "<br>".$e;
                                                        }
                                            }   

                                            else if($data->FIELDNAME[$j]->DataType=='Multiple_Selection_Tool')
                                            {
                                                        $rb = $_POST['c'.$plus];
                                                        foreach ($rb as $eb)
                                                        {
                                                            $name= $data->FIELDNAME[$j];
                                                           $ele3 = $doc->createElement($name);
                                                            $ele3->nodeValue = $eb;
                                                            $ele->appendChild($ele3);
                                                        }
                                                        ++$plus;
                                            }
                    }
                    $doc->save('Bulk.xml');
                    $data = file_get_contents('Bulk.xml');
                    //include_once './Classes/Insert_Product.php';
                    date_default_timezone_set('Asia/Calcutta');
                    $prod_last_update = date('Y-m-d H:i:s');
//                    $sel=new Insert_Product_Class;
//                     $insertprod=$sel->insert_product($prod_name, $c, $prod_stock, $prod_desc, $prod_mrp, $prod_sp, $image1,$image2, $prod_last_update, $data);
                    //$select_db = mysqli_select_db('sai_enterprise');
        $insert_query = mysqli_query($con,"INSERT INTO se_product values (null ,'$prod_name','$c' , $prod_stock , '$prod_desc' ,  $prod_mrp , $prod_sp , '$image1' , '$image2' ,'$prod_last_update' , '$data'  )") or die(mysqli_error());
        if($insert_query)
        {
            header("location: BulkUpload.php?stock_updated='Product has been updated!!'&status=yes");
        }
        else
        {
            header("location: BulkUpload.php?stock_updated='Product is NOT updated!! Try Again'&status=no");
        }
                    
                                                        }



?>

