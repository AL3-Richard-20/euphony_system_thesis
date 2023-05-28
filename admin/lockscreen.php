<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>


<?php

	if($_SESSION['auth'] == null){

		echo "<script>location.href='index.php';</script>";
	}

?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">



		<link rel = "stylesheet"  type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<link rel="stylesheet" type="text/css" href="../includes/style.css">

		<title>Euphony | Lockscreen</title>

	</head>

	<body style="background-color: #f4f4f4; background-image: url('../images/background/shape-r1.png'); background-size: cover; background-attachment: fixed;">

		<div class = "container-fluid">
			
			<?php 

				$query = "SELECT Last_name FROM user_info_tbl ";
				$query .="WHERE User_Id = '$user_id' ";

				$query_name = mysqli_query($con, $query);

				confirmQuery($query_name);

				$row = mysqli_fetch_assoc($query_name);

				$lastname = $row['Last_name'];

				$fullname = "$firstname $lastname";

			?>

			<div class = "margin"></div>

			<div class="col-sm-3"></div>

			<form method="POST" id="lockscreen_auth" novalidate>

				<input type="hidden" id="userid" value="<?php echo $user_id; ?>">

				<div class="col-sm-6">

					<div class="panel panel-default">

						<div class="panel-body"><br>

							<div class="row">
								<div class="col-sm-12">
									<center><img src="../images/profile_img/<?php echo $profileimg; ?>" class="img-responsive" style="border: 2px solid black; border-radius: 100px;"><br>
									<h4><?php echo $fullname; ?></h4></center>
								</div>	
							</div><br>

							<div class="item">
								<p>Password</p>
								<input class="form control input-lg" type="password" id="password" required="required" style="width:100%">
							</div>

						</div>

						<div class="panel-footer">
							<div class="text-center">
								<button class="btn_1">Submit</button>
							</div>
						</div>

					</div>

				</div>

			</form>

			<div class="col-sm-3"></div>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<script>

			$(document).ready(function(){

				$('#password').focus()

			})
			
			$('#lockscreen_auth').submit(function(e){

				e.preventDefault()

				var user_id 	= $('#userid').val() 
				var password 	= $('#password').val()

				if(password == ""){

					sweetAlertSide('error', 'Cannot be empty')

					$('#password').focus()
				}

				else{

					$.ajax({

						url:"action.php",
						method:"POST",
						data:{
							userid:user_id,
							password:password,
							action:"lockscreen"
						},
						success:function(data){

							var result = JSON.parse(data)

							if(result == '1'){

								location.href='unlock_screen_exe.php'
							}

							else if(result == '2'){

								sweetAlert('error', 'Invalid Password', 'Try again', 'lockscreen.php')
							}

							else if(result == '3'){

								sweetAlert('info', 'Something went wrong', 'Try again', 'lockscreen.php')
							}
						}
					})
				}

			})

		</script>

	</body>
	
</html>