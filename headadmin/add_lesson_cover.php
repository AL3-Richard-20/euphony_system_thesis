<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

  	<head>

  		<!---Header--->
		<!---Links--->
		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">

		<link rel = "stylesheet"  type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href="../assets/croppie/croppie.css" />

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.css"> -->

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<!-- <script src = "scripts/functions.js"></script> -->

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<!---End--->
		<!---Header END--->

  		<title>Euphony | Lesson Image</title>

  	</head>

  	<body>

  		<?php 

			if(isset($_GET['lessid'])){

				$last_id   = $_GET['lessid'];
			}
			else{

				echo "<script>location.href='services.php';</script>";
			}

		?>

		<div class = "container-fluid">

			<?php include "includes/headadmin_navigation.php"; ?><br><br>

			<form method = "POST" enctype = "multipart/form-data">
				
				<div class="col-sm-3"></div>

				<!---Balances--->
				<div class ="col-sm-6">	

					<div class = "panel panel-default">

						<div class = "panel-header">
							<center>
								<h3 class="cap">Lesson Image</h3>
							</center>
						</div>

						<div class = "panel-body">

							<p>You can resize the picture</p>

							<input type="hidden" id="lastid" value="<?php echo $last_id; ?>">

							<center><img src='../images/default/services_raw.jpg' alt='photo' id='upload-demo' class='img-responsive'></center>

	            			<div class="item">

								<input type = "file" id="upload"> 

	            			</div>			

						</div>

						<div class="panel-footer">

							<center><button type = "submit" class = "btn btn-primary btn-lg lesson_image_btn">Next</button></center>
							
						</div>

					</div>

				</div>
				<!---Balances END--->

				<div class="col-sm-3"></div>

			</form>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/croppie/croppie.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script> -->

		<script type = "text/javascript"  src = "../assets/croppie/croppie.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

		<script type="text/javascript">
			
		  	$uploadCrop = $('#upload-demo').croppie({
		      	viewport: {
		          width: 370,
		          height: 250,
		          type: 'square'
		      	},
		      	boundary: {
		          width: 400,
		          height:300
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


			$('.lesson_image_btn').on('click', function (ev) {

				ev.preventDefault();

				var last_id = document.getElementById('lastid').value;

			    $uploadCrop.croppie('result', {
			      type: 'canvas',
			      size: 'viewport'
			    }).then(function (resp) {

				    $.ajax({

				        url:"action_image.php",

				        type:"POST",

				        data:{
				        	action:"lesson_image", 
				        	lastid:last_id,
				        	image:resp
				        },

				        success: function (data) {
				        	
				        	var result = JSON.parse(data);

				        	location.href=result;

				        	// alert(result);
				        }
				    });

			    });
			    
			});

		</script>

 	</body>

</html>