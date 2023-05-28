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

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Add New Lesson</title>

	</head>

	<body>

		<?php

	  		if(isset($_POST['lesson_desc'])){

	  			$new_lesson_id  	= escape($_POST['lesson_id']);
	  			$new_lesson_desc 	= escape($_POST['lesson_desc']);
  				$new_amount 	 	= escape($_POST['lesson_price']);
  				$new_no_of_lesson 	= escape($_POST['lesson_no']);
  				$lesson_content 	= escape($_POST['lesson_content']);

  				// Icon
  				// $icon 			= escape($_FILES['icon']['name']);
	    	// 	$icon_temp 		= $_FILES['icon']['tmp_name'];

	    	// 	move_uploaded_file($icon_temp, "../images/lessons/Icon/$icon");
	    		// Icon END

	    		// Cover
  				// $cover 			= escape($_FILES['cover']['name']);
	    	// 	$cover_temp 	= $_FILES['cover']['tmp_name'];

	    	// 	move_uploaded_file($cover_temp, "../images/lessons/Cover/$cover");
	    		// Cover END

  				$query = "INSERT INTO lessons_tbl (Lesson_Id, Lesson_desc, Amount, No_of_lesson, Content) ";
  				$query .= "VALUES ('$new_lesson_id', '$new_lesson_desc', '$new_amount', ";
  				$query .= "'$new_no_of_lesson', '$lesson_content')";

  				$query_add_lesson = mysqli_query($con, $query);

  				confirmQuery($query_add_lesson);

  				echo "<script>location.href='add_lesson_cover.php?lessid=$new_lesson_id';</script>";

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

					                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='services.php'"><span class="fa fa-arrow-left"></span></button>

					            </div>

					            <div class="col-sm-4">
					              <center><h3 class="cap">Add New Lesson</h3></center>
					            </div>

					            <div class="col-sm-4"></div>

					        </div>

	          			</div>

						<div class='panel-body'>

							<div class="col-sm-12">

								<p><label>Step 1: </label> Lesson Information</p>

							</div><br>

							<div class="col-sm-3">
								<div class="item">
									<p>Lesson ID</p>
			  	                    <input type = "text" class = "form-control" name = "lesson_id" required="required" placeholder="e.g. G12">
			  	                </div> 
			  	            </div>

			  	            <div class="col-sm-3">
		  	                	<div class="item">
			   	                   	<p>Description</p>
			                      	<input type = "text" class = "form-control" name = "lesson_desc" required="required" placeholder="e.g. Guitar">
			                    </div>
			                </div> 	

			                <div class="col-sm-3">
			                    <div class="item">
									<p>Number of Lesson</p>
									<input type = "number" class = "form-control" name = "lesson_no" required="required" placeholder="e.g. 12">
								</div>
							</div>

							<div class="col-sm-3">
								<div class="item">
									<p>Price</p>
									<input type = "number" class = "form-control" name = "lesson_price" required="required" placeholder="e.g. 5950">
								</div>
							</div>

							<div class="row">

								<div class="col-sm-12">

									<div class="item">
										<p>Content</p>
						                <textarea class="form-control" name="lesson_content" id="lesson_content" rows="9" onKeyDown="limitText(this.form.lesson_content, 928, 929)" required="required"></textarea>
						            </div>

						            <div class="text-right">
										<p>Maximum characters: 
										<strong style="color:green; font-size: 20px" id="inputted">0</strong> / <strong style="color:green; font-size: 20px">930</strong></p>
									</div>

								</div><br>

								<div class="col-sm-12">

									<div class="text-right">
										<button type="submit" class="btn btn-primary btn-lg" id="send">Next</button>

	    								<button type="button" class="btn btn-default btn-lg" onclick="location.href='services.php';">Cancel</button> 
									</div>

								</div>

							</div>

			            </div>

			        </div>

			    </div>



			    <div class="col-sm-3">
			        	
			        <div class="panel panel-default">	

						<div class='panel-body'>

							<p><label>Step 2: </label> Lesson Image</p>

	    					<img src = "../images/default/services_raw.jpg" class = "img-responsive" id = "image"><hr>

    						<p><label>Step 3: </label> Lesson Icon</p>

    						<center><img src = "../images/lessons/Icon/Guitar.png" class = "img-circle img-responsive" id = "image" style="border: 2px solid black; border-radius: 100%; height: 200px;"></center>

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

		<!-- script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

		<script>
			
			$(document).ready(function(){

				var content = $('#lesson_content').val();
				var count 	= content.length;

				document.getElementById('inputted').innerHTML = count;

				$('#lesson_content').keyup(function(){

					var content = $('#lesson_content').val();
					var count 	= content.length;

					document.getElementById('inputted').innerHTML = count; 
				})

			});

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