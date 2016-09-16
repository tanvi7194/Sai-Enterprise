<?php
require_once 'connection_file.php';

session_start();
$f=1;
        $doc = new DOMDocument( );
        $ele = $doc->createElement('productAttributes');
        $doc->appendChild($ele);


for($i=1;$i<=$_SESSION['num'];$i++)
{
    //echo "<br><br><Br>".$_SESSION['name'.$i]."  ".$_SESSION['nm'.$i]."  ";
    $name = $_SESSION['name'.$i];
    $fname=str_replace(' ', '_', $name);
    
    $datatype1 = $_SESSION['nm'.$i];
    $datatype = str_replace(' ', '', $datatype1);
    
        $a=$doc->createElement('FIELDNAME');
        $a->nodeValue= $fname;
        $ele->appendChild($a);
        //echo "<br><Br> Replaced String ".str_replace(' ', '', $fname);
        $ele3=$doc->createElement('DataType');
        $ele3->nodeValue=$_SESSION['nm'.$i];
        $a->appendChild($ele3);
   
    
    
       
//        $ele1 = $doc->createElement($name);
//        $ele33->appendChild($ele1);
        //$item=$doc->createElement('Value');
        //$item->nodeValue=$value;
        //$ele->appendChild($ele1);
        
        
//        $val1=$_SESSION['nm'.$i];
//        
//        $ele2 = $doc->createElement($datatype);
//        //$ele->appendChild($ele2);
//        foreach ($val1 as  $value) {
//             $item=$doc->createElement('Value');
//             $item->nodeValue=$value;
//             $ele2->appendChild($item);
//        }
//        $ele->appendChild($ele2);
        
        
    if($_SESSION['nm'.$i]=='Text_Value_Tool')
    {
        
    }
    else
    {
        if(isset($_SESSION['j1'.$i]))
        {
            for($j=$f;$j<($f+$_SESSION['j1'.$i]);$j++)
            {
                //echo "  ".$_POST['txt'.$j]."  ";
                
                $ele4 = $doc->createElement('Value');
                $ele4->nodeValue = $_POST['txt'.$j];
                $ele3->appendChild($ele4);

            }
            $f = $j;
            $_SESSION['lastValue']=$f;
            echo "<br>";
        }
    }
}
$category = $_SESSION['category'];
$doc->save($category.'.xml');
//$doc->save('Categorykanaamjohogawoh.xml');
$data = file_get_contents($category.'.xml');
//echo "<br><Br>".$category.'.xml';
$str = "insert into se_product_category values(null , '$category' , '$data') ";
$qu = mysqli_query($con,$str);

?>

<?php 
if($qu)
{

    header("location:AddNewProduct.php?category_added='New Category Has been added Successfully!'&status=yes");
}
else
{
    header("location:AddNewProduct.php?category_added='New Category Has been added Successfully!'&status=no");
}
?>
