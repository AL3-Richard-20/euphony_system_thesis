<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<!---Header--->
		<!---Links--->
		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">

		<link rel = "stylesheet"  type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<<!-- link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Profile Settings</title>

	</head>

	<body>

		<?php 

			if(isset($_GET['userid'])){

				$user_id 		= escape($_GET['userid']);
				$query_admin 	= studInfo($user_id);

				confirmQuery($query_admin);

				while($row = mysqli_fetch_assoc($query_admin)){

					//stud_tbl
		  			$lastname 		= escape($row['Last_name']);
		  			$firstname 		= escape($row['First_name']);
		  			$middlename 	= escape($row['Middle_name']);
		  			$address 		= escape($row['Address']);
		  			$birthdate 		= escape($row['Birthdate']);
		  			$age 			= escape($row['Age']);
		  			$sex 			= escape($row['Sex']);
		  			$contactno 		= escape($row['Contact_no']);
		  			$profileimg 	= escape($row['Profile_img']);
		  			$status 		= escape($row['Status']);
		  			$datestarted 	= escape($row['Date_started']);
		  			$nationality 	= escape($row['Nationality']);

		  			//users_tbl
		  			$email  		= escape($row['Email']);
		  			$password  		= escape($row['Password']);
		  			//Branch_tbl
				}
			}

			if(isset($_POST['lastname'])){

				$new_last_name 		 = escape($_POST["lastname"]);
				$new_first_name 	 = escape($_POST["firstname"]);
				$new_middle_name 	 = escape($_POST["middlename"]);
				$new_sex 			 = escape($_POST["sex"]);
				$new_address 		 = escape($_POST["address"]);
				$new_contact_no 	 = escape($_POST["contactno"]);
				$new_birthdate 		 = escape($_POST["birthdate"]);
				$new_age 			 = escape($_POST['age']);
				$new_nationality 	 = escape($_POST['nationality']);
				//Nationality

				$query = "UPDATE user_info_tbl SET Last_name = '{$new_last_name}', ";
				$query .="First_name = '{$new_first_name}', ";
				$query .="Middle_name = '{$new_middle_name}', "; 
				$query .="Sex = '{$new_sex}', Address = '{$new_address}', ";
				$query .="Age = '{$new_age}', Nationality = '{$new_nationality}', ";
				$query .="Contact_no = '{$new_contact_no}', ";
				$query .= "Birthdate = '{$new_birthdate}' WHERE User_Id = '{$user_id}'";

				$update_student_profile = mysqli_query($con, $query);

				confirmQuery($update_student_profile);

				echo "<script>formAlert('success', 'Successfully Updated', 'Your profile was updated', 'index.php');</script>";

			}

		?>

		<div class = "container"><br><br>

			<?php include "includes/student_navigation.php"; ?>

			<form  method = "POST" enctype = "multipart/form-data" novalidate>

				<div class = "panel panel-default">

					<div class="panel-header">
						<center><h3 class="cap">Edit Profile</h3></center>
					</div>

					<div class = "panel-body">

						<div class = "col-sm-3">

							<div class="item">

								<label>
									<p>Profile Picture</p>

									<?php

										profileImg($profileimg, $sex, $user_id);
										echo "<br>";
									?>

		            			</label>

		            			<div class="row">

		            				<div class="col-sm-6">
		            					<a href="add_profile_pic.php?userid=<?php echo $user_id; ?>" class = "btn btn-primary">Upload a photo</a><br>
		            				</div>

		            				<div class="col-sm-6">
		            					<a href="student_account_settings.php?userid=<?php echo $user_id; ?>" class = "btn btn-default"><span class = "fa fa-cog"></span> Account</a>
		            				</div>

		            			</div>

		            		</div>

		            	</div><br>



		            	<div class = "col-sm-3">
		            		<div class="item">
								<label>
		           					<p>Last Name: </p>
		           					<input type = "text" class = "form-control" name = "lastname" value = "<?php echo $lastname; ?>" required="required">
		           				</label>
		           			</div>
		           		</div>

		           		<div class = "col-sm-3">
		           			<div class="item">
								<label>
		           					<p>First Name: </p>
		           					<input type = "text" class = "form-control" name = "firstname" value = "<?php echo $firstname; ?>" required="required">
		           				</label>
		           			</div>
		           		</div>

		           		<div class = "col-sm-3">
		           			<div class="item">
								<label>
		           					<p>Middle Name: </p>
		           					<input type = "text" class = "form-control" name = "middlename" value = "<?php echo $middlename; ?>" required="required">
		           				</label>
		           			</div>
		            	</div>

		            	<div class = "col-sm-3">
		            		<div class="item">
		            			<label>
				            		<p>Sex: </p>
				           			<select class = "form-control" name = "sex" required="required">

				           				<?php echo "<option value = '$sex'>$sex</option>"; ?>

				           				<?php 

				           					if($sex == 'Male'){

				           						echo "<option value = 'Female'>Female</option>";
				           					}
				           					else if($sex == 'Female'){

				           						echo "<option value = 'Male'>Male</option>";

				           					}

				           				?>

				           			</select>
			           			</label>
		           			</div>
		           		</div>

		           		<div class = "col-sm-3">
		           			<div class="item">
								<label>
		           					<p>Birthdate: </p>
		           					<input type = "date" class = "form-control" name = "birthdate" id = "the_date" value = "<?php echo $birthdate; ?>" required="required">
		           				</label>
		           			</div>
		           		</div>

		           		<div class = "col-sm-3">
		           			<div class="item">
								<label>
		           					<p>Age: </p>
		           					<input type = "number" class = "form-control" name = "age" id = "age" value = "<?php echo $age; ?>" required="required">
		           				</label>
		           			</div>
		            	</div>

		            	<div class = "col-sm-3">
		            		<div class="item">
								<label>
		           					<p>Nationality: </p>
		           					<input type = "text" class = "form-control" name = "nationality" value = "<?php echo $nationality; ?>" required="required">
		           				</label>
		           			</div>
		           		</div>

		           		<div class = "col-sm-3">
		            		<div class="item">
								<label>
		           					<p>Address: </p>
		           					<input type = "text" class = "form-control" name = "address" value = "<?php echo $address; ?>" required="required">
		           				</label>
		           			</div>
		           		</div>

		           		<div class = "col-sm-3">
		           			<div class="item">
								<label>
		           					<p>Contact Number: </p>
		           					<input type = "number" class = "form-control" name = "contactno" value = "<?php echo $contactno; ?>" required="required">
		           				</label>
		           			</div>
		            	</div>

					</div>

					<div class="panel-footer">
						
						<div class="text-right">
							<button type = "submit" class = "btn btn-success btn-lg" id="send">Save</button>
			          		<button type = "button" class = "btn btn-default btn-lg" onclick = "location.href='index.php';">Cancel</button>
		          		</div>

					</div>

				</div>

			</form>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

	</body>
	
</html>