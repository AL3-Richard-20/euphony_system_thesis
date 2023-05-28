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



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Stock Out</title>

	</head>

	<body>

		<?php

			// Date Filter
			if(isset($_POST['date_filter'])){

				$date_filter = $_POST['date_filter'];

			}
			else{
				$date_filter = "Today";
			}
			// Date Filter END

		?>

		<div class = "container-fluid">

			<?php include "includes/admin_navigation.php"; ?>

			<div class = "margin"></div>

			<div class = "panel panel-default">

				<div class = "panel-header">

					<div class="row">

		              	<div class="col-sm-4">

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='inventory.php';"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		                	<center><h3 class="cap">Stock Out Products</h3></center>
		              	</div>

		              	<div class="col-sm-4"></div>

		            </div>

				</div>

				<div class="panel-body">

        			<div class="row">

        				<form method="POST">
                			<div class="col-sm-4">
                				<div class="row">
                					<div class="col-sm-9">	
                						<input type="date" name="date_filter" class="form-control">
                					</div>
                					<div class="col-sm-3">
                						<button class="btn btn-primary">Apply</button>
                					</div>
                				</div>
                			</div>
            			</form>

            			<div class="col-sm-4"></div>

            			<div class="col-sm-4">
            				<div class="text-right">
								
				              	<a href="print_stock_out.php?branchid=<?php echo $branch_id; ?>&date=<?php echo $date_filter; ?>" target="_blank" title= "Print" class="btn btn-success" id="print">Print</a>

			              	</div>
            			</div>

		            </div><br>

		            <div class="row">

		            	<div class="col-sm-4">

			            	<div class="text-center" style="font-size: 19px"><br>

			            		<p>Stock out records as of

			            			<b>

			            			<?php 

			            				if($date_filter == 'Today'){
			            					// echo "" .date("m-d-Y"). "";
			            					echo date('F d, Y', strtotime($date_filter)); 
			            				}
			            				else{
			            					echo date('F d, Y', strtotime($date_filter)); 
			            				}
			            				
			            			?>
			            				
			            			</b></p>
			            		</p>

			            	</div>

			            </div>

			            <div class="col-sm-4">
			            	
			            	<div class="text-center" style = "border: 2px solid #f4f4f4">
		            				
		            			<p>Total Stock Out Quantity</p>

		            			<?php

		            				if(isset($_POST['date_filter'])){

								$date_filter = $_POST['date_filter'];

								$query = "SELECT SUM(sales_detail.Quantity) as Total, sales_tbl.Sold_to, sales_detail.Prod_Id, ";
								$query .="sales_detail.Price, sales_detail.Quantity, ";
								$query .="products_tbl.Prod_name, products_tbl.Prod_brand ";
								$query .="FROM sales_tbl LEFT JOIN sales_detail ON ";
								$query .="sales_tbl.Sales_Id = sales_detail.Sales_Id ";
								$query .="LEFT JOIN products_tbl ON sales_detail.Prod_Id ";
								$query .="= products_tbl.Prod_Id WHERE ";
								$query .="sales_tbl.Branch_Id = '$branch_id' AND sales_tbl.Status = 1 ";
								$query .="AND Date = '{$date_filter}' ";

									}

									else{

								$query = "SELECT SUM(sales_detail.Quantity) as Total, sales_tbl.Sold_to, sales_detail.Prod_Id, ";
								$query .="sales_detail.Price, sales_detail.Quantity, ";
								$query .="products_tbl.Prod_name, products_tbl.Prod_brand ";
								$query .="FROM sales_tbl LEFT JOIN sales_detail ON ";
								$query .="sales_tbl.Sales_Id = sales_detail.Sales_Id ";
								$query .="LEFT JOIN products_tbl ON sales_detail.Prod_Id ";
								$query .="= products_tbl.Prod_Id WHERE ";
								$query .="sales_tbl.Branch_Id = '$branch_id' AND sales_tbl.Status = 1 ";
								$query .="AND Date = curdate() ";

                					}

                					$query_the_sum  = mysqli_query($con, $query);

                					confirmQuery($query_the_sum);

                					while($row = mysqli_fetch_assoc($query_the_sum)){
                						$total_quantity_in = $row['Total'];
                					}

                					if($total_quantity_in == 0){
                						echo "<h3>0</h3>";
                					}
                					else{
										echo "<h3>$total_quantity_in</h3>";
                					}

		            			?>
		            		</div>

			            </div>

			            <div class="col-sm-4">
			            	
			            	<div class="text-center" style = "border: 2px solid #f4f4f4">

		            			<p>Total Stock Out Value</p>

		            			<?php

		            				if(isset($_POST['date_filter'])){

										$date_filter = $_POST['date_filter'];

										$query = "SELECT SUM(sales_detail.Price * sales_detail.Quantity) as Total, sales_tbl.Sold_to, sales_detail.Prod_Id, ";
										$query .="sales_detail.Price, sales_detail.Quantity, ";
										$query .="products_tbl.Prod_name, products_tbl.Prod_brand ";
										$query .="FROM sales_tbl LEFT JOIN sales_detail ON ";
										$query .="sales_tbl.Sales_Id = sales_detail.Sales_Id ";
										$query .="LEFT JOIN products_tbl ON sales_detail.Prod_Id ";
										$query .="= products_tbl.Prod_Id WHERE sales_tbl.Branch_Id ";
										$query .="= '$branch_id' AND sales_tbl.Status = 1 ";
										$query .="AND Date = '{$date_filter}' ";

									}

									else{

										$query = "SELECT SUM(sales_detail.Price * sales_detail.Quantity) as Total, sales_tbl.Sold_to, sales_detail.Prod_Id, ";
										$query .="sales_detail.Price, sales_detail.Quantity, ";
										$query .="products_tbl.Prod_name, products_tbl.Prod_brand ";
										$query .="FROM sales_tbl LEFT JOIN sales_detail ON ";
										$query .="sales_tbl.Sales_Id = sales_detail.Sales_Id ";
										$query .="LEFT JOIN products_tbl ON sales_detail.Prod_Id ";
										$query .="= products_tbl.Prod_Id WHERE sales_tbl.Branch_Id ";
										$query .="= '$branch_id' AND sales_tbl.Status = 1 ";
										$query .="AND Date = curdate() ";

                					}

                					$query_the_sum  = mysqli_query($con, $query);

                					confirmQuery($query_the_sum);

									while($row = mysqli_fetch_assoc($query_the_sum)){

										$the_sum = $row['Total'];

										echo "<h3>".number_format($the_sum,2)." PHP</h3>";
									}

		            			?>
		            			
		            		</div>

			            </div>

		            </div><br>
            		
            		<div class="row">

            			<div class="col-sm-12">

	            			<div class = "table-responsive">

	            				<form method = "POST">

		                			<table class = "table table-bordered table-hover" id="standardAsc">

		                				<thead class="cap">
		                					<tr>
		                						<th>No</th>
		                						<th>Customer</th>
		                						<th>Product</th>
		                						<th>Brand</th>
		                						<th>Price</th>
		                						<th>Quantity</th>
		                					</tr>
		                				</thead>

		                				<tbody>

		                					<?php


		                						if(isset($_POST['date_filter'])){

							$date_filter = $_POST['date_filter'];

							$query = "SELECT sales_tbl.Sold_to, sales_detail.Prod_Id, ";
							$query .="sales_detail.Price, sales_detail.Quantity, ";
							$query .="products_tbl.Prod_name, products_tbl.Prod_brand ";
							$query .="FROM sales_tbl LEFT JOIN sales_detail ON ";
							$query .="sales_tbl.Sales_Id = sales_detail.Sales_Id ";
							$query .="LEFT JOIN products_tbl ON sales_detail.Prod_Id ";
							$query .="= products_tbl.Prod_Id WHERE sales_tbl.Branch_Id ";
							$query .="= '$branch_id' AND sales_tbl.Status = 1 ";
							$query .="AND Date = '{$date_filter}' ";

												}

												else{

							$date_filter = 'None';

							$query = "SELECT sales_tbl.Sold_to, sales_detail.Prod_Id, ";
							$query .="sales_detail.Price, sales_detail.Quantity, ";
							$query .="products_tbl.Prod_name, products_tbl.Prod_brand ";
							$query .="FROM sales_tbl LEFT JOIN sales_detail ON ";
							$query .="sales_tbl.Sales_Id = sales_detail.Sales_Id ";
							$query .="LEFT JOIN products_tbl ON sales_detail.Prod_Id ";
							$query .="= products_tbl.Prod_Id WHERE sales_tbl.Branch_Id ";
							$query .="= '$branch_id' AND sales_tbl.Status = 1 ";
							$query .="AND Date = curdate() ";

			                					}

		                						$query_stock_out = mysqli_query($con, $query);

		                						$count = mysqli_num_rows($query_stock_out);

		                						confirmQuery($query_stock_out);

		                						if($count > 0){

								                    $n = 1;

								                    while($row = mysqli_fetch_array($query_stock_out)){

								                      	$prod_Id      	= escape($row["Prod_Id"]);
								                      	$prod_name    	= escape($row["Prod_name"]);
								                      	$prod_brand   	= escape($row["Prod_brand"]);
								                      	$price 			= escape($row['Price']);
								                      	$quantity 		= escape($row['Quantity']);
								                      	$customer 		= escape($row['Sold_to']);

								                      	echo "<tr>";
								                      	echo "<td>".$n++."</td>";
								                      	echo "<td>$customer</td>";
								                      	echo "<td><a href='edit_product.php?prodid=$prod_Id'>$prod_name</a></td>";
								                      	echo "<td>$prod_brand</td>";
								                      	echo "<td>".number_format((int)$price,2)." PHP</td>";
								                      	echo "<td>$quantity</td>";
								                      	echo "</tr>";

								                    }

								                }

								                else{

								                	echo "<script>document.getElementById('print').className='hidden';</script>";
								                }

							                  ?>

		                				</tbody>

		                			</table>

		                		</form>

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



		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

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