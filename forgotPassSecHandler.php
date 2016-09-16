<html>


<?php
$con = mysql_connect("localhost","root","") or die("connection fail");
$db = mysql_select_db("sai_enterprise");


echo "
    
<form action=forgot_password_by_sec_ques.php method=post>
<div class=form-group>
  <label for=usr>Email:</label>
  <input type=email name=email class=form-control id=email>
</div>
";
echo "
<div class=form-group>
    <input type=submit value=Submit>
</div>
</form>
";

?>
    <script src="../js/validator_admin.js">

</script>

</html>