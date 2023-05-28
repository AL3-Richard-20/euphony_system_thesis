<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1">



		<link rel = "stylesheet" href = "assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet" href = "assets/animate/animate.min.css">

		<link rel = "stylesheet" href = "assets/font/css/all.min.css">

		<link rel = "stylesheet" type="text/css" href = "assets/sweetalert2/sweetalert2.min.css">

		<script src = "assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet" href = "includes/style.css">

		<title>Euphony | Log In</title>

	</head><br>

	<body>

		<?php

			if(isset($_POST['user_email'])){

				$email 	  = escape($_POST['user_email']);
				$password = escape($_POST['user_password']);

				$query = "SELECT * FROM user_login WHERE Email = '$email'";
				$select_user_query = mysqli_query($con, $query);

				confirmQuery($select_user_query);

				$count = mysqli_num_rows($select_user_query);

				if($count > 0){

					while($row = mysqli_fetch_array($select_user_query)){

						$db_user_id 		= escape($row['User_Id']);
						$db_user_email 		= escape($row['Email']);
						$db_user_password 	= escape($row['Password']);
						$db_user_level 		= escape($row['Level']);
						$verification 		= escape($row['verified']);
					}

					if($verification == 0){

						echo "<script>loginAlert('error', 'Not Verified', 'This account has not yet verified');</script>";

					}

					else{

						if(isset($db_user_password)){

							if(password_verify($password, $db_user_password)){

								$_SESSION['user_id']	= $db_user_id;
								$_SESSION['user_role'] 	= $db_user_level;

								$the_user_id = $_SESSION['user_id'];	

								if($_SESSION['user_role'] == 'Student'){

									// $query2 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
									// $query2.= "VALUES (curdate(), curtime(), 'Login to the system', '$the_user_id') ";
									// $add_activity = mysqli_query($con, $query2);

									// confirmQuery($add_activity);

									// if($add_activity == 1){
										echo "<script>location.href='student/index.php';</script>";
									// }

								}

								else if($_SESSION['user_role'] == 'Administrator'){

									// echo "<script>sweetAlert('success', 'Login Success', 'Welcome back', 'admin/index.php');</script>";

									$query2 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
									$query2.= "VALUES (curdate(), curtime(), 'Login to the system', '$the_user_id') ";
									$add_activity = mysqli_query($con, $query2);

									confirmQuery($add_activity);

									if($add_activity == 1){
										// header("location: admin/index.php");

										echo "<script>location.href='admin/index.php';</script>";
									}
								}

								else if($_SESSION['user_role'] == 'Head Administrator'){

									$query2 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
									$query2.= "VALUES (curdate(), curtime(), 'Login to the system', '$the_user_id') ";
									$add_activity = mysqli_query($con, $query2);

									confirmQuery($add_activity);

									if($add_activity == 1){
										// header("location: headadmin/index.php");
										echo "<script>location.href='headadmin/index.php';</script>";

									}
								}

							}

							else{

								echo "<script>loginAlert('error', 'Invalid Email or Password', 'Try to login again');</script>";
							}
						}
						else{
							echo "<script>loginAlert('error', 'Invalid Email or Password', 'Try to login again');</script>";
						}

					}

				}

				else{
					echo "<script>loginAlert('error', 'Invalid Email or Password', 'Try to login again');</script>";
				}
			}
		?>

		<div class="col-sm-3"></div>

		<div class="container animated fadeInLeft">

        	<div class="panel panel-default">

        		<div class="panel-body">

	                <div class="form-content">

	                    <div class="the-form">

	                        <center><h1 id = "h3" class="cap" style="font-size: 25px">Log In</h1></center>	

	                        <form method="POST" novalidate>
 
                            	<div class="item">
									<label>
										<p class = "text-left">Email</p>
										<input type = "email" name = "user_email" class = "form-control" required = "required" placeholder="Juan Dela Cruz@gmail/yahoo.com">
									</label>
								</div>	

                                <div class="item">
									<label>
										<p class = "text-left">Password</p>
										<input type = "password" class = "form-control" name = "user_password" data-validate-length = "6" required = "required">
									</label>
								</div>

								<center><a href="#">Forgot Password</a></center><br>

	                            <div class="form-group">

	                               	<center>
	                               		<button type = "submit" class = "btn btn-primary btn-lg" name="login" id="send">Confirm</button>

										<button type = "button" class = "btn btn-default btn-lg" onclick = "location.href = 'index.php';">Cancel</button>

										<!-- <button type = "button" class = "btn btn-default btn-lg" onclick = "location.href = 'euphonymusiccenter.000webhostapp.com/index.php';">Cancel</button> -->
									</center>

	                            </div>

	                        </form>

	                    </div>

	                    <div class="form-image">
	                        <figure><img src="images/default/signup-image.jpg" class="side-img"></figure>
	                        <a href="registration_branch.php" class="form-image-link">I don't have an account</a>
	                        <!-- <a href="euphonymusiccenter.000webhostapp.com/registration_branch.php" class="form-image-link">I don't have an account</a> -->
	                    </div>

	                </div>

	            </div>

        	</div>

        </div>

        <script src = "assets/jquery/1.12.0/jquery.min.js"></script>

        <script src = "assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>



        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script src = "assets/validator/validator.js"></script>

		<script src = "assets/validator/validate.js"></script>

	</body>

	<!---Include--->
	<?php include "includes/footer.php"; ?>
	<!---Include--->
	
</html>