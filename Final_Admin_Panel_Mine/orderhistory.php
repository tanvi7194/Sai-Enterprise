<?php
require_once 'connection_file.php';
session_start();
if (!isset($_POST['delid'])) {
    $_POST['delid'] = $_SESSION['delid'];
} else {
    $_SESSION['delid'] = $_POST['delid'];
}
$oid = $_POST['delid'];
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Order History | Sai Enterprise</title>
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
	<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
        <script type="text/javascript">
            function updateStatus(value)
            {
               
            window.location.href="updateOrderStatus.php?value=" + value;
        }
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
					<span>Full Order Details</span>
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
                    
                    <?php
                $query = mysqli_query($con,"Select * from se_orders WHERE order_id='$oid'");
                while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {

                    $data = $row['product_info'];
                    $xml = new SimpleXMLElement($data);
                    $x = 0;
                    foreach ($xml->children() as $parent) {
                        $arr[$x] = $xml->p_id[$x];
                        //echo "array of x".$xml->p_id[$x];
                        $x++;
                    }
                    for ($index = 0; $index < count($arr); $index++) {
                          //echo "Array contents" . $arr[$index];
                    }
                    //
                    ?>
			<div class="box-content">
				<div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Full Order Details</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">

                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-offset-0">

                                            <!-- Simple Invoice - START -->
                                            <!--<div class="container col-lg-10">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="row">
                                            -->
                                            <div class="col-xs-12 col-md-6 col-lg-5 pull-left">
                                                <div class="panel panel-default height">
                                                    <div class="panel-heading">Order Information</div>
                                                    <div class="panel-body">
                                                        <label class="col-lg-5 col-sm-9 col-xs-8 control-label"><strong>Order ID:</strong></label><label class="col-lg-5 col-sm-9 col-xs-4 control-label"> <?php echo $row['order_id']; ?></label><br/>
                                                        <label class="col-lg-5 col-sm-9 col-xs-10 control-label"><strong>Transaction ID:</strong></label><label class="col-lg-5 col-sm-9 col-xs-4 control-label"> <?php echo $row['transaction_id']; ?></label><br/><br/>
                                                        <label class="col-lg-4 col-sm-9 col-xs-12 control-label"><strong>Order Status:</strong></label>
                                                        <label class="col-lg-6 col-sm-9 col-xs-12 control-label">
                                                            <select name="orderstat" id="orderstat" placeholder="<?php echo $row['order_status']; ?>" class="form-control placeholder" onchange="updateStatus(orderstat.value)">
                                                                <option id="tag1" selected="selected"><?php echo $row['order_status']; ?></option>
                                                                <option value="Dispatching Soon">Dispatching Soon</option>
                                                                <option value="Dispatched">Dispatched</option>
                                                                <option value="In-Transit">In-Transit</option>
                                                                <option value="Out For Delivery">Out For Delivery</option>
                                                                <option value="Delivered">Delivered</option>
                                                                <option value="Cancelled">Cancelled</option>
                                                                <option value="Returned To Origin">Returned To Origin</option>
                                                                
                                                            </select>
                                                        </label>
<!--                                                        <a href="#" onclick="updateStatus(orderstat.value)"><label class="col-lg-1 col-sm-9 col-xs-12 control-label" ><span class="glyphicon glyphicon-refresh" ></span></label></a>-->
                                                        <br/>
                                                        <br/><br/>
                                                        <label class="col-lg-5  col-sm-9 col-xs-7 control-label"><strong>Payment Method:</strong></label>
                                                        <label class="col-lg-5 col-sm-9 col-xs-1 control-label"><select name="payment_method" id="orderstatus" placeholder="<?php echo $row['order_payment_mode']; ?>" class="form-control placeholder" >
                                                                <option id="tag1" selected="selected"><?php echo $row['order_payment_mode']; ?></option>
                                                                <option value="Debit Card">Debit Card</option>
                                                                <option value="Credit Card">Credit Card</option>
                                                                
                                                            </select></label>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-3 col-lg-3">
                                                <div class="panel panel-default height">
                                                    <div class="panel-heading">Order Preferences</div>
                                                    <div class="panel-body">
                                                        <strong>Gift:</strong> No<br>
                                                        <strong>Coupon:</strong> No<br>
                                                        <strong>Refund:</strong> No<br>
                                                        <strong>Order Cancellation:</strong> No<br>
                                                        <strong>Order Date:</strong> <?php echo $row['order_date']; ?><br><br>

                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            $uid = $row['u_id'];
                                        }
                                        $query = mysqli_query($con,"Select u_fname,u_lname from se_user WHERE u_id='$uid' ");
                                        while ($user = mysqli_fetch_array($query,MYSQLI_BOTH)) {
                                            $fn = $user['u_fname'];
                                            $ln = $user['u_lname'];
                                            ?>

                                            <div class="col-xs-12 col-md-3 col-lg-4 pull-right">
                                                <div class="panel panel-default height">
                                                    <div class="panel-heading">Shipping Address</div>
                                                    <div class="panel-body">
                                                        <label class="col-lg-12 col-sm-9 col-xs-12 control-label"><?php echo $fn . " " . $ln; ?></label>
                                                        <!--                                        <AddressInfo>-->
                                                        <?php
                                                    } ?>

                                                    <?php $address=mysqli_fetch_array(mysqli_query($con,"Select * from se_shipping_address where u_id=".$uid),MYSQLI_BOTH);echo $address['add_line_1'];?><br>
                                                    <?php echo $address['add_line_2'];?><br>
                                                    <?php $city=mysqli_fetch_array(mysqli_query($con,"Select * from se_shipping_address where u_id=".$uid),MYSQLI_BOTH);
                                                    $cityadd= $city['city_id']; 
                                                    $cityname=mysqli_fetch_array(mysqli_query($con,"Select * from se_city where city_id=".$cityadd),MYSQLI_BOTH);
                                                    echo $cityname['city_name'];
                                                    ?><br>
                                                    <strong><?php echo $address['zip_code'];?></strong><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            //$sql = mysqli_query($con,"SELECT notification_c_id FROM se_orders WHERE order_id='$oid'");
