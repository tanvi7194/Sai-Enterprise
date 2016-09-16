<?php


include './mpdf60/mpdf.php';

$mpdf=new mPDF();
$mpdf->WriteHTML("<h1><p style='text-align: center;'>Stock Report</p></h1>");


$mpdf->WriteHTML("<table class=table border=1>
      <tr>
          <th>Product ID</th> <th>Product Name</th><th>Image </th> <th>Category </th><th>Stock Quantity</th>
      </tr>");
      
     
  

require_once 'connection_file.php';
$q = mysqli_query($con,"select * from se_product order by category_id ASC");
        while($data = mysqli_fetch_array($q,MYSQLI_BOTH))
        {
            $img = $data["product_image_path_1"];
            $mpdf->WriteHTML("<tr><form name='edit_product' method='post' action='Update_Product_Stock_Handler.php'><td style='text-align: center;'><input type='hidden' name='id' value=".$data['product_id'].">".$data['product_id']."</td><td>".$data['product_name']."</td><td><img src=$img height=100 width=100></td>");
            
            $d = "select category_type from se_product_category where category_id=".$data['category_id'];
            
            $get_category = mysqli_fetch_array(mysqli_query($con,$d),MYSQLI_BOTH);
            $val = $get_category['category_type'];
            $mpdf->WriteHTML("<td>".$val."</td><td style='text-align: center;'><div class='form-group has-success has-feedback'><div class='col-sm-5'>".$data['stock_quantity']."</div></div></td>");
            $mpdf->WriteHTML("</form></tr>");
            
            
        }
        $mpdf->WriteHTML("</table>");
?>
                                        
<?php
$mpdf->WriteHTML("</table>");
$mpdf->Output();


?>

