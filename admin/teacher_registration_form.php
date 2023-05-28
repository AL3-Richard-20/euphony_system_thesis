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

	<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

	<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

	<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

	<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



	<script src = "scripts/functions.js"></script>

	<title>Euphony | Class</title>

	<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  </head>

  <body>

	<?php 

		if(isset($_GET['teacherid']) && isset($_GET['sex'])){

			$teacher_id   	= $_GET['teacherid'];
			$sex   			= $_GET['sex'];

		}

		if(isset($_POST['lesson'])){

			$the_lesson = escape($_POST['lesson']);
			$the_day 	= escape($_POST['day']);
			$the_time 	= escape($_POST['time']);

			$query = "INSERT INTO teacher_lesson_tbl (Teacher_Id, Lesson_Id ) ";
			$query .="VALUES ('$teacher_id', '$the_lesson')";

			$add_lesson = mysqli_query($con, $query);

			confirmQuery($add_lesson);

			$last_id = mysqli_insert_id($con);

			if($add_lesson == 1){

				$query2 = "INSERT INTO class_tbl (Tea_less_Id, Day, Time, Status) ";
				$query2 .="VALUES ('$last_id', '$the_day', '$the_time', 'Available')";

				$add_schedule = mysqli_query($con, $query2);

				confirmQuery($add_schedule);

				echo "<script>location.href='teacher_profile_pic.php?userid=".$teacher_id."&sex=".$sex."';</script>";
			}
			
		}

	?>

	<div class="container-fluid">

		<?php include "includes/admin_navigation.php"; ?>

		<div class="margin"></div>

		<form method="POST">
			
			<!---Balances--->
			<div class="col-sm-12">	

				<div class="panel panel-default">

					<div class="panel-header">
						<center><h3 class="cap">Add lesson and schedule</h3></center>
					</div>

					<div class="panel-body"><br>

						<div class="col-sm-6">
							
							<div class="item">
								<p>Lesson</p>
								<select class = "form-control" name ="lesson" id="select2">
										
									<?php echo fill_lesson(); ?>
										
								</select>
							</div>

							<div class="item">
								<p>Day</p>
								<select class = "form-control" name ="day">
										
									<?php echo dayQuery(); ?>
										
								</select>
							</div>


							<div class="item">
								<p>Time</p>
								<select class = "form-control" name ="time">
										
									<?php echo timeQuery(); ?>
										
								</select>
							</div>

						</div>

					</div>

					<div class="panel-footer">

						<div class="text-right">
							<button type="submit" class="btn btn-success btn-lg" id="send"><span>Next</span></button>	
						</div>

					</div>

				</div>

			</div>
			<!---Balances END--->

		</form>

	</div>

	<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

	<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<script src="../assets/js/select2.full.min.js"></script>



	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->



	<script src = "../assets/validator/validator.js"></script>

	<script src = "../assets/validator/validate.js"></script>

	<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

	<script src = "scripts/shortcut_keys.js"></script>

	<script>
		
		$(document).ready(function(){

			$("#select2").select2({
		      allowClear: true
		    });

		});

	</script>

  </body>

</html>