<!DOCTYPE html>
<html lang="en">
    
<?php
session_start();
?>
	<head>
             <link rel="stylesheet" href="css/sweet-alert.css">


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/sweet-alert.min.js"></script>

            <?php
            
if(isset($_GET['combo_added']))
{
    if($_GET['status']=='yes')
    {
    echo "   <script> $(document).ready(
            function()
    {
        swal({   title: 'Success!', 
                text:".$_GET['combo_added']." ,
                type: 'success', 
                confirmButtonText: 'Okay'
            });
    });        
</script>
";   
    }
    else
    {
    echo "   <script> $(document).ready(
            function()
    {
        swal({   title: 'error!', 
                text:".$_GET['combo_added']." ,
                type: 'error', 
                confirmButtonText: 'Okay'
            });
    });        
</script>
";   
    }    
}
            
            ?>
		<meta charset="utf-8">
		<title>Sai Enterprise | Manage Combo Offer</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" re
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
<!--		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">-->
		<link href="css/style_v2.css" rel="stylesheet">
<!--		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->

                <script type="text/javascript">
            function SendMessage(userid,msg)
            {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

//                        document.getElementById("displayItems").innerHTML = xmlhttp.responseText;
                            alert(xmlhttp.responseText);
                    }

                }
                xmlhttp.open("GET", "sendMessage.php?value=" + msg+"&id="+userid, true);
                xmlhttp.send();

            }

            function getMessage(userid)
            {
//                var objDiv = document.getElementById("message");
//                objDiv.scrollTop = objDiv.scrollHeight;
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        document.getElementById("message").innerHTML = xmlhttp.responseText;

                    }

                }
                xmlhttp.open("GET", "getMessage.php?value="+userid, true);
                xmlhttp.send();

            }
        </script>
        <script>
            setInterval(function(){getMessage(<?php echo $_SESSION["admin_id"];?>)},5000);



        </script>
	</head>
    <body>
        <?php 
                    include_once './half_nav_file.php';
        ?>
        <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Manage Combo Offer</span>
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
				<form id="defaultForm" method="post" action="AddComboHandler.php" class="form-horizontal">
					<fieldset>
						<legend>Manage Combo Offer</legend>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Select Category of Combo Offer</label>
							<div class="col-sm-5">
								<select class="populate placeholder" name="selectedval" id="product">
									<option value="">-- Select Category of Combo Offer --</option>
									<option value="Products Only">Products Only</option>
									<option value="Combo of Products And Services">Combo of Products And Services</option>
									
								</select>
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
					</fieldset>
					
				</form>
			</div>
		</div>
	</div>
	
</div>
        <script type="text/javascript">
        $(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
     size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
});
$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chat_window_1" ).remove();
});


        </script>
    </body>
</html>
<?php 
include_once './scripts_to_add.php';
?>