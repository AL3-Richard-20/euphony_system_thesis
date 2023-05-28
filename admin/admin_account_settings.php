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

		<title>Euphony | Account Settings</title>

	</head>

  	<body>

  		<?php include "includes/admin_navigation.php"; ?>

  		<div class="margin"></div>

  		<div class = "container">

  			<?php

  				// =================== User's Profile ===================

  				if(isset($_GET['userid'])){

  					$the_user_id 	= $_GET['userid'];

  					$query_user_info = tableQuery_3('user_login', 'User_Id', $the_user_id);

  					confirmQuery($query_user_info);

  					while($row = mysqli_fetch_assoc($query_user_info)){

  						$user_email 	= escape($row['Email']);
			  			$user_password 	= escape($row['Password']);

  					}
  				}
  				else{
  					echo "<script>location.href='index.php';</script>";
  				}

  				// =================== User's Profile END ===================


  				// =================== Editing User's Acc Info ===================

  				if(isset($_POST['email'])){

  					$email 			= escape($_POST['email']);
			  		$password 		= escape($_POST['password']);
			  		$oldpass 		= escape($_POST['oldpass']);	

			  		if(password_verify($oldpass, $user_password)){

				  		$new_password 	= password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

				  		$query = "UPDATE user_login SET Email = '{$email}', Password = '{$new_password}' ";
				  		$query .= "WHERE User_Id = '{$the_user_id}'";
				  		$update_user_account = mysqli_query($con, $query);

				  		confirmQuery($update_user_account);

				  		if($update_user_account == 1){

				  			$query2 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
				  			$query2 .="VALUES (curdate(), curtime(), 'Edit account information', '$the_user_id')";

				  			$add_to_logs = mysqli_query($con, $query2);

				  			confirmQuery($add_to_logs);

					  		echo "<script>sweetAlert('success', 'Successfully Updated!', 'Your account was updated', 'admin_profile_settings.php?userid=$the_user_id');</script>";
					  	}

				  	}

				  	else{

				  		$query = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
			  			$query .="VALUES (curdate(), curtime(), 'Edit account information attempt', '$the_user_id')";

			  			$add_to_logs = mysqli_query($con, $query);

			  			confirmQuery($add_to_logs);

				  		echo "<script>sweetAlert('error', 'Unsuccessful', 'Old password is invalid', 'admin_account_settings.php?userid=$the_user_id');</script>";	

				  	}
				 
  				}

  				// =================== Editing User's Info END ===================

  			?>

  			<form method="POST" novalidate>

	  			<div class="panel panel-default">

	  				<div class="panel-header">
	  					<center><h3 class="cap">Edit Account</h3></center>
	  				</div>

	  				<div class="panel-body"><br>

	  					<div class="container-fluid">

	  						<div class="row">
	  							
		  						<div class="col-sm-4">

		  							<div class="item">
		  								<label>
				  							<p class = "text-left">Email</p>
					  						<input type = "email" class = "form-control" name = "email" value = "<?php echo $user_email; ?>" required="required">
				  						</label>
			  						</div>

		  						</div>

		  						<div class = "col-sm-4">

		  							<div class="item">
		  								<label>
					  						<p class = "text-left">New Password</p>
					  						<input type = "password" class = "form-control" name = "password" data-validate-length="6,8" required="required">
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

			  				</div>

		  					<div class = "col-sm-4">

		  						<div class="item">
		  							<label>
				  						<br><p><em>Enter old password to apply changes</em></p><br>
				  						<p class = "text-left">Old Password</p>
				  						<input type = "password" class = "form-control" name = "oldpass" required="">
				  					</label>
		  						</div><br>

		  					</div>

	  					</div>

	  				</div>

	  				<div class="panel-footer">
	  					
	  					<center>

	  						<button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button>

					  		<button type = "button" class = "btn btn-default btn-lg" onclick = "location.href='admin_profile_settings.php?userid=<?php echo $the_user_id; ?>';">Cancel</button>

					  	</center>

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

  	</body>

  </html>