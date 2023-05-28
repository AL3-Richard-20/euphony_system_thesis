<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1">



		<link rel = "stylesheet" href = "assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet" href = "assets/animate/animate.min.css">

		<link rel = "stylesheet" href = "assets/font/css/all.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->



		<link rel = "stylesheet" href = "includes/style.css">

		<title>Euphony | Choosing a Branch</title>

	</head>

	<body>

		<div class="container"><br><br>

			<!---Choose a branch--->

		    	<form method = "POST">

		    			<h3 class="cap" id="h3"><center>Choose a branch near you</center></h3>

		    			<div class='row text-center'>

							<?php

								$query_branch = tableQuery_3('branches_tbl', 'randSalt3', 1);

								while($row = mysqli_fetch_array($query_branch)){

									$branchid 		= $row["Branch_Id"];
									$branch 		= $row["Branch_desc"];
									$branchlocation = $row["Branch_location"];
									$branchimage 	= $row["Branch_image"];

							  		echo "<div class='col-sm-4'>";
									echo "<div class='thumbnail'>";
									echo "<img src='images/branches/$branchimage' alt = 'Image' class='img-responsive'>";
									echo "<br>";
									echo "<p class='ellip'><strong>$branch</strong></p>";
									echo "<p class='ellip'><b>Address:</b> $branchlocation</p>";
									echo "<a href='student_registration.php?branchid=$branchid&branchdesc=$branch' class = 'btn btn-success' title = 'Enroll Here?' data-toggle='popover' data-trigger='hover' data-content='Click If Yes' id = 'checkbox'><span class = 'fa fa-check'></span></a>";
									echo "</div>";
									echo "</div>";
								}
							?>

						</div>

					<div class="row">

						<div class="col-sm-4"></div>

						<div class="col-sm-4">
							<div class="text-center">
								<button class = "btn btn-default btn-lg" type = "button" onclick="location.href='index.php'"><span>Back</span></button>
							</div>
						</div>

						<div class="col-sm-4"></div>
						
					</div>

			</form>

		</div>

		<script src = "assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

	</body>
	
</html>