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

  		<title>Euphony | Daily Overall Sales</title>

  	</head>

	<body>

		<div class = "container">

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class="margin"></div>

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

						<div class="col-sm-12">

				  			<div class="col-sm-1">
				  				<center><img src="../images/default/Sales (3).png" style="height:70px"></center>
				  			</div>

				  			<div class="col-sm-3">
				  				<h3 class="cap">Overall Sales</h3>
				  			</div>

				  			<div class="col-sm-4"></div>

				  			<div class="col-sm-4" style = "border: 2px solid #f4f4f4; background-color: #dff0d8">

				  				<?php 

				  					$query = "SELECT SUM(Cash) - Cash_change as Sales FROM sales_tbl ";
									$query .="WHERE randSalt4 = 1 AND ";
									$query .="Date = curdate() ";

									$query_overall_sales = mysqli_query($con, $query);

									confirmQuery($query_overall_sales);

									$row = mysqli_fetch_array($query_overall_sales);

									echo "<h3>".number_format($row['Sales'],2)." PHP</h3>";

				  				?>

				  				
				  				<p>Overall Sales Today</p>

				  			</div>

				  		</div>

			  		</div>

			  		<hr/>

			  		<div class="row">

			  			<div class="col-sm-12">

				  			<?php

				  				$query = "SELECT Branch_Id, Branch_desc, ";
				  				$query .="Branch_location FROM branches_tbl "; 
	 	
				  				$query_all_branch = mysqli_query($con, $query);

				  				while($row = mysqli_fetch_assoc($query_all_branch)){

				  					$branch_Id 	 	 = escape($row['Branch_Id']);
				  					$branch_desc 	 = escape($row['Branch_desc']);
				  					$branch_location = escape($row['Branch_location']);

				  					echo "<div class='col-sm-4' onclick='salesMenu2(".$branch_Id.")' style='cursor:pointer'>";
				  					echo "<div class='panel panel-default'>";
							  		echo "<div class='panel-footer'>";


							  		$query2 ="SELECT SUM(Cash) - Cash_change as Sum ";
							  		$query2 .="FROM sales_tbl WHERE Branch_Id = ";
							  		$query2 .="'".$branch_Id."' AND Date = curdate() ";

							  		$sales_today = mysqli_query($con, $query2);

							  		$row2 = mysqli_fetch_assoc($sales_today);

							  		$sum = $row2['Sum']; 

							  		echo "<h3>".number_format((int)$sum,2)." PHP</h3>";


							  		echo "<span><a href='sales_menu_2.php?branchid=$branch_Id'>$branch_desc</a></span>";
							  		echo "</div>";
							  		echo "</div>";
							  		echo "</div>";

				  				}

				  			?>

			  			</div>

			  		</div>

				</div>

			</div>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<script>
			
			function salesMenu2(branchid){

				location.href='sales_menu_2.php?branchid=' + branchid;
			}

		</script>

	</body>

</html>