//                            $sql = mysqli_query($con,"Select * from se_orders WHERE order_id='$oid'");
//                            if (mysqli_num_rows($sql) > 0) {
//                                while ($bill = mysqli_fetch_array($sql,MYSQLI_BOTH)) {
//                                    'Bil id:' . $bid = $bill['notification_c_id'];
//                                }
//                            } else {
//                                die("There was an error with the bill request!!") . mysqli_error();
//                            }

                            $billquery = mysqli_query($con,"Select * from se_orders WHERE order_id='$oid'");
                            if (mysqli_num_rows($billquery) > 0) {
                                $count = 0;
                                while ($billinfo = mysqli_fetch_array($billquery,MYSQLI_BOTH)) {
                                    $data = $billinfo['product_info'];
                                    file_put_contents("orderinfo.xml", $data);
                                    $xml = new SimpleXMLElement($data);
                                }
                                $xml = new SimpleXMLElement($data);
                                foreach ($xml->pid as $parent) {
                                    $proid[$count] = $xml->pid[$count];
                                    $qty[$count] = $xml->quantity;
                                    $price[$count] = $xml->price;
                                    
                                    
                                    $count++;
                                }
                            } else {
                                die("There was an error with the bill request!!") . mysqli_error();
                            }
                            ?>                        

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="text-center"><strong>Order summary</strong></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>Item Name</strong></td>
                                                            <td class="text-center"><strong>Item Price</strong></td>
                                                            <td class="text-center"><strong>Item Quantity</strong></td>
                                                            <td class="text-right"><strong>Total</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $y = 0;
                                                    $total=0;
                                                    $cou=0;
                                                    foreach ($xml->pid as $pq) {
                                                        $pquery = mysqli_query($con,"SELECT * FROM se_product WHERE product_id='$proid[$y]'");
                                                        while ($pq = mysqli_fetch_array($pquery,MYSQLI_BOTH)) {

                                                            $pnm = $pq['product_name'];
                                                            $cou++;
                                                            $price=$pq['product_selling_price'];
                                                            $total1=$qty[$y]*$price;
                                                            $total+=$total1;
                                                            ?>
                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo $pnm; ?></td>
                                                                    <td class="text-center">Rs. <?php echo $price; ?></td>
                                                                    <td class="text-center"><?php echo $qty[$y]; ?></td>
                                                                    <td class="text-right">Rs. <?php echo $qty[$y]*$price; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            $y++;
                                                        }
                                                        ?>
                                                        <tr>    
                                                            <td class="highrow"></td>
                                                            <td class="highrow"></td>
                                                            <td class="highrow text-center"><strong>Subtotal</strong></td>
                                                            <td class="highrow text-right">
                                                                <?php
                                                                
                                                                echo 'Rs. ' . $total;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                                            <td class="emptyrow text-right">Rs. 0</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow text-center"><strong>Total</strong></td>
                                                            <td class="emptyrow text-right"><?php echo 'Rs. ' . $total; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                       
                                       
                                    </div>
                                     <input type="button" class="col-sm-2 col-xs-5 col-lg-offset-9 col-xs-offset-3 text-center btn btn-primary" value="Save">
                                     <br/>
                                </div>
                            </div>
                                
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
			</div>
		</div>
	</div>
	
</div>
    </div>
    </div>
    </div>

        <script>
                                                            $(document).ready(function () {
                                                                $('#dataTables-example').dataTable();
                                                                $('#dataTables-example_filter').hide();

                                                                //        $(select).click(
                                                                //                {
                                                                $('#tag1').hide();
                                                                //                });
                                                                ////        $('select').blur(
                                                                //                {
                                                                //                  $('#tag1').show();  
                                                                //                });

                 $('#manorder').addClass("active");


                                                            }
                                                            );
        </script>
    </body>
</html>
<?php 
        include_once './scripts_to_add.php';
?>