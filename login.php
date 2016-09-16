<?php
session_start();
require_once 'connection_file_user.php';
?>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        

        <title>Login | Sai Enterprise</title>
        <style>
           .submitbtn {
  -webkit-border-radius: 12;
  -moz-border-radius: 12;
  border-radius: 12px;
  font-family: Arial;
  color: #ffffff;
  font-size: 21px;
  background: #3498db;
  padding: 15px 70px 12px 70px;
  text-decoration: none;
}

.submitbtn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
        </style>
        <link rel="stylesheet" type="text/css" href="css/Custom/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/demo_textbox.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/component_textbox.css" />
        <link href="./css/sweet-alert.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="engine1/style.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/nav_stylesheet.css" />
        
    </head>
    <body>
    <center>
<!--	<form method="post" name="mypage" id="mypage">
             <table>
             <tr><td><h1>Login</h1></td></tr>
                 <tr><td><input type="text" name="email" placeholder="Email" required id="e" autocomplete="off"></td></tr>
                 <tr><td><input type="password" name="password" placeholder="Password" required id="p"></td></tr>
	         <td><a href="#">Forgot Password?</a></td>
                 <tr><td colspan="2" align="center"><input type="button" value="Login"></td></tr>
             </table>
        </form>-->
<form method="post" name="mypage" id="mypage" action="User_Login_Handler.php" >
                 <section class="content">
                     <img src="new.png" height="200" width="300">
                     <br>
                                <span id="inputtype1" class="input input--hoshi">
					<input class="input__field input__field--hoshi" type="text" id="id"  name="id"/>
					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
						<span class="input__label-content input__label-content--hoshi">Email_ID</span>
					</label>
				</span>
                                <br>
				<span id="inputtype2" class="input input--hoshi">
					<input class="input__field input__field--hoshi" type="password" id="password" name="pwd"/>
					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-5">
						<span class="input__label-content input__label-content--hoshi">Password</span>
					</label>
				</span>
                                <br>
                                <span id="inputtype3" class="input input--hoshi">
                                    <input class="submitbtn" type="submit" id="login" value="Login">
                                    <input class="submitbtn" type="button"  value="Forgot Password" onclick="location.href='forgotPassword_client.php'">
				</span>
				
			</section>
    </form>
           </center>
        
        <script src="js/classie.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
         <script type="text/javascript" src="./js/sweet-alert.min.js"></script>

        <script>
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
					(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();
		</script>
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
        <?php
        if(isset($_GET["status"]))
        {
            echo "<script>$(document).ready(function() {
swal({
title: 'Error!',
text: 'Error while Login. Recheck the password and id!',
type: 'error',
confirmButtonText: 'OK'
});
});</script>";
        }
        ?>
    </body>
</html>