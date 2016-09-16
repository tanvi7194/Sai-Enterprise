<?php


include './mpdf60/mpdf.php';

$mpdf=new mPDF();
$mpdf->WriteHTML("<h1><p style='text-align: center;'>Product Report</p></h1>");


$mpdf->WriteHTML("<table class=table border=1>
                                        <thead>
                                            <tr>
                                                <th>Product ID </th>

                                                <th>Product Image</th>
                                                <th>Product Name</th>
                                                <th>Total Purchases</th>
                                                <th>Stock Quantity</th>


                                            </tr> 
                                            </thead>");
      
     
  

                                            require_once 'connection_file.php';
           
                                            $productReport = mysqli_query($con,"Select count(product_id) , product_id  from se_productReportTable group by product_id order by count(product_id) DESC");

                                            while ($row1 = mysqli_fetch_array($productReport,MYSQLI_BOTH)) {
                                                $pid=$row1['product_id'];

                                                $query = mysqli_query($con,"Select * from se_product where product_id=$pid");
                                                while ($rowdisplay = mysqli_fetch_array($query,MYSQLI_BOTH)) {
                                                    
                                                    

                                                    $img=$rowdisplay['product_image_path_1'];
                                                    $mpdf->WriteHTML( "<tr>");

                                                    $mpdf->WriteHTML( '<td>' . $rowdisplay['product_id'] . '</td>');

                                                    
                                                   
                                                $mpdf->WriteHTML("<td>");
                                                $mpdf->WriteHTML("<img src=$img height=100 width=100>");
                                                $mpdf->WriteHTML("</td>");
                                                
                                                $mpdf->WriteHTML( "<td style='text-align: center;'>" . $rowdisplay['product_name'] . "</td>");
                                                 $mpdf->WriteHTML("<td style='text-align: center;'>" . $row1[0] . "</td>");
                                                
                                                
                                                $mpdf->WriteHTML( "<td style='text-align: center;'>". $rowdisplay['stock_quantity'] . "</td></tr>");
                                            }
                                                }
                                        
                                       

                                        

$mpdf->WriteHTML("</table>");
$mpdf->Output();


?>

