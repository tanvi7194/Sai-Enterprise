<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
	<head>
		<meta charset="utf-8">
		<title>Sai Enterprise | Manage Testimonials</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" re
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet">
<!--		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">-->
		<link href="css/style_v2.css" rel="stylesheet">
<!--		<link href="plugins/chartist/chartist.min.css" rel="stylesheet"> -->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
 
    
    
    
    
    
    
            <script>
 


    function delpro(f_id)
    {
        //alert(f_id);
         if (window.XMLHttpRequest)
                                {
                                    xmlhttp=new XMLHttpRequest();
                                } 
                          else 
                                {  
                                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                 }
                          xmlhttp.onreadystatechange=function() {
                          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            if(xmlhttp.responseText==0)
                            {
                                //alert(xmlhttp.responseText);
                                window.location.href="ManageTestimonials.php";
                            }
                            else
                            {
                                    //alert(xmlhttp.responseText);
                            }
                          }
                        }
                        xmlhttp.open("GET","Delete_Testimonial_Handler.php?fid="+f_id,true);
                        xmlhttp.send();
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
                            //alert(xmlhttp.responseText);
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
					<span>Manage Testimonials</span>
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
				<h4 class="page-header">Manage Testimonials</h4>

        <form name="edit_product" method="post">
<div class="panel panel-default">
  <!-- Default panel contents -->
  
  

  
  <!-- Table -->
  <table class="table">
      <tr>
          <th>Sr No</th> <th>Product Name</th><th>Image </th> <th>User Name</th>  <th>Feedback Content</th>  <th></th>
      </tr>
      
  <?php
  require_once 'connection_file.php';
        $sql=  mysqli_query($con,"SELECT * FROM se_feedback");
        if(mysqli_num_rows($sql) > 0)
        {
            while ($feed=mysqli_fetch_array($sql,MYSQLI_BOTH)) {
                
                $id=$feed['feedback_id'];
                
                $pid=$feed['product_id'];
                //echo "Product id".$id;
                $uid=$feed['u_id'];
                //echo "user id".$uid;
                
                $q1 = mysqli_query($con,"Select * from se_user WHERE u_id='$uid'");
                while($d1 = mysqli_fetch_array($q1,MYSQLI_BOTH)){
                    $uname=$d1['u_fname'];
                    //echo "User name".$uname;
                }
                $query = mysqli_query($con,"Select * from se_product WHERE product_id='$pid'");
                 while($data = mysqli_fetch_array($query,MYSQLI_BOTH)){
                     
                     $img = $data["product_image_path_1"];
                     $str = "<tr><td>".$data['product_id']."</td><td>".$data['product_name']."</td><td><img src=$img height=100 width=100></td>";
                     
                     $str.="<td>".$uname."</td><td>".$feed['feedback_content']."</td>";
                     $str.="<td><input type='button' class='btn btn-primary' value='Delete' onclick=delpro(".$feed['feedback_id'].")></td></tr>";
                     echo $str;
                 }
            }
        }
//        $data = mysqli_fetch_array($q);
//        $productAttributes = $data['product_attribute'];
//
////                            
//        echo $productAttributes;
        ?>
      
      
  </table>
</div>        
        
        
        </form>
    </div>
			</div>
		</div>
	</div>
<!--                    </div>-->
		</div>
		<!--End Content-->
	</div>
</div>
    
    
  
    </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>


 
