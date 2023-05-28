<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>
<!---Includes END-->

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">

		<link rel = "stylesheet"  type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Add Administrator</title>

	</head>

	<body>

		<div class="container">

			<?php

				if(isset($_POST['branch'])){

					$lastname 		= escape($_POST['lastname']);
					$firstname 		= escape($_POST['firstname']);
					$middlename 	= escape($_POST['middlename']);
					$sex 			= escape($_POST['sex']);
					$birthdate 		= escape($_POST['birthdate']);
					$age 			= escape($_POST['age']);
					$nationality 	= escape($_POST['nationality']);
					$address 		= escape($_POST['address']);
					$contactno 		= escape($_POST['contactno']);
					// $email 			= escape($_POST['email']);
					// $password 		= escape($_POST['password']);
					// $password 		= password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

					// $profile_img 	 	 = $_FILES["profileimg"]["name"];
					// $profile_img_tmp 	 = $_FILES["profileimg"]["tmp_name"];

					//move_uploaded_file($profile_img_tmp, "../images/profile_img/$profile_img");

					// if(empty($profile_img)){

					// 	if($sex == 'Male'){

					// 		$profile_img = "Vector_1.png";
					// 	}
					// 	else if($sex == 'Female'){

					// 		$profile_img = "Vector_2.png";
					// 	}

					// }

					$the_branch 	= escape($_POST['branch']);

					$query = "INSERT INTO user_info_tbl(Branch_Id, Last_name, First_name, Middle_name, Address, Contact_no, Birthdate, Age, Sex, Nationality) ";
					$query .= "VALUES('$the_branch', '$lastname','$firstname','$middlename','$address','$contactno','$birthdate', '$age', '$sex', '$nationality')";

					$query_add_user = mysqli_query($con, $query);

					confirmQuery($query_add_user);

					$last_id = mysqli_insert_id($con);

					echo "<script>location.href='new_admin_account.php?lastid=".$last_id."';</script>";
				}
			?>

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class="margin"></div>

			<form method="POST" enctype = "multipart/form-data" novalidate>

				<div class = "panel panel-default">

					<div class="panel-header">
						<center><h3 class="cap">Add new administrator</h3></center>
					</div>

					<div class = "panel-body">

							<!-- <div class = "col-sm-3">

								<div class="item">

									<label>
										<p>Profile Picture</p>
			           					<center><img src = "../images/profile_img/Vector_1.png" class = "img-circle img-responsive" alt = "photo" id = "profileimg"></center><br>
			            			</label>

			            			<input type = "file" name = "profileimg">

			            		</div>

			            	</div><br> -->

			            <div class="row">

			            	<div class="col-sm-12">
			            		<p><b>Personal Information</b></p>
			            	</div><br><br>

			            	<div class = "col-sm-3">
			            		<div class="item">
									<label>
			           					<p>Last Name </p>
			           					<input type = "text" class = "form-control" name = "lastname" required="required">
			           				</label>
			           			</div>
			           		</div>

							<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>First Name </p>
			           					<input type = "text" class = "form-control" name = "firstname" required="required">
			           				</label>
			           			</div>
			           		</div>

			           		<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>Middle Name </p>
			           					<input type = "text" class = "form-control" name = "middlename" required="required">
			           				</label>
			           			</div>
			            	</div>

			            	<div class = "col-sm-3">
			            		<div class="item">
			            			<label>
					            		<p>Sex </p>
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
			           					<p>Birthdate </p>
			           					<input type="date" class="form-control" name="birthdate" id="birthdate" required="required">
			           				</label>
			           			</div>
			           		</div>

			           		<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>Age </p>
			           					<input type="number" class="form-control" name ="age" id="age" required="required">
			           				</label>
			           			</div>
			            	</div>

			            	<div class = "col-sm-3">
			            		<div class="item">
									<label>
			           					<p>Nationality </p>
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
			           					<p>Address </p>
			           					<input type = "text" class = "form-control" name = "address" required="required">
			           				</label>
			           			</div>
			           		</div>

			           		<div class = "col-sm-3">
			           			<div class="item">
									<label>
			           					<p>Contact Number </p>
			           					<input type="number" class="form-control" name="contactno" onKeyDown="limitText(this.form.contactno, 10, 11);" required="required">
			           				</label>
			           			</div>
			            	</div>

			            	<div class="col-sm-3">
		  						<p>Branch</p>
		  						<select class="form-control" name="branch">
		  							<option value="">Select Here</option>
		  							<?php

		  								$query_branches = queryTable('branches_tbl');

		  								confirmQuery($query_branches);

		  								while($row = mysqli_fetch_assoc($query_branches)){

		  									$branch_Id 		= escape($row['Branch_Id']);
		  									$branch_desc 	= escape($row['Branch_desc']);

		  									echo "<option value='$branch_Id'>$branch_desc</option>";
		  								}

		  							?>
		  						</select>
		  					</div>

			            </div>

			            <!-- <div class="row">
			            	<div class="col-sm-4">
			            		<h3 class="cap">Account</h3><hr/>
			            	</div>
			            </div>

			            <div class="row">
	  							
	  						<div class="col-sm-4">

	  							<div class="item">
	  								<label>
			  							<p class = "text-left">Email</p>
				  						<input type = "email" class = "form-control" name = "email" required="required">
			  						</label>
		  						</div>

	  						</div>

	  						<div class = "col-sm-4">

	  							<div class="item">
	  								<label>
				  						<p class = "text-left">Password</p>
				  						<input type = "password" class = "form-control" name = "password" required="required">
				  					</label>
		  						</div>

		  					</div>

		  					<div class = "col-sm-4">

		  						<div class="item">
		  							<label>
		  								<p class = "text-left">Confirm Password</p>
		  								<input type = "password" class = "form-control" data-validate-linked="password" required="required">
		  							</label>
		  						</div>

		  					</div>

		  				</div>--->

					</div>

					<div class="panel-footer">
						
						<div class="text-right">
							<button type="submit" class = "btn btn-primary btn-lg" id="send">Next</button>
			          		<button type = "button" class = "btn btn-default btn-lg" onclick = "location.href='administrators.php';">Cancel</button>
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