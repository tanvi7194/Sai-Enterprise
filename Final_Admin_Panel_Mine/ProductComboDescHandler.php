

<?php
session_start();
$cost=$_POST['cost'];
$desc=$_POST['desc'];
$pro_id=$_SESSION['pro_id'];

//echo "Cost ".$cost."<br>Desc ".$desc;

require_once 'connection_file.php';
echo "Max ".$pro_id;

$insert_query_combo = mysqli_query($con,"INSERT INTO se_combo_offer values (null ,$pro_id, null, $cost, '$desc')") or die(mysqli_error());
if($insert_query_combo)
{
    
    header("location:ManageComboOffer.php?combo_added='Combo Offer has been Successfully added'&status=yes");
    //echo "<script>alert('Combo Offer Successfully Added...');</script>";
}
else
{
    header("location:ManageComboOffer.php?combo_added='Sorry.. there is a problem adding Combo Offer!!'&status=no");
}