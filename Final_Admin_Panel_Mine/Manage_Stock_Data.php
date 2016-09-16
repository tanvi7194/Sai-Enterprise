<?php
$flag=0;
$id = $_REQUEST['id'];
$str = "<table class='table'>
      <tr>
          <th>Sr No</th> <th>Product Name</th><th>Image </th> <th>Category </th><th>Stock Quantity</th><th></th>
      </tr>";
      
 
 require_once 'connection_file.php';
if(!$con)
{
    die("Please check your connection");
}


mysqli_select_db($databse);
if($id==0)
{
        $q = mysqli_query($con,"select * from se_product");
        while($data = mysqli_fetch_array($q,MYSQLI_BOTH))
        {
            $img = $data["product_image_path_1"];
            $str.= "<tr><form id='form".$flag."' name='edit_product' method='post' action='Update_Product_Stock_Handler.php'><td><input type='hidden' name='id' value=".$data['product_id'].">".$data['product_id']."</td><td>".$data['product_name']."</td><td><img src=$img height=100 width=100></td>";
            
            $d = "select category_type from se_product_category where category_id=".$data['category_id'];
            
            $get_category = mysqli_fetch_array(mysqli_query($con,$d),MYSQLI_BOTH);
            $val = $get_category['category_type'];
            $str.= "<td>".$val."</td><td><div class='form-group has-success has-feedback'><div class='col-sm-5'><input type='Number' class='form-control' name='stock' id='stock".$flag."' value=".$data['stock_quantity']." required></div></div></td>";
            $str.="<td><input type='submit' class='btn btn-primary save' id='".$flag."' value='Save' ></td></form></tr>";
            
            $flag++;
        }
}
else
{
        $q = mysqli_query($con,'select * from se_product where category_id='.$id);
        while($data = mysqli_fetch_array($q,MYSQLI_BOTH))
        {
            $img = $data["product_image_path_1"];
            $str.= "<tr><form id=edit_product name='edit_product' method='post' action='Update_Product_Stock_Handler.php'>"
                    . "<td><input type='hidden' name='id' value=".$data['product_id'].">".$data['product_id']."</td>"
                    . "<td>".$data['product_name']."</td><td><img src=$img height=100 width=100></td>";
            
            $d = "select category_type from se_product_category where category_id=".$data['category_id'];
            
            $get_category = mysqli_fetch_array(mysqli_query($con,$d),MYSQLI_BOTH);
            $val = $get_category['category_type'];
            $str.= "<td>".$val."</td><td><div class='form-group has-success has-feedback'>
						
						<div class='col-sm-5'>
							<input type='Number' class='form-control' name='stock' value=".$data['stock_quantity']." required>
						</div>
					</div></td>";
            $str.="<td><input type='submit' class='btn btn-primary save' value='Save'></td></form></tr>";
            
            
    
        }
        
}
            
 $str.="</table>";
 echo $str;
       
        ?>
      
      
  