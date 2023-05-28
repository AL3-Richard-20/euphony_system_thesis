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


		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->


		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  		<title>Euphony | Profile Picture</title>

  	</head>

  <body>

  	<div class = "container-fluid">

  		<?php 

			if(isset($_GET['userid'])){

				$user_id   = $_GET['userid'];

				$query_profile_pic = studInfo($user_id);

				while($row = mysqli_fetch_assoc($query_profile_pic)){

					$profileimg = escape($row['Profile_img']);
					$sex 		= escape($row['Sex']);
				}

				$_SESSION['userid'] = $user_id;
			}

			if(isset($_POST['image'])){

				$data 		= $_POST['image'];
				$user_id	= $_SESSION['userid'];

				$image_array_1 = explode(';', $data);
				$image_array_2 = explode(',', $image_array_1[1]);

				$data = base64_decode($image_array_2[1]);

				$imageName = time().'.png';

				file_put_contents('../images/profile_img/'.$imageName, $data);

				$query = "UPDATE user_info_tbl SET Profile_img = '$imageName' WHERE User_Id = '$user_id'";
				$update_profile_pic = mysqli_query($con, $query);

				confirmQuery($update_profile_pic);

				if($update_profile_pic == 1){

					echo "<script>location.href='index.php';</script>";
				}

			}

		?>

		<?php include "includes/student_navigation.php"; ?>

		<div class="margin"></div>

		<form method = "POST" enctype = "multipart/form-data">
			
			<div class="col-sm-3"></div>

			<!---Balances--->
			<div class ="col-sm-6">	

				<div class = "panel panel-default">

					<div class = "panel-header">
						<center>
							<h3 class="cap">Change Profile Picture</h3>
						</center>
					</div>

					<div class = "panel-body">

						<div class = "col-sm-12">

							<div class="item">

								<label>
									<p>You can resize the picture</p>

									<?php

										if($profileimg == NULL){

											if($sex == 'Male'){

												echo "<center><img src = '../images/profile_img/Vector_1.png' class = 'img-circle img-responsive' alt = 'photo' id = 'upload-demo'></center>";
											}
											else if($sex == 'Female'){

												echo "<center><img src = '../images/profile_img/Vector_2.png' class = 'img-circle img-responsive' alt = 'photo' id = 'upload-demo'></center>";
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
  		      			<button type="button" class="btn btn-default btn-lg" onclick = "location.href='../';">Cancel</button></center>

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

	<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

	

	<script type = "text/javascript"  src = "scripts/functions.js"></script>

	<script type="text/javascript">
		
		cropImage(200, 200, 'circle', 'add_profile_pic.php', 'index.php');

	</script>

  </body>

</html>=