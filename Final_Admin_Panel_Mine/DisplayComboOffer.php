<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
   <meta charset="utf-8">
		<title>Combo Offer | Sai Enterprise</title>
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
                 
       


       
    </head>
    <script>
    function deletecombo(id)
    {
        window.location.href="DeleteComboOffer.php?id="+id;
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
					<span>Combo Offer</span>
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
    <div class="container">
   <div class="row text-center">
            <div class="col-md-12">
            <br/><br/>
            <h3>
            
            Combo Offer
            </h3>
            <br/><br/>
            </div>
    </div>        
           <?php
        require_once 'connection_file.php';

                                        $query = mysqli_query($con,"Select * from se_combo_offer");
                                         
                                        while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {
                                            //echo $row['order_id'];
                                            echo "<tr><form id=form action=DisplayComboOfferDisplay.php method=POST>";
                                            $id=$row['combo_id'];
                                            $cost=$row['combo_amount'];
                                            $desc=$row['combo_description'];
                                            $pc_id=$row['product_combo_id'];
                                            $psc_id=$row['product_service_combo_id'];
                                            
                                            
                                           
                                        ?>
  <div class="row db-padding-btm">
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                <div class="db-wrapper">
                    <div class="db-pricing-eleven db-bk-color-two">
                       
                        <div class="price">
                            <?php echo "<div style='font-size:30'>Cost:</div><br/>";?>
                            Rs<?php echo $cost; echo "/-"; ?>
                            <small></small>
                        </div>
                        <div class="type">
                            <?php echo "<div style='font-size:20'>Description:</div><br/>"; echo $desc; ?>
                        </div>
                        <ul>
<!--                            <li><i class="glyphicon glyphicon-print"></i>-->
                            <?php
                                if($pc_id!=NULL){
                                    
                                    $query1 = mysqli_query($con,"Select * from se_product_combo where product_combo_id=".$pc_id);
                                         echo "<br/>";
                                        while ($row1 = mysqli_fetch_array($query1,MYSQLI_BOTH)) {
                                            
                                            $data=$row1['product_info'];
                                            
                                            $xml = new SimpleXMLElement($data);
                                            $x=0;
                                                
                                                foreach ($xml as $parent) {
                                                $pro_id = $xml->pid[$x];
                                                
                                               
                                                $q=mysqli_query($con,"SELECT * FROM se_product where product_id=".$pro_id);
                                                     while ($row3 = mysqli_fetch_array($q,MYSQLI_BOTH)) {
                                                         $p_nm=$row3['product_name'];
                                                         echo $p_nm."<br/>";
                                                     }
                                                      $x++; 
                                                }
                                           
                                        
                                        }
                                            
                                ?>
                            
                                <?php }
                                ?>
<!--                            </li>-->
<!--                             <li><i class="glyphicon glyphicon-time"></i>-->
                           <?php
                                if($psc_id!=NULL){
                                    
                                    $query2 = mysqli_query($con,"Select * from se_product_service_combo where product_service_combo_id=".$psc_id);
                                         echo "<br/>";
                                        while ($row2 = mysqli_fetch_array($query2,MYSQLI_BOTH)) {
                                            
                                            $data=$row2['product_service_ids'];
                                            
                                            $xml = new SimpleXMLElement($data);
                                            $x=0;
                                                
                                                foreach ($xml as $parent) {
                                                $pro_id = $xml->pid[$x];
                                                $ser_id = $xml->sid[$x];
                                                
                                               if(isset($pro_id)){
                                                $q=mysqli_query($con,"SELECT * FROM se_product where product_id=".$pro_id);
                                                     while ($row3 = mysqli_fetch_array($q,MYSQLI_BOTH)) {
                                                         $p_nm=$row3['product_name'];
                                                         echo $p_nm."<br/>";
                                                     }
                                               }
                                               elseif(isset($ser_id)){
                                                $q1=mysqli_query($con,"SELECT * FROM se_service where service_id=".$ser_id);
                                                     while ($row4 = mysqli_fetch_array($q1,MYSQLI_BOTH)) {
                                                         $s_nm=$row4['service_name'];
                                                         echo $s_nm."<br/>";
                                                     }
                                               }
                                                      $x++; 
                                                }
                                           
                                        
                                        }
                                            
                                ?>
                           
                                <?php }?>
                            </li>
                            
                        </ul>
                        <div class="pricing-footer">

                            <a href="#" class="btn db-button-color-square btn-lg" onclick="deletecombo(<?php echo $id;?>)">DELETE COMBO OFFER</a>
                        </div>
                    </div>
                </div>
            </div>
             <?php } ?>
        </div>
                                       

    </div>
               </div>
	</div>
	
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