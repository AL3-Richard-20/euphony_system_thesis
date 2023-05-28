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



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    	<link rel = "stylesheet" href = "includes/schedule_style.css">

    	<title>Euphony | Schedules</title>

  	</head>

  	<body>

  		<?php include "includes/admin_navigation.php"; ?>

		<?php


			if(!isset($_GET['lesson']) || !isset($_GET['teacher'])){

				header("location: schedule.php");
			}

			if(isset($_POST['filtered_lesson']) && isset($_POST['selected_teacher'])){

				$lesson 	= escape($_POST['filtered_lesson']);
				$teacher 	= escape($_POST['selected_teacher']);

				if($teacher == '' || $lesson == ''){

					echo "<script>window.location.href='schedule.php';</script>";

				}
				else{
					echo "<script>window.location.href='view_schedule.php?lesson=$lesson&teacher=$teacher';</script>";
				}
				
			}

		?>

		<div class = "container-fluid">

  		<div class = "margin"></div>

  			<div class = "panel panel-default">

  				<?php

  					if(isset($_GET['lesson']) || isset($_GET['teacher'])){

						$filtered_lesson  = escape($_GET['lesson']);
						$filtered_teacher = escape($_GET['teacher']);

						$query_lesson_info = tableQuery_3('lessons_tbl', 'Lesson_Id', $filtered_lesson);

						while($row = mysqli_fetch_assoc($query_lesson_info)){

							$lesson_desc  = $row['Lesson_desc'];
							$No_of_lesson = $row['No_of_lesson'];
						}

						$query_teacher_info = tableQuery_3('teacher_tbl', 'Teacher_Id', $filtered_teacher);

						while($row = mysqli_fetch_assoc($query_teacher_info)){

							$teacher_lastname   = escape($row['T_Last_name']);
							$teacher_firstname  = escape($row['T_First_name']);
							$teacher_middlename = escape($row['T_Middle_name']);
						}
					}

  				?>

  				<div class="panel-header">
					
					<div class="row">

			            <div class="col-sm-4">
			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>
			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Class Schedules</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>

				</div>

  				<form method="POST">

	  				<div class="panel-body">

	  					<p>
	  						<center><b>Lesson:</b> <?php echo "$lesson_desc" . " - " . "$No_of_lesson" . " Lessons"; ?></center>
	  					</p>
						<p>
							<center><b>Teacher:</b> <?php echo "$teacher_firstname $teacher_middlename $teacher_lastname"; ?></center>
						</p><br>

						<div class = "row">

							<div class = "col-sm-3">
								<select class = "form-control" name = "filtered_lesson" id="select2">
			  						<option value = "">Select a Lesson</option>
			  						<?php fill_lesson(); ?>
			  					</select><br>
					  		</div>

					  		<div class = "col-sm-3">

			  					<select class = "form-control" name = "selected_teacher">

			  						<option value = "">Select a Teacher</option>

			  						<?php 

			  							$query_all_teachers = tableQuery('teacher_tbl');

			  							while($row = mysqli_fetch_assoc($query_all_teachers)){

			  								$teacher_id = escape($row['Teacher_Id']);
			  								$lastname 	= escape($row['T_Last_name']);
			  								$firstname 	= escape($row['T_First_name']);
			  								$middlename = escape($row['T_Middle_name']);

			  								echo "<option value = '$teacher_id'>$lastname, $firstname $middlename</option>";
			  							}
			  						?>

			  					</select><br>

		  					</div>

		  					<div class = "col-sm-1">
		  						<button class = "btn btn-primary" name = "view_schedule">Apply</button>
		  					</div>

					  	</div><br>
						
		  			</form>

	  				<div class="table-responsive">

						<table class = "table table-bordered table-hover">

							<thead>
								<tr class="row100 head">
									<th class="column100 cap"></th>
									<th class="column100"><center><b>SUNDAY</b></center></th>
									<th class="column100"><center><b>MONDAY</b></center></th>
									<th class="column100"><center><b>TUESDAY</b></center></th>
									<th class="column100"><center><b>WEDNESDAY</b></center></th>
									<th class="column100"><center><b>THURSDAY</b></center></th>
									<th class="column100"><center><b>FRIDAY</b></center></th>
									<th class="column100"><center><b>SATURDAY</b></center></th>
								</tr>
							</thead>

							<tbody>
								
								<tr class="row100">

									<td class="column100 column1" data-column="column1">9:00 - 10:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 1);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

											$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 1);

											confirmQuery($query_monday_sched);

											viewTeachersched2($query_monday_sched);

											count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

										?>

										<?php

											$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 1);

											confirmQuery($query_tuesday_sched);

											viewTeachersched2($query_tuesday_sched);

											count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

										?>

										<?php

											$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 1);

											confirmQuery($query_wednesday_sched);

											viewTeachersched2($query_wednesday_sched);

											count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

										?>

										<?php

											$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 1);

											confirmQuery($query_thursday_sched);

											viewTeachersched2($query_thursday_sched);

											count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

										?>

										<?php

											$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 1);

											confirmQuery($query_friday_sched);

											viewTeachersched2($query_friday_sched);

											count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

										?>

										<?php

											$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 1);

											confirmQuery($query_saturday_sched);

											viewTeachersched2($query_saturday_sched);

											count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

										?>

									
								</tr>



								<tr class="row100">

									<td class="column100 column1" data-column="column1">10:00 - 11:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 2);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 2);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 2);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 2);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 2);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 2);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 2);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">11:00 - 12:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 3);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 3);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 3);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 3);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 3);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 3);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 3);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">12:00 - 1:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 4);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 4);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 4);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 4);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 4);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 4);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 4);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">1:00 - 2:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 5);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 5);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 5);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 5);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 5);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 5);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 5);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">2:00 - 3:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 6);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 6);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 6);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 6);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 6);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 6);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 6);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">3:00 - 4:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 7);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 7);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 7);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 7);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 7);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 7);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 7);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">4:00 - 5:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 8);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 8);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 8);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 8);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 8);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 8);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 8);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>



								<tr class="row100">

									<td class="column100 column1" data-column="column1">5:00 - 6:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 9);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 9);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 9);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 9);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 9);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 9);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 9);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">6:00 - 7:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 10);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 10);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 10);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 10);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 10);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 10);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 10);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">7:00 - 8:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 11);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 11);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 11);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 11);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 11);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 11);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 11);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>


								<tr class="row100">

									<td class="column100 column1" data-column="column1">8:00 - 9:00</td>

									<?php

										
										$query_sunday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 7, 12);

										confirmQuery($query_sunday_sched);

										viewTeachersched2($query_sunday_sched);

										count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_monday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 1, 12);

										confirmQuery($query_monday_sched);

										viewTeachersched2($query_monday_sched);

										count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_tuesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 2, 12);

										confirmQuery($query_tuesday_sched);

										viewTeachersched2($query_tuesday_sched);

										count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_wednesday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 3, 12);

										confirmQuery($query_wednesday_sched);

										viewTeachersched2($query_wednesday_sched);

										count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_thursday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 4, 12);

										confirmQuery($query_thursday_sched);

										viewTeachersched2($query_thursday_sched);

										count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_friday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 5, 12);

										confirmQuery($query_friday_sched);

										viewTeachersched2($query_friday_sched);

										count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>

									<?php

										$query_saturday_sched = filterSchedules($filtered_lesson, $filtered_teacher, 6, 12);

										confirmQuery($query_saturday_sched);

										viewTeachersched2($query_saturday_sched);

										count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

									?>
									
								</tr>

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

		<<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src="../assets/js/select2.full.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->



		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/functions.js"></script>

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