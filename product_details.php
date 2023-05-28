<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1">



		<link rel = "stylesheet" href = "assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet" href = "assets/font/css/all.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet" href = "includes/style.css">

		<title>Euphony | Product Details</title>

	</head>

	<body>

		<?php

			if(isset($_GET['prodid'])){

				$prod_Id = escape($_GET['prodid']);

				$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
				$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
				$query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level FROM products_tbl as P, ";
				$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id ";
				$query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
				$query .= "and P.Prod_Id = '$prod_Id'";

				$query_product_info = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($query_product_info)){

                    $prod_name    = escape($row["Prod_name"]);
                    $prod_brand   = escape($row["Prod_brand"]);
                    $prod_price   = escape(number_format($row["Prod_price"],2));
                    $prod_desc    = $row["Prod_desc"];
                    $prod_status  = escape($row["Status"]);
                    $prod_image   = escape($row["Prod_image"]);
                    $prod_quantity = escape($row['Quantity']);

                    $branch_desc = escape($row['Branch_desc']);

				}
			}

		?>

		<div class="container">

			<?php include "includes/navigation_2.php"; ?>

			<div class="margin"></div>
			
			<div class="panel panel-default">
				
				<div class="panel-header">
					
					<div class="row">

			            <div class="col-sm-4">

			                <button type = "button" class = "btn btn-default btn-lg" style = "float: left" onclick="history.back()"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Product Information</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>

				</div>

				<div class="panel-body">
					
					<div class="col-sm-6">
						<div class="text-center">
							<img src="images/products/<?php echo $prod_image; ?>" class = "img-responsive" style="width:100%; height:auto">
						</div>
					</div>

					<div class="col-sm-6">

						<h3><strong><?php echo $prod_name; ?></strong></h3>
						<em><?php echo $prod_brand; ?></em><br><br>
						<p><b>Status: </b><?php echo $prod_status; ?></p>
						<p><b>Branch: </b><?php echo $branch_desc; ?></p>

						<div class="text-justify" style="background-color: white; white-space: pre-wrap; "><?php echo $prod_desc; ?></div>
						

						<h3 style = "color: green"><?php echo $prod_price; ?> PHP</h3><br>

						<span>Go to our store to purchase this item</span>
					</div>

				</div>

			</div>

		</div>

		<script src = "assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

	</body>

	<?php include "includes/footer.php"; ?>

</html>