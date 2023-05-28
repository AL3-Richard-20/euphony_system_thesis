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

    	<title>Euphony | Schedule</title>

  	</head>

  	<body>

		<?php

			if(isset($_GET['lesson']) && isset($_GET['teacher'])){

				$filtered_lesson  = escape($_GET['lesson']);
				$filtered_teacher = escape($_GET['teacher']);
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

  			<?php include "includes/admin_navigation.php"; ?>

  			<div class = "margin"></div>

  			<div class = "panel panel-default">
  				
  				<div class  = "panel-header">

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

  				<div class = "panel-body">

  					<form method = "POST">
	  				
	  					<p><center><b>Lesson:</b> Lesson Here</center></p>
  						<p><center><b>Teacher:</b> Teacher Here</center></p><br>

  						<div class = "row">

  							<div class = "col-sm-3">

			  					<select class = "form-control" name = "filtered_lesson" id="select2">

			  						<option value = "">Select a Lesson</option>

			  						<?php 

			  							global $con;

										$query_lessons = tableQuery('lessons_tbl');	

										while($row = mysqli_fetch_array($query_lessons)){

											$lesson_id 		= escape($row['Lesson_Id']);
											$lesson_amount 	= escape($row['Amount']);
											$lesson_desc	= escape($row['Lesson_desc']);
											$lesson_no 		= escape($row['No_of_lesson']);

											echo "<option value = '$lesson_id'>$lesson_desc " . "-" . "$lesson_no" . " Lessons" . "</option>";
										}

			  						?>

			  					</select><br>

		  					</div>

		  					<div class = "col-sm-3">

			  					<select class = "form-control" name = "selected_teacher">

			  						<option value = "">Select a Teacher</option>

			  						<?php 

			  							$query = "SELECT teacher_tbl.Teacher_Id, teacher_tbl.T_Last_name, teacher_tbl.T_First_name, teacher_tbl.T_Middle_name, teacher_branch_tbl.Branch_Id FROM ";
			  							$query .="teacher_tbl LEFT JOIN teacher_branch_tbl ON ";
			  							$query .="teacher_tbl.Teacher_Id = teacher_branch_tbl.Teacher_Id LEFT JOIN branches_tbl ON branches_tbl.Branch_Id = teacher_branch_tbl.Branch_Id ";
			  							$query .="WHERE teacher_branch_tbl.Branch_Id = '$branch_id'";

			  							$query_all_teachers = mysqli_query($con, $query);

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

				  				<button type="submit" class = "btn btn-primary" name = "view_schedule" id="send">Apply</button>

		  					</div><br>
		  					
  						</div>

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

									<!-- Sunday -->
									<td class="column100 column2" data-column="column2">--</td>
									<!-- Sunday END -->

									<!-- Monday -->
									<td class="column100 column2" data-column="column3">--</td>
									<!-- Monday END -->

									<!-- Tuesday -->
									<td class="column100 column4" data-column="column4">--</td>
									<!-- Tuesday END-->

									<!-- Wednesday -->
									<td class="column100 column5" data-column="column5">--</td>
									<!-- Wednesday END-->

									<!-- Thursday -->
									<td class="column100 column6" data-column="column6">--</td>
									<!-- Thursday END -->

									<!-- Friday -->
									<td class="column100 column7" data-column="column7">--</td>
									<!-- Friday END -->

									<!-- Saturday -->
									<td class="column100 column8" data-column="column8">--</td>
									<!-- Saturday END -->
									
								</tr>
								

								<tr class="row100">
									<td class="column100 column1" data-column="column1">10:00 - 11:00</td>
									<td class="column100 column2" data-column="column2">--</td>

									<!---Monday--->
									<td class="column100 column4" data-column="column3">--</td>
									<!---Monday END--->

									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">11:00 - 12:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">12:00 - 1:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">1:00 - 2:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">2:00 - 3:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">3:00 - 4:00</td>
									<td class="column100 column2" data-column="column2">----</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">4:00 - 5:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">5:00 - 6:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">6:00 - 7:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">7:00 - 8:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

								<tr class="row100">
									<td class="column100 column1" data-column="column1">8:00 - 9:00</td>
									<td class="column100 column2" data-column="column2">--</td>
									<td class="column100 column3" data-column="column3">--</td>
									<td class="column100 column4" data-column="column4">--</td>
									<td class="column100 column5" data-column="column5">--</td>
									<td class="column100 column6" data-column="column6">--</td>
									<td class="column100 column7" data-column="column7">--</td>
									<td class="column100 column8" data-column="column8">--</td>
								</tr>

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src="../assets/js/select2.full.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->

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