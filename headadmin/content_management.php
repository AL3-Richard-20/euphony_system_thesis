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

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Settings</title>

	</head>

	<body>

		<div class ="container">

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class = "margin"></div>

			<div class ="row">
				<div class = "col-sm-6">

					<!-- <div class="panel panel-default">
					  	<div class="panel-body">
					 		<h3>Header</h3>
					 		<p><em>(Logo, Company Name)</em></p>
					 		<div class = "text-right">
					 			<button class = "btn btn-primary btn-lg" onclick = "location.href = '#';">Open</button>
					 		</div>
					  	</div>
					</div> -->

					<div class="panel panel-default">
					  	<div class="panel-body">
					 		<h3 class="cap">About Us</h3>
					 		<p><em>(History, Mission, Vision)</em></p>
					 		<div class = "text-right">
					 			<button class = "btn btn-primary btn-lg" onclick = "location.href = 'about_us.php';">Open</button>
					 		</div>
					  	</div>
					</div>

					<div class="panel panel-default">
					  	<div class="panel-body">
					  		<h3 class="cap">Branches</h3>
					  		<p><em>(Administrators, Address)</em></p>
					  		<div class = "text-right">
					 			<button class = "btn btn-primary btn-lg" onclick = "location.href = 'branches.php';">Open</button>
					 		</div>
					  	</div>
					</div>

					<div class="panel panel-default">
					  	<div class="panel-body">
					  		<h3 class="cap">Gallery</h3>
					  		<p><em>(Images)</em></p>
					  		<div class = "text-right">
					 			<button class = "btn btn-primary btn-lg" onclick = "location.href = 'gallery.php';">Open</button>
					 		</div>
					  	</div>
					</div>

				</div>

				<div class = "col-sm-6">

					<div class="panel panel-default">
					  	<div class="panel-body">
					  		<h3 class="cap">Services Offered</h3>
					  		<p><em>(Lessons, etc.)</em></p>
					  		<div class = "text-right">
					 			<button class = "btn btn-primary btn-lg" onclick = "location.href = 'services.php';">Open</button>
					 		</div>
					  	</div>
					</div>
					
					<div class="panel panel-default">
					  	<div class="panel-body">
					  		<h3 class="cap">Policy</h3>
					  		<p><em>(Terms & Conditions)</em></p>
						  	<div class = "text-right">
					 			<button class = "btn btn-primary btn-lg" onclick = "location.href = 'edit_policy.php';">Open</button>
					 		</div>
					 	</div>
					</div>

					<div class="panel panel-default">
					  	<div class="panel-body">
					  		<h3 class="cap">Products</h3>
					  		<p><em>(Display, Fast Moving, Settings)</em></p>
						  	<div class = "text-right">
					 			<button class = "btn btn-primary btn-lg" onclick = "location.href = 'products.php';">Open</button>
					 		</div>
					 	</div>
					</div>

					<!-- <div class="panel panel-default">
					  	<div class="panel-body">
					  		<h3>Footer</h3>
					  		<p><em>(Links)</em></p>
					  		<div class = "text-right">
					 			<button class = "btn btn-primary btn-lg" onclick = "location.href = '#';">Open</button>
					 		</div>
					  	</div>
					</div> -->
					
				</div>

			</div>
			
		</div>

	</body>

	<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

	<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

	<script src = "scripts/functions.js"></script>

 </html>