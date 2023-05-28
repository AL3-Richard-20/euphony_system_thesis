<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

		<meta charset = "utf-8">

		<meta name = "viewport" content = "width=device-width, initial-scale=1">



		<link rel = "stylesheet" type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet" type="text/css" href = "../assets/font/css/all.min.css">

		<link rel = "stylesheet" type="text/css" href="../assets/datatables/datatables.min.css"/>

		<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<title>Euphony | Teacher Information</title>

		<link rel = "stylesheet" type="text/css" href = "../includes/style.css">

		<link rel = "stylesheet" href = "includes/schedule_style.css">

	</head>

  	<body>

  		<?php include "includes/admin_navigation.php"; ?>

  		<?php

			if(isset($_GET['teacherid'])){
				
	  			$teacher_id = $_GET['teacherid'];

	  			$query_selected_teacher = teacherInfo($teacher_id);

	  			while($row = mysqli_fetch_assoc($query_selected_teacher)){

	  				//stud_tbl
		  			$lastname 		= escape($row['T_Last_name']);
		  			$firstname 		= escape($row['T_First_name']);
		  			$middlename 	= escape($row['T_Middle_name']);
		  			$age 			= escape($row['T_Age']);
		  			$address 		= escape($row['T_Address']);
		  			$birthdate 		= escape($row['T_Birthdate']);
		  			$sex 			= escape($row['T_Sex']);
		  			$contactno 		= escape($row['T_Contact_no']);
		  			$nationality 	= escape($row['T_Nationality']);
		  			$profileimg 	= escape($row['T_Profile_img']);
		  			//stud_tbl END

		  			$fullname = "$firstname $middlename $lastname";

	  			}

	  			$teacher_class_lesson = tableQuery_3('teacher_lesson_tbl', 'Teacher_Id', $teacher_id);

	  			confirmQuery($teacher_class_lesson);

	  			count_records($teacher_class_lesson, "<script>sweetAlert('info', 'Walang Laman!', 'Mag add ka nga', 'teacher_registration_form.php?teacherid=$teacher_id');</script>");

  			}

  			if(isset($_POST['add_lesson'])){

				$new_lesson = escape($_POST['add_lesson']);

				$query1 = "SELECT * FROM teacher_lesson_tbl WHERE Lesson_Id = '$new_lesson' ";
				$query1 .="AND Teacher_Id = '$teacher_id' ";
				$query_lesson_verify = mysqli_query($con, $query1);

				confirmQuery($query_lesson_verify);

				$count_records = mysqli_num_rows($query_lesson_verify);

				if($count_records == 1){
					echo "<script>sweetAlert('error', 'Lesson already exist', 'This action cannot be done', 'edit_teacher.php?teacherid=$teacher_id');</script>";
				}
				else{
					$query = "INSERT INTO teacher_lesson_tbl (Teacher_Id, Lesson_Id) ";
					$query .="VALUES ('$teacher_id', '$new_lesson')";

					$query_add_lesson = mysqli_query($con, $query);

					confirmQuery($query_add_lesson);

					echo "<script>sweetAlert('success', 'Successfully Added!', 'You added a lesson', 'edit_teacher.php?teacherid=$teacher_id');</script>";
				}

			}

			if(isset($_POST['edit_time'])){

  				$the_day 	= escape($_POST['edit_day']);
  				$the_time 	= escape($_POST['edit_time']);

  				$query = "UPDATE selected_class_tbl SET the_Day = '{$the_day}', the_Time = '{$the_time}' ";
  				$query .="WHERE User_Id = '{$user_id}'";

  				$query_update_schedule = mysqli_query($con, $query);

  				confirmQuery($query_update_schedule);

  				echo "<script>sweetAlert('success', 'Successfully Updated', 'You changed the schedule');</script>";
  			}

	  	?>

  		<div class="container-fluid">	

  			<div class="margin"></div>

  			<div class="row">

  				<div class="col-sm-12">

		  			<div class="panel panel-default">

		  				<div class="panel-header">

				          	<div class="row">

					            <div class="col-sm-4">

					                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='teachers.php'"><span class="fa fa-arrow-left"></span></button>

					            </div>

				            	<div class="col-sm-4">

				              		<center><h3 class="cap">Teacher Information</h3></center>

				            	</div>

				            	<div class="col-sm-4"></div>

				          	</div>

				        </div>

				        <div class = "panel-body">

							<div class = "col-sm-3" onclick = "location.href='teacher_profile_pic.php?userid=<?php echo $teacher_id; ?>&sex=<?php echo $sex; ?>';">

			           			<!-- <center><img src = "../images/profile_img/<?php echo $profileimg; ?>" class = "img-circle img-responsive" alt = "photo" id = "profileimg" onclick = "location.href='teacher_profile_pic.php?userid=<?php echo $teacher_id; ?>&sex=<?php echo $sex; ?>';"></center> -->

			           			<?php profileImg($profileimg, $sex); ?>

			            	</div><br>

			            	<div class = "col-sm-4">

			            		<table class = "table">

			            			<thead class="cap">
			            				<th colspan = "2"><label>Personal Information</label></th>
			            			</thead>

			            			<tbody>

			            				<tr>
			            					<td><strong>Full Name: </strong></td>
			            					<td><?php echo $fullname; ?></td>
			            				</tr>

			            				<tr>
			            					<td><strong>Sex: </strong></td>
			            					<td><?php echo $sex; ?></td>
			            				</tr>

			            				<tr>
			            					<td><strong>Birthdate: </strong></td>
			            					<td><?php echo date('F d, Y', strtotime($birthdate)); ?></td>
			            				</tr>

			            				<tr>
			            					<td><strong>Age: </strong></td>
			            					<td><?php echo $age; ?></td>
			            				</tr>

			            				<tr>
			            					<td><strong>Nationality: </strong></td>
			            					<td><?php echo $nationality; ?></td>
			            				</tr>

			            			</tbody>

			            		</table>	           			

			            	</div>

			            	<div class = "col-sm-5">

			            		<table class = "table">
			            			
			            			<thead class="cap">

			            				<th colspan = "2"><label>Contact Information</label></th>

			            			</thead>

			            			<tbody>

			            				<tr>
			            					<td><strong>Address: </strong></td>
			            					<td><?php echo $address; ?></td>
			            				</tr>

			            				<tr>
			            					<td><strong>Mobile Number: </strong></td>
			            					<td><?php echo $contactno; ?></td>
			            				</tr>

			            			</tbody>

			            		</table>

			            	</div>

						</div>

						<div class="panel-footer">
							
							<div class="text-right">
		           				<a class = "btn btn-primary" onclick = "location.href='teacher_profile_settings.php?teacherid=<?php echo $teacher_id; ?>';">Edit</a>
		           			</div>

						</div>

					</div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-body">

					<ul class="nav nav-pills nav-justified">
					  <li class="active" style="border: 1px solid gray"><a data-toggle="tab" href="#menu1">Class Schedules</a></li>
					  <li style="border: 1px solid gray"><a data-toggle="tab" href="#menu2">Lesson/s</a></li>
					  <li style="border: 1px solid gray"><a data-toggle="tab" href="#menu3">Attendance Records</a></li>
					</ul>

					<div class="tab-content">

					  	<div id="menu1" class="tab-pane fade in active"><br>
					  		
					  		<div class="table-responsive">
					  			
					  			<table class="table table-bordered table-hover">

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

											<td class="column100" data-column="column1">
												<center>9:00 - 10:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 1);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 1);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 1);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 1);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 1);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 1);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 1);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>



										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>10:00 - 11:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 2);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 2);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 2);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 2);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 2);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 2);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 2);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>



										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>11:00 - 12:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 3);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 3);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 3);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 3);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 3);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 3);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 3);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>



										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>12:00 - 1:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 4);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 4);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 4);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 4);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 4);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 4);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 4);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>



										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>1:00 - 2:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 5);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 5);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 5);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 5);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 5);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 5);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 5);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>



										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>2:00 - 3:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 6);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 6);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 6);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 6);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 6);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 6);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 6);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>


										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>3:00 - 4:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 7);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 7);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 7);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 7);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 7);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 7);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 7);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>


										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>4:00 - 5:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 8);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 8);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 8);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 8);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 8);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 8);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 8);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>



										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>5:00 - 6:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 9);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 9);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 9);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 9);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 9);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 9);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 9);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>


										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>6:00 - 7:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 10);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 10);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 10);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 10);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 10);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 10);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 10);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>


										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>7:00 - 8:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 11);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 11);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 11);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 11);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 11);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 11);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 11);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>


										<tr class="row100">

											<td class="column100" data-column="column1">
												<center>8:00 - 9:00</center>
											</td>

											<?php
											
												$query_sunday_sched = viewTeachersched($teacher_id, 7, 12);

												confirmQuery($query_sunday_sched);

												viewTeachersched2($query_sunday_sched);

												count_records($query_sunday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_monday_sched = viewTeachersched($teacher_id, 1, 12);

												confirmQuery($query_monday_sched);

												viewTeachersched2($query_monday_sched);

												count_records($query_monday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_tuesday_sched = viewTeachersched($teacher_id, 2, 12);

												confirmQuery($query_tuesday_sched);

												viewTeachersched2($query_tuesday_sched);

												count_records($query_tuesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_wednesday_sched = viewTeachersched($teacher_id, 3, 12);

												confirmQuery($query_wednesday_sched);

												viewTeachersched2($query_wednesday_sched);

												count_records($query_wednesday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_thursday_sched = viewTeachersched($teacher_id, 4, 12);

												confirmQuery($query_thursday_sched);

												viewTeachersched2($query_thursday_sched);

												count_records($query_thursday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_friday_sched = viewTeachersched($teacher_id, 5, 12);

												confirmQuery($query_friday_sched);

												viewTeachersched2($query_friday_sched);

												count_records($query_friday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

											<?php

												$query_saturday_sched = viewTeachersched($teacher_id, 6, 12);

												confirmQuery($query_saturday_sched);

												viewTeachersched2($query_saturday_sched);

												count_records($query_saturday_sched, "<td class='column100 column4' data-column='column4'><center>---</center></td>");

											?>

										</tr>

									</tbody>

								</table>

								<div class="text-right">
									<a href="#" class = "btn btn-primary" onclick = "location.href='edit_teacher_schedule.php?teacherid=<?php echo $teacher_id; ?>';">Edit</a>
								</div>

					  		</div>

					  	</div>

					  	<div id="menu2" class="tab-pane fade"><br>
					    	
					    	<table class = "table table-responsive table-bordered table-hover">

								<thead class="cap">
									<th>No</th>
									<th>Lesson</th>
									<th>Action</th>
								</thead>

								<tbody>

									<?php

										$query_teacher_lesson = teacherLesson($teacher_id);

										confirmQuery($query_teacher_lesson);

										$n = 1;

										tableNull($query_teacher_lesson, '3', 'No lessons');

										while($row = mysqli_fetch_assoc($query_teacher_lesson)){

											$tea_less_Id 	= escape($row['Tea_less_Id']);
											$lesson_id 		= escape($row['Lesson_Id']);
											$lesson_desc 	= escape($row['Lesson_desc']);
											$nooflesson		= escape($row['No_of_lesson']);
											$lesson_amount	= escape($row['Amount']);

											$the_lesson 	= "".$lesson_desc. " - " .$nooflesson." Lessons";

											echo "<tr>";
											echo "<td>".$n++."</td>";
											echo "<td>$the_lesson</td>";
											echo "<td>";

											?>

											<a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?teacherless=<?php echo $tea_less_Id; ?>&tealessid=<?php echo $teacher_id; ?>');">Delete</a>

											<?php

											echo "</td>";
											echo "</tr>";

										}

										
									?>

								</tbody>

							</table>

							<div class="text-right">
								<a href="#" class = "btn btn-success" data-toggle="modal" data-target="#addLesson">Add</a>
							</div>

					  	</div>

					  <div id="menu3" class="tab-pane fade">

					  	<div class="margin"></div>

					    <table class = "table table-responsive table-bordered table-hover" id="standardAsc">

								<thead class="cap">
		  							<th>No.</th>
		  							<th>Date</th>
		  							<th>Time</th>
		  							<th>Student</th>
		  							<th>Lesson</th>
		  						</thead>

								<tbody>

									<?php

										$query_teacher_attendance = teacherAttendance($teacher_id);

										confirmQuery($query_teacher_attendance);

										$n = 1;

										while($row = mysqli_fetch_assoc($query_teacher_attendance)){

											$date 			= escape($row['Date_att']);
		  									$time_att 		= escape($row['Time_att']);
		  									$lesson_desc 	= escape($row['Lesson_desc']);
		  									$no_of_lesson 	= escape($row['No_of_lesson']);

		  									$stud_lastname 	= escape($row['Last_name']);
		  									$stud_firstname = escape($row['First_name']);
		  									$stud_middlename= escape($row['Middle_name']);

		  									$the_student 	= "$stud_firstname $stud_middlename $stud_lastname";
		  									$the_lesson 	= "$lesson_desc - $no_of_lesson Lessons";

		  									echo "<tr>";
		  									echo "<td>".$n++."</td>";
		  									echo "<td>".date('F d, Y', strtotime($date))."</td>";
		  									echo "<td>".date('h:i A', strtotime($time_att))."</td>";
		  									echo "<td>$the_student</td>";
		  									echo "<td>$the_lesson</td>";

		  									echo "</tr>";

										}

										
									?>

								</tbody>

							</table>

					  </div>

					</div>

				</div>

			</div>

			<?php include "includes/add_lesson.php"; ?>

		</div>


		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script src = "../assets/js/popover.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<script src = "../assets/js/select2.full.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->

		<script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<!-- <script src = "scripts/messages.js"></script> -->

		<script>

			$(document).ready(function(){  

				$('#standardDesc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

				$('#standardAsc').DataTable({
					select: true,
					"order": [[ 0, "asc" ]]
				});

				$("#select2").select2({
			      allowClear: true
			    });

			});
				
		</script>

  	</body>

</html>