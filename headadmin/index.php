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

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  		<title>Euphony Music Center & Studio</title>

  	</head>

	<body>

  		<?php 

  			$query_profile = headadminProfile($user_id);

  			while($row = mysqli_fetch_assoc($query_profile)){

  				$branch_id 		 = escape($row['Branch_Id']);
				$lastname 		 = escape(substr($row['Last_name'], 0,20));
				$firstname 	 	 = escape(substr($row['First_name'], 0,15));
				$middlename 	 = escape(substr($row['Middle_name'], 0,20));
				$sex 			 = escape($row['Sex']);
				$address 		 = escape(substr($row['Address'], 0,35));
				$contact_no 	 = escape(substr($row['Contact_no'], 0,35));
				$profileimg 	 = escape($row['Profile_img']);
				$branch_desc 	 = escape(substr($row['Branch_desc'], 0,35));
				$branch_location = escape(substr($row['Branch_location'], 0,35));
				$branch_image 	 = escape($row['Branch_image']);
				$branch_level 	 = escape(substr($row['Level'], 0,35));

				$fullname = "$firstname $middlename $lastname";

				$_SESSION['branch_id']  = $branch_id;
				$_SESSION['firstname']  = $firstname;
				$_SESSION['profileimg'] = $profileimg;
				$_SESSION['sex'] 		= $sex;

  			}

  		?>	

	  	<div class = "container-fluid">

	  		<?php include "includes/headadmin_navigation.php"; ?><br><br>

			<!---Account--->
			<div class ="col-sm-6">	

				<div class = "panel panel-default">
					<div class = "panel-header">
						<center>
							<h3 class="cap">My Account 
								<a href = "headadmin_profile_settings.php?userid=<?php echo $user_id; ?>" class = "text-right" title = "Edit Account"><i class='fa fa-pencil-alt'></i></a>
							</h3>
						</center>
					</div>

					<div class = "panel-body">

						<div class = "col-sm-3" onclick = "location.href='add_profile_pic.php?userid=<?php echo $user_id; ?>';">
							<?php echo profileImg($profileimg, $sex, $user_id); ?>
						</div>

						<div class = "col-sm-9">

							<table class="table">

								<tbody>

									<tr>
										<td><b>Name:</b></td>
										<td><?php echo substr($fullname, 0,30); ?></td>
									</tr>

									<tr>
										<td><b>Address:</b></td>
										<td><?php echo substr($address, 0,30); ?></td>
									</tr>

									<tr>
										<td><b>Position:</b></td>
										<td>General Manager</td>
									</tr>

									<!-- <tr>
										<td><b>Mobile Number:</b></td>
										<td><?php echo $contact_no; ?></td>
									</tr> -->

								</tbody>	

							</table>

						</div>

					</div>

					<div class="panel-footer">
						<div class="text-right">
							<a href="view_profile.php?userid=<?php echo $user_id; ?>" class = "btn btn-primary">View</a>
						</div>
					</div>

				</div>

			</div>
			<!---Account END--->

			<!---Sales Today--->
			<div class ="col-sm-6">	
				<div class = "panel panel-default">
					<div class = "panel-header">
						<center><h3 class="cap">Overall Sales (Today)</h3></center>
					</div>
					<div class = "panel-body"><br>
						<?php sales_Today(); ?>
					</div><br>
					<div class="panel-footer">
						<div class="text-right"><br>
							<a href="sales_menu.php" class = "btn btn-primary">View</a>
						</div>
					</div>
				</div>
			</div>
			<!---Sales Today END--->

			<!---Branches--->
			<div class ="col-sm-3">
				<div class = "panel panel-default" onclick="location.href='branches.php';">
					<div class = "panel-header">
						<center><h3 class="cap">Branches</h3></center><br>
					</div>
					<div class = "panel-body">
						<div><center><h1><?php countRecords('branches_tbl'); ?></h1></center></div>
						<div class = "margin"></div>
					</div>
				</div>
			</div>
			<!---Branches END--->

			<!---Lessons--->
			<div class ="col-sm-3">
				<div class = "panel panel-default" onclick="location.href='services.php';">
					<div class = "panel-header">
						<center><h3 class="cap">Lessons Offered</h3></center><br>
					</div>
					<div class = "panel-body">
						<div><center><h1><?php echo countRecords('lessons_tbl'); ?></h1></center></div>
						<div class = "margin"></div>
					</div>
				</div>
			</div>
			<!---Lessons END--->

			<!---Services--->
			<div class ="col-sm-3">
				<div class = "panel panel-default" onclick="location.href='services.php?active=services';">
					<div class = "panel-header">
						<center><h3 class="cap">Services Offered</h3></center><br>
					</div>
					<div class = "panel-body">
						<div><center><h1><?php echo countRecords('services_tbl'); ?></h1></center></div>
						<div class = "margin"></div>
					</div>
				</div>
			</div>
			<!---Services END--->

			<!---Categories--->
			<div class ="col-sm-3">
				<div class = "panel panel-default" onclick="location.href='categories.php';">
					<div class = "panel-header">
						<center><h3 class="cap">Product Categories</h3></center><br>
					</div>
					<div class = "panel-body">
						<div><center><h1><?php echo countRecords('category_tbl'); ?></h1></center></div>
						<div class = "margin"></div>
					</div>
				</div>
			</div>
			<!---Categories END--->

			<!-- Policy -->
			<div class="col-sm-12">

				<div class="panel panel-default">

					<div class="panel-header">
						<center><h3 class="cap">Policy</h3></center>
					</div>

					<div class="panel-body">

						<?php

							$query_policy = queryTable('policy_tbl');

							confirmQuery($query_policy);

							while($row = mysqli_fetch_assoc($query_policy)){

								$content = $row['Content'];

								echo "<p>$content</p>";
							}
						?>

					</div>

				</div>

			</div>
			<!-- Policy END -->

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

  	</body>

  	<?php include "../includes/footer.php"; ?>

 </html>