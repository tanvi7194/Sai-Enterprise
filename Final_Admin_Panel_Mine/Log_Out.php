<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
        
        </script>
    </head>
    <body>
        <?php
        session_start();
        session_unset();
        session_destroy();
        //session_abort();
        header("location:Admin_Login.php");
        
        // put your code here
        ?>
    </body>
</html>
