<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
	<head>
		<meta charset="utf-8">
		<title>Manage New Arrival | Sai Enterprise</title>
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
   


    function chck_id(p_id)
    {
        
                        window.location.href="Add_New_Arrival_Handler.php?pid="+p_id;
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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Add New Arrival</span>
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
				<h4 class="page-header">Add New Arrival</h4>

        <form name="edit_product" method="post">
<div class="panel panel-default">
  <!-- Default panel contents -->
  
  

  
  <!-- Table -->
  <table class="table">
      <tr>
          <th>Sr No</th> <th>Product Name</th><th>Image </th> <th>Price</th>  <th>Category Name</th>  <th></th>
      </tr>
      
  <?php
 require_once 'connection_file.php';
$flag=0;
        $q = mysqli_query($con,"select * from se_product");
        while($data = mysqli_fetch_array($q,MYSQLI_BOTH))
        {
            $exist = mysqli_query($con,"select * from se_new_arrivals");
            if(mysqli_num_rows($exist)>0)
            {
                while($d = mysqli_fetch_array($exist,MYSQLI_BOTH))
                {
                    
                    if($data['product_id'] != $d['product_id'])
                    {
                        $flag=1;
                        
                        
                    }
                    else
                    {
                        $flag=0;
                        break;
                    }
                }
                
            }
        if($flag==1)
        {
            $img = $data["product_image_path_1"];
            $str = "<tr><td>".$data['product_id']."</td><td>".$data['product_name']."</td><td><img src=$img height=100 width=100></td><td>".$data['product_mrp']."</td>";
            
            $d = "select category_type from se_product_category where category_id=".$data['category_id'];
            
            $get_category = mysqli_fetch_array(mysqli_query($con,$d),MYSQLI_BOTH);
            $val = $get_category['category_type'];
            $str.= "<td>".$val."</td>";
            $str.="<td><input type='button' class='btn btn-primary' value='Add' onclick=chck_id(".$data['product_id'].")></td></tr>";
            echo $str;
        }
        else
        {
          
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
        
        <script src="js/bootstrap.min.js"></script>
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

 
