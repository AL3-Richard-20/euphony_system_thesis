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

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Admin Account</title>

	</head>

  	<body>
  		
  		<?php include "includes/headadmin_navigation.php"; ?><br><br><br>

  		<div class = "container">

  			<?php

  				if(isset($_GET['lastid'])){

  					$the_user_id 	= $_GET['lastid'];
  				}

  				// if(isset($_POST['email'])){

  				// 	$email 			= escape($_POST['email']);
			  	// 	$password 		= escape($_POST['password']);
			  	// 	$oldpass 		= escape($_POST['oldpass']);	

			  	// 	if(password_verify($oldpass, $user_password)){

				  // 		$new_password 	= password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

				  // 		$query = "UPDATE user_login SET Email = '{$email}', Password = '{$new_password}' ";
				  // 		$query .= "WHERE User_Id = '{$the_user_id}'";
				  // 		$update_user_account = mysqli_query($con, $query);

				  // 		confirmQuery($update_user_account);

				  // 		if($update_user_account == 1){
				  // 			echo "<script>sweetAlert('success', 'Successfully Updated', 'Account was updated', 'index.php');</script>";
				  // 		}
				  // 	}

				  // 	else{

				  // 		echo "<script>sweetAlert('error', 'Cannot be done', 'Old password is invalid', 'headadmin_account_settings.php?userid=$the_user_id');</script>";	

				  // 	}
				 
  				// }

  			?>

  			<form method="POST" id="admin_acc_form" novalidate>

	  			<div class = "panel panel-default">

	  				<div class = "panel-header">
	  					<center><h3 class="cap">Administrator's Account</h3></center>
	  				</div>

	  				<div class = "panel-body"><br>

	  					<div class = "container-fluid">

	  						<div class="row">
	  							
		  						<div class="col-sm-4">

		  							<input type="hidden" id="last_id" value="<?php echo $the_user_id ; ?>">

		  							<div class="item">
		  								<label>
				  							<p class="text-left">Email</p>
					  						<input type="email" class="form-control" name="email" id="email" data-parsley-type="email" data-parsley-trigger="focusout" data-parsley-checkemail data-parsley-checkemail-message="Email already taken">
				  						</label>
			  						</div>

		  						</div>

		  						<div class = "col-sm-4">

		  							<div class="item">
		  								<label>
					  						<p class="text-left">Password</p>
					  						<input type="password" class="form-control" name="password" id="password" required="required">
					  					</label>
			  						</div>

			  					</div>

			  					<div class = "col-sm-4">

			  						<div class="item">
			  							<label>
			  								<p class="text-left">Re-type Password</p>
			  								<input type="password" class="form-control" data-validate-linked="password" required="required">
			  							</label>
			  						</div>

			  					</div>

			  				</div>

	  					</div>

	  				</div>

	  				<div class="panel-footer">
	  					
	  					<center>
	  						<button type="submit" class="btn btn-primary btn-lg" id="send">Next</button>
					  </center>

	  				</div>

	  			</div>

  			</form>

  		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<!-- <script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script> -->

		<script src = "../assets/parsely/parsley.js"></script>

		<script>

			$('#email').parsley();

		    window.ParsleyValidator.addValidator('checkemail', {
		      validateString: function(value)
		      {
		        return $.ajax({
		          url:'../fetch_email.php',
		          method:"POST",
		          data:{email:value},
		          dataType:"json",
		          success:function(data)
		          {
		            return true;
		          }
		        });
		      }
		    });

			
			$('#admin_acc_form').submit(function(e){

				e.preventDefault();

				var last_id  	= $('#last_id').val();
				var email   	= $('#email').val();
				var password  	= $('#password').val();

				$.ajax({

					url:"action.php",
					method:"POST",
					data: {
						lastid:last_id,
						email:email,
						password:password,
						action:"admin_account"
					},

					success:function(data){

						var result = JSON.parse(data);

						if(result == '1'){

							sweetAlert('info', 'Verification Code', 'Verification code was sent to the address provided', 'admin_profile_pic.php?userid=' + last_id + '');
						}

						else if(result == '2'){

							sweetAlert('error', 'Mailer Error', 'Mailer server was failed', 'new_admin_account.php?lastid=' + last_id + '');
						}

						else if(result == '3'){
							sweetAlert('info', 'Item has been missing', 'Try again', 'new_admin_account.php?lastid=' + last_id + '');
						}

						else if(result == '4'){
							sweetAlert('error', 'Email already exist', 'Try another one', 'new_admin_account.php?lastid=' + last_id + '');
						}
					}
				});

			});

		</script>

  	</body>

  </html>