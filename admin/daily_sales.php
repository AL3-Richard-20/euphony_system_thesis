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

		<link rel = "stylesheet" type="text/css" href = "../assets/datatables/datatables.min.css"/>

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Daily Product Sales</title>

	</head>

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

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='sales_menu.php'"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		                	<center><h3 class="cap">Daily Product Sales</h3></center>
		              	</div>

		              	<div class="col-sm-4"></div>

		            </div>

				</div>

				<div class="panel-body">

					<div class="row">

		              <form method="POST">

		                <div class="col-sm-4">
		                	<div class="item">
		                		<input type="date" name="date_filter" class="form-control" placeholder="Filter by Date" required="required">
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

			            		<p>Sales Record as of

			            		<?php

			    					if(isset($date_filter)){

							            // $the_date  = $_GET['date'];

							            if($date_filter == 'Today'){

							            	echo "<b>" . date('F d, Y', strtotime("Today")) . "</b></p>";
							            }
							            else{
							            	echo "<b>".date('F d, Y', strtotime($date_filter))."</b></p>";
							            }

							        }
			    				?>

			            	</div>
		            	</div>

		            	<div class="col-sm-4"></div>

		            	<div class="col-sm-4">
		            		<div class="text-center" style = "border: 2px solid #f4f4f4">
		            			
		            			<p>Total Sales</p>

		            			<?php

		            				if(isset($date_filter)){

		            					if($date_filter == 'Today'){

							            	$query = "SELECT SUM(Cash) - Cash_change as Sales ";
							            	$query .="FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
							            	$query .="AND Status = 1 ";
											$query .="AND Date = curdate() AND randSalt4 = 1";
							            }
							            else{
							            	$query = "SELECT SUM(Cash) - Cash_change as Sales ";
							            	$query .="FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
							            	$query .="AND Status = 1 ";
											$query .="AND Date = '$date_filter' AND randSalt4 = 1";
							            }

							            $query_sales_today = mysqli_query($con, $query);

										while($row = mysqli_fetch_assoc($query_sales_today)){

											$sales = $row['Sales'];

											echo "<h3>".number_format($sales,2)." PHP</h3>";
										}

		            				}

		            			?>
		            		</div>
		            	</div>

		            </div><hr/>

		            <!-- <div class="margin"></div> -->

		            <!-- <ul class="nav nav-pills nav-justified">
					  <li class="active"><a href="#menu1" data-toggle="tab">Sales</a></li>
					  <li><a href="#menu2" data-toggle="tab">Voided</a></li>
					  <li><a href="#menu3" data-toggle="tab">Unfinished</a></li>
					</ul><br> -->


					<div class="tab-content">

					  	<div id="menu1" class="tab-pane fade in active">

					  		<div class="text-right">
								<a href="print_daily_sales.php?branchid=<?php echo $branch_id; ?>&date=<?php echo $date_filter; ?>" class="btn btn-primary" id="print" target="_blank">Print</a>
							</div><br>

							<div class="table-responsive">
						
								<table class="table table-bordered" id="standardDesc">

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

											if(isset($date_filter)){

												// $filtered_date = $_GET['date'];

												if($date_filter == "Today"){

													$query = "SELECT * FROM sales_tbl WHERE Branch_Id = ";
													$query .="'$branch_id' AND Status = 1 ";
													$query.="AND Date = curdate() AND randSalt4 = 1";

												}
												else{
													$query  ="SELECT * FROM sales_tbl WHERE Date ";
													$query .="= '$date_filter' AND Status = 1 ";
													$query .="AND Branch_Id='$branch_id' AND ";
													$query .="randSalt4 = 1 ";
												}
											}

											$query_sales = mysqli_query($con, $query);

											$count1 = mysqli_num_rows($query_sales); 

											confirmQuery($query_sales);

											if($count1 > 0){

												$n = 1;

												while($row = mysqli_fetch_assoc($query_sales)){

													$sales_Id		= escape($row['Sales_Id']);
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
								    				echo "<td>$total_discount %</td>";
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
											}
											
											else{
												echo "<script>document.getElementById('print').className = 'hidden';</script>";
											}

										?>
									</tbody>
									
								</table>

							</div>

					  	</div>



					  	<!-- <div id="menu2" class="tab-pane fade">
					    	
					    	<div class="text-right">
								<a href="print_daily_sales.php?branchid=<?php echo $branch_id; ?>&date=<?php echo $date_filter; ?>" class="btn btn-primary" id="print" target="_blank">Print</a>
							</div><br>

							<div class="table-responsive">
						
								<table class = "table table-bordered" id="standardDesc">

									<thead>
										<th>No.</th>
										<th>Date</th>
										<th>OR</th>
										<th>AR</th>
										<th>Subtotal</th>
										<th>Discount</th>
										<th>Total</th>
										<th>Cash</th>
										<th>Change</th>
										<th>Action</th>
									</thead>

									<tbody>
										<?php

											if(isset($date_filter)){

												// $filtered_date = $_GET['date'];

												if($date_filter == "Today"){

													$query = "SELECT * FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
													$query.="AND Date = curdate() AND randSalt4 = 2";

												}
												else{
													$query  ="SELECT * FROM sales_tbl ";
													$query .="WHERE Date = '$date_filter' AND Branch_Id='$branch_id' AND randSalt4 = 2 ";
												}
											}

											$query_sales = mysqli_query($con, $query);

											confirmQuery($query_sales);

											$n = 1;

											while($row = mysqli_fetch_assoc($query_sales)){

												$sales_Id		= escape($row['Sales_Id']);
												$trans_date 	= escape($row['Date']);
							    				$customer 		= escape($row['Sold_to']);
							    				$OR_no			= escape($row['OR_no']);
							    				$AR_no			= escape($row['AR_no']);
							    				$subtotal 		= escape($row['Subtotal']);
							    				$total_discount	= escape($row['Total_discount']);
							    				$total 			= escape($row['Total']);
							    				$cash 			= escape($row['Cash']);
							    				$change 		= escape($row['Cash_change']);

							    				echo "<tr>";
							    				echo "<td>".$n++."</td>";
							    				echo "<td>$trans_date</td>";
							    				echo "<td><a href='receipt_or.php?salesid=$sales_Id' target='_blank'>$OR_no</a></td>";
							    				echo "<td><a href='receipt_ar.php?salesid=$sales_Id' target='_blank'>$AR_no</a></td>";
							    				echo "<td>P".number_format($subtotal,2)."</td>";
							    				echo "<td>P".number_format($total_discount,2)."</td>";
							    				echo "<td>P".number_format($total,2)."</td>";
							    				echo "<td>P".number_format($cash,2)."</td>";
							    				echo "<td>P".number_format($change,2)."</td>";
							    				echo "<td>";
							    				echo "<a href='#' class='btn btn-primary'>Edit</a> ";
							    				echo "<a href='#' class='btn btn-danger'>Delete</a>";
							    				echo "</td>";
							    				echo "</tr>";
											}

										?>
									</tbody>

								</table>

							</div><br>

		            		<div class="col-sm-4"></div>

		            		<div class="col-sm-4"></div>

		            		<div class="col-sm-4" style = "border: 2px solid #f4f4f4">
			            		<div class="text-center">
			            			<p>Total Amount of Voided Transactions</p>

			            			<?php

			            				if(isset($date_filter)){

			            					if($date_filter == 'Today'){

								            	$query = "SELECT SUM(Total) as Sales FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
												$query .="AND Date = curdate() AND randSalt4 = 2";
								            }
								            else{
								            	$query = "SELECT SUM(Total) as Sales FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
												$query .="AND Date = '$date_filter' AND randSalt4 = 2";
								            }

								            $query_sales_today = mysqli_query($con, $query);

											while($row = mysqli_fetch_assoc($query_sales_today)){

												$sales = $row['Sales'];

												echo "<h3>".number_format($sales,2)." PHP</h3>";
											}

			            				}

			            			?>
			            		</div>

			            	</div>

					  	</div> -->



					  	<!-- <div id="menu3" class="tab-pane fade">
					    	
					    	<div class="text-right">
								<a href="print_daily_sales.php?branchid=<?php echo $branch_id; ?>&date=<?php echo $date_filter; ?>" class="btn btn-primary" id="print" target="_blank">Print</a>
							</div><br>

							<div class="table-responsive">
						
								<table class = "table table-bordered" id="standardAsc">

									<thead>
										<th>No.</th>
										<th>Date</th>
										<th>OR</th>
										<th>AR</th>
										<th>Subtotal</th>
										<th>Discount</th>
										<th>Total</th>
										<th>Cash</th>
										<th>Change</th>
										<th>Action</th>
									</thead>

									<tbody>
										<?php

											// if(isset($date_filter)){

											// 	// $filtered_date = $_GET['date'];

											// 	if($date_filter == "Today"){

											// 		$query = "SELECT * FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
											// 		$query.="AND Date = curdate() AND randSalt4 = 0";

											// 	}
											// 	else{
											// 		$query  ="SELECT * FROM sales_tbl ";
											// 		$query .="WHERE Date = '$date_filter' AND Branch_Id='$branch_id' AND randSalt4 = 0 ";
											// 	}
											// }

											// $query_sales = mysqlI_query($con, $query);

											// confirmQuery($query_sales);

											// $n = 1;

											// while($row = mysqli_fetch_assoc($query_sales)){

											// 	$sales_Id		= escape($row['Sales_Id']);
											// 	$trans_date 	= escape($row['Date']);
							    // 				$customer 		= escape($row['Sold_to']);
							    // 				$OR_no			= escape($row['OR_no']);
							    // 				$AR_no			= escape($row['AR_no']);
							    // 				$subtotal 		= escape($row['Subtotal']);
							    // 				$total_discount	= escape($row['Total_discount']);
							    // 				$total 			= escape($row['Total']);
							    // 				$cash 			= escape($row['Cash']);
							    // 				$change 		= escape($row['Cash_change']);

							    // 				echo "<tr>";
							    // 				echo "<td>".$n++."</td>";
							    // 				echo "<td>$trans_date</td>";
							    // 				echo "<td><a href='receipt_or.php?salesid=$sales_Id' target='_blank'>$OR_no</a></td>";
							    // 				echo "<td><a href='receipt_ar.php?salesid=$sales_Id' target='_blank'>$AR_no</a></td>";
							    // 				echo "<td>".number_format($subtotal,2)."</td>";
							    // 				echo "<td>".number_format($total_discount,2)."</td>";
							    // 				echo "<td>".number_format($total,2)."</td>";
							    // 				echo "<td>".number_format($cash,2)."</td>";
							    // 				echo "<td>".number_format($change,2)."</td>";
							    // 				echo "<td>";
							    // 				echo "<a href='#' class='btn btn-primary'>Edit</a> ";
							    // 				echo "<a href='#' class='btn btn-danger'>Delete</a>";
							    // 				echo "</td>";
							    // 				echo "</tr>";
											// }

										?>
									</tbody>

								</table>

							</div>

					  	</div> -->

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

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>
			
			$('#standardDesc').DataTable({
				select: true,
				"order": [[ 0, "desc" ]]
			});

		</script>

	</body>

</html>