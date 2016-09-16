<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CheckOut Address | Sai Enterprise</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        
        
        <link href="css/Custom/main.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="engine1/style.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/component.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/style_search.css" />
        <link rel="stylesheet" type="text/css" href="css/Custom/nav_stylesheet.css" />
        <script>
            
    function chckans(ans,ans2)
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
                            document.getElementById('answer').innerHTML = "Please enter right Answer!!";
                        }
                    }
                }
                xmlhttp.open('GET', 'compare_ans.php?ans='+ans+'&orig='+ans2, true);
                xmlhttp.send();
            }
    </script>

    </head>
    <body>
<?php
include_once './connection_file_user.php';
session_start();
if(mysqli_num_rows(mysqli_query($con,"select * from se_user where u_emailid='".$_POST['email']."'"))==1)
{
    
$_SESSION['mail']=$_POST['email'];

$q = mysqli_fetch_array(mysqli_query($con,"select * from se_user where u_emailid='".$_POST['email']."'"),MYSQLI_BOTH);
$ques = mysqli_fetch_array(mysqli_query($con,"select security_ques from se_security_ques where security_ques_id=".$q['security_ques_id']),MYSQLI_BOTH);

//echo "<input type=text value='".$ques['security_ques']."'>";
}
?>
    <input type="hidden" value='<?php echo $q['security_ans']; ?>' name='anss' id='anss'>
 <div class='form-group'>
     <div class="form-group has-success has-feedback">
        
    <label class="col-sm-2 control-label">Security Question:</label>
    <div class="col-sm-3">
        <input type=text class=form-control value='<?php echo $ques['security_ques']; ?>'>
    </div>
       
     </div>
    
    
  
    
<div class="form-group has-success has-feedback">
    <label class="col-sm-1 control-label">Answer </label>
    <div class="col-sm-4">
        <input type=text class=form-control id=ans name=ans placeholder="Answer">
    </div>
        
     </div> 
      </div>


  
    
     <div class="form-group">
						
						<div class="col-sm-2">
							<button type="button" class="btn btn-primary btn-label-left" onclick="chckans(ans.value,anss.value)">
							<span><i class="fa fa-clock-o"></i></span>
								Submit
							</button>
						</div>
					</div>
    <br><Br><Br>
    <span id="answer"></span>
</body>

 <script src="../js/validator_admin.js">
   <script type="text/javascript" src="js/modernizr.js"></script>
        
        <script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/index.js"></script>   
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="tetext/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/classie.js"></script>
        <script type="text/javascript" src="js/uisearch.js"></script>

