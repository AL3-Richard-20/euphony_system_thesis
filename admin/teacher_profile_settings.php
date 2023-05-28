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

		<link rel = "stylesheet"  type="text/css" href="../assets/datatables/datatables.min.css"/>

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Edit Teacher Profile</title>

	</head>

	<body>

		<?php include "includes/admin_navigation.php"; ?>

		<?php

			if(isset($_GET['teacherid'])){
				
	  			$teacher_id = $_GET['teacherid'];

	  			$query_selected_teacher = teacherInfo($teacher_id);

	  			while($row = mysqli_fetch_assoc($query_selected_teacher)){

	  				//stud_tbl
		  			$lastname 		= escape($row['T_Last_name']);
		  			$firstname 		= escape($row['T_First_name']);
		  			$middlename 	= escape($row['T_Middle_name']);
		  			$age 			= escape($row['T_Age']);
		  			$address 		= escape($row['T_Address']);
		  			$birthdate 		= escape($row['T_Birthdate']);
		  			$sex 			= escape($row['T_Sex']);
		  			$contactno 		= escape($row['T_Contact_no']);
		  			$nationality 	= escape($row['T_Nationality']);
		  			$profileimg 	= escape($row['T_Profile_img']);
		  			//stud_tbl END

	  			}

  			}

			if(isset($_POST['lastname'])){

				$new_lastname 		 = escape($_POST["lastname"]);
				$new_firstname 	 	 = escape($_POST["firstname"]);
				$new_middlename 	 = escape($_POST["middlename"]);
				$new_sex 			 = escape($_POST["sex"]);
				$new_birthdate 		 = escape($_POST["birthdate"]);
				$new_age 		 	 = escape($_POST["age"]);
				$new_nationality 	 = escape($_POST["nationality"]);
				$new_address 		 = escape($_POST["address"]);
				$new_contactno 	 	 = escape($_POST["contactno"]);

				$query = "UPDATE teacher_tbl SET T_Last_name = '{$new_lastname}', ";
				$query .="T_First_name = '{$new_firstname}', T_Middle_name = '{$new_middlename}', ";
				$query .="T_Sex = '{$new_sex}', T_Birthdate = '{$new_birthdate}', ";
				$query .="T_Age = '{$new_age}', T_Address = '{$new_address}', ";
				$query .="T_Nationality = '{$new_nationality}', T_Contact_no = '{$new_contactno}' ";
				$query .="WHERE Teacher_Id = '{$teacher_id}'";

				$update_teacher = mysqli_query($con, $query);

				confirmQuery($update_teacher);

				echo "<script>sweetAlert('success', 'Successfully Updated!', 'You updated the teacher information', 'edit_teacher.php?teacherid=$teacher_id');</script>";

			}

		?>

		<div class = "margin"></div>
		
		<div class = "container">

			<form  method = "POST" enctype = "multipart/form-data" novalidate>

				<div class = "panel panel-default">

					<div class="panel-header">
						<center><h3 class="cap">Edit Teacher</h3></center>
					</div>

					<div class = "panel-body">

						<div class = "col-sm-3">

							<div class="item">

								<label>
									<p>Profile Picture</p>
									<center><?php profileImg($profileimg, $sex); ?></center><br>
		            			</label>

		            			<div class="row">

		            				<center><a href="teacher_profile_pic.php?userid=<?php echo $teacher_id; ?>&sex=<?php echo $sex; ?>" class = "btn btn-primary">Upload a photo</a></center><br>

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
							<button type = "submit" class = "btn btn-success btn-lg upload_image" id="send">Save</button>
			          		<button type = "button" class = "btn btn-default btn-lg" onclick = "location.href='edit_teacher.php?teacherid=<?php echo $teacher_id; ?>';">Cancel</button>
		          		</div>

					</div>

				</div>

			</form>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>

		<script src="../assets/js/select2.full.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->



		<script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

	</body>
	
</html>