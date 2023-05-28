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

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>
		
		
		
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->
		
		
		
		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Add Teacher</title>

	</head>

	<body>

		<?php

			if(isset($_POST['lastname'])){

				$lastname 		 = escape($_POST["lastname"]);
				$firstname 	 	 = escape($_POST["firstname"]);
				$middlename 	 = escape($_POST["middlename"]);
				$sex 			 = escape($_POST["sex"]);
				$birthdate 		 = escape($_POST["birthdate"]);
				$age 		 	 = escape($_POST["age"]);
				$nationality 	 = escape($_POST["nationality"]);
				$address 		 = escape($_POST["address"]);
				$contactno 	 	 = escape($_POST["contactno"]);

				$query = "INSERT INTO teacher_tbl (T_Last_name, T_First_name, ";
				$query .="T_Middle_name, T_Sex, T_Birthdate, T_Age, ";
				$query .="T_Address, T_Nationality, T_Contact_no) ";
				$query .="VALUES('$lastname', '$firstname', '$middlename', ";
				$query .="'$sex', '$birthdate', ";
				$query .="'$age', '$address', '$nationality', '$contactno') ";

				$add_teacher = mysqli_query($con, $query);

				$last_id = mysqli_insert_id($con);

				confirmQuery($add_teacher);

				if($add_teacher == 1){

					$query2 = "INSERT INTO teacher_branch_tbl(Teacher_Id, ";
					$query2 .="Branch_Id) VALUES ('$last_id', '$branch_id')";

					$teacher_branch = mysqli_query($con, $query2);

					confirmQuery($teacher_branch);

					echo "<script>location.href='teacher_registration_form.php?teacherid=".$last_id."&sex=".$sex."';</script>";
				}
			}

		?>

		<div class="container">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<form  method="POST" enctype="multipart/form-data" novalidate>

				<div class="panel panel-default">

					<div class="panel-header">
						<center><h3 class="cap">Add Teacher</h3></center>
					</div>

					<div class="panel-body">

		            	<div class="row">

			            	<div class="col-sm-12">
			            		<p><b>Personal Information</b></p>
			            	</div><br><br>

			            	<div class = "col-sm-3">
			            		<div class="item">
									<label>
			           					<p>Last Name: </p>
			           					<input type = "text" class = "form-control" name = "lastname" required="required">
			           				</label>
			           			</div>
			           		</div>

			           		<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>First Name: </p>
			           					<input type = "text" class = "form-control" name = "firstname" required="required">
			           				</label>
			           			</div>
			           		</div>

			           		<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>Middle Name: </p>
			           					<input type = "text" class = "form-control" name = "middlename" required="required">
			           				</label>
			           			</div>
			            	</div>

			            	<div class = "col-sm-3">
			            		<div class="item">
			            			<label>
					            		<p>Sex: </p>
					           			<select class = "form-control required" name = "sex">

					           				<option value = "">Select Here</option>

					           				<option value = "Male">Male</option>

					           				<option value = "Female">Female</option>

					           			</select>
				           			</label>
			           			</div>
			           		</div>

			           		<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>Birthdate: </p>
			           					<input type = "date" class = "form-control" name="birthdate" id="birthdate" required="required">
			           				</label>
			           			</div>
			           		</div>

			           		<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>Age: </p>
			           					<input type="number" class="form-control" name="age" id="age" required="required">
			           				</label>
			           			</div>
			            	</div>

			            	<div class = "col-sm-3">
			            		<div class="item">
									<label>
			           					<p>Nationality: </p>
			           					<input type = "text" class = "form-control" name = "nationality" required="required">
			           				</label>
			           			</div>
			           		</div>

			           	</div>

			           	<div class="row">

			            	<div class="col-sm-12">
			            		<p><b>Contact Information</b></p>
			            	</div><br><br>

			           		<div class = "col-sm-3">
			            		<div class="item">
									<label>
			           					<p>Address: </p>
			           					<input type = "text" class = "form-control" name = "address" required="required">
			           				</label>
			           			</div>
			           		</div>

			           		<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>Contact Number: </p>
			           					<input type="number" class="form-control" name="contactno" id="mobileno" required="required" onKeyDown="limitText(this.form.contactno, 10, 11);">
			           				</label>
			           			</div>
			            	</div>

			            </div>

					</div>

					<div class="panel-footer">
						
						<div class="text-right">

							<button type="submit" class="btn btn-primary btn-lg" id="send" name="save">Next</button>

			          		<button type="button" class="btn btn-default btn-lg" onclick="location.href='teachers.php';">Cancel</button>

		          		</div>

					</div>

				</div>

			</form>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->



		<script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>
			

		$('#birthdate').keyup(function(){

	  		var d 			= new Date();
			var curyear 	= d.getFullYear();

			var selected  	= $('#birthdate').val();

			var final = selected.slice(0,4);

			var total = (curyear - final);

			$('#age').val(total);


	    });

	    function limitText(limitField, limitCount, limitNum){

	    	if(limitField.value.length > limitNum){

	    		limitField.value = limitField.value.substring(0, limitNum);
	    	}
	    	else{
	    		limitCount.value = limitNum - limitField.value.length;
	    	}
	    }

		</script>

	</body>
	
</html>