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

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Lessons</title>

	</head>

	<body>

		<div class = "container">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

					<div class="row">

			             <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class = "fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			            	<center><h3 class="cap">LESSONS</h3></center>
			            </div>

			        </div>

				</div>

				<div class="panel-body">

					<!-- <div class="text-right">
						<a href="print_slow_moving.php?branchid=<?php echo $branch_id; ?>" class="btn btn-primary" id="print" target="_blank">Print</a>
					</div><br> -->

					<div class="table-responsive">
				
						<table class = "table table-bordered" id="standardAsc">

							<thead>
								<th><b>NO.</b></th>
								<th><b>DESCRIPTION</b></th>
								<th><b>SESSION</b></th>
								<th><b>AMOUNT</b></th>
								<th><b>IMAGE</b></th>
								<th><b>STUDENTS ENROLLED</b></th>
							</thead>

							<tbody>

								<?php

									$most_enrolled = mostEnrolled($branch_id);

									confirmQuery($most_enrolled);

									$n = 1;

									while($row = mysqli_fetch_assoc($most_enrolled)){

										$lesson_Id 			= escape($row['Lesson_Id']);
										$lesson_desc		= escape($row['Lesson_desc']);
										$lesson_img 		= escape($row['Cover_image']);
										$lesson_amount 		= escape($row['Amount']);
										$nooflesson 		= escape($row['No_of_lesson']);
										$students_enrolled 	= escape($row['Total']);

										echo "<tr>";
										echo "<td>".$n++."</td>";
										echo "<td>$lesson_desc</td>";
										echo "<td>$nooflesson</td>";
										echo "<td>".number_format($lesson_amount,2)." PHP</td>";
										echo "<td><center><img src='../images/lessons/Cover/$lesson_img' height=70></center></td>";
										echo "<td>$students_enrolled</td>";
										echo "</tr>";
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

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<script>
			
			$(document).ready(function(){

				$('#standardAsc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

			});

		</script>

	</body>

</html>