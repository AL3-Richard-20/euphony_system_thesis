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

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Edit Policy</title>

	</head>

	<body>	

		<?php

			if(isset($_POST['content1'])){

				$the_content = $_POST['content1'];

				$query 			= "UPDATE policy_tbl SET Content = '$the_content'";
				$query_update 	= mysqli_query($con, $query);

				confirmQuery($query_update);

				if($query_update == 1){
					echo "<script>sweetAlert('success', 'Successfully Updated!', 'You updated the policy', 'edit_policy.php');</script>";
				}
			}

			if(isset($_POST['content2'])){

				$the_content = $_POST['content2'];

				$query 			= "INSERT INTO policy_tbl (Content) VALUE('$the_content')";
				$query_insert 	= mysqli_query($con, $query);

				confirmQuery($query_insert);

				if($query_insert == 1){
					echo "<script>sweetAlert('success', 'Successfully Saved!', 'You updated the policy', 'edit_policy.php');</script>";
				}
			}

		?>

		<div class="container">

			<?php include "includes/headadmin_navigation.php"; ?>
				
			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">
					<div class="row">

			            <div class="col-sm-4">

			               <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='content_management.php'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Edit Policy</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>
				</div>

				<div class="panel-body">
					
					<!-- <?php

						$query_policy = queryTable('policy_tbl');

						confirmQuery($query_policy);

						while($row = mysqli_fetch_assoc($query_policy)){

							$content = $row['Content'];
						}

					?>

					<div class="row">
						<div class="col-sm-12">
							<div class="well">
								<?php 
									if(isset($content)){
										echo "<p>$content</p>";
									}
									else{
										echo "<p>Empty</p>";
									}
								?>
							</div>
						</div>
					</div> -->

					<form method="POST" novalidate>

						<div class="row">	

							<div class="col-sm-12">

								<?php 
									if(isset($content)){

										echo "<textarea class='ckeditor' name='content1' rows='5'>$content</textarea>";
									}

									else{
										echo "<textarea class='ckeditor' name='content2' rows='5'></textarea>";
									}

								?>
								
								<br>

								<div class="text-right">
									<button class="btn btn-success btn-lg" id="send">Save</button>
								</div>

							</div>

						</div>

					</form>

				</div>	

			</div>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript"  src = "../assets/ckeditor/ckeditor.js" type = "text/javascript"></script>



		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

	</body>

</html>