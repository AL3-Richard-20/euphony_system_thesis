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

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">



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

		              	<div class="col-sm-4"><br>

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='sales_menu.php'"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		                	<center><h3 class="cap">Product Sales</h3></center>
		              	</div>

		              	<div class="col-sm-4"></div>

		            </div>

				</div>

				<div class="panel-body">

					<div class="row">

		              <form method="POST" id="filter_form">

		              	<div class="col-sm-2">
		                	<div class="item">
		                		<select class="form-control" id="month_filter">
		                			<option value="">Select Month here</option>
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
		                		<input type="number" name="day_filter" id="day_filter" class="form-control" placeholder="Input Day here">
		                	</div>
		                </div>

		                <div class="col-sm-2">
		                	<div class="item">
		                		<input type="number" name="year_filter" id="year_filter" class="form-control" placeholder="Input Year here">
		                	</div>
		                </div>

		                <div class="col-sm-1">
		                  <button class="btn btn-primary" id="btn_sales_prod">Apply</button>
		                </div>

		                

		              </form>

		            </div>

		            <div class="row">
		            	
		            	<div class="col-sm-4">

		            		<div class="text-center" style="font-size: 19px"><br>

			            		<p>Sales Record as of

			            		<?php

			    					// if(isset($date_filter)){

							     //        // $the_date  = $_GET['date'];

							     //        if($date_filter == 'Today'){

							     //        	echo "<b>" . date('F d, Y', strtotime("Today")) . "</b></p>";
							     //        }
							     //        else{
							     //        	echo "<b>".date('F d, Y', strtotime($date_filter))."</b></p>";
							     //        }

							     //    }
			    				?>

			            	</div>
		            	</div>

		            	<div class="col-sm-4"></div>

		            	<div class="col-sm-4">
		            		<div class="text-center" style = "border: 2px solid #f4f4f4">
		            			
		            			<p>Total Sales</p>

		            			<?php

		        //     				if(isset($date_filter)){

		        //     					if($date_filter == 'Today'){

							   //          	$query = "SELECT SUM(Cash) - Cash_change as Sales ";
							   //          	$query .="FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
							   //          	$query .="AND Status = 1 ";
										// 	$query .="AND Date = curdate() AND randSalt4 = 1";
							   //          }
							   //          else{
							   //          	$query = "SELECT SUM(Cash) - Cash_change as Sales ";
							   //          	$query .="FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
							   //          	$query .="AND Status = 1 ";
										// 	$query .="AND Date = '$date_filter' AND randSalt4 = 1";
							   //          }

							   //          $query_sales_today = mysqli_query($con, $query);

										// while($row = mysqli_fetch_assoc($query_sales_today)){

										// 	$sales = $row['Sales'];

										// 	echo "<h3>".number_format($sales,2)." PHP</h3>";
										// }

		        //     				}

		            			?>
		            		</div>

		            	</div>

		            </div><hr/>


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

									<tbody id="table_prod_sales">


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

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>
			
			$(document).ready(function(){

				prodSales();

				$('#standardDesc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

			});

			function prodSales(){

				$('#filter_form').submit(function(e){

					e.preventDefault();

					var month 	= $('#month_filter').val();
					var day 	= $('#day_filter').val();
					var year 	= $('#year_filter').val();

					$.ajax({

						url:"action.php",
						method:"POST",
						data:{
							f_month:month,
							f_day:day,
							f_year:year,
							action:"prod_sales"
						},
						success:function(data){

							var result = JSON.parse(data);

							$('#table_prod_sales').html(result);
						}
					});

				});

			}

		</script>

	</body>

</html>