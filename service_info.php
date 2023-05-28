<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/sessions.php"; ?>
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

  		<title>Euphony | Service Information</title>

  	</head>

	<body>

		<?php

			if(isset($_GET['serviceid'])){

				$service_id = escape($_GET['serviceid']);

				$query_service = tableQuery_3('services_tbl', 'service_Id', $service_id);

				confirmQuery($query_service);

				while($row = mysqli_fetch_assoc($query_service)){

					$service_id 	= escape($row['service_Id']);
		          	$service_title 	= escape($row['title']);
		          	$service_image 	= escape($row['image']);
		          	$service_price 	= escape($row['price']);
		          	$service_content 	= $row['content'];
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

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='services_offered.php?active=services'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Service Information</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>
				</div><br>

				<div class="panel-body">
					
					<div class="row">

						<div class="col-sm-6">
							<img src="images/services/<?php echo $service_image; ?>" class = "img-responsive" style="height:50%;width:100%;">
						</div>

						<div class="col-sm-6">
							
							<h3><b><?php echo $service_title; ?></b> </h3>

							<table class="table"><br>

								<tbody>
									<tr>
										<td>Price: </td>
										<td><b style="color:green;"><?php echo number_format($service_price,2); ?> PHP</b></td>
									</tr>
									<tr>
										<td>Rating: </td>
										<td><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
									</tr>
								</tbody>

							</table>

						</div>

					</div><br>

					<div class="panel-group" id="accordion">

					  	<div class="panel panel-default">

					    	<div class="panel-heading">
					      		<h4 class="panel-title">
					        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><b>Details</b></a>
					      		</h4>
					    	</div>

					    	<div id="collapse1" class="panel-collapse collapse in">
					      		<div class="panel-body"><br>
					      			<span class="text-justify" style='white-space: pre-wrap;'><?php echo $service_content; ?></span>
					      		</div>

					    	</div>

					  	</div>

					</div>

				</div>

				<div class="panel-footer">
					<div class="text-right">
						<button class="btn btn-default" onclick="location.href='index.php#Services';">Go to homepage</button>
					</div>
				</div>

			</div>		
			
		</div>

		<script src = "assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>


		
		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

	</body>

	<?php include "includes/footer.php"; ?>

</html>