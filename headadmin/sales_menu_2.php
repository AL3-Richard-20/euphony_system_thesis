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



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  		<title>Euphony | Overall Sales Menu</title>

  	</head>

	<body>

		<div class = "container">

			<?php include "includes/headadmin_navigation.php"; ?>

			<?php 

				if(isset($_GET['branchid'])){

					$the_branch_Id = $_GET['branchid'];

					$query = "SELECT Branch_desc FROM branches_tbl ";
					$query .="WHERE Branch_Id = '$the_branch_Id' ";

					$branch_info = mysqli_query($con, $query);

					$row = mysqli_fetch_assoc($branch_info);

					$branch_desc = $row['Branch_desc'];

					if($_GET['branchid'] == null){

						echo "<script>location.href='sales_menu.php';</script>";
					}


				}

				else if(!isset($_GET['branchid'])){

					echo "<script>location.href='sales_menu.php';</script>";
				}

			?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">
					
					<div class="row">

		              	<div class="col-sm-4"><br>
		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='sales_menu.php'"><span class="fa fa-arrow-left"></span></button>
		              	</div>

		            </div>

				</div><br>

				<div class="panel-body">

					<div class="row">
			  			<div class="col-sm-1">
			  				<center><img src="../images/default/Sales (3).png" style="height:70px"></center>
			  			</div>
			  			<div class="col-sm-11">
			  				<h3 class="cap">Overall Sales </h3> <p>(<?php echo $branch_desc; ?>)</p>
			  			</div>
			  		</div><br><br>

			  		<div class="row">

			  			<div class="col-sm-4">
			  				<div class="thumbnail" onclick="location.href='overall_daily.php?branchid=' + <?php echo $the_branch_Id; ?>;" style="cursor:pointer">
			  					<center><h3>Daily Sales</h3></center>
			  				</div>
			  			</div>

			  			<div class="col-sm-4">
			  				<div class="thumbnail" onclick="location.href='overall_monthly.php?branchid=' + <?php echo $the_branch_Id; ?>;" style="cursor:pointer">
			  					<center><h3>Monthly Sales</h3></center>
			  				</div>
			  			</div>

			  			<div class="col-sm-4">
			  				<div class="thumbnail" onclick="location.href='overall_yearly.php?branchid=' + <?php echo $the_branch_Id; ?>;" style="cursor:pointer">
			  					<center><h3>Yearly Sales</h3></center>
			  				</div>
			  			</div>

			  		</div>

				</div>

			</div>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		
		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

	</body>

</html>