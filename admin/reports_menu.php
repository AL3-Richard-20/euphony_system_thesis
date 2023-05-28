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



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Reports</title>

	</head>

	<body>

		<?php include "includes/admin_navigation.php"; ?>

		<div class="margin"></div>

		<div class = "container">

			<div class="panel panel-default">

				<div class="panel-header">
					
					<div class="row">

		              	<div class="col-sm-4">
		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>
		              	</div>

		            </div>

				</div><br>

				<div class="panel-body">

			  		<div class="row">
			  			<div class="col-sm-1">
			  				<center><img src="../images/default/Print2.png" style="height:70px"></center>
			  			</div>
			  			<div class="col-sm-11">
			  				<h3 class="cap">Reports</h3>
			  			</div>
			  		</div>

			  		<div class="col-sm-4">
				  		<div class="form-group">


				  			<h3>Class</h3><hr/>
			  				<a href="attendance.php">
				  				<p>
				  					Attendance Record
				  					<!-- <i class="fas fa-dot-circle text-success"></i> -->
				  				</p>
				  			</a>


			  				<a href="payments.php">
			  					<p>Payment Balances</p>
			  				</a>
			  				<a href="print_official_stud.php?branchid=<?php echo $branch_id; ?>">
			  					<p>Official Students</p>
			  				</a>


		  				</div>
	  				</div>

	  				<div class="col-sm-4">

		  				<div class="form-group">

		  					<h3>Inventory</h3><hr/>

			  				<a href="stock_in.php">
			  					<p>Stock In</p>
			  				</a>
			  				<a href="stock_out.php">
			  					<p>Stock Out</p>
			  				</a>
			  				<a href="print_stocks_on_hand.php?branchid=<?php echo $branch_id; ?>" target="_blank">
			  					<p>Stock on hand</p>
			  				</a>
			  				<a href="print_fast_moving.php?branchid=<?php echo $branch_id; ?>" target="_blank">
			  					<p>Fast Moving</p>
			  				</a>
			  				<a href="print_slow_moving.php?branchid=<?php echo $branch_id; ?>" target="_blank">
			  					<p>Slow Moving Products</p>
			  				</a>
			  				<a href="print_critical_stocks.php?branchid=<?php echo $branch_id; ?>" target="_blank">
			  					<p>Critical Stocks</p>
			  				</a>
			  			</div>
			  		</div>

			  		<div class="col-sm-4">

		  				<div class="form-group">

		  					<h3>Sales</h3><hr/>

			  				<a href="daily_sales.php">
			  					<p>Product Sales Report</p>
			  				</a>

			  				<a href="payments.php">
			  					<p>Lesson Sales Report</p>
			  				</a>

			  			</div>

			  		</div>

			  		<!-- <div class="col-sm-4">
		  				<div class="form-group">
					  		<h3>Logs</h3>
			  				<a href="#">
			  					<s>Activity Log</s>
			  				</a><br>
			  				<a href="#">
			  					<s>User Log</s>
			  				</a>
			  			</div>
			  		</div> -->

				</div>

			</div>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

	</body>

</html>