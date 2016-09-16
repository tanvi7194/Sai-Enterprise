<?php
session_start();
require_once 'connection_file_user.php';
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <meta name='description' content='Online hardware shopping website' />
        <meta name='Sai Products' content='Products of Sai Enterprise Website' />
        <meta name='Sai Services' content='Services of Sai Enterprise Website' />
        <meta name='Hardware' content='Online hardware shopping website' />
        <title>Home Page of Sai Enterprise</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
       
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' rel='stylesheet'>

        <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'>
        <link rel='stylesheet' type='text/css' href='engine1/style.css' />
        <link rel='stylesheet' type='text/css' href='css/Custom/nav_stylesheet.css' />
        <link href='./css/sweet-alert.css' rel='stylesheet'>
<link rel='stylesheet' href='css/sweet-alert.css'>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='js/sweet-alert.min.js'></script>

<?php
if(isset($_GET['msg']))
{
   
    echo "   <script> $(document).ready(
            function()
    {
        swal({   title: 'Success!', 
                text:".$_GET['msg']." ,
                type: 'success', 
                confirmButtonText: 'Okay'
            });
    });        
</script>
";   
}

?>
<script>
    function chckCode(code)
            {
                alert('Display');
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                }
                xmlhttp.onreadystatechange = function () {
                    
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                       alert(xmlhttp.responseText);
                        if(xmlhttp.responseText=='yes')
                        {
                            window.location.href='new_passwd.php';
                        }
                        else
                        {
                            document.getElementById('ans').innerHTML = "Please enter Valid Recovery code!!";
                        }
                    }
                }
                xmlhttp.open('GET', 'compare_code.php?code='+code, true);
                xmlhttp.send();
            }
    </script>
    </head>
    
    <body>
        
        Recovery Code : <input type='text' id='code' name='code' placeholder='Recovery Code' class='form-group has-success has-feedback'>
        <input type='button' value='Submit' onclick="chckCode(code.value)">
        <br><Br><br><br><br>
        <span id='ans'></span>
                                     
        
    </body>
         <script type='text/javascript' src='engine1/wowslider.js'></script>
	<script type='text/javascript' src='engine1/script.js'></script>
        <script type='text/javascript' src='js/app.js'></script>
        <script type='text/javascript' src='js/index.js'></script>
        <script type='text/javascript' src='./js/sweet-alert.min.js'></script>
        
        
</html>

        
        
        
        
        
        
        
        
        
        