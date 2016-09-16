<?php
require_once 'connection_file.php';
$query = mysqli_fetch_array(mysqli_query($con,"select * from se_administration"),MYSQLI_BOTH);


if(isset($_SESSION['nm']))
{
    echo "HAIIIIII";
}
else
{
    echo "<script>header('location:Admin_Login.php?msg=Tannu'); </script>";
}
?>


<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
	<head>
		<meta charset="utf-8">
		<title>Admin Profile | Sai Enterprise</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="css/style_v2.css" rel="stylesheet">
		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
                <script type="text/javascript">

             function call(val)
            {
                //alert(val);
                var xmlhttp ;
                if(window.XMLHttpRequest)
                    {
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
                        {
                             xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }
                xmlhttp.onreadystatechange=function()
                {
                    
                     if(xmlhttp.readyState==4 && xmlhttp.status==200)
                         {
                                    document.getElementById('spn').innerHTML= xmlhttp.responseText ;
                         }
                            
                 }
                xmlhttp.open("GET",'Check_Old_Password.php?passwd='+val, true);
                xmlhttp.send();
            }        
        
            function match_new_password(newpasswd , confirm)
            {
                if(newpasswd && confirm)
                {
                    if(newpasswd == confirm)
                    {
                        //alert("Yeah");
                    }
                    else
                    {
                        //alert("Lost");
                    }
                }
            }
         
        function PreviewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("getimage").files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById("image1").src = oFREvent.target.result;
                };
            }
            ;
        </script>
    <body>
    <?php 
    include './half_nav_file.php';
    ?>
                    <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Admin Profile</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Admin Profile</h4>
                                <form class="form-horizontal" role="form" method="post" action="Update_Profile_Handler.php" name='profile_form' enctype="multipart/form-data">
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Admin ID</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='admin_id' value=".$query['admin_id']." readonly>";?>
						</div>
					</div>
                                    
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='admin_name' value=".$query['admin_name'].">";?>
						</div>
					</div>
					<div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">E-Mail ID</label>
						<div class="col-sm-4">
							<?php echo "<input type='text' class='form-control' name='admin_mail' value=".$query['admin_email'].">";?>
						</div>
					</div>
                                    <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Contact Number</label>
						<div class="col-sm-4">
							<?php echo "<input type='number' class='form-control' name='admin_contact' value=".$query['admin_contact'].">";?>
						</div>
					</div>
                                    <?php
                                    $img = $query['admin_photo'];
                                    ?>
                                    <div class='form-group has-success has-feedback'>
                                <label class='col-sm-2 control-label'>Image</label>
                                
                                <div class='col-sm-4'>
                                    <input name='img1' type='file' id='getimage' data-toggle='tooltip' title='Select Image!'  onchange='PreviewImage()' />
                                </div>
                                <div class='col-sm-3 col-lg-8 col-md-8 col-xs-3'>
                                    <br/>
                                 <img class='img-responsive' id='image1'  src='<?php echo $img; ?>' height=100 width=150>
                                
                                </div>
                                
                            </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group">
						<div class="row form-group">
						<div class="col-sm-offset-2 col-sm-2">
							<div class="checkbox">
							<label>
                                                            <input type="checkbox" id='chck'> Change Password
								<i class="fa fa-square-o small"></i>
                                                                
							</label>
						</div>
                                                </div>
                                    </div>
                                        <div id='chng_password'>
                                        <div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Old Password</label>
						<div class="col-sm-4">
                                                    <input type='password' class='form-control' name='old_passwd' id='old_passwd' onchange="call(this.value)">
						</div>
                                                <span id='spn'></span>
					</div>
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
                                        </div>
                                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-2">
							<button type="cancel" class="btn btn-default btn-label-left">
							<span><i class="fa fa-clock-o txt-danger"></i></span>
								Reset
							</button>
						</div>
						
						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary btn-label-left">
							<span><i class="fa fa-clock-o"></i></span>
								Submit
							</button>
						</div>
                                        
					</div>
                                    </div>
                                </form>
                        </div>
                </div>
        </div>
    </div>
                </div>
        </div>
</div>

        
        <script src='js/jquery.js'></script>
        <script>
            $(document).ready(
            function()
    {
        $('#chng_password').hide();
    }        
            
            );
    $('#chck').change(function (){
        if($(this).prop('checked'))
        {
            $('#chng_password').show();
        }
        else
        {
            $('#chng_password').hide();
        }
    });
    
        
        
        </script>
               <script>

$(document).ready(function() {
    var $submit = $("input[type=submit], button[type=submit]"),
        $inputs = $('input[type=file]');
       
    function checkEmpty() {

        // filter over the empty inputs

        return $inputs.filter(function() {
            return !$.trim(this.value);
        }).length === 0;
    }

    $inputs.on('change', function() {
        $submit.prop("disabled", !checkEmpty());
    }).change(); 
});


        </script>
    </body>
    
</html>
        <?php 
    include './scripts_to_add.php';
        ?>
            
