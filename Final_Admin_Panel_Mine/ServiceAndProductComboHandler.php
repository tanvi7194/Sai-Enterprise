<?php
session_start();
echo "hello";
$nm1=$_POST['type1'];
$nm2=$_POST['type2'];

$doc = new DOMDocument();
$ele = $doc->createElement('ComboAttributes');
$doc->appendChild($ele);


for($i=0;$i<count($nm1);$i++)
{
    //echo "value ".$nm1[$i]."<br>";
    
    $name=$nm1[$i];
    
    $item=$doc->createElement('pid');
    $item->nodeValue=$name;
    $ele->appendChild($item);
    
}
for($i=0;$i<count($nm2);$i++)
{
    //echo "value ".$nm2[$i]."<br>";
    
     $name1=$nm2[$i];
    $item1=$doc->createElement('sid');
    $item1->nodeValue=$name1;
    $ele->appendChild($item1);
    
}
        
$doc->save('productServiceComboInfo.xml');
$data = file_get_contents('productServiceComboInfo.xml');

require_once 'connection_file.php';

$insert_query = mysqli_query($con,"INSERT INTO se_product_service_combo values (null ,'$data'  )") or die(mysqli_error());
if($insert_query)
{
    
    $query= mysqli_query($con,"SELECT max(product_service_combo_id) FROM se_product_service_combo ") or die(mysqli_error());
    while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {
        $pros_id=$row[0];
    }
    $_SESSION['pros_id']=$pros_id;
    header("location:ProductServiceComboDesc.php");
    
}
else
{
    echo "Nope";
}

