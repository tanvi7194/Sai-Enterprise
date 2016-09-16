<?php
$type = json_decode($_REQUEST['value']);


require_once 'connection_file_user.php';
foreach ($type as $key) {

    $result = mysqli_query($con,"select * from se_product where category_id=$key");
    if(!$result)
    {
        echo "lol";
    }
    while($data = mysqli_fetch_array($result,MYSQLI_BOTH))
                                {
                                
    



?>
<div class="col-xs-18 col-sm-4 col-md-4">
			<div class="productbox">

				<div class="imgthumb img-responsive">
                                    <img class="img" src="<?php echo $data['product_image_path_1']; ?>" height="300" width="250">
				</div>
				<div class="caption">
					<h5><?php echo $data["product_name"]; ?></h5>
                  	<s class="text-muted">&#8377; <?php echo $data["product_mrp"]; ?></s> <b class="finalprice">&#8377; <?php echo $data["product_selling_price"]; ?></b>
                        
                    <form method="POST" action="product_details.php">
                            <input type="hidden" value='<?php echo $data['product_id']; ?>' name='pid' id='pid'/>
                            <input type="submit" value="Buy Now" class="btn btn-success btn-md btn-block">
                      
                        </form>
                        
              	</div>
                            
			</div>
		</div>
                <?php
                                }


}
                ?>



