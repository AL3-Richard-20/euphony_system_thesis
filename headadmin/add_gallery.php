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

		<link rel = "stylesheet"  type="text/css" href = "../assets/select2/select2.min.css"/>

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<!-- link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    	<title>Euphony | Add Image</title>

	</head>

	<body>	

		<?php

			if(isset($_POST['g_category'])){

				$the_g_desc 		= escape($_POST['g_desc']);
				$the_category_Id 	= escape($_POST['g_category']);

				//image
	    		// $g_image	 	= $_FILES["g_image"]['name'];
	      //   	$g_image_temp	= $_FILES["g_image"]['tmp_name'];
	    		// move_uploaded_file($g_image_temp, "../images/gallery/$g_image");
	    		//image END

	    		$query = "INSERT INTO gallery (GC_Id, Description, Date_added, Time_added) ";
	    		$query .="VALUES ('$the_category_Id', '$the_g_desc', curdate(), curtime()) ";

	    		$query_add_image = mysqli_query($con, $query);

	    		confirmQuery($query_add_image);

	    		$last_id = mysqli_insert_id($con);

	    		if($query_add_image == 1){

	    			// echo "<script>sweetAlert('success', 'Successfully Added!', 'You added a photo to gallery', 'gallery.php');</script>";

	    			echo "<script>location.href='add_image_gallery.php?gid=$last_id&gimg=';</script>";

	    		}
			}

		?>

		<div class = "container-fluid">

			<?php include "includes/headadmin_navigation.php"; ?>

				<div class="margin"></div>	

	      		<form method = "POST" enctype = "multipart/form-data" novalidate>

	      			<div class="col-sm-9">

		          		<div class="panel panel-default">	

		          			<div class="panel-header">
		          				
		          				<div class="row">

						            <div class="col-sm-4">

						                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='gallery.php'"><span class="fa fa-arrow-left"></span></button>

						            </div>

						            <div class="col-sm-4">
						              <center><h3 class="cap">Add Image to Gallery</h3></center>
						            </div>

						            <div class="col-sm-4"></div>

						        </div>

		          			</div>

							<div class='panel-body'>

								<div class="col-sm-12">
									<label>Step 1</label>	
								</div>
								<br><br>

								<div class="col-sm-12">

									<div class="item">
			                          	<p>Description:</p>
			                          	<input type = "text" class = "form-control" name = "g_desc" required="required">
		                          	</div>

		                          	<div class="item">
		                          		<p>Category:</p>
										<select class="form-control required" name="g_category" id="select2">

											<option value="">Select Here</option>
											<?php

												$gallery_categories = tableQuery_3('gallery_category', 'Status', 1);

												confirmQuery($gallery_categories);

												while($row = mysqli_fetch_assoc($gallery_categories)){

													$gc_Id 		= escape($row['GC_Id']);
													$gc_desc	= escape($row['Description']);

													echo "<option value='$gc_Id'>$gc_desc</option>";
												}

											?>
										</select>
										
									</div>

								</div>

				            </div>

				            <div class="panel-footer">

				            	<div class="text-right">
				            		
				            		<button type = "submit" class = "btn btn-primary btn-lg" id = "send">Next</button>

	    							<button type="button" class = "btn btn-default btn-lg" onclick="location.href='gallery.php';">Cancel</button>

				            	</div>

				            </div>

				        </div>

				    </div>



				    <div class="col-sm-3">
				        	
				        <div class="panel panel-default">	

							<div class='panel-body'>

								<p><label>Step 2: </label> Image</p>

		    					<img src = "../images/default/branch_raw.jpg" class = "img-responsive" id = "image">

				            </div>

				        </div>
				        
				    </div>

			    </form>

			</div>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript"  src = "../assets/js/select2.full.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->



		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

		<script type="text/javascript">
			
			$(document).ready(function(){

				$("#select2").select2({
			      	placeholder: "Select a product here",
			      	allowClear: true
			    });
			})
			
			function showImage(){

		 		if(this.files && this.files[0])
		 		{
		 			var obj = new FileReader();
		 			obj.onload = function(data){
		 				var image = document.getElementById("image");
		 				image.src = data.target.result;
		 				image.style.display = "block";
		 			}
		 			obj.readAsDataURL(this.files[0]);
		 		}
		 	}

		</script>
		
	</body>

</html>