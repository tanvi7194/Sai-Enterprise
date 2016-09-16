<?php
session_start();
$p_id = $_POST['id'];
$stock_quant=$_POST['quant'];

include './Classes/Update_Product.php';
$sel=new Update_Product_Class();
$updt = $sel->update_product_stock($p_id, $stock_quant); 


