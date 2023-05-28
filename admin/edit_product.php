<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">



		<link rel = "stylesheet" type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet" type="text/css" href = "../assets/font/css/all.min.css">

		<link rel = "stylesheet" type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Edit Product</title>

	</head>

	<body>

		<?php

			if(isset($_GET['prodid'])){

				$the_product_id = $_GET['prodid'];

				$query_selected_product = productListId($branch_id, $the_product_id);
				
				while($row = mysqli_fetch_assoc($query_selected_product)){

					$prod_Id 		= escape($row["Prod_Id"]);
	              	$prod_name 		= escape($row["Prod_name"]);
	              	$prod_brand 	= escape($row["Prod_brand"]);
	              	$prod_price 	= escape($row["Prod_price"]);
	              	$prod_desc 		= $row["Prod_desc"];
	              	$prod_status 	= escape($row["Status"]);
	              	$prod_image 	= escape($row["Prod_image"]);
	              	$prod_quantity 	= escape($row['Quantity']);
	              	$prod_cat_id 	= escape($row['Category_Id']);
	              	$prod_category 	= escape($row['Category_title']);
                
	            }
	        }

	        if(isset($_POST['prod_status'])){

              	$prod_name 			= escape($_POST["prod_name"]);
              	$prod_brand 		= escape($_POST["prod_brand"]);
              	$prod_price 		= escape($_POST["prod_price"]);
              	$prod_desc 			= escape($_POST["prod_desc"]);
              	$prod_category_Id 	= escape($_POST["prod_category"]);
              	$prod_status 		= escape($_POST["prod_status"]);

              	$query = "UPDATE products_tbl SET ";
              	$query .= "Prod_name = '{$prod_name}', Prod_brand = '{$prod_brand}', ";
              	$query .= "Prod_price = '{$prod_price}', Prod_desc = '{$prod_desc}', ";
              	$query .= "Status = '$prod_status', ";
              	$query .= "Category_Id = '{$prod_category_Id}' ";
              	$query .= "WHERE Prod_Id = '{$the_product_id}'";

              	$query_update_product = mysqli_query($con, $query);

              	confirmQuery($query_update_product);

              	if($query_update_product == 1){

              		echo "<script>sweetAlert('success', 'Successfully Updated', 'You update a product', 'inventory.php');</script>";
              	}
	        }

        ?>

		<div class="container-fluid">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

            <form method = "POST" enctype = "multipart/form-data" novalidate>

      			<div class="col-sm-9">

	          		<div class="panel panel-default">	

	          			<div class="panel-header">
	          				
	          				<div class="row">

					            <div class="col-sm-4">

					                <button type = "button" class = "btn btn-default btn-lg" style = "float: left" onclick = "location.href='inventory.php';"><span class = "fas fa-arrow-left"></span></button>

					            </div>

					            <div class="col-sm-4">
					              <center><h3 class="cap">Edit Product</h3></center>
					            </div>

					        </div>

	          			</div>

						<div class="panel-body">

							<div class="col-sm-12">
								<p><b>Product Information</b></p>
							</div><br><br>

							<div class="col-sm-4">
								<div class="item">
	                  				<p>Product Name:</p>
	                  				<input type = "text" class = "form-control" name = "prod_name" value = "<?php echo $prod_name; ?>" required="required">
	                  			</div>
                  			</div>

                  			<div class="col-sm-4">
	                  			<div class="item">

	                  				<p>Product Category:</p>
	                  				<select class = "form-control required" name = "prod_category" id="select2">
			                  			<?php echo "<option value = '$prod_cat_id'>$prod_category</option>"; ?>
			                  			<option value = "">Select Here</option>
			                  			<?php fill_category(); ?>
	                  				</select>

	                  			</div>
	                  		</div>

	                  		<div class="col-sm-4">
	                  			<div class="item">
	                  				<p>Product Brand:</p>
	                  				<input type = "text" class = "form-control" value = "<?php echo $prod_brand; ?>" name = 'prod_brand' required="required">
	                  			</div>
	                  		</div>

	                  		<div class="col-sm-4">
		                  		<div class="item">
	                  				<p>Price:</p>
	                  				<input type = "text" class = "form-control mask-money"  value = "<?php echo $prod_price; ?>" name = "prod_price" required="required">
	                  			</div>
	                  		</div>

	                  		<div class="col-sm-4">
	                  			<div class="item">
	                  				<p>Status:</p>
	                  				<select class="form-control required" name="prod_status">
	                  					<option value='<?php echo $prod_status; ?>'><?php echo $prod_status; ?></option>

	                  					<?php

	                  						if($prod_status == 'Available'){
	                  							
	                  							echo "<option value='New Arrival'>New Arrival</option>";
	                  							echo "<option value='Not Available'>Not Available</option>";
	                  						}
	                  						else if($prod_status == 'Not Available'){
	                  							// echo "<option value='$prod_status'>$prod_status</option>";
	                  							echo "<option value='New Arrival'>New Arrival</option>";
	                  							echo "<option value='Available'>Available</option>";
	                  						}
	                  						else if($prod_status == 'New Arrival'){
	                  							// echo "<option value='$prod_status'>$prod_status</option>";
	                  							echo "<option value='Available'>Available</option>";
	                  							echo "<option value='Not Available'>Not Available</option>";
	                  						}
	                  						else if($prod_status == 'Top Seller'){
	                  							// echo "<option value='$prod_status'>$prod_status</option>";
	                  							echo "<option value='New Arrival'>New Arrival</option>";
	                  							echo "<option value='Available'>Available</option>";
	                  							echo "<option value='Not Available'>Not Available</option>";
	                  						}

	                  					?>

	                  					<?php
								
											$query = "SELECT SUM(Quantity) as TotalOrders FROM sales_detail WHERE Prod_Id = '$prod_Id'";
											$query_orders = mysqli_query($con, $query);

											confirmQuery($query_orders);

											while($row = mysqli_fetch_assoc($query_orders)){

												$total_orders = $row['TotalOrders'];
											}

											if($prod_status != 'Top Seller'){

												if($total_orders >= 7){
													echo "<option value='Top Seller'>Set as Top Seller</option>";
												}
											}
										?> 
	                  					
	                  				</select>
	                  				
	                  			</div>

	                  		</div>

	                  		<div class="col-sm-12">

	                  			<div class="item">
	                  				<p>Description:</p>
	                  				<textarea class="form-control" name="prod_desc" id="prod_desc" rows="5" onKeyDown="limitText(this.form.prod_desc, 348, 349)"><?php echo $prod_desc; ?></textarea>
	                  			</div>

	                  			<div class="text-right">
									<p>Maximum characters: 
									<strong style="color:green; font-size: 20px" id="inputted1">0</strong> / <strong style="color:green; font-size: 20px">350</strong></p>
								</div>

	                  		</div>

			            </div>

			        </div>

			    </div>



			    <div class="col-sm-3">
			        	
			        <div class="panel panel-default">	

						<div class="panel-body">

							<p><b>Product Image</b></p>
							<img src = "../images/products/<?php echo $prod_image; ?>" class = "img-responsive" height="200" id="image">

							<button type="button" class="btn btn-primary" onclick="location.href='edit_product_image.php?prodid=<?php echo $the_product_id; ?>&prodimg=<?php echo $prod_image; ?>';">Edit Image</button>

							<hr/>

							<button type="submit" class = "btn btn-success btn-lg" id = "send">Save</button>
			            	<button type="button" class = "btn btn-default btn-lg" onclick="location.href='inventory.php';">Cancel</button>

			            </div>

			        </div>
			        
			    </div>

		    </form>

        </div>


        
        <script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

        <script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <script src="../assets/js/select2.full.min.js"></script>



        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->



		<script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>

			$(document).ready(function(){

				$("#select2").select2({
			      allowClear: true
			    });

			    var content1 = $('#prod_desc').val();
				var count1 	= content1.length;

				document.getElementById('inputted1').innerHTML = count1;

				$('#prod_desc').keyup(function(){

					var content1 = $('#prod_desc').val();
					var count1 	= content1.length;

					document.getElementById('inputted1').innerHTML = count1; 
				})
				
			});
		 	
		</script>

	</body>
	
</html>