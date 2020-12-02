<?php

//fetch_item.php

include('database_connection.php');

$query = "SELECT * FROM tbl_product ORDER BY id ASC";

$statement = $connect->prepare($query);

if($statement->execute())
{
	$result = $statement->fetchAll();
	$output = '';

?>
<div class="container">
<div class="row">
<?php
	foreach($result as $row)
	{


	?>
	
	
		<div class="col-md-3 " >  
            <div class="card"  >
            	<img src="images/<?php echo $row["image"];?>" class="img-fluid" style="width: 100%; min-height:200px; " /><br />
            	<h4 class="card-title"><?php echo $row["name"];?></h4>
            	<h4 class="text-danger">$ <?php echo $row["price"];?></h4>
            	<input type="text" name="quantity" id="quantity<?php echo $row["id"];?>" class="form-control" value="1" />
            	<input type="hidden" name="hidden_name" id="name<?php echo $row["id"];?>" value="<?php echo $row["name"];?>" />
            	<input type="hidden" name="hidden_price" id="price<?php echo $row["id"];?>" value="<?php echo $row["price"];?>" />
            	<input type="button" name="add_to_cart" id="<?php echo $row["id"];?>" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart" />
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