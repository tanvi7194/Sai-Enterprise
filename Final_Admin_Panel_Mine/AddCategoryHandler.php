
<!DOCTYPE html>
<html lang="en">
 
<?php 
session_start();
?>


    <head>
        <head>
		<meta charset="utf-8">
		<title>Manage New Category | Sai Enterprise</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
                <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">
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
	<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
        
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
					<span>Add New Category</span>
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
        <form method="post" action="abc.php">
            
      <table class="table">
      <thead>
      <tr>
          <th>Sr No</th> 
          <th>Field Name</th>
          <th>Data Type </th>
          
      </tr>
      </thead>
<?php

$num = $_SESSION['number'];
$_SESSION['category'] = $_POST['cat2'];
//echo "<table><th>Sr No</th><th>Field Name</th><th>Data Type</th><th></th></tr>";
 $f=1;
 $_SESSION['num']=$num;
for($i=1;$i<=$num;$i++)
{
        
    $a = $_POST['name'.$i];
    $_SESSION['name'.$i]=$a;
    $b = $_POST['nm'.$i];
    $_SESSION['nm'.$i]=$b;
   
    if($b!='Text_Value_Tool')
    {
        $c = $_POST['a'.$i];
        echo "<tr><td><label class='col-sm-3 control-label'>$i</label></td><td><label class='col-sm-3 control-label'>".$a."</label></td><td> <label class='col-sm-3 control-label'>".$b."</label></td><td><label class='col-sm-3 control-label'>".$c."</label></td><td>";
        $_SESSION['j1'.$i]=$c;
        //echo "<br>C is  ".$c."<br>";
        for($j=$f;$j<($f+$c);$j++)
        {
            
            echo "Value-$j<input type=text class='form-control' name=txt$j>";
        }
        $f = $j;
        $_SESSION['lastValue']=$f;
        //echo "<br>F is".$f."<br>";
        echo "</td></tr>";
        
        
    }
    else
    {
       echo "<tr><td><label class='col-sm-3 control-label'>$i</label></td><td><label class='col-sm-3 control-label'>".$a."</label></td><td><label class='col-sm-3 control-label'> ".$b."</label></td><td></td></tr>  ";
    }
   
}
 //echo "</table>";

?>
      <tr><td>
      <div class="form-group">
      <div class="col-sm-3">
        <button type="submit" class="btn btn-primary btn-label-left ">
        <span><i class="fa fa-clock-o"></i></span>
                Submit
        </button>
</div>
      </div>
          </td></tr>
      
      </table>      
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
