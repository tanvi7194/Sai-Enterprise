<?php
session_start();
?>
<html lang="en"><head>
		<meta charset="utf-8">
		<title>Sai Enterprise | Manage Blog</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" re
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet">
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
	<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
        <script>
        function blog(id)
        {
            
            document.getElementById('edit_blog').submit();
//            edit_blog
//            window.location.href="Update_Blog_Handler.php?b_id="+id;
        }
   
        </script>

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
    
    
    <link rel="stylesheet" href="css/sweet-alert.css">

<script src="js/jquery.js"></script>
<script src="js/sweet-alert.min.js"></script>
        <?php
        if(isset($_GET['stock_updated']))
{
    if($_GET['status']=='yes')
    {
    echo "   <script> $(document).ready(
            function()
    {
        swal({   title: 'Success!', 
                text:".$_GET['stock_updated']." ,
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
                text:".$_GET['stock_updated']." ,
                type: 'error', 
                confirmButtonText: 'Okay'
            });
    });        
</script>
";   
    }    
}
        
        
        ?>
   
    
<body>
<?php 
include_once './half_nav_file.php';
?>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">     
                    <div class="box-content">
                        <form name="edit_blog" id="edit_blog" method="post" action="Update_Blog_Handler.php">
<div class="panel panel-default">
  <!-- Default panel contents -->
  
  

  
  <!-- Table -->
  <table class="table">
      <tr>
          <th>Profile Photo</th> <th>Blog</th> <th></th>
      </tr>
      
                    
<?php 
require_once 'connection_file.php';
$blog = mysqli_query($con,"select * from se_blog");
$pic =  mysqli_query($con,"SELECT * FROM se_administration");
while($blg = mysqli_fetch_array($blog,MYSQLI_BOTH))
{
    while ($row = mysqli_fetch_array($pic,MYSQLI_BOTH)) {
        
    $photo=$row['admin_photo'];
    
        $str = "<tr><td><img class='img-responsive' id='image1' name='image1' src=$photo height=100 width=150></td><td><div class='form-group has-success has-feedback'>
                <div class='col-sm-4'>
                <textarea class='form-control' name='content'  required>".$blg['blog_content']."</textarea>
                </div></div></td>
                <td><input type='submit' class='btn btn-primary' value='Save' onclick=blog(".$blg['blog_id'].")></td></tr>";
                
                
                echo $str;
    }
}


?>

  </table>
</div>
        </form>
                    </div>
                </div>
        </div>
</div>
                </div>
                
                </div>
        </div>

</body>
</html>
<?php 
include_once './scripts_to_add.php';
?>