<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">



		<link rel = "stylesheet"  type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Add Product</title>

	</head>

	<body>

		<?php

	        if(isset($_POST['prod_status'])){

              	$prod_name 			= escape($_POST["prod_name"]);
              	$prod_brand 		= escape($_POST["prod_brand"]);
              	$prod_price 		= escape($_POST["prod_price"]);
              	$prod_desc 			= escape($_POST["prod_desc"]);
              	$prod_category_Id 	= escape($_POST["prod_category"]);
              	$prod_quantity  	= 0;
              	$prod_status 		= escape($_POST["prod_status"]);

              	$query = "INSERT INTO products_tbl (Prod_name, Prod_brand, Prod_price, Prod_desc, Status, Category_Id, randSalt3, Status_2) ";
              	$query .= "VALUES('$prod_name','$prod_brand','$prod_price','$prod_desc','$prod_status','$prod_category_Id', 0, 1)";

              	$query_add_product = mysqli_query($con, $query);

              	confirmQuery($query_add_product);

              	$last_id = mysqli_insert_id($con);

              	if($query_add_product == 1){

	              	$query2 = "INSERT INTO prod_invt_tbl (Prod_Id, Branch_Id, Quantity) ";
	              	$query2 .= "VALUES('$last_id','$branch_id', '$prod_quantity')";

	              	$query_add_product_2 = mysqli_query($con, $query2);

	              	confirmQuery($query_add_product_2);

	              	echo "<script>location.href='add_product_pic.php?prodid=".$last_id."';</script>";

	            }
	        }

            ?>

			<div class = "container-fluid">

				<?php include "includes/admin_navigation.php"; ?>

				<div class="margin"></div>

                <form method = "POST" enctype = "multipart/form-data" novalidate>

	      			<div class="col-sm-9">

		          		<div class="panel panel-default">	

		          			<div class="panel-header">
		          				
		          				<div class="row">

						            <div class="col-sm-4">

						                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='inventory.php';"><span class="fa fa-arrow-left"></span></button>

						            </div>

						            <div class="col-sm-4">
						              <center><h3 class="cap">Add new product</h3></center>
						            </div>

						            <div class="col-sm-4"></div>

						        </div>

		          			</div>

							<div class='panel-body'>

								<div class="col-sm-12">
									<p><b>Step 1: </b>Product Information</p>	
								</div><br><br>

								<div class="col-sm-4">
									<div class="item">
		                  				<p>Product Name:</p>
		                  				<input type = "text" class = "form-control" name = "prod_name" required="required">
		                  			</div>
		                  		</div>

		                  		<div class="col-sm-4">
			            	      	<div class="item">

		                  				<p>Product Category:</p>

		                  				<select class = "form-control required" name = "prod_category" id="select2">

		                  					<option value = "">Select Category Here</option>

				                  			<?php fill_category(); ?>

				                  		</select>
				                  		
		                  			</div>
		                  		</div>

		                  		<div class="col-sm-4">
		                  			<div class="item">
		                  				<p>Product Brand:</p>
		                  				<input type = "text" class = "form-control" name = 'prod_brand' required="required">
		                  			</div>
		                  		</div>

		                  		<div class="col-sm-4">
			                  		<div class="item">
		                  				<p>Price:</p>
		                  				<input type = "number" class = "form-control" name = "prod_price" required="required">
		                  			</div>
		                  		</div>

		                  		<div class="col-sm-4">
		                  			<div class="item">
		                  				<p>Status:</p>
		                  				<select class="form-control required" name="prod_status">
		                  					<option value="">Select Here</option>
		                  					<option value="Available">Available</option>
		                  					<option value="Not Available">Not Available</option>
		                  					<option value="New Arrival">New Arrival</option>
		                  				</select>
		                  			</div>
		                  		</div>

		                  		<div class="col-sm-12">

		                  			<div class="item">
		                  				<p>Description:</p>
		                  				<textarea name="prod_desc" id="prod_desc" class="form-control" onKeyDown="limitText(this.form.prod_desc, 348, 349)" rows="5" required="required"></textarea>
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

							<div class='panel-body'>

								<p><b>Step 2: </b>Product Image</p>

								<img src = "../images/default/product_raw.jpg" class = "img-responsive" height = "200" id = "image"><br>

	    						<button type = "submit" class = "btn btn-primary btn-lg" id = "send">Next</button>

				            </div>

				        </div>
				        
				    </div>

			    </form>

            </div>

        </div>


        
    	<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src = "../assets/js/select2.full.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->

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