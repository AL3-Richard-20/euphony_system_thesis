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

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | My Profile</title>

	</head>

	<body>

		<?php 

			if(isset($_GET['userid'])){

				$user_id = escape($_GET['userid']);
				
				$query_admin = adminProfile($user_id);

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
		  			$nationality 	= escape($row['Nationality']);
		  			$profileimg 	= escape($row['Profile_img']);

		  			//users_tbl
		  			$email  		= escape($row['Email']);
		  			//Branch_tbl

		  			$fullname = "$firstname $middlename $lastname";
				}
			}

		?>
		
		<div class="container">

			<?php include "includes/admin_navigation.php"; ?>
		
			<div class="margin"></div>

			<form  method="POST" enctype="multipart/form-data" novalidate>

				<div class="panel panel-default">

					<div class="panel-header">
						<center><h3 class="cap">My Profile</h3></center>
					</div>

					<div class="panel-body">

						<div class="col-sm-3" onclick = "location.href='add_profile_pic.php?userid=<?php echo $user_id; ?>&sex=<?php echo $sex; ?>&profileimg=<?php echo $profileimg; ?>';">

		           			<?php

								if($profileimg == NULL){

									if($sex == 'Male'){

										echo "<center><img src = '../images/profile_img/Vector_1.png' class = 'img-circle img-responsive' alt = 'photo' id = 'profileimg'></center>";
									}
									else if($sex == 'Female'){

										echo "<center><img src = '../images/profile_img/Vector_2.png' class = 'img-circle img-responsive' alt = 'photo' id = 'profileimg'></center>";
									}
								}
								else{

									echo "<center><img src = '../images/profile_img/$profileimg' class = 'img-circle img-responsive' alt = 'photo' id = 'profileimg'></center>";
								}

							?>

		            	</div><br>

		            	<div class = "col-sm-4">

		            		<table class = "table">

		            			<thead class="cap">
		            				<th colspan = "2"><label>Personal Information</label></th>
		            			</thead>

		            			<tbody>

		            				<tr>
		            					<td><strong>Full Name: </strong></td>
		            					<td><?php echo $fullname; ?></td>
		            				</tr>

		            				<tr>
		            					<td><strong>Sex: </strong></td>
		            					<td><?php echo $sex; ?></td>
		            				</tr>

		            				<tr>
		            					<td><strong>Birthdate: </strong></td>
		            					<td><?php echo date('F d, Y', strtotime($birthdate)); ?></td>
		            				</tr>

		            				<tr>
		            					<td><strong>Age: </strong></td>
		            					<td><?php echo $age; ?></td>
		            				</tr>

		            				<tr>
		            					<td><strong>Nationality: </strong></td>
		            					<td><?php echo $nationality; ?></td>
		            				</tr>

		            			</tbody>

		            		</table>	           			

		            	</div>

		            	<div class = "col-sm-5">

		            		<table class = "table">
		            			
		            			<thead class="cap">

		            				<th colspan = "2"><label>Contact Information</label></th>

		            			</thead>

		            			<tbody>

		            				<tr>
		            					<td><strong>Address: </strong></td>
		            					<td><?php echo $address; ?></td>
		            				</tr>

		            				<tr>
		            					<td><strong>Mobile Number: </strong></td>
		            					<td><?php echo $contactno; ?></td>
		            				</tr>

		            				<tr>
		            					<td><strong>Email: </strong></td>
		            					<td><?php echo $email; ?></td>
		            				</tr>


		            			</tbody>

		            		</table>

		            	</div>

					</div>

					<div class="panel-footer">
						
						<p style = "color: white">Action</p>
	           			<center><button type = "button" class = "btn btn-primary btn-lg" onclick = "location.href='admin_profile_settings.php?userid=<?php echo $user_id; ?>';">Edit</button>
	          			<button type = "button" class = "btn btn-default btn-lg" onclick = "location.href='index.php';">Cancel</button></center>

					</div>

				</div>

			</form>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

    	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/functions.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

	</body>
	
</html>