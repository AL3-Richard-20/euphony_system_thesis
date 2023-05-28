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

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href="../assets/croppie/croppie.css" />

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.css"> -->

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  		<title>Euphony | About Image</title>

  	</head>

  	<body>

		<div class = "container-fluid">

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class="margin"></div>

			<form method = "POST" enctype = "multipart/form-data">
				
				<div class="col-sm-3"></div>

				<!---Balances--->
				<div class ="col-sm-6">	

					<div class = "panel panel-default">

						<div class = "panel-header">
							<center><h3 class="cap">Change Photo</h3></center>
						</div>

						<div class = "panel-body">

							<div class = "col-sm-12">

								<div class="item">

									<label>
										
										<p>You can resize the picture</p>

										<?php

											$about_us_query = tableQuery_3('about_us_tbl', 'Id', 1);

											while($row = mysqli_fetch_array($about_us_query)){

												$about_us_image		= escape($row['Image']);

												echo "<center><img src = '../images/about/$about_us_image' class = 'img-responsive' alt = 'photo' id = 'upload-demo' name = 'image'></center>";

											}

										?>

			            			</label>

			            			<div class="row">

			            				<input type = "file" id="upload"> 

			            			</div>

			            		</div>

		            		</div>				

						</div>

						<div class="panel-footer">

							<center>
								<button type = "submit" class = "btn btn-success btn-lg change_image_btn">Save</button>
	  		      				<button type="button" class="btn btn-default btn-lg" onclick = "location.href='about_us.php';">Cancel</button>
	  		      				<!-- <button type="button" class="btn btn-default btn-lg" onclick = "location.href='euphonymusiccenter.000webhostapp.com/about_us.php';">Cancel</button> -->
	  		      			</center>

						</div>

					</div>

				</div>
				<!---Balances END--->

				<div class="col-sm-3"></div>

			</form>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/croppie/croppie.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script> -->

		<script type = "text/javascript"  src = "../assets/croppie/croppie.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<script>

			$uploadCrop = $('#upload-demo').croppie({
			    viewport: {
			        width: '200',
			        height: '200',
			        type: 'square'
			    },
			    boundary: {
			        width: 300,
			        height: 300
			    }
			});


			//Button (Displays the image)
			$('#upload').on('change', function () { 
			    var reader = new FileReader();
			      	reader.onload = function (e) {
			        	$uploadCrop.croppie('bind', {
			          		url: e.target.result
			        	}).then(function(){
			          		console.log('jQuery bind complete');
			        });
			        
			    }
			    reader.readAsDataURL(this.files[0]);
			});


			$('.change_image_btn').on('click', function (ev) {

				ev.preventDefault();
				
			    $uploadCrop.croppie('result', {
			      	type: 'canvas',
			      	size: 'viewport'
			    }).then(function (resp) {


			      	$.ajax({

			        	url:"action_image.php",
			        	type:"POST",
			        	data:{
			        		action: "about_img", 
			        		image:resp
			        	},

			        	success:function(data){

			        		var result = JSON.parse(data);

			        		if(result == '1'){

			        			sweetAlert('success', 'Saved Successfully', 'You updated an image', 'about_us.php');
			        		}

			        		else if(result == '2'){
			        			
			        			sweetAlert('error', 'Something went wrong', 'Try again', 'about_us.php');
			        		}

			        		else if(result == '3'){
			        			
			        			sweetAlert('info', 'item has been missing', 'Try again', 'about_us.php');
			        		}
			        	}	
			      	});

			    });
			    
			});

		</script>

  	</body>

</html>