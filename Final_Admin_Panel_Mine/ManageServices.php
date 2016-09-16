<html lang="en">
    <?php
    session_start();
//    if(isset($_GET["status"]))
//{
//    if($_GET["status"] == "success")
//    {
//        echo "<script>alert('status changed successfully!')</script>";
//    }
//    else
//    {
//        echo "<script>alert('Error')</script>";
//    }
//}
    ?>
	<head>
		<meta charset="utf-8">
		<title>Manage Services | Sai Enterprise</title>
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
<!--		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
     <script>
        function chck_id(p_id,cat)
        {

            if(cat=='Laptop')
            {

                window.location.href="EditProductLaptop.php?delid="+p_id;
            }
            else if(cat=="Graphic_Card")
            {

                window.location.href="EditProductGraphiccard.php?delid="+p_id;
            }
            else if(cat=="Mother_Board")
            {

                window.location.href="EditProductMotherBoard.php?delid="+p_id;
            }
            else if(cat=="Processor")
            {

                window.location.href="EditProductProcessor.php?delid="+p_id;
            }
            else if(cat=="External_Harddisk")
            {
                window.location.href="EditProductHDD(External).php?delid="+p_id;
            }
            else if(cat=="Internal_Harddisk")
            {
                window.location.href="EditProductHDD(Internal).php?delid="+p_id;
            }
            else if(cat=="Router")
            {
                window.location.href="EditProduct_Router.php?delid="+p_id;
            }
        }


    function delpro(p_id)
    {
//        alert(p_id);
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
                                window.location.href="Manage_Product.php";
                            }
                            else
                            {
                                    alert(xmlhttp.responseText);
                            }
                          }
                        }
                        xmlhttp.open("GET","Delete_Product.php?pid="+p_id,true);
                        xmlhttp.send();
    }

    function changeStatus(serv_id,user_id)
    {
        window.location.href="http://localhost/SaiEnterpriseWebsite/Final_Admin_Panel_Mine/changeservicestatus.php?sid="+serv_id+"&uid="+user_id;
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
        <link rel="stylesheet" href="css/sweet-alert.css">

        <script src="js/jquery.js"></script>
        <script src="js/sweet-alert.min.js"></script>
        
        <?php
        if(isset($_GET['service_status']))
{
    if($_GET['status']=='success')
    {
    echo "   <script> $(document).ready(
            function()
    {
        swal({   title: 'Success!', 
                text:".$_GET['service_status']." ,
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
                text:".$_GET['service_status']." ,
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
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Manage Services</span>
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
				<h4 class="page-header">Manage Services</h4>

        <form name="edit_product" method="post">
<div class="panel panel-default">
  <!-- Default panel contents -->
<!--  <div class="panel-heading">Panel heading</div>-->



  <!-- Table -->
  <table class="table">
      <thead>
          <th>Sr No</th> <th>User Name</th><th>Service Name </th> <th>Service Status</th>  <th></th>  <th></th>
      </thead>
      <tbody>
  <?php
        require_once 'connection_file.php';

$i=1;
        $q = mysqli_query($con,"select * from se_service_user");
        while($data = mysqli_fetch_array($q,MYSQLI_BOTH))
        {
            $sid = $data["service_id"];
            $uid = $data["u_id"];
            echo "<tr>";
            echo "<td>".$i."</td>";
            $getuser=mysqli_query($con,"select * from se_user where u_id=".$data["u_id"]);
            while($row1=mysqli_fetch_array($getuser,MYSQLI_BOTH))
            {
               echo "<td>".$row1["u_fname"]."</td>";

            }
            $getuser=mysqli_query($con,"select * from se_service where service_id=".$data["service_id"]);
            while($row1=mysqli_fetch_array($getuser,MYSQLI_BOTH))
            {
               echo "<td>".$row1["service_name"]."</td>";

            }
            

            echo "<td>".$data["service_status"]."</td>";
            echo "<td><button type='button' class='btn btn-primary' onclick='changeStatus($sid,$uid);'>Change Status</button></td>";
            echo "</tr>";
            $i++;
        }

        ?>

</tbody>
  </table>
</div>

        
        </form>
                        </div>
			</div>
		</div>
	</div>

		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->


 
</body>
</html>
<?php 
    include_once './scripts_to_add.php';
?>



