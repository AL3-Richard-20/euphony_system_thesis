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

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Add Student Lesson</title>

	</head>

  	<body>

		<?php 

			if(isset($_GET['user_id'])){

				$user_id   = $_GET['user_id'];
			}

			if(isset($_POST['lesson'])){

				$the_lesson = escape($_POST['lesson']);
				$the_day 	= escape($_POST['day']);
				$the_time 	= escape($_POST['time']);

				$query = "INSERT INTO selected_class_tbl (Lesson_Id, User_Id, the_Day, the_Time, ";
				$query .="Date_started, Status) ";
				$query .="VALUES ('$the_lesson', '$user_id', '$the_day', '$the_time', now(), 'New')";

				$add_class = mysqli_query($con, $query);

				confirmQuery($add_class);

				echo "<script>sweetAlert('success', 'Success', 'You added student lesson and schedule', 'edit_student.php?userid=$user_id');</script>";
			}

		?>

		<div class="container">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-body">

		            <div class="form-content">

		                <div class="the-form">

		                    <center><h3 class="cap">Choose a lesson and schedule</h3></center><br>

		                    <form method="POST" novalidate>

		                    	<div class="item">

									<select class="form-control required lessondd" name="lesson">
										<option value="">Select Lesson Here</option>
										<?php echo fill_lesson(); ?>
									</select>

								</div>

								<p>Amount</p>
								<h3 id="amount" style="color:green; font-weight: bold;">0</h3><br>

								<div class="item">

									<select class = "form-control required" name ="day">
										<option value="">Select Day Here</option>
										<?php echo dayQuery(); ?>
									</select>

								</div>


								<div class="item">

									<select class = "form-control required" name ="time">
										<option value="">Select Time Here</option>
										<?php echo timeQuery(); ?>
									</select>

								</div><br>

		                        <div class="form-group">
		                        	<center><button type = "submit" class = "btn btn-success btn-lg" id = "send">Next</button></center>
		                        </div>

		                    </form>

		                </div>

		                <div class="form-image">
		                    <figure><img src="../images/default/signin-image.jpg" class="side-img"></figure>
		                </div>

		            </div>

		        </div>

			</div>	

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src = "../assets/js/select2.full.min.js"></script>
		
		
		
		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->


		
		<script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script>

		<script>
			
			$("#select2").select2({
		      allowClear: true
		    });

		    $('.lessondd').change(function(){

				var lessonid = $('.lessondd').val();

				$.ajax({

					url:'fetch_lesson_amount.php',
					method:'POST',
					data:{
						lessonid:lessonid,
						action:'amount'
					},
					success:function(data){

						var result = JSON.parse(data);

						document.getElementById('amount').innerHTML = result + " PHP";
					}
				})

			})
			
		</script>

  	</body>

</html>