<?php

//fetch_item.php


// use DataBaseAction;
$query = "SELECT * FROM tbl_product ORDER BY id ASC";

$statement = $conn->Getconnection()->prepare($query);

if($statement->execute())
{
	$result = $statement->fetchAll();
	$output = '';

?>
<div class="container">
<div class="row mb-5" style=" margin:25px auto;">
<?php
	foreach(array_slice($result,0,3) as $row)
	{


	?>
	
	
		<div class="col-md-4 " >  
            <div class="card"  >
            	<img src="images/<?php echo $row["image"];?>" class="img-fluid" style="max-width: 100%; height:auto; min-height:240px;" /><br />
            	<h4 class="card-title"><?php echo $row["name"];?></h4>
            	<h4 class="text-danger">$ <?php echo $row["price"];?></h4>
            	<input type="text" name="quantity" id="quantity<?php echo $row["id"];?>" class="form-control" value="1" />
            	<input type="hidden" name="hidden_name" id="name<?php echo $row["id"];?>" value="<?php echo $row["name"];?>" />
            	<input type="hidden" name="hidden_price" id="price<?php echo $row["id"];?>" value="<?php echo $row["price"];?>" />
            	<input type="button" name="add_to_cart" id="<?php echo $row["id"];?>" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Order" />
            </div>
        </div>
		
	<?php
	}
	?>
</div>
<div class="row mb-5" style=" margin:0px auto">
<?php
	foreach(array_slice($result,3,3,true) as $row)
	{


	?>
	
	
		<div class="col-md-4 " >  
            <div class="card"  >
            	<img src="images/<?php echo $row["image"];?>" class="img-fluid" style="width: 100%; height:auto; min-height:250px; " /><br />
            	<h4 class="card-title"><?php echo $row["name"];?></h4>
            	<h4 class="text-danger">$ <?php echo $row["price"];?></h4>
            	<input type="text" name="quantity" id="quantity<?php echo $row["id"];?>" class="form-control" value="1" />
            	<input type="hidden" name="hidden_name" id="name<?php echo $row["id"];?>" value="<?php echo $row["name"];?>" />
            	<input type="hidden" name="hidden_price" id="price<?php echo $row["id"];?>" value="<?php echo $row["price"];?>" />
            	<input type="button" name="add_to_cart" id="<?php echo $row["id"];?>" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Order" />
            </div>
        </div>
		
	<?php
	}
	?>
</div>
<div class="row mb-5" style=" margin:0px auto">
<?php
	foreach(array_slice($result,6,3,true) as $row)
	{


	?>
	
	
		<div class="col-md-4 " >  
            <div class="card"  >
            	<img src="images/<?php echo $row["image"];?>" class="img-fluid d-block" style="max-width: 100%; height:auto; min-height:250px " /><br />
            	<h4 class="card-title"><?php echo $row["name"];?></h4>
            	<h4 class="text-danger">$ <?php echo $row["price"];?></h4>
            	<input type="text" name="quantity" id="quantity<?php echo $row["id"];?>" class="form-control" value="1" />
            	<input type="hidden" name="hidden_name" id="name<?php echo $row["id"];?>" value="<?php echo $row["name"];?>" />
            	<input type="hidden" name="hidden_price" id="price<?php echo $row["id"];?>" value="<?php echo $row["price"];?>" />
            	<input type="button" name="add_to_cart" id="<?php echo $row["id"];?>" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Order" />
            </div>
        </div>
		
	<?php
	}
	?>
</div>

</div>
<?php	
}


?>