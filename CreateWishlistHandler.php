<?php
session_start();

require_once 'connection_file_user.php';//mysqli_select_db("jwelleryshop") or die("No database found");

$id = $_SESSION['u_id'];
$flag = 0;

$select = mysqli_query($con,"Select * from se_wishlist where u_id=$id");

if (mysqli_num_rows($select) > 0) {
    while ($row = mysqli_fetch_assoc($select,MYSQLI_ASSOC)) {
        $uid = $row['user_id'];
        $flag=1;
        
        
    }
} else {
    $flag=3;
    }

//    //echo $flag." FLAG <br>";
//
if($flag == 3)
{
    $doc = new DOMDocument( );
    $ele = $doc->createElement('product');
    $doc->appendChild($ele);

    $doc->save('ImagesPath.xml');


    $data = file_get_contents('ImagesPath.xml');
    echo $data;
    $query = mysqli_query($con,"INSERT INTO se_wishlist VALUES (NULL, $id, '$data')");
    if ($query) {
        echo "  created";
        header("Location:home.php");
    }
}
else
{
    echo 'Existing';
    header("Location:home.php");
}

    