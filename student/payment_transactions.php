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

		<link rel = "stylesheet"  type="text/css" href = "../assets/datatables/datatables.min.css"/>

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->




		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  		<title>Euphony | Payment Transactions</title>

  	</head>

  	<body>

	  	<div class = "container-fluid">

	  		<?php include "includes/student_navigation.php"; ?>

	  		<div class="margin"></div>

	  		<div class="panel panel-default">
	  			
	  			<div class="panel-header">

	  				<div class="row">

		              	<div class="col-sm-4">

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		                	<center><h3 class="cap">Payment Balances</h3></center>
		              	</div>

		              	<div class="col-sm-4"></div>

		            </div>

	  			</div>

	  			<div class="panel-body">
	  				
	  				<div class="table-responsive">
	  					
	  					<table class = "table table-bordered table-hover" id="standardAsc">

							<thead class="cap">
									<th>No</th>
									<th>Date</th>
									<th>Time</th>
									<th>Recent Balance</th>
									<th>Cash</th>
									<th>Change</th>
									<th>Balance</th>
								</thead>

							<tbody>

								<?php

									$query = "SELECT user_info_tbl.Last_name, user_info_tbl.First_name, ";
									$query .="user_info_tbl.Middle_name, stud_balances.Transaction_Id, ";
									$query .="stud_balances.Date, stud_balances.Cash_tendered, ";
									$query .="stud_balances.The_change, stud_balances.The_balance, ";
									$query .="stud_balances.Total_balance, stud_balances.Trans_time ";
									$query .="FROM user_info_tbl LEFT JOIN stud_balances ON ";
									$query .="user_info_tbl.User_Id = stud_balances.User_Id ";
									$query .="WHERE stud_balances.User_Id = '{$user_id}' ";
									$query .="ORDER BY stud_balances.Transaction_Id";

									$query_stud_balances = mysqli_query($con, $query);

									confirmQuery($query_stud_balances);

									$n = 1;

									while($row = mysqli_fetch_assoc($query_stud_balances)){

										$trans_Id 		= escape($row['Transaction_Id']);
										$trans_date 	= escape($row['Date']);
										$trans_time 	= escape($row['Trans_time']);
										$the_balance 	= escape($row['The_balance']);
										$amount_paid	= escape($row['Cash_tendered']);
										$balance 		= escape($row['Total_balance']);
										$b_firstname 	= escape($row['First_name']);
										$b_lastname 	= escape($row['Last_name']);	
										$b_middlename 	= escape($row['Middle_name']);
										$b_change 		= escape($row['The_change']);

										echo "<tr>";
										echo "<td>".$n++."</td>";
										echo "<td>".date('F d, Y', strtotime($trans_date))."</td>";
										echo "<td>".date('h:i A', strtotime($trans_time))."</td>";
										echo "<td>".number_format($the_balance,2)." PHP</td>";
										echo "<td>".number_format($amount_paid,2)." PHP</td>";
										echo "<td>".number_format($b_change,2)." PHP</td>";
										echo "<td>".number_format($balance,2)." PHP</td>";
										echo "</tr>";
										
									}
								?>

							</tbody>
							
						</table>

	  				</div>

	  			</div><br>

	  			<div class="panel-footer">

					<div class="text-right">

						<p>Total Balance: 
							
							<b style = "font-size:20px; color: #d02737">

							<?php 

								if(isset($balance)){

									if($balance == 0){
										echo "<span class='label label-success'>Paid</span>";
									}

									else{	
										echo "" .number_format($balance,2). " PHP";
									}
								}

								else{
									$query = "SELECT selected_class_tbl.Lesson_Id, ";
									$query .="lessons_tbl.Amount FROM selected_class_tbl ";
									$query .="LEFT JOIN lessons_tbl ON selected_class_tbl.";
									$query .="Lesson_Id = lessons_tbl.Lesson_Id WHERE ";
									$query .="selected_class_tbl.User_Id = '$user_id' ";
									$query .="AND selected_class_tbl.Status = 'New' ";

									$query_lessamount = mysqli_query($con, $query);

									confirmQuery($query_lessamount);

									$row = mysqli_fetch_assoc($query_lessamount);

									$lessamount = $row['Amount'];

									echo "" .number_format($lessamount,2). " PHP";
								}

							?>

							</b>

						</p>

					</div>

	  			</div>

	  		</div>

	  	</div>

	  	<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

	  	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<script>
			
			$(document).ready(function(){

				$('#standardAsc').DataTable({
					select: true,
					"order": [[ 0, "asc" ]]
				});

			});

		</script>

	</body>

</html>