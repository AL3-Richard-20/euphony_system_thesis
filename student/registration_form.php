<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>
<!---Includes END--->

<!DOCTYPE html>

<html lang = "en">

  	<head>

  		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">



  		<link rel = "stylesheet" type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<link rel = "stylesheet" type="text/css" href = "../assets/font/css/all.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<link rel = "stylesheet" type="text/css" href = "../includes/style.css">

  		<title>Euphony | Lesson and Schedule</title>

  	</head>

  	<body>

	<?php 

		if(isset($_GET['user_id'])){

			$user_id   = $_GET['user_id'];

			$query_selected_student = studInfo($user_id);

			confirmQuery($query_selected_student);

			while($row = mysqli_fetch_assoc($query_selected_student)){

				//stud_tbl
				$lastname 		= escape($row['Last_name']);
				$firstname 		= escape($row['First_name']);
				$middlename 	= escape($row['Middle_name']);
				$address 		= escape($row['Address']);
				$birthdate 		= escape($row['Birthdate']);
				$age 			= escape($row['Age']);
				$sex 			= escape($row['Sex']);
				$contactno 		= escape($row['Contact_no']);
				$profileimg 	= escape($row['Profile_img']);
				$status 		= escape($row['Status']);
				$datestarted 	= escape($row['Date_started']);

				//users_tbl
				$email  		= escape($row['Email']);
				$password  		= escape($row['Password']);
				//Branch_tbl

				$_SESSION['firstname'] 		= $firstname;
	  			$_SESSION['profileimg'] 	= $profileimg;
	  			$_SESSION['user_id'] 		= $user_id;
	  			$_SESSION['sex'] 			= $sex;

			}
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

			echo "<script>formAlert('success', 'Success', 'You can now proceed to your account', 'index.php');</script>";
		}

	?>

	<div class="container">

		<div class="panel panel-default">

			<div class="panel-body">

	            <div class="form-content">

	                <div class="the-form">

	                    <center><h3 id="h3" class="cap">Choose a lesson and schedule</h3></center>

	                    <form method="POST" novalidate>

	                    	<div class="item">

								<select class = "form-control required lessondd" name ="lesson" id="select2">
									<option value="">Select Lesson Here</option>
									<?php echo fill_lesson(); ?>
								</select>

							</div>

							<p>Amount</p>
							<h3 id="amount" style="color:green; font-weight: bold;">0</h3><br>

							<div class="item">
								<p>Day</p>
								<select class = "form-control required" name ="day">
									<option value="">---</option>
									<?php echo dayQuery(); ?>
								</select>

							</div>


							<div class="item">

								<p>Time</p>
								<select class = "form-control required" name ="time">
									<option value="">---</option>
									<?php echo timeQuery(); ?>
								</select>

							</div>

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

	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

	<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

	<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

	<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

	<script src="../assets/js/select2.full.min.js"></script>

	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->

	

	<script>
		
		$(document).ready(function(){

			$("#select2").select2({
		      allowClear: true
		    });
		})

		$('.lessondd').change(function(){

			var lessonid = $('.lessondd').val();

			$.ajax({

				url:'fetch.php',
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

	<?php include "includes/footer.php"; ?>

  	</body>

</html>