<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
	<head>
		<meta charset="utf-8">
		<title>Manage Product Discount | Sai Enterprise</title>
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
        
        <script>
        function chck_id(p_id)
        {
                window.location.href="update_discount.php?delid="+p_id;
        }
//
//
//    function delpro(p_id)
//    {
//        alert(p_id);
//         if (window.XMLHttpRequest)
//                                {
//                                    xmlhttp=new XMLHttpRequest();
//                                } 
//                          else 
//                                {  
//                                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//                                 }
//                          xmlhttp.onreadystatechange=function() {
//                          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
//                            if(xmlhttp.responseText==0)
//                            {
//                                //alert(xmlhttp.responseText);
//                                window.location.href="Manage_Product.php";
//                            }
//                            else
//                            {
//                                    alert(xmlhttp.responseText);
//                            }
//                          }
//                        }
//                        xmlhttp.open("GET","Delete_Product.php?pid="+p_id,true);
//                        xmlhttp.send();
//    }

        function delpro(p_id)
    {
        alert(p_id);
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
                                window.location.href="ManageProductDiscount.php";
                            }
                            else
                            {
                                    alert(xmlhttp.responseText);
                            }
                          }
                        }
                        xmlhttp.open("GET","delete_discount.php?pid="+p_id,true);
                        xmlhttp.send();
    }
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
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Manage Product Discount</span>
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
				<h4 class="page-header">Manage Product Discount</h4>
        <form name="edit_product" method="post" action="update_stock.php">
<div class="panel panel-default">
  <!-- Default panel contents -->
  
  

  
  <!-- Table -->
  <table class="table">
      <thead>
      <tr>
          <th>Sr No</th> 
          <th>Product Name</th>
          <th>Image </th>
          <th>Selling Price</th> 
          <th>Discount % </th>
          <th>Discount From</th>
          <th>Discount Upto</th>
          <th>Operation</th>
         
      </tr>
      </thead>
      
  <?php
        require_once 'connection_file.php';
$sql=  mysqli_query($con,"SELECT * FROM se_discount");
if(mysqli_num_rows($sql) > 0)
        {
            while ($discountarr = mysqli_fetch_array($sql,MYSQLI_BOTH)) {
                $id=$discountarr['discount_id'];
                $pid=$discountarr['product_id'];
                $dp=$discountarr['product_discount_percentage'];
                $from=$discountarr['valid_from'];
                $to=$discountarr['valid_to'];
                //echo $id."<br>".$pid."</br>".$dp."</br>".$from."<br>".$to;
                
                $query = mysqli_query($con,"Select * from se_product WHERE product_id='$pid'");
                if(mysqli_num_rows($query) > 0)
                {
                 while($data = mysqli_fetch_array($query,MYSQLI_BOTH)){
                     $img = $data["product_image_path_1"];
                     $str = "<tr><td>".$discountarr['discount_id']."</td><td>".$data['product_name']."</td><td><img src=$img height=100 width=100></td><td>".$data['product_selling_price']."</td>";
                     $str.= "<td>".$dp."</td><td>".$from."</td><td>".$to."</td>";
                     $str.="<td><input type='button' class='btn btn-primary' value='Edit' onclick=chck_id(".$discountarr['discount_id'].")><br><br><input type=button class='btn btn-danger' value='Delete' onclick=delpro(".$discountarr['discount_id'].")></td></tr>";
                     //$str.="<td><input type='button' class='btn btn-primary' value='Edit' onclick=chck_id(".$data['product_id'].",'".$val."')><br><br><input type=button class='btn btn-danger' value='Delete' onclick=delpro(".$data['product_id'].")></td></tr>";
                     echo $str;
                    }
                }
             
            
            }
        }
        else
            {
                echo"<h1>NO PRODUCT EXIST...!!!</h1>";
            }
//        $q = mysqli_query("select * from se_product");
//        while($data = mysqli_fetch_array($q))
//        {
//            $img = $data["product_image_path_1"];
//            $str = "<tr><td>".$data['product_id']."</td><td>".$data['product_name']."</td><td><img src=$img height=100 width=100></td>";
//            
//            $d = "select category_type from se_product_category where category_id=".$data['category_id'];
//            
//            $get_category = mysqli_fetch_array(mysqli_query($d));
//            $val = $get_category['category_type'];
//            $str.= "<td>".$val."</td><td>".$data['stock_quantity']."</td>";
//            $str.="<td><input type='button' class='btn btn-primary' value='Edit' onclick=chck_id(".$data['product_id'].")></td></tr>";
//            echo $str;
//            
//        }
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



 
