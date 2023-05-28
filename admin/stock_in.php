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

		<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Stock In</title>

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


			//Delete Product on Stock In
			if(isset($_GET['delete'])){

				//Get the Info
				$the_prod_Id 		= escape($_GET['delete']);
				$the_quantity_in 	= escape($_GET['quantityin']);
				//Get the Info END

				//Query the actual quantity
				$query = "SELECT * FROM prod_invt_tbl WHERE Prod_Id = '$the_prod_Id'";
				$query_the_item = mysqli_query($con, $query);

				confirmQuery($query_the_item);

				while($row = mysqli_fetch_assoc($query_the_item)){
					$the_prod_quantity = escape($row['Quantity']);
				}
				//Query the actual quantity END


				$formula = $the_prod_quantity - $the_quantity_in;


				//Updating the stock
				$query2 = "UPDATE prod_invt_tbl SET Quantity = '$formula' WHERE Prod_Id = '$the_prod_Id'";
				$query_minus = mysqli_query($con, $query2);

				confirmQuery($query_minus);

				if($query_minus == 1){

					$query3 = "DELETE FROM stock_in WHERE Prod_Id = '$the_prod_Id' AND Date = curdate()";
					$query_delete_stockin = mysqli_query($con, $query3);

					confirmQuery($query_delete_stockin);

					echo "<script>sweetAlert('success', 'Successfully Removed', 'You removed a product on stock in', 'stock_in.php');</script>";

				}
				//Updating the stock END

			}
			//Delete Product on Stock In END




			//Adding a product to Stock In
			if(isset($_POST['the_product'])){

				//Input from Forms
				$the_prod_Id 	= escape($_POST['the_product']);
				$the_quantity 	= escape($_POST['quantity']);
				//Input from Forms END



				//Query the product if existing
				$query1 = "SELECT stock_in.Prod_Id, stock_in.Date, stock_in.Quantity_In FROM stock_in LEFT JOIN ";
				$query1 .="products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN ";
				$query1 .="prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id ";
				$query1 .="WHERE stock_in.Prod_Id = '$the_prod_Id' AND stock_in.Date = curdate() ";

				$if_prod_exist = mysqli_query($con, $query1);

				confirmQuery($if_prod_exist);

				$count_record = mysqli_num_rows($if_prod_exist);

				while($row = mysqli_fetch_assoc($if_prod_exist)){
					$the_quantity_in = $row['Quantity_In'];
				}

				if($count_record == 1){

					$total = $the_quantity_in + $the_quantity;

					$query = "UPDATE stock_in SET Quantity_In = '$total', Time = curtime() ";
					$query .="WHERE Prod_Id = '$the_prod_Id' AND Date = curdate() ";
				}
				
				else{
					$query = "INSERT INTO stock_in (Prod_Id, Date, Time, Quantity_In) ";
					$query .="VALUES ('$the_prod_Id', curdate(), curtime(), '$the_quantity') ";
				}
				//Query the product if existing END


				//Perform Query (ADDING)
				$stock_in_item = mysqli_query($con, $query);

				confirmQuery($stock_in_item);

				if($stock_in_item == 1){


					//Getting the actual quantity
					$query2 = "SELECT * FROM prod_invt_tbl WHERE Prod_Id = '$the_prod_Id'";
					$query_the_item = mysqli_query($con, $query2);

					confirmQuery($query_the_item);

					while($row = mysqli_fetch_assoc($query_the_item)){
						$the_prod_quantity = escape($row['Quantity']);
					}
					//Getting the actual quantity END



					$sum = ((int)$the_prod_quantity + (int)$the_quantity);


					//Updating the quantity
					$query3 = "UPDATE prod_invt_tbl SET Quantity = '$sum' WHERE Prod_Id = '$the_prod_Id'";
					$add_stock = mysqli_query($con, $query3);

					confirmQuery($add_stock);

					// echo "<script>sweetAlert('success', 'Successfully Added', 'You added a stock for a product', 'stock_in.php');</script>";

					echo "<script>sweetAlertSide('success', 'Successfully Added');</script>";
					//Updating the quantity END
					
				}
				//Perform Query (ADDING) END

			}
			//Adding a product to Stock In END


			if(isset($_POST['edited_quantity'])){

				$edit_prod_Id 	 = $_POST['s_prod_id']; 
				$old_quantity 	 = $_POST['old_quantity'];
				$edited_quantity = $_POST['edited_quantity'];

				//Query the original quantity from prod_invt_tbl
				$query = "SELECT * FROM prod_invt_tbl WHERE Prod_Id = '$edit_prod_Id'";
				$query_the_prod = mysqli_query($con, $query);

				confirmQuery($query_the_prod);

				while($row = mysqli_fetch_assoc($query_the_prod)){

					$actual_quantity = escape($row['Quantity']);
				}
				//Query the original quantity from prod_invt_tbl END


				$formula = $actual_quantity - $old_quantity;

				$query2 = "UPDATE prod_invt_tbl SET Quantity = '$formula' WHERE Prod_Id = '$edit_prod_Id'";
				$query_minus = mysqli_query($con, $query2);

				confirmQuery($query_minus);


				if($query_minus == 1){

					$querypart2 = "SELECT * FROM prod_invt_tbl WHERE Prod_Id = '$edit_prod_Id'";
					$query_the_prod2 = mysqli_query($con, $querypart2);

					confirmQuery($query_the_prod2);

					while($row2 = mysqli_fetch_assoc($query_the_prod2)){

						$actual_quantity2 = escape($row2['Quantity']);
					}

					$sum = $actual_quantity2 + $edited_quantity;

					$query3 = "UPDATE prod_invt_tbl SET Quantity = '$sum' WHERE Prod_Id = '$edit_prod_Id'";
					$query_sum = mysqli_query($con, $query3);

					confirmQuery($query_sum);
				}

				if($query_sum == 1){

					$query4 = "UPDATE stock_in SET Quantity_In = '$edited_quantity' WHERE Prod_Id = '$edit_prod_Id' AND Date = curdate()";
					$query_update_stockin = mysqli_query($con, $query4);

					confirmQuery($query_update_stockin);

					// echo "<script>sweetAlert('success', 'Successfully Updated', 'You updated product quantity', 'stock_in.php');</script>";

					echo "<script>sweetAlertSide('success', 'Successfully Updated');</script>";

				}
			}

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
		                	<center><h3 class="cap">Stock In</h3></center>
		              	</div>

		              	<div class="col-sm-4"></div>

		            </div>

				</div>

				<div class = "panel-body">

					<div class = "col-sm-4">

						<form method="POST" name="form1" id="form1">

							<div class="item">

								<div class = "margin"></div>
								<p>Product</p>
								<select class="form-control required" name="the_product" id="select2" style="width:100%">	

									<option value = "">Select Here</option>

									<?php

										$query_product_list = productList($branch_id);

										while($row = mysqli_fetch_assoc($query_product_list)){

											$prod_Id      = escape($row["Prod_Id"]);
						                    $prod_name    = escape($row["Prod_name"]);

											echo "<option value='$prod_Id'>$prod_name</option>";
										}
									?>

								</select>

							</div>

							<div class="item">
								<p>Quantity (per piece)</p>
								<input type="number" class = "form-control" name="quantity" required="required"> 
							</div>

							<div class = "form-group">	
								<button class = "btn btn-success" id="send">Add</button>
							</div>

							<div class = "margin"></div>

						</form>

            		</div>

            		<div class = "col-sm-8">	

            			<div class="row">

            				<form method="POST" name="form2" id="form2">
	                			<div class="col-sm-4">
	                				<div class="row">
	                					<div class="col-sm-9">	
	                						<input type="date" name="date_filter" class="form-control">
	                					</div>
	                					<div class="col-sm-3">
	                						<button name="datestockin" class="btn btn-primary">Apply</button>
	                					</div>
	                				</div>
	                			</div>
                			</form>

                			<div class="col-sm-4"></div>

                			<div class="col-sm-4">
                				<div class="text-right">
                					
	                				<!-- <a href="add_product.php" title= "Print" class="hidden" id="print_old" style="background-color:#ff704d; border:2px solid #ff704d;">Print</a> -->
	                				<div class="btn-group">
									    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									    More <span class="caret"></span></button>
									    <ul class="dropdown-menu" role="menu">
									      <li><a href="add_product.php" title= "Add product" target="_blank">Add new product</a></li>
									    </ul>
									</div>
									
					              	<a href="print_stock_in_today.php?branchid=<?php echo $branch_id; ?>&date=<?php echo $date_filter; ?>" target="_blank" title= "Print" class="btn btn-success" id="print">Print</a>

				              	</div>
                			</div>

			            </div><hr/>

			            <div class="row">

		            		<div class="col-sm-4"></div>

		            		<div class="col-sm-4" style = "border: 2px solid #f4f4f4">
		            			<div class="text-center">
			            			<p>Total Stock In Quantity</p>

			            			<?php

			            				if(isset($_POST['date_filter'])){

											$date_filter = $_POST['date_filter'];

											$query = "SELECT SUM(stock_in.Quantity_In) as Total, stock_in.Prod_Id, stock_in.Date, stock_in.Time, ";
											$query .="stock_in.Quantity_In, products_tbl.Prod_Id, products_tbl.Prod_name, products_tbl.Prod_price, ";
											$query .="products_tbl.Prod_brand, products_tbl.Prod_image, prod_invt_tbl.Quantity FROM stock_in ";
											$query .="LEFT JOIN products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id WHERE prod_invt_tbl.Branch_Id = '{$branch_id}' AND stock_in.Date = '$date_filter' ";

										}

										else{

											$query = "SELECT SUM(stock_in.Quantity_In) as Total, stock_in.Prod_Id, stock_in.Date, stock_in.Time, ";
											$query .="stock_in.Quantity_In, products_tbl.Prod_Id, products_tbl.Prod_name, products_tbl.Prod_price, ";
											$query .="products_tbl.Prod_brand, products_tbl.Prod_image, prod_invt_tbl.Quantity FROM stock_in ";
											$query .="LEFT JOIN products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id WHERE prod_invt_tbl.Branch_Id = '{$branch_id}' AND stock_in.Date = curdate()";

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

		            		<div class="col-sm-4" style = "border: 2px solid #f4f4f4">
			            		<div class="text-center">
			            			<p>Total Stock In Value</p>

			            			<?php

			            				if(isset($_POST['date_filter'])){

											$date_filter = $_POST['date_filter'];

											$query = "SELECT stock_in.Prod_Id, stock_in.Date, stock_in.Time, ";
											$query .="stock_in.Quantity_In, products_tbl.Prod_Id, products_tbl.Prod_name, products_tbl.Prod_price, ";
											$query .="products_tbl.Prod_brand, products_tbl.Prod_image, prod_invt_tbl.Quantity, SUM(products_tbl.Prod_price * stock_in.Quantity_In) as Sum FROM stock_in ";
											$query .="LEFT JOIN products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id WHERE prod_invt_tbl.Branch_Id = '{$branch_id}' AND stock_in.Date = '$date_filter' ";

										}

										else{

											$query = "SELECT stock_in.Prod_Id, stock_in.Date, stock_in.Time, ";
											$query .="stock_in.Quantity_In, products_tbl.Prod_Id, products_tbl.Prod_name, products_tbl.Prod_price, ";
											$query .="products_tbl.Prod_brand, products_tbl.Prod_image, prod_invt_tbl.Quantity, SUM(products_tbl.Prod_price * stock_in.Quantity_In) as Sum FROM stock_in ";
											$query .="LEFT JOIN products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id WHERE prod_invt_tbl.Branch_Id = '{$branch_id}' AND stock_in.Date = curdate()";

	                					}

	                					$query_the_sum  = mysqli_query($con, $query);

										while($row = mysqli_fetch_assoc($query_the_sum)){

											$the_sum = $row['Sum'];

											echo "<h3>".number_format($the_sum,2)." PHP</h3>";
										}

			            			?>
			            		</div>

		            		</div>

		            	</div><hr/>

			            <div class="row">
			            	<div class="text-center">
			            		<p>Stock In records as of <br>
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
			            				
			            			</b>
			            		</p>
			            	</div>
			            </div>
            			
            			<div class = "table-responsive">

                			<table class="table table-bordered table-hover" id="standardDesc">

                				<thead class="cap">
                					<tr>
                						<th>No</th>
                						<th>Time</th>
                						<th>Product</th>
                						<th>Brand</th>
                						<th>Price</th>
                						<th>Image</th>
                						<th>Stock In</th>
                						<th><center>Action</center></th>
                					</tr>
                				</thead>

                				<tbody>

                					<?php

                						if(isset($_POST['date_filter'])){

											$date_filter = $_POST['date_filter'];

											$query = "SELECT stock_in.Prod_Id, stock_in.Date, stock_in.Time, ";
											$query .="stock_in.Quantity_In, products_tbl.Prod_Id, products_tbl.Prod_name, products_tbl.Prod_price, ";
											$query .="products_tbl.Prod_brand, products_tbl.Prod_image, prod_invt_tbl.Quantity FROM stock_in ";
											$query .="LEFT JOIN products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id WHERE prod_invt_tbl.Branch_Id = '{$branch_id}' AND stock_in.Date = '$date_filter' ORDER BY stock_in.Time ASC";

										}

										else{

											$date_filter = 'None';

											$query = "SELECT stock_in.Prod_Id, stock_in.Date, stock_in.Time, ";

											$query .="stock_in.Quantity_In, products_tbl.Prod_Id, products_tbl.Prod_name, products_tbl.Prod_price, ";
											$query .="products_tbl.Prod_brand, products_tbl.Prod_image, prod_invt_tbl.Quantity FROM stock_in ";
											$query .="LEFT JOIN products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id WHERE prod_invt_tbl.Branch_Id = '{$branch_id}' AND stock_in.Date = curdate() ORDER BY stock_in.Time ASC";

	                					}

                						$query_stock_in = mysqli_query($con, $query);

                						$count1 = mysqli_num_rows($query_stock_in);

                						confirmQuery($query_stock_in);

                						if($count1 > 0){

						                    $n = 1;

						                    while($row = mysqli_fetch_assoc($query_stock_in)){

						                      	$prod_Id      	= $row["Prod_Id"];
						                      	$prod_name    	= escape($row["Prod_name"]);
						                      	$prod_brand   	= escape($row["Prod_brand"]);	
						                      	$prod_image   	= escape($row["Prod_image"]);
						                      	$prod_price 	= escape($row['Prod_price']);
						                      	$prod_quantity 	= escape($row['Quantity']);
						                      	// $the_sum 		= escape($row['Sum']);
						                      	$time_in 		= escape($row['Time']);

						                      	$quantity_in 	= escape($row['Quantity_In']);

						                      	?>

						                      	<form method="POST" name="form3" id="form3" novalidate>

						                      	<?php

						                      	echo "<tr>";
						                      	echo "<td>".$n++."</td>";
						                      	echo "<td>".date('h:i A', strtotime($time_in))."</td>";
						                      	echo "<td><a href='edit_product.php?prodid=$prod_Id'>$prod_name</a></td>";
						                      	echo "<td>$prod_brand</td>";
						                      	echo "<td>".number_format((int)$prod_price,2)." PHP</td>";
						                      	echo "<td><center><img src = '../images/products/$prod_image' class = 'imagesize' alt='Image'></center></td>";
						                      	echo "<td>$quantity_in</td>";
						                      	echo "<td>";

						                      	if($date_filter == 'None'){

				  									echo "<a href='' title='Edit' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editStockIn".$prod_Id."' id='editstockin'>Edit</a> ";

						                      		echo "<a href='stock_in.php?delete=$prod_Id&quantityin=$quantity_in' title='Delete' class='btn btn-danger btn-sm'>Delete</a>";
				  								}

				  								else if($date_filter == date('Y-m-d')){

				  									echo "<a href='' title='Edit' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editStockIn".$prod_Id."' id='editstockin'>Edit</a> ";

						                      		echo "<a href='stock_in.php?delete=$prod_Id&quantityin=$quantity_in' title='Delete' class='btn btn-danger btn-sm'>Delete</a>";
				  								}

						                      	else{
				  									echo "Not Available ";
				  								}

						                      	echo" </td>";
						                      	echo "</tr>";

						                      	include "includes/edit_stock_in.php";

						                      	?>

						                      	</form>

						                      	<?php


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

    	</div>

    	<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

    	<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    	<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>

    	<script src="../assets/js/select2.full.min.js"></script>



    	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>-->	


		
		<script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>
			
			$(document).ready(function(){

				$("#select2").select2({
			      allowClear: true
			    });

			    $('#standardDesc').DataTable({
		          select: true,
		          "order": [[ 0, "desc" ]]
		        });

			});

			$('#editstockin').click(function(e){

				e.preventDefault();

				alert('Hello');
			});

		</script>

	</body>

</html>