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

		<link rel = "stylesheet"  type="text/css" href="../assets/croppie/croppie.css" />

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  		<title>Euphony | Profile picture</title>

  	</head>

  	<body>

  		<div class="container-fluid">

  			<?php include "includes/admin_navigation.php"; ?>

	  		<?php 

				if(isset($_GET['userid'])){

					$teacher_Id    	= $_GET['userid'];
					$sex 			= $_GET['sex'];

					$query_profile_pic = teacherInfo($teacher_Id);

					while($row = mysqli_fetch_assoc($query_profile_pic)){

						$profileimg = escape($row['T_Profile_img']);
					}

				}

			?>

			<div class="margin"></div>

			<form method = "POST" enctype = "multipart/form-data">
				
				<div class="col-sm-3"></div>

				<!---Balances--->
				<div class ="col-sm-6">	

					<div class = "panel panel-default">

						<div class = "panel-header">
							<center><h3 class="cap">Change Profile Picture</h3></center>
						</div>

						<div class="panel-body">

							<input type="hidden" id="teacher_Id" value="<?php echo $teacher_Id; ?>">

							<div class = "col-sm-12">

							<div class="item">

								<label>
									<p>You can resize the picture</p>

									<?php

										if($profileimg == NULL){

											if($sex == 'Male'){

												echo "<center><img src = '../images/profile_img/Vector_1.png' class = 'img-circle img-responsive' alt = 'photo' id = 'upload-demo' name = 'image'></center>";
											}
											else if($sex == 'Female'){

												echo "<center><img src = '../images/profile_img/Vector_2.png' class = 'img-circle img-responsive' alt = 'photo' id = 'upload-demo' name = 'image'></center>";
											}
										}
										else{

											echo "<center><img src = '../images/profile_img/$profileimg' class = 'img-circle img-responsive' alt = 'photo' id = 'upload-demo' name = 'image'></center>";
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

							<center><button type = "submit" class = "btn btn-success btn-lg change_profile_btn">Save</button>
	  		      			<button type="button" class="btn btn-default btn-lg" onclick = "location.href='teacher_profile_settings.php?teacherid=<?php echo $teacher_Id; ?>';">Cancel</button></center>

						</div>

					</div>

				</div>
				<!---Balances END--->

				<div class="col-sm-3"></div>

			</form>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src = "../assets/croppie/croppie.js"></script>

		<script src = "../assets/croppie/croppie.min.js"></script>

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

    	<script src = "scripts/shortcut_keys.js"></script>

		<script src="scripts/functions.js"></script>

		<script>
			
			$(document).ready(function(){

				$uploadCrop = $('#upload-demo').croppie({
				    viewport: {
				        width: 200,
				        height: 200,
				        type: 'circle'
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


				$('.change_profile_btn').on('click', function (ev) {

					ev.preventDefault();

					var teacher_Id = $('#teacher_Id').val();

					$uploadCrop.croppie('result', {
						type: 'canvas',
						size: 'viewport'
					}).then(function (resp) {

						$.ajax({
							url: "action.php",
							type: "POST",
							data: {
								"image":resp,
								teacherId:teacher_Id,
								action:"teacher_profile_pic"
							},
							success:function (data) {

								var result = JSON.parse(data);

								if(result == '1'){

									sweetAlert('success', 'Saved Successfully', '', 'teachers.php');
								}

								else if(result == '2'){

									sweetAlert('error', 'Something Went Wrong', 'Try again', 'index.php');
								}

								else if(result == '3'){

									sweetAlert('info', 'Item has been missing', 'Try again', 'index.php');
								}
							}
						});

					});
				});

			});

		</script>

  	</body>

</html>