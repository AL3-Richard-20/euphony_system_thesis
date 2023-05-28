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

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/select2/select2.min.css"/>

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Products</title>

	</head>

	<body>

		<?php

			if(isset($_GET['active']) == 'settings'){

				$settings_tab = 1;
			}

			if(isset($_POST['addprod'])){

				$the_prod_Id = escape($_POST['addprod']);

				$query = "SELECT * FROM products_tbl WHERE randSalt3 = 1";
				$query_count = mysqli_query($con, $query);

				confirmQuery($query_count);

				$count = mysqli_num_rows($query_count);

				if($count == 6){

					echo "<script>sweetAlert('info', 'Maximum number reached', 'You cannot add more products to the display', 'products.php');</script>";
				}
				else{

					$query2 = "SELECT * FROM products_tbl WHERE Prod_Id = '$the_prod_Id' ";
					$query2 .="AND randSalt3 = 1";
					$query_if_exist = mysqli_query($con, $query2);

					confirmQuery($query_if_exist);

					$count_prod = mysqli_num_rows($query_if_exist);

					if($count_prod == 1){
						echo "<script>sweetAlert('error', 'Cannot be duplicate', 'Choose other product', 'products.php');</script>";
					}
					else{

						$query3 = "UPDATE products_tbl SET randSalt3 = 1 WHERE ";
						$query3 .="Prod_Id = '$the_prod_Id' ";

						$query_add = mysqli_query($con, $query3);

						confirmQuery($query_add);

						echo "<script>sweetAlert('success', 'Successfully Added', 'New product was added to the display', 'products.php');</script>";
					}
				}
			}

			if(isset($_POST['based_no'])){

				$the_prod_sett_Id 	= escape($_POST['the_prod_sett_Id']);
				$the_based_no 		= escape($_POST['based_no']);

				$query = "UPDATE product_settings SET Number = '$the_based_no' ";
				$query .="WHERE Prod_sett_Id = '$the_prod_sett_Id' ";

				$query_update = mysqli_query($con, $query);

				confirmQuery($query_update);

				echo "<script>sweetAlert('success', 'Successfully Updated', 'You changed the based number', 'products.php?active=settings');</script>";
			}

		?>

		<div class="container">

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class = "margin"></div>
			
			<div class="panel panel-default">
				
				<div class="panel-header">

					<div class="row">

			            <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='content_management.php'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Products</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>

				</div><br>

				<input type="hidden" id="settings_tab" value="<?php echo $settings_tab; ?>">

				<div class="panel-body">
					
					<ul class="nav nav-pills nav-justified">
						<li class="active" id="li1"><a data-toggle="tab" href="#menu1">Display (Front Page)</a></li>
					  	<li id="li2"><a data-toggle="tab" href="#menu2">Fast Moving</a></li>
					  	<li id="li3"><a data-toggle="tab" href="#menu3">Settings</a></li>
					</ul>

					<br>

					<div class="tab-content">

					  	<div id="menu1" class="tab-pane fade in active">
					    	
				    		<div class="text-right">
				    			<button type="button" data-toggle="modal" data-target="#addProduct" class="btn btn-success">Add</button>
				    		</div><br>

				    		<div class="table-responsive">
				    			
				    			<table class="table table-bordered table-hover" id="standardDesc">
				    				
				    				<thead class="cap">
				    					<tr>
						                    <th>No.</th>
						                    <th>Item</th>
						                    <th>Brand</th>
						                    <th>Price</th>
						                    <th>Image</th>
						                    <th>Action</th>
						                </tr>
				    				</thead>

				    				<tbody>
				    					
				    					<?php

				    						$query = "SELECT * FROM products_tbl WHERE randSalt3 = 1 ";

				    						$query_disp_prod = mysqli_query($con, $query);

				    						confirmQuery($query_disp_prod);

				    						$n = 1;

				    						while($row = mysqli_fetch_assoc($query_disp_prod)){

				    							$prod_Id      = escape($row["Prod_Id"]);
						                      	$prod_name    = escape($row["Prod_name"]);
						                      	$prod_brand   = escape($row["Prod_brand"]);
						                      	$prod_price   = escape(number_format($row["Prod_price"],2));
						                      	$prod_desc    = escape($row["Prod_desc"]);
						                      	$prod_image   = escape($row["Prod_image"]);

						                      	echo "<tr>";
						                      	echo "<td>".$n++."</td>";
						                      	echo "<td>$prod_name</td>";
						                      	echo "<td>$prod_brand</td>";
						                      	echo "<td>$prod_price</td>";
						                      	echo "<td><center><img src = '../images/products/$prod_image' class = 'imagesize'></center></td>";
						                      	echo "<td>";

						                      	?>

						                      	<button onclick="deleting('action.php?delproddisp=<?php echo $prod_Id; ?>');" title="Delete" class="btn btn-danger btn-md">Delete</button>

						                      	<?php

						                      	echo" </td>";
						                      	echo "</tr>";
				    						}

				    					?>

				    				</tbody>

				    			</table>

				    		</div>

					  	</div>

					  	<?php include "includes/add_product_disp.php"; ?>

					  	<div id="menu2" class="tab-pane fade in"><br>

					  		<!-- <div class="text-right">
				    			<a href="#" class="btn btn-success" id="print">Print</a>
				    		</div><br> -->

				    		<form method = "POST" novalidate>

					    		<div class="row">

						    		<div class="text-left">

						    			<div class="col-sm-4">

							    			<div class="item">

							    				<select class="form-control required" name="filter_branch" id="branch_filter">

							    					<option value="">Filter Branch Here</option>

							    					<?php 

							    						$query_branches = queryTable('branches_tbl');

							    						confirmQuery($query_branches);

							    						while($row = mysqli_fetch_assoc($query_branches)){

							    							$branch_Id 		= escape($row['Branch_Id']);
							    							$branch_desc	= escape($row['Branch_desc']);

							    							echo "<option value='$branch_Id'>$branch_desc</option>";
							    						}
							    					?>

							    				</select>

							    			</div>

							    		</div>

						    		</div>

					    		</div>

				    		</form>

				    		<div class="row">
				    			<div class="text-center">
				    				<?php

				    					if(isset($the_branch)){

				    						$query_branch = tableQuery_3('branches_tbl', 'Branch_Id', $the_branch);

											confirmQuery($query_branch);

											while($row = mysqli_fetch_assoc($query_branch)){

												$branch_desc	= escape($row['Branch_desc']);

												echo "<p>Fast Moving Products of <br> <b>$branch_desc</b></p>";

											}

				    						
				    					}
				    				?>				    			
				    			</div>
				    		</div><br>
					    	
					    	<div class="table-responsive">

						    	<table class = "table table-bordered" id="standardDesc2">

									<thead class="cap">
										<th>No.</th>
										<th>Item</th>
										<th>Brand</th>
										<th>Price</th>
										<th>Status</th>
										<th>Image</th>
										<th>Orders</th>
									</thead>

									<tbody id="fast_moving_prods">
										<!-- Fast Moving Products Here -->
									</tbody>
									
								</table>

							</div>

					  	</div>

					  	<div id="menu3" class="tab-pane fade in"><br><br>
					    	
					    	<div class="table-responsive">
					    		
					    		<table class="table table-bordered table-hover">

					    			<thead class="cap">
					    				<tr>
					    					<th>No.</th>
					    					<th>Description</th>
					    					<th>Reorder Point</th>
					    					<th>Action</th>
					    				</tr>
					    			</thead>

					    			<tbody>
					    				
					    				<?php

					    					$query = "SELECT * FROM product_settings";
					    					$query_settings = mysqli_query($con, $query);

					    					confirmQuery($query_settings);

					    					$n = 1;

					    					while($row = mysqli_fetch_assoc($query_settings)){

					    						$prod_sett_Id 	= escape($row['Prod_sett_Id']);
					    						$description 	= escape($row['Description']);
					    						$number 		= escape($row['Number']);

					    						echo "<form method='POST'>";
					    						echo "<tr>";
					    						echo "<td>".$n++."</td>";
					    						echo "<td>$description</td>";
					    						echo "<td>$number</td>";
					    						echo "<td><a href='' class='btn btn-primary' data-toggle='modal' data-target='#prodSett$prod_sett_Id'>Edit</a></td>";
					    						echo "</tr>";

					    						include "includes/prod_settings_modal.php";

					    						echo "</form>";
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

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript"  src = "../assets/datatables/datatables.min.js"></script>

		<script type = "text/javascript"  src = "../assets/js/select2.full.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>	 -->	

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

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

				$("#select2").select2({
			      	placeholder: "Select a product here",
			      	allowClear: true
			    });

				var settings = $('#settings_tab').val();

			    if(settings == 1){
					$('#li1').removeClass('active');
					$('#li1').removeAttr('href data-toggle');
					$('#li1').removeClass('active');
					$('#menu1').removeClass('active');
					$('#li3').addClass('active');
					$('#menu3').addClass('active');
					$('#li3').attr('href', '#menu3');
					$('#li3').attr('data-toggle', 'pill');
				}

			});

			$('#branch_filter').change(function(){

				var branch = $('#branch_filter').val();

				$.ajax({

					url:"action.php",
					method:"POST",
					data: {
						branchid:branch,
						action:"branch_filter"
					},

					success:function(data){

						var result = JSON.parse(data)

						$("#fast_moving_prods").html(result)
					}
				})

			});

		</script>

	</body>

</html>
