<?php
session_start();
echo "hello";
$nm=$_POST['type1'];

$doc = new DOMDocument();

$ele1 = $doc->createElement('productAttributes');
$doc->appendChild($ele1);


for($i=0;$i<count($nm);$i++)
{
    echo "value ".$nm[$i]."<br>";
    
     $name=$nm[$i];
    $item=$doc->createElement('pid');
    $item->nodeValue=$name;
    $ele1->appendChild($item);
    
}
        
$doc->save('productComboInfo.xml');
$data = file_get_contents('productComboInfo.xml');

require_once 'connection_file.php';

$insert_query = mysqli_query($con,"INSERT INTO se_product_combo values (null ,'$data'  )") or die(mysqli_error());
if($insert_query)
{
    
    $query= mysqli_query($con,"SELECT max(product_combo_id) FROM se_product_combo ") or die(mysqli_error());
    while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {
        $pro_id=$row[0];
    }
    $_SESSION['pro_id']=$pro_id;
    header("location:ProductComboDesc.php");
    
}
else
{
    echo "Nope";
}

