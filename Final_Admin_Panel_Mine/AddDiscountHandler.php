 <?php
 $id = $_REQUEST['id'];
 //echo $id;
 
 echo 
 "<div class='box'>     
                    <div class='box-content'>
        <form name='edit_product' method='post'>
<div class='panel panel-default'>";
  
  
  

  
      
 
 require_once 'connection_file.php';
if($id==0)
{
    echo "
  <table class='table'>
      <tr>
          <th>Sr No</th> <th>Product Name</th><th>Image </th> <th>Price</th>  <th>Category Name</th>  <th></th>
      </tr>";
  
        $q = mysqli_query($con,'select * from se_product');
        while($data = mysqli_fetch_array($q,MYSQLI_BOTH))
        {
            $exist = mysqli_query($con,"select * from se_discount");
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
            $img = $data['product_image_path_1'];
            $str = "<tr><td>".$data['product_id']."</td><td>".$data['product_name']."</td><td><img src=".$img." height=100 width=100></td><td>".$data['product_mrp']."</td>";
            
            $d = 'select category_type from se_product_category where category_id='.$data['category_id'];
            
            $get_category = mysqli_fetch_array(mysqli_query($con,$d),MYSQLI_BOTH);
            $val = $get_category['category_type'];
            $str.= '<td>'.$val.'</td>';
            $str.="<td><input type='button' class='btn btn-primary' value='ADD DISCOUNT' onclick=chck_id(".$data['product_id'].",'".$val."')></td></tr>";
            echo $str;
            }
            
        }
}
else
    {
    
        
        $q1 = mysqli_query($con,'select product_id from se_product where category_id='.$id);
         $count = mysqli_fetch_array($q1,MYSQLI_BOTH);
         //echo "Count ".$count[0];
        if($count==0){
            echo "<table class='table'>
      <tr><td><center><b><h2>PRODUCTS DOES NOT EXIST IN THIS CATEGORY..!!!</h2></b></center></td></tr>";
        }
    else{
            //echo "else";
        echo "
  <table class='table'>
      <tr>
          <th>Sr No</th> <th>Product Name</th><th>Image </th> <th>Price</th>  <th>Category Name</th>  <th></th>
      </tr>";
            $q = mysqli_query($con,'select * from se_product where category_id='.$id);
        while($data = mysqli_fetch_array($q,MYSQLI_BOTH))
        {
            
            $exist = mysqli_query($con,"select * from se_discount");
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
             
            $img = $data['product_image_path_1'];
            $str = "<tr><td>".$data['product_id']."</td><td>".$data['product_name']."</td><td><img src=".$img." height=100 width=100></td><td>".$data['product_mrp']."</td>";
            
            
            $d = 'select category_type from se_product_category where category_id='.$data['category_id'];
            
            $get_category = mysqli_fetch_array(mysqli_query($con,$d),MYSQLI_BOTH);
            $val = $get_category['category_type'];
            $str.= '<td>'.$val.'</td>';
            $str.="<td><input type='button' class='btn btn-primary' value='ADD DISCOUNT' onclick=chck_id(".$data['product_id'].",'".$val."')></td></tr>";
            echo $str;
            }
             
            
        }
    }
}
?>
      
      
  </table>
</div>        
        
        
        </form>
                    </div>
                    
                </div>