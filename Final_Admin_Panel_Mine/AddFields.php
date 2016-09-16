<?php
session_start();

$cat = $_REQUEST['name'];
$num = $_REQUEST['num'];
$_SESSION['number'] = $num;
require_once './connection_file.php';
$exist = mysqli_num_rows(mysqli_query($con,"select * from se_product_category where category_type='".$cat."'"));
if($exist==0)
{
for($i=1;$i<=$num;$i++)
{
    echo "<div class='form-group'>
            <label class='col-sm-3 control-label'>Field-$i</label>
            <div class='col-sm-2'>
                <input type='text' class='form-control' name='name$i'>

            </div>
            <label class='col-sm-3 control-label'>Input type-$i</label>
            <div class='col-sm-2'>
                <select name='nm$i' onchange=values(this.value,$i) class='form-control'>
                    <option value='Text_Value_Tool'>Text Value Tool
                    <option value='Single_Selection_Tool'>Single Selection Tool
                    <option value='Multiple_Selection_Tool'>Multiple Selection Tool

                </select>
            </div>
            <div class='col-sm-2'>
                <span id=txt$i></span>
            </div>

            </div>";
}
?>
<div class="col-sm-2">
                                                    <button type="submit" class="btn btn-primary btn-label-left" >
							<span><i class="fa fa-clock-o"></i></span>
								Submit
							</button>
						</div>
<?php
}
else
{
    echo "The Category with the Same name Exists!!";
}