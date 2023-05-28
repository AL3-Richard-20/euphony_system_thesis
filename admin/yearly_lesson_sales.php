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

		<link rel = "stylesheet"  type="text/css" href = "../assets/datatables/datatables.min.css"/>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Yearly Lesson Sales</title>

	</head>

	<body>

		<?php 

			if(isset($_POST['year_filter'])){

				$year_filter = $_POST['year_filter'];

			}
			else{
				$year_filter = "Today";
			}

		?>

		<div class="container-fluid">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

					<div class="row">

						<div class="col-sm-4">

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='lesson_sales_menu.php'"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		              		<center><h3 class="cap">Yearly Lesson Sales</h3></center>
		              	</div>

		              	<div class="col-sm-4"></div>
		              	
					</div>
				</div>

				<div class="panel-body">

					<div class="row">

		              <form method="POST" novalidate>

		                <div class="col-sm-4">
		                	<div class="item">
		                  		<input type="number" class="form-control" name="year_filter" placeholder="Filter by Year" required="required">
		                  	</div>
		                </div>

		                <div class="col-sm-4">
		                  <button class="btn btn-primary" id="send">Apply</button>
		                </div>

		              </form>

		            </div>

		            <div class="row">

		            	<div class="col-sm-4">
		            		
		            		<div class="text-center" style="font-size: 19px"><br>

			            		<p>Sales Record as of year

			            		<?php

			            			if(isset($year_filter)){

			            				if($year_filter == 'Today'){
			            					echo "<b>".date("Y")."</b></p>";
			            				}
			            				else{
			            					echo "<b>$year_filter</b></p>";
			            				}
			            			}

			            		?>

			            	</div>

		            	</div>

		            	<div class="col-sm-4"></div>

		            	<div class="col-sm-4">
		            		
		            		<div class="text-center" style = "border: 2px solid #f4f4f4">

		            			<p>Total Sales for this year</p>

		            			<?php

		            				if(isset($year_filter)){

		            					if($year_filter == 'Today'){

											$query = "SELECT SUM(SB.Cash_tendered - SB.The_change) as Sales, ";
											$query .="SB.Transaction_Id, SB.The_balance, ";
											$query .="SB.Cash_tendered, SB.Total_balance, ";
											$query .="SB.Discount, SB.OR_no, SB.AR_no, SB.Date,";
											$query .="SB.The_change, U.First_name, ";
											$query .="U.Middle_name, U.Last_name, U.User_Id ";
											$query .="FROM stud_balances as SB, user_info_tbl as U ";
											$query .="WHERE SB.User_Id = U.User_Id AND ";
											$query .="U.Branch_Id = '$branch_id' AND ";
											$query .="Year(SB.Date) = Year(curdate()) AND ";
											$query .="SB.Status = 1 ";

							            }

							            else{

											$query = "SELECT SUM(SB.Cash_tendered - SB.The_change) as Sales, ";
											$query .="SB.Transaction_Id, SB.The_balance, ";
											$query .="SB.Cash_tendered, SB.Total_balance, ";
											$query .="SB.Discount, SB.OR_no, SB.AR_no, SB.Date, ";
											$query .="SB.The_change, U.First_name, ";
											$query .="U.Middle_name, U.Last_name, U.User_Id ";
											$query .="FROM stud_balances as SB, user_info_tbl as U ";
											$query .="WHERE SB.User_Id = U.User_Id AND ";
											$query .="U.Branch_Id = '$branch_id' AND ";
											$query .="Year(SB.Date) = '$year_filter' AND ";
											$query .="SB.Status = 1 ";

							            }

							            $query_sales = mysqli_query($con, $query);

										while($row = mysqli_fetch_assoc($query_sales)){

											$sales = $row['Sales'];

											echo "<h3>".number_format($sales,2)." PHP</h3>";
										}

		            				}

		            			?>
		            			
		            		</div>

		            	</div>

		            </div><hr/>

			  		<div class="table-responsive">
		
						<table class="table table-bordered" id="standardDesc">

							<thead class="cap">
								<th>No.</th>
								<th>Student</th>
								<th>OR</th>
								<th>AR</th>
								<th>Balance</th>
								<th>Cash</th>
								<th>Change</th>
								<th>Discount</th>
								<th>Total Balance</th>
								<th>Payment</th>
								<th>Action</th>
							</thead>

							<tbody>
								<?php

									if(isset($year_filter)){

										if($year_filter == 'Today'){

											$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
											$query .="SB.Cash_tendered, SB.Total_balance, ";
											$query .="SB.Discount, SB.OR_no, SB.AR_no, ";
											$query .="SB.Date, SB.Payment, SB.The_change, ";
											$query .="U.First_name, U.Middle_name, U.Last_name,  ";
											$query .="U.User_Id FROM stud_balances as SB, ";
											$query .="user_info_tbl as U WHERE SB.User_Id = U.User_Id ";
											$query .="AND U.Branch_Id = '$branch_id' AND ";
											$query .="Year(SB.Date) = Year(curdate()) AND ";
											$query .="SB.Status = 1 ";

										}

										else{

											$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
											$query .="SB.Cash_tendered, SB.Total_balance, ";
											$query .="SB.Discount, SB.OR_no, SB.AR_no, ";
											$query .="SB.Date, SB.Payment, SB.The_change, ";
											$query .="U.First_name, U.Middle_name, U.Last_name,  ";
											$query .="U.User_Id FROM stud_balances as SB, ";
											$query .="user_info_tbl as U WHERE SB.User_Id = U.User_Id ";
											$query .="AND U.Branch_Id = '$branch_id' AND ";
											$query .="Year(SB.Date) = '$year_filter' AND ";
											$query .="SB.Status = 1 ";

										}
									}

									$query_payments = mysqli_query($con, $query);

									confirmQuery($query_payments);

									$n =1;

									while($row = mysqli_fetch_assoc($query_payments)){
				
										$stud_id 			= $row['User_Id'];
										$stud_firstname 	= $row['First_name'];
										$stud_middlename 	= $row['Middle_name'];
										$stud_lastname 		= $row['Last_name'];

										$the_student 		= "$stud_firstname $stud_middlename $stud_lastname";

										$trans_Id 			= $row['Transaction_Id'];
										$trans_date 		= $row['Date'];
										$or_no 				= $row['OR_no'];
										$ar_no 				= $row['AR_no'];
										$the_balance 		= $row['The_balance'];
										$cash_tendered 		= $row['Cash_tendered'];
										$total_balance 		= $row['Total_balance'];
										$discount 			= $row['Discount'];
										$the_change 		= $row['The_change'];
										$payment 			= $row['Payment'];

										echo "<tr>";
										echo "<td>".$n++."</td>";
										echo "<td>$the_student</td>";

								        echo "<td><a href='SB_receipt_or.php?transid=$trans_Id' target='_blank'>$or_no</a></td>";
								        echo "<td><a href='SB_receipt_ar.php?transid=$trans_Id' target='_blank'>$ar_no</a></td>";

										echo "<td>".number_format($the_balance,2)." PHP </td>";
										echo "<td>".number_format($cash_tendered,2)." PHP </td>";
										echo "<td>".number_format($the_change,2)." PHP </td>";
										echo "<td>".number_format($discount,2)." PHP </td>";
										echo "<td>".number_format($total_balance,2)." PHP </td>";
										echo "<td>$payment</td>";
										echo "<td>";

										if($trans_date != date('Y-m-d')){

		  									echo "Not Available ";

		  								}

		  								else{

		  									?>

		  									<a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?lesssalesid=<?php echo $trans_Id; ?>');">Delete</a>

		  									<?php

		  								}

										echo "</td>";
										echo "</tr>";
								    }

								?>
								
							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->



		<script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>
			
			$(document).ready(function(){

				$('#standardDesc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

			});

		</script>

	</body>

</html>