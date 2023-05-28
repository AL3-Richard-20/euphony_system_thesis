<?php session_start(); ?>
<?php include "../includes/db.php";?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">



		<link rel = "stylesheet"  type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    	<title>Euphony | Add New Service</title>

	</head>

	<body>

		<?php

		    if(isset($_POST['service_content'])){

		    	$add_service_desc	    = escape($_POST['service_desc']);
		    	$service_content 		= escape($_POST['service_content']);
		    	$service_price 			= escape($_POST['service_price']);

				$query = "INSERT INTO services_tbl (title, price, content) ";
				$query .= "VALUES('$add_service_desc', '$service_price', '$service_content')";

				$query_add_service = mysqli_query($con, $query);

				confirmQuery($query_add_service);

				$last_id = mysqli_insert_id($con);

				if($query_add_service){

					echo "<script>location.href='add_service_image.php?serviceid=".$last_id."&serviceimg=';</script>";

				}
				
		    }

		?>
			
		<div class="container-fluid">

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class="margin"></div>

			<form method = "POST" enctype = "multipart/form-data" novalidate>

      			<div class="col-sm-9">

	          		<div class="panel panel-default">	

	          			<div class="panel-header">
	          				
	          				<div class="row">

					            <div class="col-sm-4">

					            	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='services.php#services_sec'"><span class="fa fa-arrow-left"></span></button>
					            </div>

					            <div class="col-sm-4">
					              <center><h3 class="cap">Add New Service</h3></center>
					            </div>

					            <div class="col-sm-4"></div>

					        </div>

	          			</div>

						<div class='panel-body'>

							<div class="col-sm-12">
								<p><label>Step 1: </label> Service Informaton</p><br>
							</div>

							<div class="col-sm-6">
								<div class="item">
									<p>Description</p>
			                      	<input type = "text" class = "form-control" name = "service_desc" required="required">
			                    </div>
		                    </div>

		                    <div class="col-sm-6">
			                    <div class="item">
		                      		<p>Price</p>
		                      		<input type = "text" class = "form-control" name = "service_price" required="required">
		                      	</div>
	                      	</div>

	                      	<div class="col-sm-12">
								<div class="item">
									<p>Content</p>
					                <textarea class="form-control" name="service_content" id="service_content" rows="7" onKeyDown="limitText(this.form.service_content, 928, 929)" required="required"></textarea>
					            </div>
				            </div>

				            <div class="text-right">
								<p>Maximum characters: 
								<strong style="color:green; font-size: 20px" id="inputted">0</strong> / <strong style="color:green; font-size: 20px">930</strong></p>
							</div>

			            </div>

			            <div class="panel-footer">

			            	<div class="text-right">
			            		<button type="submit" class="btn btn-primary btn-lg" id="send">Next</button>

    							<button type="button" class="btn btn-default btn-lg" onclick="location.href='services.php?active=services';">Cancel</button>
			            	</div>

			            </div>

			        </div>

			    </div>



			    <div class="col-sm-3">
			        	
			        <div class="panel panel-default">	

						<div class='panel-body'>

							<p><label>Step 2: </label> Service Image</p>

	    					<img src = '../images/default/services_raw.jpg' class = 'img-responsive' id = 'image'>

			            </div>

			        </div>
			        
			    </div>

		    </form>
			        
		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript"  src = "../assets/ckeditor/ckeditor.js" type = "text/javascript"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
		
		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

		<script>

			$(document).ready(function(){

				var content = $('#service_content').val();
				var count 	= content.length;

				document.getElementById('inputted').innerHTML = count;

				$('#service_content').keyup(function(){

					var content = $('#service_content').val();
					var count 	= content.length;

					document.getElementById('inputted').innerHTML = count; 
				})

			});

		</script>

	</body>

</html>