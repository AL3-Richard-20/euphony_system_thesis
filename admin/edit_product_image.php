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

		<link rel = "stylesheet" type="text/css" href="../assets/croppie/croppie.css" />

		<link rel = "stylesheet" type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  		<title>Euphony | Product Image</title>

  	</head>

  	<body>

  		<?php 

			if($_GET['prodid'] != NULL){

				$the_prod_Id = $_GET['prodid'];
			}
			else{
				echo "<script>location.href='index.php';</script>";
			}

			if($_GET['prodimg'] != NULL){

				$the_prod_img = $_GET['prodimg'];

			}
			else{
				echo "<script>location.href='index.php';</script>";
			}

		?>

		<div class = "container-fluid">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<form method="POST" enctype="multipart/form-data">
				
				<div class="col-sm-3"></div>

				<div class="col-sm-6">	

					<div class="panel panel-default">

						<div class="panel-header">
							<center><h3 class="cap">Product Image</h3></center>
						</div>

						<div class="panel-body">

							<div class = "col-sm-12">

							<input type="hidden" id="prod_id" value="<?php echo $the_prod_Id; ?>">

							<div class="item">

								<label>

									<p>You can resize the picture</p>

									<?php 

										if(isset($the_prod_img)){

											echo "<center><img src='../images/products/$the_prod_img' class='img-responsive' alt='photo' id='product_pic'></center>";

										}
										else{
											echo "<script>location.href='index.php';</script>";
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
								<button type = "submit" class = "btn btn-success btn-lg product_pic_btn">Save</button> 
								<button type="button" class="btn btn-default btn-lg" onclick="location.href='edit_product.php?prodid=<?php echo $the_prod_Id; ?>';">Cancel</button>
							</center>

						</div>

					</div>

				</div>

				<div class="col-sm-3"></div>

			</form>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script src = "../assets/croppie/croppie.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script> -->

		<script src = "../assets/croppie/croppie.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<script>
			
			$(document).ready(function(){

				$uploadCrop = $('#product_pic').croppie({
				    viewport: {
				        width: 200,
				        height: 200,
				        type: 'square'
				    },
				    boundary: {
				        width: 300,
				        height: 300
				    }
				});


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


				$('.product_pic_btn').on('click', function (ev) {

					ev.preventDefault();

					var prod_id = $('#prod_id').val();

					$uploadCrop.croppie('result', {
						type: 'canvas',
						size: 'viewport'
					}).then(function (resp) {

						$.ajax({
							url: "action.php",
							type: "POST",
							data: {
								image:resp,
								prodid:prod_id,
								action:"add_prod_pic"
							},
							success: function (data) {

								var result = JSON.parse(data);

								if(result == '1'){
									sweetAlert('success', 'Successfully Added', 'You added a new product', 'inventory.php');
								}

								else if(result == '2'){
									sweetAlert('error', 'Something went wrong', 'Try again', 'inventory.php');
								}

								else if(result == '3'){
									sweetAlert('info', 'Item has been missing', 'Try again', 'inventory.php');
								}
							}
						});

					});
				});
			});

		</script>

  	</body>

</html>