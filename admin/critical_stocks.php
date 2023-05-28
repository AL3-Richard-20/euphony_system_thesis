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

		<title>Euphony | Critical Stocks</title>

	</head>

	<body>

		<div class="container-fluid">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

					<div class="row">

			             <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='inventory.php'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			            	<center><h3 class="cap">Critical Stocks</h3></center>
			            </div>

			        </div>

				</div>

				<div class="panel-body">

					<div class="text-right">
						<a href="print_critical_stocks.php?branchid=<?php echo $branch_id; ?>" class="btn btn-primary" id="print" target="_blank">Print</a>
					</div><br>

					<div class="table-responsive">
				
						<table class="table table-bordered" id="standardAsc">

							<thead class="cap">
								<th>No.</th>
								<th>Item</th>
								<th>Brand</th>
								<th>Price</th>
								<th>Status</th>
								<th>Image</th>
								<th>Stocks</th>
							</thead>

							<tbody>

								<?php

									$query_prod_settings = prodSett('3');

						          	confirmQuery($query_prod_settings);

						          	while($row2 = mysqli_fetch_assoc($query_prod_settings)){

						          		$number = escape($row2['Number']);
						          		
						          	}

									$query_critical_stocks = criticalStocks($branch_id, $number , 10000);

									confirmQuery($query_critical_stocks);

									$count = mysqli_num_rows($query_critical_stocks);

									if($count > 0){

										$n = 1;

										while($row = mysqli_fetch_assoc($query_critical_stocks)){

											$prod_Id 		= escape($row["Prod_Id"]);
								          	$prod_name 		= escape($row["Prod_name"]);
								          	$prod_brand 	= escape($row["Prod_brand"]);
								          	$prod_price 	= escape($row["Prod_price"]);
								          	$prod_desc 		= escape($row["Prod_desc"]);
								          	$prod_status 	= escape($row["Status"]);
								          	$prod_image 	= escape($row["Prod_image"]);
								          	$prod_quantity 	= escape($row['Quantity']);
								          	$prod_cat_id 	= escape($row['Category_Id']);
								          	$prod_category 	= escape($row['Category_title']);

								          	if($prod_quantity == 0){

								          		if($prod_status != 'Not Available'){

									          		$query = "UPDATE products_tbl SET Status = 'Not Available' ";
									          		$query .="WHERE Prod_Id = '$prod_Id' ";
									          		$query_update_status = mysqli_query($con, $query);

									          		confirmQuery($query_update_status);
									          	}
								          	}
								          	
								          	echo "<tr>";
								          	echo "<td>".$n++."</td>";
								          	echo "<td><a href='edit_product.php?prodid=$prod_Id' title= 'Edit' target='_blank'>$prod_name</a></td>";
								          	echo "<td>$prod_brand</td>";
					                      	echo "<td>".number_format($prod_price,2)." PHP</td>";
					                      	echo "<td>$prod_status</td>";
					                      	echo "<td><center><img src = '../images/products/$prod_image' class = 'imagesize'></center></td>";
					                      	echo "<td>$prod_quantity</td>";
								          	echo "</tr>";

										}

									}

									else{

										echo "<script>document.getElementById('print').className='hidden';</script>";
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



		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>
			
			$('#standardAsc').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

		</script>

	</body>

</html>