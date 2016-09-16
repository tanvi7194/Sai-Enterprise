<?php
 session_start();
 $value=$_POST['selectedval'];
 //echo "return ".$p_only;
 
 if($value=='Products Only')
 {
     header("location:ProductsCombo.php");
 }
 
 else
 {
     header("location:ServiceAndProductCombo.php");
 }