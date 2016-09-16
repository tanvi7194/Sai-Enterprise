<?php


function sec_ques_dropdown($con)
{
    $result = mysqli_query($con,"select security_ques from se_security_ques");
    return $result;
}
function stateDropdown($con)
{
    $result = mysqli_query($con,"select state_name from se_state");
    return $result;
}
function getCategory($con)
{
    $result2 = mysqli_query($con,"select * from se_product_category");
    return $result2;
}

?>
