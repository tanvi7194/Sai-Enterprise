<?php
require_once 'connection_file.php';

$id=$_REQUEST['id'];
$delete_query_combo=mysqli_query($con,"DELETE FROM se_combo_offer where combo_id=".$id);
if($delete_query_combo)
{
    
    header("location:DisplayComboOffer.php?combo_added='Combo Offer has been Deleted Successfully'&status=yes");
    //echo "<script>alert('Combo Offer Successfully Added...');</script>";
}
else
{
    header("location:DisplayComboOffer.php?combo_added='Sorry.. there is a problem in deleting Combo Offer!!'&status=no");
}