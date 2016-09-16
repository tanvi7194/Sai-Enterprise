

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Login | Sai Enterprise</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href=""> <!-- Logo -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/sweet-alert.css" rel="stylesheet">

 </head>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

$(document).ready(function() {
    var $submit = $("input[type=submit]"),
        $inputs = $('input[type=text], input[type=password]');

    function checkEmpty() {

        // filter over the empty inputs

        return $inputs.filter(function() {
            return !$.trim(this.value);
        }).length === 0;
    }

    $inputs.on('keyup', function() {
        $submit.prop("disabled", !checkEmpty());
    }).keyup(); 
});


        </script>
<body>

    <div class="container">
        <div class="row" >
            <div class="col-md-4 col-md-offset-4" style="margin-top: 100px;">
                <div class="well">
                    <form action="Admin_Login_Handler.php" method="POST">
                        <center><img class="img-responsive" src="logo.png" height='130' width='130'/> <br/> <span style="font-size: 25px;"> Sign In</span></center>
                        <hr/>
                        <div class="form-group ">
                            <input class="form-control" placeholder="E-mail" id="mailid" name="mail" type="email"  autofocus required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" id="passwrd" name="passwd" type="password" value="" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <center> <input style="width:50%;" value="Login" name="Login" type="submit"></center>
                        </div>
                        <div>
                            <?php
                            if(isset($_REQUEST['msg']))
                            {
                                 echo "<span id='msg' >".$_REQUEST['msg']."</span>";
                            }
                                   
                                    ?>
                        </div>
                    </form>
                    <input type="hidden" id="hid">
                </div>
            </div>
        </div>
    </div>
    
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./js/sweet-alert.min.js"></script>
    
    <?php if(isset($_GET["status"])) 
{
        echo "<script>$(document).ready(function() {
swal({
title: 'Error!',
text: 'Please login to get the access of Admin Panel!',
type: 'error',
confirmButtonText: 'OK'
});
});</script>";
    
}
    
    ?>
    
</body>

</html>
