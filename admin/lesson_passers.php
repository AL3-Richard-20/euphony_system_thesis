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



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->



		<link rel = "stylesheet"  type = "text/css" href = "../includes/style.css">

		<title>Euphony | Graduates</title>

	</head>

	<body>

		<?php

			if(isset($_POST['year_filter'])){

				$the_year = $_POST['year_filter'];
			}
		?>
		
		<div class="container-fluid">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

					<div class="row">

		              	<div class="col-sm-4">

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='students.php'"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		              		<center><h3 class="cap">Graduates</h3></center>
		              	</div>

		            </div>

				</div>

				<div class="panel-body">

					<form method="POST">
						<div class="row">
							<div class="col-sm-4">
								<div class="item">
									<input type="text" name="year_filter" class="form-control" placeholder="Filter by Year" required="required">
								</div>
							</div>
							<div class="col-sm-1">
								<button class="btn btn-primary" id="send">Apply</button>
							</div>
						</div>
					</form>

					<div class="row">

			  			<div class="col-sm-1">
			  				<center><img src="../images/default/Graduates.png" style="height:70px"></center>
			  			</div>

			  			<div class="col-sm-1">

			  				<?php

			  					if(isset($the_year)){

									$query = "SELECT user_info_tbl.Last_name, ";
									$query .="user_info_tbl.First_name, ";
									$query .="user_info_tbl.Middle_name, ";
									$query .="user_info_tbl.Branch_Id, ";
									$query .="lessons_tbl.Lesson_Id, ";
									$query .="lessons_tbl.Lesson_desc, ";
									$query .="lessons_tbl.Amount, ";
									$query .="lessons_tbl.No_of_lesson, ";
									$query .="selected_class_tbl.Date_completed, ";
									$query .="selected_class_tbl.the_Day, ";
									$query .="selected_class_tbl.the_Time ";
									$query .="FROM user_info_tbl LEFT JOIN ";
									$query .="selected_class_tbl ON ";
									$query .="selected_class_tbl.User_Id ";
									$query .="= user_info_tbl.User_Id LEFT JOIN ";
									$query .="lessons_tbl ON selected_class_tbl.Lesson_Id ";
									$query .="=lessons_tbl.Lesson_Id WHERE ";
									$query .="user_info_tbl.Branch_Id = '$branch_id' AND ";
									$query .="selected_class_tbl.Status = 'Completed'";
									$query .="AND Year(selected_class_tbl.Date_completed) = '$the_year'";
								}

								else{

									$query = "SELECT user_info_tbl.Last_name, ";
									$query .="user_info_tbl.First_name, ";
									$query .="user_info_tbl.Middle_name, ";
									$query .="user_info_tbl.Branch_Id, ";
									$query .="lessons_tbl.Lesson_Id, ";
									$query .="lessons_tbl.Lesson_desc, ";
									$query .="lessons_tbl.Amount, ";
									$query .="lessons_tbl.No_of_lesson, ";
									$query .="selected_class_tbl.Date_completed, ";
									$query .="selected_class_tbl.the_Day, ";
									$query .="selected_class_tbl.the_Time ";
									$query .="FROM user_info_tbl LEFT JOIN ";
									$query .="selected_class_tbl ON ";
									$query .="selected_class_tbl.User_Id ";
									$query .="= user_info_tbl.User_Id LEFT JOIN ";
									$query .="lessons_tbl ON selected_class_tbl.Lesson_Id ";
									$query .="=lessons_tbl.Lesson_Id WHERE ";
									$query .="user_info_tbl.Branch_Id = '$branch_id' AND ";
									$query .="selected_class_tbl.Status = 'Completed'";
								}

								$query_passers = mysqli_query($con, $query); 

								confirmQuery($query_passers);

			  					$count_lesson_passers = mysqli_num_rows($query_passers);

			  					if($count_lesson_passers != NULL){
			  						echo "<center><h3>$count_lesson_passers</h3></center>";
			  					}
			  					else{
			  						echo "<center><h3>0</h3></center>";
			  					}
			  				?>
			  				
			  			</div>

			  			<div class="col-sm-2"></div>

			  			<div class="col-sm-4">

			  				<div class="text-center">
								<?php 
									if(isset($the_year)){
										echo "<p>Lesson Passers as of <b>$the_year</b></p>"; 
									}
									else{
										echo "";
									}
								?>
							</div>

			  			</div>

			  			<div class="col-sm-4"></div>

			  		</div><br>

					<div class="table-responsive">
				
						<table class = "table table-bordered" id="standardAsc">

							<thead class="cap">
								<th>No.</th>
								<th>Student</th>
								<th>Lesson</th>
								<th>Date Completed</th>
								<th>Action</th>
							</thead>

							<tbody>
								<?php

									if(isset($the_year)){

										$query = "SELECT user_info_tbl.Last_name, ";
										$query .="user_info_tbl.User_Id, ";
										$query .="user_info_tbl.First_name, ";
										$query .="user_info_tbl.Middle_name, ";
										$query .="user_info_tbl.Branch_Id, ";
										$query .="lessons_tbl.Lesson_Id, ";
										$query .="lessons_tbl.Lesson_desc, ";
										$query .="lessons_tbl.Amount, ";
										$query .="lessons_tbl.No_of_lesson, ";
										$query .="selected_class_tbl.Selected_class_Id, ";
										$query .="selected_class_tbl.Date_completed, ";
										$query .="selected_class_tbl.the_Day, ";
										$query .="selected_class_tbl.the_Time ";
										$query .="FROM user_info_tbl LEFT JOIN ";
										$query .="selected_class_tbl ON ";
										$query .="selected_class_tbl.User_Id ";
										$query .="= user_info_tbl.User_Id LEFT JOIN ";
										$query .="lessons_tbl ON selected_class_tbl.Lesson_Id ";
										$query .="=lessons_tbl.Lesson_Id WHERE ";
										$query .="user_info_tbl.Branch_Id = '$branch_id' AND ";
										$query .="selected_class_tbl.Status = 'Completed'";
										$query .="AND Year(selected_class_tbl.Date_completed) = '$the_year'";
									}

									else{

										$query = "SELECT user_info_tbl.Last_name, ";
										$query .="user_info_tbl.User_Id, ";
										$query .="user_info_tbl.First_name, ";
										$query .="user_info_tbl.Middle_name, ";
										$query .="user_info_tbl.Branch_Id, ";
										$query .="lessons_tbl.Lesson_Id, ";
										$query .="lessons_tbl.Lesson_desc, ";
										$query .="lessons_tbl.Amount, ";
										$query .="lessons_tbl.No_of_lesson, ";
										$query .="selected_class_tbl.Selected_class_Id, ";
										$query .="selected_class_tbl.Date_completed, ";
										$query .="selected_class_tbl.the_Day, ";
										$query .="selected_class_tbl.the_Time ";
										$query .="FROM user_info_tbl LEFT JOIN ";
										$query .="selected_class_tbl ON ";
										$query .="selected_class_tbl.User_Id ";
										$query .="= user_info_tbl.User_Id LEFT JOIN ";
										$query .="lessons_tbl ON selected_class_tbl.Lesson_Id ";
										$query .="=lessons_tbl.Lesson_Id WHERE ";
										$query .="user_info_tbl.Branch_Id = '$branch_id' AND ";
										$query .="selected_class_tbl.Status = 'Completed'";
									}

									$query_list = mysqli_query($con, $query);

									confirmQuery($query_list);

									$n = 1;

									while($row = mysqli_fetch_assoc($query_list)){

										$graduate_Id 		= escape($row['Selected_class_Id']);
										$stud_Id 			= escape($row['User_Id']);
										$stud_last_name 	= escape($row['Last_name']);
										$stud_first_name 	= escape($row['First_name']);
										$stud_middle_name 	= escape($row['Middle_name']);

										$the_student = "$stud_first_name $stud_middle_name $stud_last_name";

										$lesson_Id 		= escape($row['Lesson_Id']);
										$lesson_desc 	= escape($row['Lesson_desc']);
										$lesson_amount 	= escape($row['Amount']);
										$no_of_lesson 	= escape($row['No_of_lesson']);

										$the_lesson = "$lesson_desc $no_of_lesson - Lessons";

										$date_completed = escape($row['Date_completed']);

										echo "<tr>";
										echo "<td>".$n++."</td>";
										echo "<td>$the_student</td>";
										echo "<td>$the_lesson</td>";
										echo "<td>".date('F d, Y', strtotime($date_completed))."</td>";
										echo "<td>";
										echo "<center><a href='cert_of_completion.php?studid=$stud_Id&branchid=$branch_id&gradid=$graduate_Id' class='btn btn-success' id='print' target='_blank'>Print</a>";
										echo "</td></center>";
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



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->



		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>
			
			$(document).ready(function(){

				$('#standardAsc').DataTable({
					select: true,
					"order": [[ 0, "asc" ]]
				});
				
			});

		</script>

	</body>

</html>