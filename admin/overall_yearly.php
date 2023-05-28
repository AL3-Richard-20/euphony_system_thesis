<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>
	
<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">



		<link rel = "stylesheet" type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet" type="text/css" href = "../assets/font/css/all.min.css">

		<link rel = "stylesheet" type="text/css" href="../assets/datatables/datatables.min.css"/>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->



		<link rel = "stylesheet" type="text/css" href = "../includes/style.css">

		<title>Euphony | Yearly Overall Sales</title>

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

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='overall_sales_menu.php'"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		              		<center><h3 class="cap">Yearly Overall Sales</h3></center>
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

			            		<p>Sales record as of year

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

		            			<p>Overall Sales for this year</p>

		            			<?php

		            				if(isset($year_filter)){

		            					if($year_filter == 'Today'){

											$query = "SELECT SUM(stud_balances.Cash_tendered - ";
											$query .="stud_balances.The_change) as Total1, ";
											$query .="stud_balances.Date FROM stud_balances ";
											$query .="LEFT JOIN user_info_tbl ON ";
											$query .="stud_balances.User_Id = ";
											$query .="user_info_tbl.User_Id WHERE ";
											$query .="user_info_tbl.Branch_Id = '$branch_id' ";
											$query .="AND YEAR(stud_balances.Date) ";
											$query .="= YEAR(CURRENT_DATE()) AND ";
											$query .="stud_balances.Status = 1 ";

											$query_sales_today = mysqli_query($con, $query);

											confirmQuery($query_sales_today);

											while($row = mysqli_fetch_assoc($query_sales_today)){

												$lessonsales 	= $row['Total1'];
											}
											//Lesson Sales END

											//Product Sales
											$query2 = "SELECT SUM(Cash) - Cash_change as Total2 FROM ";
											$query2 .="sales_tbl WHERE Branch_Id = '$branch_id' ";
											$query2 .="AND YEAR(Date) = YEAR(CURRENT_DATE()) AND ";
											$query2 .="randSalt4 = 1 AND Status = 1 ";

											$query_prod_sales_today = mysqli_query($con, $query2);

											while($row = mysqli_fetch_assoc($query_prod_sales_today)){

												$productsales = $row['Total2'];
												
											}
											//Product Sales END
										}

										else{

											$query = "SELECT SUM(stud_balances.Cash_tendered - ";
											$query .="stud_balances.The_change) as Total1, ";
											$query .="stud_balances.Date FROM stud_balances ";
											$query .="LEFT JOIN user_info_tbl ON ";
											$query .="stud_balances.User_Id = user_info_tbl.User_Id ";
											$query .="WHERE user_info_tbl.Branch_Id = '$branch_id' ";
											$query .="AND YEAR(stud_balances.Date) = '$year_filter' ";
											$query .="AND stud_balances.Status = 1 ";

											$query_sales_today = mysqli_query($con, $query);

											confirmQuery($query_sales_today);

											while($row = mysqli_fetch_assoc($query_sales_today)){

												$lessonsales 	= $row['Total1'];
											}
											//Lesson Sales END

											//Product Sales
											$query2 = "SELECT SUM(Total) as Total2 FROM sales_tbl ";
											$query2 .="WHERE Branch_Id = '$branch_id' AND ";
											$query2 .="YEAR(Date) = '$year_filter' AND ";
											$query2 .="randSalt4 = 1 AND Status = 1";

											$query_prod_sales_today = mysqli_query($con, $query2);

											while($row = mysqli_fetch_assoc($query_prod_sales_today)){

												$productsales = $row['Total2'];
												
											}
											//Product Sales END
										}

										$formula = $lessonsales + $productsales;

										echo "<h3>".number_format($formula,2)." PHP</h3>";

		            				}

		            			?>
		            		</div>

		            	</div>

		            		
		            </div><hr/>

		            <ul class="nav nav-pills nav-justified">
					  <li class="active"><a href="#menu1" data-toggle="tab">Product Sales</a></li>
					  <li><a href="#menu2" data-toggle="tab">Lesson Sales</a></li>
					</ul><br>

					<div class="tab-content">

					  	<div id="menu1" class="tab-pane fade in active">

					  		<div class="table-responsive">
				
								<table class = "table table-bordered" id="standardDesc">

									<thead class="cap">
										<th>No.</th>
										<th>Date</th>
										<th>OR</th>
										<th>AR</th>
										<th>Subtotal</th>
										<th>Discount</th>
										<th>Total</th>
										<th>Cash</th>
										<th>Change</th>
										<th>Payment</th>
										<th>Action</th>
									</thead>

									<tbody>

										<?php

											if(isset($year_filter)){

												if($year_filter == 'Today'){

													$query = "SELECT * FROM sales_tbl WHERE ";
													$query .="Branch_Id = '$branch_id' ";
													$query .="AND Year(Date) = Year(curdate()) ";
													$query .="AND randSalt4 = 1 AND Status = 1";

												}

												else{

													$query = "SELECT * FROM sales_tbl WHERE ";
													$query .="Year(Date) = '$year_filter' ";
													$query .="AND Branch_Id='$branch_id' ";
													$query .="AND randSalt4 = 1 AND Status = 1";

												}

											}

											$query_sales = mysqlI_query($con, $query);

											confirmQuery($query_sales);

											$n = 1;

											while($row = mysqli_fetch_assoc($query_sales)){

												$sales_Id 		= escape($row['Sales_Id']);
												$trans_date 	= escape($row['Date']);
							    				$customer 		= escape($row['Sold_to']);
							    				$OR_no			= escape($row['OR_no']);
							    				$AR_no			= escape($row['AR_no']);
							    				$subtotal 		= escape($row['Subtotal']);
							    				$total_discount	= escape($row['Total_discount']);
							    				$total 			= escape($row['Total']);
							    				$cash 			= escape($row['Cash']);
							    				$change 		= escape($row['Cash_change']);
							    				$payment 		= escape($row['Payment']);

							    				echo "<tr>";
							    				echo "<td>".$n++."</td>";
							    				echo "<td>".date('M d, Y', strtotime($trans_date))."</td>";
							    				echo "<td><a href='receipt_or.php?salesid=$sales_Id' target='_blank'>$OR_no</a></td>";
							    				echo "<td><a href='receipt_ar.php?salesid=$sales_Id' target='_blank'>$AR_no</a></td>";
							    				echo "<td>".number_format($subtotal,2)." PHP</td>";
							    				echo "<td>".number_format($total_discount,2)." PHP</td>";
							    				echo "<td>".number_format($total,2)." PHP</td>";
							    				echo "<td>".number_format($cash,2)." PHP</td>";
							    				echo "<td>".number_format($change,2)." PHP</td>";
							    				echo "<td>$payment</td>";
							    				echo "<td>";

							    				if($trans_date != date('Y-m-d')){

				  									echo "Not Available ";

				  								}

				  								else{

				  									?>

				  									<a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?prodsalesid=<?php echo $sales_Id; ?>');">Delete</a>

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


					  	<div id="menu2" class="tab-pane fade in">
					  		
					  		<div class="table-responsive">
				
								<table class = "table table-bordered" id="standardDesc2">

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
													$query .="SB.Cash_tendered, SB.Total_balance,";
													$query .="SB.Discount, SB.OR_no, SB.AR_no, ";
													$query .="SB.Date, SB.Payment, SB.The_change, ";
													$query .="U.First_name, U.Middle_name, ";
													$query .="U.Last_name, U.User_Id ";
													$query .="FROM stud_balances as SB, ";
													$query .="user_info_tbl as U ";
													$query .="WHERE SB.User_Id = U.User_Id ";
													$query .="AND U.Branch_Id = '$branch_id' ";
													$query .="AND Year(SB.Date) = Year(curdate()) ";
													$query .="AND SB.Status = 1 ";

												}

												else{

													$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
													$query .="SB.Cash_tendered, SB.Total_balance,";
													$query .="SB.Discount, SB.OR_no, SB.AR_no, ";
													$query .="SB.Date, SB.Payment, SB.The_change, ";
													$query .="U.First_name, U.Middle_name, ";
													$query .="U.Last_name, U.User_Id ";
													$query .="FROM stud_balances as SB, ";
													$query .="user_info_tbl as U ";
													$query .="WHERE SB.User_Id = U.User_Id ";
													$query .="AND U.Branch_Id = '$branch_id' ";
													$query .="AND Year(SB.Date) = '$year_filter' ";
													$query .="AND SB.Status = 1 ";

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

				$('#standardDesc2').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

			});

		</script>

	</body>

</html>