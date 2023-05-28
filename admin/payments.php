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

		<link rel = "stylesheet"  type="text/css" href="../assets/datatables/datatables.min.css"/>

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Daily Lesson Sales</title>

	</head>

	<!-- #1f262e -->

	<body>

		<?php

			if(isset($_POST['date_filter'])){

				$date_filter = $_POST['date_filter'];

			}
			else{
				$date_filter = "Today";
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
							<center><h3 class="cap">Daily Lesson Sales</h3></center>	
						</div>

						<div class="col-sm-4"></div>

					</div>

				</div>

				<div class="panel-body">

					<form method="POST" novalidate>

						<div class="row">

	    					<div class="col-sm-4">	
	    						<div class="item">
	    							<input type="date" name="date_filter" class="form-control" required="required">
	    						</div>
	    					</div>
		    				
	    					<div class="col-sm-4"><button class = "btn btn-primary">Apply</button></div>
	    					<div class="col-sm-4">
	    						
	    					</div>
	    				</div>

	    			</form>

	    			<div class="row">

	    				<div class="col-sm-4">
	    					
	    					<div class="text-center" style="font-size: 19px"><br>

		    					<p>Payment Record as of

			    				<?php

			    					if(isset($date_filter)){

							            // $the_date  = $_GET['date'];

							            if($date_filter == 'Today'){

							            	echo "<b>" . date("F d, Y", strtotime("Today")) . "</b></p>";
							            }
							            else{
							            	echo "<b>".date("F d, Y", strtotime($date_filter))."</b></p>";
							            }

							        }
			    				?>

			    			</div>

	    				</div>

	    				<div class="col-sm-4">
	    					
	    				</div>

	    				<div class="col-sm-4">
	    					
	    					<div class="text-center" style = "border: 2px solid #f4f4f4">

		            			<p>Total Lesson Sales</p>

		            			<?php

		            				if(isset($date_filter)){

		            					// $the_date = $_POST['date_filter'];

		            					if($date_filter == 'Today'){

											$query = "SELECT SUM(SB.Cash_tendered - SB.The_change) as ";
											$query .="Sales, SB.Transaction_Id, SB.The_balance, ";
											$query .="SB.Cash_tendered, SB.Total_balance, SB.Discount, ";
											$query .="SB.OR_no, SB.AR_no, SB.Date, ";
											$query .="SB.The_change, U.First_name, U.Middle_name, ";
											$query .="U.Last_name, U.User_Id ";
											$query .="FROM stud_balances as SB, user_info_tbl as U ";
											$query .="WHERE SB.User_Id = U.User_Id AND ";
											$query .="U.Branch_Id = '$branch_id' AND ";
											$query .="SB.Status = 1 AND SB.Date = curdate() ";

							            }

							            else{

											$query = "SELECT SUM(SB.Cash_tendered - SB.The_change) as ";
											$query .="Sales, SB.Transaction_Id, SB.The_balance, ";
											$query .="SB.Cash_tendered, SB.Total_balance, SB.Discount,";
											$query .="SB.OR_no, SB.AR_no, SB.Date, ";
											$query .="SB.The_change, U.First_name, U.Middle_name, ";
											$query .="U.Last_name, U.User_Id ";
											$query .="FROM stud_balances as SB, user_info_tbl as U ";
											$query .="WHERE SB.User_Id = U.User_Id AND ";
											$query .="U.Branch_Id = '$branch_id' AND ";
											$query .="SB.Status = 1 AND SB.Date = '$date_filter' ";

							            }

							            $query_sales_today = mysqli_query($con, $query);

							            confirmQuery($query_sales_today);

										while($row = mysqli_fetch_assoc($query_sales_today)){

											$sales = $row['Sales'];

											echo "<h3>".number_format($sales,2)." PHP</h3>";
										}

		            				}

		            			?>
		            		</div>

	    				</div>

	    			</div><hr/>

	    			<div class = "text-right">
			             <a style = "font-size: 15px;" href="print_payment_records.php?branchid=<?php echo $branch_id; ?>&date=<?php echo $date_filter; ?>" title= "Print" class="btn btn-primary btn-sm" id="print" target="_blank">Print</a> 
			        </div><br>

					<div class="table-responsive">
						
						<table class="table table-bordered table-hover" id="standardDesc">

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

									if(isset($_POST['date_filter'])){

										$the_date = $_POST['date_filter'];

										$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
										$query .="SB.Cash_tendered, SB.Total_balance, SB.Discount, ";
										$query .="SB.OR_no, SB.AR_no, SB.Date, SB.Payment, ";
										$query .="SB.The_change, U.First_name, U.Middle_name, ";
										$query .="U.Last_name, U.User_Id ";
										$query .="FROM stud_balances as SB, user_info_tbl as U ";
										$query .="WHERE SB.User_Id = U.User_Id AND ";
										$query .="U.Branch_Id = '$branch_id' AND ";
										$query .="SB.Status = 1 AND SB.Date = '$the_date' ";
									}


									else{

										$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
										$query .="SB.Cash_tendered, SB.Total_balance, SB.Discount, ";
										$query .="SB.OR_no, SB.AR_no, SB.Date, SB.Payment, ";
										$query .="SB.The_change, U.First_name, U.Middle_name, ";
										$query .="U.Last_name, U.User_Id ";
										$query .="FROM stud_balances as SB, user_info_tbl as U ";
										$query .="WHERE SB.User_Id = U.User_Id AND ";
										$query .="U.Branch_Id = '$branch_id' AND ";
										$query .="SB.Status = 1 AND SB.Date = curdate() ";

									}

									$query_payments = mysqli_query($con, $query);

									$count1 = mysqli_num_rows($query_payments);

									confirmQuery($query_payments);

									if($count1 > 0){

										$n = 1;

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

											echo "<td>".number_format($the_balance,2)." PHP</td>";
											echo "<td>".number_format($cash_tendered,2)." PHP</td>";
											echo "<td>".number_format($the_change,2)." PHP</td>";
											echo "<td>$discount %</td>";
											echo "<td>".number_format($total_balance,2)." PHP</td>";
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
									}

									else{

										echo "<script>document.getElementById('print').className = 'hidden';</script>";
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

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script src = "scripts/functions.js"></script>

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