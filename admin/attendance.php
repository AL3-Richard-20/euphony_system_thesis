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



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Attendance Record</title>

	</head>

	<!-- #1f262e -->
	<body>

		<?php

			if(isset($_POST['date_filter'])){

				$date_filter = $_POST['date_filter'];

			}
			else{
				$date_filter = "Today";
			}
			
		?>

		<div class="container-fluid">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">
					<div class="row">

		              	<div class="col-sm-4"><br>

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		              		<center><h3 class="cap">Attendance Record</h3></center>
		              	</div>
		            </div>
				</div>

				<div class="panel-body">

					<form method="POST">

						<div class="row">
	    					<div class="col-sm-4">	
	    						<input type="date" name="date_filter" class="form-control">
	    					</div>
	    					<div class="col-sm-4"><button class = "btn btn-primary">Apply</button></div>
	    					<div class="col-sm-4">
	    						<div class = "text-right">
					              <a style = "font-size: 15px;" href="print_attendance.php?branchid=<?php echo $branch_id; ?>&date=<?php echo $date_filter; ?>" title= "Print" class="btn btn-primary btn-sm" id="print" target="_blank">Print</a> 
					            </div><br>
	    					</div>
	    				</div><br>

	    			</form>

	    			<div class="row">

	    				<div class="text-center">

	    					<p>Attendance Record as of</p>

		    				<?php

		    					if(isset($date_filter)){

						            // $the_date  = $_GET['date'];

						            if($date_filter == 'Today'){

						            	echo "<b>" . date("F d, Y", strtotime("Today")) . "</b>";
						            }
						            else{
						            	echo "<b>".date('F d, Y',strtotime($date_filter))."</b>";
						            }

						        }
		    				?>

		    			</div>

	    			</div><br>

	    			<div class="row">
	    				
	    				<div class="col-sm-12">
	    					
		    				<div class="col-sm-3" style = "border: 2px solid #f4f4f4; background-color: #dff0d8 ">

				            	<div class="text-center">

					                <p>Present Students</p>

					                <?php

					                	if(isset($_POST['date_filter'])){

											$the_date = $_POST['date_filter'];

											$query = "SELECT A.Stud_class_Id, A.Date_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
											$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
											$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
											$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
											$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
											$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
											$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
											$query .="user_info_tbl as U, ";
											$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
											$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
											$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id ";
											$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = '$the_date' AND A.Remarks = 'Present'";
										}
										else{

											$query = "SELECT A.Stud_class_Id, A.Date_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
											$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
											$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
											$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
											$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
											$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
											$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
											$query .="user_info_tbl as U, ";
											$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
											$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
											$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id ";
											$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = curdate() AND A.Remarks = 'Present' ";
										}

										$query_present_students = mysqli_query($con, $query);

										$c_present = mysqli_num_rows($query_present_students);

										echo "<h3 id='present'>$c_present</h3>";

					                ?>

					            </div>

				            </div>

				            <div class="col-sm-3" style = "border: 2px solid #f4f4f4; background-color: #fcf8e3">

				            	<div class="text-center">

					                <p>Excused Students</p>
					               	
					               	<?php

					                	if(isset($_POST['date_filter'])){

											$the_date = $_POST['date_filter'];

											$query = "SELECT A.Stud_class_Id, A.Date_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
											$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
											$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
											$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
											$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
											$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
											$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
											$query .="user_info_tbl as U, ";
											$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
											$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
											$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id ";
											$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = '$the_date' AND A.Remarks = 'Excused'";
										}
										else{

											$query = "SELECT A.Stud_class_Id, A.Date_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
											$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
											$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
											$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
											$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
											$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
											$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
											$query .="user_info_tbl as U, ";
											$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
											$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
											$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id ";
											$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = curdate() AND A.Remarks = 'Excused' ";
										}

										$query_excused_students = mysqli_query($con, $query);

										$c_excused = mysqli_num_rows($query_excused_students);

										echo "<h3 id='excused'>$c_excused</h3>";

					                ?>

				              	</div>

				            </div>

				            <div class="col-sm-3" style = "border: 2px solid #f4f4f4; background-color: #f2dede">

				            	<div class="text-center">

					                <p>Absent Students</p>
					                
					                <?php

					                	if(isset($_POST['date_filter'])){

											$the_date = $_POST['date_filter'];

											$query = "SELECT A.Stud_class_Id, A.Date_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
											$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
											$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
											$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
											$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
											$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
											$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
											$query .="user_info_tbl as U, ";
											$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
											$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
											$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id ";
											$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = '$the_date' AND A.Remarks = 'Forfeited'";
										}
										else{

											$query = "SELECT A.Stud_class_Id, A.Date_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
											$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
											$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
											$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
											$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
											$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
											$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
											$query .="user_info_tbl as U, ";
											$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
											$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
											$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id ";
											$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = curdate() AND A.Remarks = 'Forfeited' ";
										}

										$query_absent_students = mysqli_query($con, $query);

										$c_absent = mysqli_num_rows($query_absent_students);

										echo "<h3 id='absent'>$c_absent</h3>";

					                ?>

					            </div>

				            </div>

				            <div class="col-sm-3" style = "border: 2px solid #f4f4f4">

				              	<div class="text-center">

				                	<p>Total Students</p>

					                <h3 id="total_stud">0</h3>
				                
				              	</div>

				            </div>

			           	</div>

	    			</div><hr/>

					<div class="table-responsive">
						
						<table class="table table-bordered table-hover" id="standardDesc">

							<thead class="cap">
								<th>No.</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Middle Name</th>
								<th>Lesson</th>
								<th>Teacher</th>
								<th>Remarks</th>
							</thead>

							<tbody>

								<?php

									if(isset($_POST['date_filter'])){

										$the_date = $_POST['date_filter'];

										$query = "SELECT A.Stud_class_Id, A.Date_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
										$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
										$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
										$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
										$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
										$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
										$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
										$query .="user_info_tbl as U, ";
										$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
										$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
										$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id ";
										$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = '$the_date' ";
										$query .="ORDER BY A.Time_att";
									}
									else{

										$query = "SELECT A.Stud_class_Id, A.Date_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
										$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
										$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
										$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
										$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
										$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
										$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
										$query .="user_info_tbl as U, ";
										$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
										$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
										$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id ";
										$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = curdate() ";
										$query .="ORDER BY A.Time_att";
									}

									$query_the_att = mysqli_query($con, $query);

									$count = mysqli_num_rows($query_the_att);

									confirmQuery($query_the_att);

									if($count > 0){

										$n = 1;

										while($row = mysqli_fetch_assoc($query_the_att)){

											$stud_firstname 	= $row['First_name'];
											$stud_middlename 	= $row['Middle_name'];
											$stud_lastname 		= $row['Last_name'];

											$lesson_desc 		= $row['Lesson_desc'];
											$lesson_no 			= $row['No_of_lesson'];
											$the_lesson 		= "$lesson_desc - $lesson_no Lessons";

											$t_lastname 		= $row['T_Last_name'];
											$t_first_name 		= $row['T_First_name'];
											$t_middlename 		= $row['T_Middle_name'];
											$teacher_Id 		= $row['Teacher_Id'];
											$the_teacher 		= "$t_first_name $t_middlename $t_lastname";

								    		$remarks 			= $row['Remarks'];

								    		echo "<tr>";
								    		echo "<td>".$n++."</td>";
								    		echo "<td>$stud_lastname</td>";
								    		echo "<td>$stud_firstname</td>";
								    		echo "<td>$stud_middlename</td>";
								    		echo "<td>$the_lesson</td>";
								    		echo "<td><a href='edit_teacher.php?teacherid=$teacher_Id'>$the_teacher</td>";

								    		if($remarks == 'Present'){
		  										echo "<td class='alert alert-success'>$remarks</td>";
		  									}
		  									else if($remarks == 'Forfeited'){
												echo "<td class='alert alert-danger'>$remarks</td>";
		  									}
		  									else if($remarks == 'Excused'){
												echo "<td class='alert alert-warning'>$remarks</td>";
		  									}
		  									
								    		echo "</tr>";
										}

									}

									else{

										echo "<script>document.getElementById('print').className='hidden';</script>";
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

		<!-- <script src = "../assets/js/jquery.tabledit.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->



		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script>
			
			$(document).ready(function(){

				var present = Number(document.getElementById('present').innerHTML);
				var excused = Number(document.getElementById('excused').innerHTML);
				var absent 	= Number(document.getElementById('absent').innerHTML);

				var total_stud = present + excused + absent;

				document.getElementById('total_stud').innerHTML = total_stud;

				$('#standardDesc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

			})

		</script>

	</body>

</html>		