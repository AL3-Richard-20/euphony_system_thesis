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

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Monthly Lesson Sales</title>

	</head>
	
	<body>

		<?php 

			if(isset($_POST['month_filter']) && !isset($_POST['year_filter'])){

				$month_filter 	= $_POST['month_filter'];

			}

			else if(isset($_POST['year_filter']) && !isset($_POST['month_filter'])){
				$year_filter 	= $_POST['year_filter'];
			}

			else if(isset($_POST['month_filter']) && isset($_POST['year_filter'])){

				$month_filter 	= $_POST['month_filter'];
				$year_filter 	= $_POST['year_filter'];
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
		              		<center><h3 class="cap">Monthly Lesson Sales</h3></center>
		              	</div>

		              	<div class="col-sm-4"></div>
		              	
					</div>
					
				</div>

				<div class="panel-body">

					<div class="row">

		              	<form method="POST">

			                <div class="col-sm-2">

			                	<div class="item">
				                  <select class="form-control required" name="month_filter">
				                    <option value="">Filter by Month</option>
				                    <option value="1">January</option>
				                    <option value="2">February</option>
				                    <option value="3">March</option>
				                    <option value="4">April</option>
				                    <option value="5">May</option>
				                    <option value="6">June</option>
				                    <option value="7">July</option>
				                    <option value="8">August</option>
				                    <option value="9">September</option>
				                    <option value="10">October</option>
				                    <option value="11">November</option>
				                    <option value="12">December</option>
				                  </select>
				              	</div>

			                </div>

			                <div class="col-sm-2">

			                	<div class="item">
				                  <input type="number" name="year_filter" class="form-control" placeholder = "Input Year">
				              	</div>

			                </div>

			                <div class="col-sm-4">

			                  	<button class="btn btn-primary" id="send">Apply</button>

			                </div>

		              	</form>

		            </div>

		            <div class="row">

		            	<div class="col-sm-4">

			            	<div class="text-center" style="font-size:19px"><br>

			            		<span>Sales record as of 

			            		<?php

			            			if(isset($month_filter)){

			            				$filtered_month = $month_filter;

										if($filtered_month == '1'){
											$filtered_month = 'January';
										}
										else if($filtered_month == '2'){
											$filtered_month = 'February';
										}
										else if($filtered_month == '3'){
											$filtered_month = 'March';
										}
										else if($filtered_month == '4'){
											$filtered_month = 'April';
										}
										else if($filtered_month == '5'){
											$filtered_month = 'May';
										}
										else if($filtered_month == '6'){
											$filtered_month = 'June';
										}
										else if($filtered_month == '7'){
											$filtered_month = 'July';
										}
										else if($filtered_month == '8'){
											$filtered_month = 'August';
										}
										else if($filtered_month == '9'){
											$filtered_month = 'September';
										}
										else if($filtered_month == '10'){
											$filtered_month = 'October';
										}
										else if($filtered_month == '11'){
											$filtered_month = 'November';
										}
										else if($filtered_month == '12'){
											$filtered_month = 'December';
										}
									}

									if(isset($filtered_month) && !$year_filter){
										echo "<strong>".$filtered_month." ".date('Y')."</strong></span>";
									}

									else if(isset($year_filter) && !$filtered_month){
										echo "<strong>".date('F')." ".$year_filter."</strong></span>";
									}

									else if(isset($year_filter) && isset($filtered_month)){
										echo "<strong>".$filtered_month." ".$year_filter."</strong></span>";
									}

									else{
										echo "<strong>".date('F Y', strtotime("Y"))."</strong></span>";
									}

			            		?>

			            	</div>	

			            </div>

			            <div class="col-sm-4"></div>

			            <div class="col-sm-4">
			            	
			            	<div class="text-center" style = "border: 2px solid #f4f4f4">

		            			<p>Total Lesson Sales for this month</p>

		            			<?php

		            				//Month Filled
		            				if(isset($month_filter) && !$year_filter){

										$query = "SELECT SUM(stud_balances.Cash_tendered - stud_balances.The_change) as Sales ";
										$query .="FROM stud_balances LEFT JOIN user_info_tbl ON ";
										$query .="stud_balances.User_Id = user_info_tbl.User_Id ";
										$query .="WHERE user_info_tbl.Branch_Id = '$branch_id' AND ";
										$query .="MONTH(stud_balances.Date) = '$month_filter' AND ";
										$query .="YEAR(stud_balances.Date) = YEAR(CURRENT_DATE()) ";
										$query .="AND stud_balances.Status = 1 ";
									}

									//Year Filled
									else if(isset($year_filter) && !$month_filter){

										$query = "SELECT SUM(stud_balances.Cash_tendered - stud_balances.The_change) as Sales ";
										$query .="FROM stud_balances LEFT JOIN user_info_tbl ON ";
										$query .="stud_balances.User_Id = user_info_tbl.User_Id ";
										$query .="WHERE user_info_tbl.Branch_Id = '$branch_id' AND ";
										$query .="MONTH(stud_balances.Date) = MONTH(CURRENT_DATE()) AND ";
										$query .="YEAR(stud_balances.Date) = '$year_filter' ";
										$query .="AND stud_balances.Status = 1 ";
									}

									//Both Filled
									else if(isset($year_filter) && isset($month_filter)){

										$query = "SELECT SUM(stud_balances.Cash_tendered - stud_balances.The_change) as Sales ";
										$query .="FROM stud_balances LEFT JOIN user_info_tbl ON ";
										$query .="stud_balances.User_Id = user_info_tbl.User_Id ";
										$query .="WHERE user_info_tbl.Branch_Id = '$branch_id' AND ";
										$query .="MONTH(stud_balances.Date) = '$month_filter' AND ";
										$query .="YEAR(stud_balances.Date) = '$year_filter' ";
										$query .="AND stud_balances.Status = 1 ";
									}

									//Current Date
									else{
										$query = "SELECT SUM(stud_balances.Cash_tendered - stud_balances.The_change) as Sales ";
										$query .="FROM stud_balances LEFT JOIN user_info_tbl ON ";
										$query .="stud_balances.User_Id = user_info_tbl.User_Id ";
										$query .="WHERE user_info_tbl.Branch_Id = '$branch_id' AND ";
										$query .="MONTH(stud_balances.Date) = MONTH(CURRENT_DATE()) AND ";
										$query .="YEAR(stud_balances.Date) = YEAR(CURRENT_DATE()) ";
										$query .="AND stud_balances.Status = 1 ";
									}

		            				$query_sales = mysqli_query($con, $query);

		            				confirmQuery($query_sales);

									while($row = mysqli_fetch_assoc($query_sales)){

										$sales = $row['Sales'];

										echo "<h3>".number_format($sales,2)." PHP</h3>";
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

									if(isset($month_filter) && !$year_filter){

										$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
										$query .="SB.Cash_tendered, SB.Total_balance, ";
										$query .="SB.Discount, SB.OR_no, SB.AR_no, SB.Date, SB.Payment, ";
										$query .="SB.The_change, U.First_name, U.Middle_name, ";
										$query .="U.Last_name, U.User_Id ";
										$query .="FROM stud_balances as SB, user_info_tbl as U ";
										$query .="WHERE SB.User_Id = U.User_Id AND ";
										$query .="U.Branch_Id = '$branch_id' AND ";
										$query .="MONTH(SB.Date) = '$month_filter' AND ";
										$query .="YEAR(SB.Date) = YEAR(CURRENT_DATE()) AND ";
										$query .="SB.Status = 1 ";

									}

									else if(isset($year_filter) && !$month_filter){
										
										$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
										$query .="SB.Cash_tendered, SB.Total_balance, ";
										$query .="SB.Discount, SB.OR_no, SB.AR_no, SB.Date, SB.Payment, ";
										$query .="SB.The_change, U.First_name, U.Middle_name, ";
										$query .="U.Last_name, U.User_Id ";
										$query .="FROM stud_balances as SB, user_info_tbl as U ";
										$query .="WHERE SB.User_Id = U.User_Id AND ";
										$query .="U.Branch_Id = '$branch_id' AND ";
										$query .="MONTH(SB.Date) = MONTH(CURRENT_DATE()) AND ";
										$query .="YEAR(SB.Date) = '$year_filter' AND ";
										$query .="SB.Status = 1 ";

									}

									else if(isset($year_filter) && isset($month_filter)){

										$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
										$query .="SB.Cash_tendered, SB.Total_balance, ";
										$query .="SB.Discount, SB.OR_no, SB.AR_no, SB.Date, SB.Payment, ";
										$query .="SB.The_change, U.First_name, U.Middle_name, ";
										$query .="U.Last_name, U.User_Id ";
										$query .="FROM stud_balances as SB, user_info_tbl as U ";
										$query .="WHERE SB.User_Id = U.User_Id AND ";
										$query .="U.Branch_Id = '$branch_id' AND ";
										$query .="MONTH(SB.Date) = '$month_filter' AND ";
										$query .="YEAR(SB.Date) = '$year_filter' AND ";
										$query .="SB.Status = 1 ";

									}

									else{

										$query = "SELECT SB.Transaction_Id, SB.The_balance, ";
										$query .="SB.Cash_tendered, SB.Total_balance, ";
										$query .="SB.Discount, SB.OR_no, SB.AR_no, SB.Date, SB.Payment, ";
										$query .="SB.The_change, U.First_name, U.Middle_name, ";
										$query .="U.Last_name, U.User_Id ";
										$query .="FROM stud_balances as SB, user_info_tbl as U ";
										$query .="WHERE SB.User_Id = U.User_Id AND ";
										$query .="U.Branch_Id = '$branch_id' AND ";
										$query .="MONTH(SB.Date) = MONTH(CURRENT_DATE()) AND ";
										$query .="YEAR(SB.Date) = YEAR(CURRENT_DATE()) AND ";
										$query .="SB.Status = 1 ";

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

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

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