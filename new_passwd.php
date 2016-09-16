
<html>
    <head>
        <script>
            function match_new_password(newpasswd , confirm)
            {
                alert('kjbkj');
                if(newpasswd && confirm)
                {
                    
                    if(newpasswd == confirm)
                    {
                        alert('Enable');
                        $("#submitbtn").prop("disabled", false);
                    }
                    else
                    {
                        alert('Disable 1');
                        $("#submitbtn").prop("disabled", true);
                    }
                }
                else
                {
                    alert('Disbalr 2');
                    $("#submitbtn").prop("disabled", true);
                }
            }
        </script>
    </head>
    <body>
        <form action='update_password.php' method="post">
             <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">New Password</label>
						<div class="col-sm-4">
							<input type='password' class='form-control' name='new_passwd' id='new_passwd'>
						</div>
					</div>
                                        <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Confirm New Password</label>
						<div class="col-sm-4">
                                                    <input type='password' class='form-control' name='confirm_passwd' id='confirm_passwd' onblur="match_new_password(new_passwd.value , this.value)">
						</div>
					</div>
            <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-4">
                                                    <input type='submit' class='form-control' name='submitbtn' id='submitbtn'>
						</div>
					</div>
            
        </form>
    </body>
</html>                                        
                                       
