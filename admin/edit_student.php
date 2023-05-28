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

		<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Student Information</title>

	</head>

  	<body>

  		<?php include "includes/admin_navigation.php"; ?>
  		
  		<?php

  			// ================ Student Profile ====================

			if(isset($_GET['userid'])){
				
	  			$user_id = $_GET['userid'];

	  			$query_selected_student = studInfo($user_id);

	  			while($row = mysqli_fetch_assoc($query_selected_student)){

	  				//stud_tbl
		  			$lastname 		= escape($row['Last_name']);
		  			$firstname 		= escape($row['First_name']);
		  			$middlename 	= escape($row['Middle_name']);
		  			$age 			= escape($row['Age']);
		  			$address 		= escape($row['Address']);
		  			$birthdate 		= escape($row['Birthdate']);
		  			$sex 			= escape($row['Sex']);
		  			$contactno 		= escape($row['Contact_no']);
		  			$nationality 	= escape($row['Nationality']);
		  			$profile_img 	= escape($row['Profile_img']);
		  			$status 		= escape($row['Status']);
		  			$verified 		= escape($row['verified']);
		  			//stud_tbl END

		  			$fullname 	= "$firstname $middlename $lastname";
		  			$fullname2 	= "$firstname $lastname";

	  			}

	  			$query_stud_selected_class = selectedClass($user_id);

	  			$check = mysqli_num_rows($query_stud_selected_class);

				if($check == NULL){

					echo "<script>sweetAlertParam('question', 'This student has no class yet', 'Do you want to add lesson and schedule?', 'Yes', 'No', 'Redirecting..', 'Please Wait', '', 'add_stud_lesson.php?user_id=$user_id', 'students.php');</script>";
				}

  			}
  			// ====================== Student Profile ======================


  			// =============================== Change Lesson ==================================
  			if(isset($_POST['lesson'])){

				$new_lesson = escape($_POST['lesson']);

				$query = "UPDATE selected_class_tbl SET Lesson_Id = '{$new_lesson}' ";
				$query .= "WHERE User_Id = '{$user_id}'";
				$query_update_lesson = mysqli_query($con, $query);

				confirmQuery($query_update_lesson);

				if($query_update_lesson == 1){

  					$query_class_id = "SELECT * FROM stud_class_tbl WHERE User_Id = '$user_id' ";
  					$query_class_id .="AND randSalt2 = '1'";

  					$get_class_id 	= mysqli_query($con, $query_class_id);

  					$count_records = mysqli_num_rows($get_class_id);

					if($count_records == NULL){

						$query2 = "UPDATE stud_class_tbl SET randSalt2 = 0 WHERE User_Id = '$user_id' ";
	  					$query_update_class = mysqli_query($con, $query2);

	  					confirmQuery($query_update_class);

	  					$query3 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
						$query3 .="VALUES (curdate(), curtime(), '$fullname2 changed a lesson - administrator', '$user_id') ";
						$add_to_logs = mysqli_query($con, $query3);

						confirmQuery($add_to_logs);

	  					echo "<script>sweetAlert('success', 'Successfully Updated!', 'You changed the lesson', 'edit_student.php?userid=$user_id/#lessons');</script>";

					}

					else{

	  					while($row = mysqli_fetch_assoc($get_class_id)){

	  						$fetched_class_id = escape($row['Class_Id']);

	  						$query2 = "UPDATE class_tbl SET Status = 'Available' WHERE Class_Id = '$fetched_class_id'";
	  						$query_update_status = mysqli_query($con, $query2);

	  					}

	  					if($query_update_status == 1){

		  					$query3 = "UPDATE stud_class_tbl SET randSalt2 = 0 WHERE User_Id = '$user_id' ";
		  					$query_update_class = mysqli_query($con, $query3);

		  					confirmQuery($query_update_class);

		  					$query4 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
							$query4 .="VALUES (curdate(), curtime(), '$fullname2 changed a lesson - Administrator', '$user_id') ";
							$add_to_logs = mysqli_query($con, $query4);

							confirmQuery($add_to_logs);

		  					echo "<script>sweetAlert('success', 'Successfully Updated!', 'You changed the lesson', 'edit_student.php?userid=$user_id/#lessons');</script>";
		  				}

	  				}

  				}
			}
			// =============================== Change Lesson ==================================







			// =============================== Edit Schedule ==================================
			if(isset($_POST['edit_time'])){

  				$the_day 	= escape($_POST['edit_day']);
  				$the_time 	= escape($_POST['edit_time']);

  				$query = "UPDATE selected_class_tbl SET the_Day = '{$the_day}', the_Time = '{$the_time}' ";
  				$query .="WHERE User_Id = '{$user_id}'";

  				$query_update_schedule = mysqli_query($con, $query);

  				confirmQuery($query_update_schedule);

  				if($query_update_schedule == 1){

  					$query_class_id = "SELECT * FROM stud_class_tbl WHERE User_Id = '{$user_id}' ";
  					$query_class_id .="AND randSalt2 = 1";

  					$get_class_id 	= mysqli_query($con, $query_class_id);

  					while($row = mysqli_fetch_assoc($get_class_id)){

  						$fetched_class_id = escape($row['Class_Id']);
  					}

  					$query2 = "UPDATE class_tbl SET Status = 'Available' WHERE Class_Id = '{$fetched_class_id}'";
  					$query_update_status = mysqli_query($con, $query2);

  					confirmQuery($query_update_status);

  				}

  				if($query_update_status == 1){

  					$query3 = "UPDATE stud_class_tbl SET randSalt2 = 0 WHERE Class_Id = '$fetched_class_id'";
  					$query_update_stud_class = mysqli_query($con, $query3);

  					confirmQuery($query_update_stud_class);

  					$query4 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
					$query4 .="VALUES (curdate(), curtime(), '$fullname2 changed a schedule - administrator', '$user_id') ";
					$add_to_logs = mysqli_query($con, $query4);

					confirmQuery($add_to_logs);

  					echo "<script>sweetAlert('success', 'Successfully Updated', 'You changed the schedule', 'edit_student.php?userid=$user_id/#lessons');</script>";
  				}

  			}
  			// =============================== Edit Schedule ==================================






  			//============================== Payment Balances ===============================
  			if(isset($_POST['pay_amount'])){

  				$or_no		= escape($_POST['or_no']);
  				$ar_no		= escape($_POST['ar_no']);
  				$the_balance= escape($_POST['balance']);
  				$balance 	= escape($_POST['total_balance_2']);
  				$amount 	= escape($_POST['pay_amount']);
  				$discount 	= escape($_POST['pay_discount']);
  				$change 	= escape($_POST['pay_change1']);
  				$payment 	= escape($_POST['payment']);

  				$query = "INSERT INTO stud_balances (User_Id, The_balance, Date, Trans_time, Cash_tendered, Total_balance, Discount, The_change, OR_no, AR_no, Payment, randSalt9) ";
  				$query .="VALUES ('$user_id', '$the_balance', curdate(), curtime(), '$amount', '$balance', '$discount', '$change', '$or_no', '$ar_no', '$payment', 1) ";

  				$query_pay_balance = mysqli_query($con, $query);

  				$last_id = mysqli_insert_id($con);

  				confirmQuery($query_pay_balance);

  				$query2 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
				$query2 .="VALUES (curdate(), curtime(), '$fullname2 pay for balance (O.R: $or_no / A.R: $ar_no) - administrator', '$user_id') ";
				$add_to_logs = mysqli_query($con, $query2);

				confirmQuery($add_to_logs);

  				echo "<script>sweetAlert('success', 'Payment Success', 'You can now finalize the transaction', 'SB_process_payment.php?transid=$last_id');</script>";
  			}
  			//============================== Payment Balances END ===============================





  			//================================ Assigning teacher ===============================
  			if(isset($_POST['assign_teacher'])){

  				$the_class_id = escape($_POST['assign_teacher']);

  				$query = "INSERT INTO stud_class_tbl (Class_Id, User_Id, randSalt2) ";
  				$query .="VALUES ('$the_class_id', '$user_id', '1')";

  				$add_class = mysqli_query($con, $query);

  				confirmQuery($add_class);

  				if($add_class == 1){

  					$query2 = "UPDATE stud_status_tbl SET Status = 'Official', ";
  					$query2 .="Date_started = curdate() ";
  					$query2 .="WHERE User_Id = '{$user_id}'";
  					
  					$change_to_official = mysqli_query($con, $query2);

  					confirmQuery($change_to_official);
  				}

  				if($change_to_official == 1){

  					$query3 = "UPDATE class_tbl SET Status = 'Occupied' WHERE Class_Id = '{$the_class_id}'";
  					$change_to_occupied = mysqli_query($con, $query3);

  					confirmQuery($change_to_occupied);
  				}

  				echo "<script>sweetAlert('success', 'Success', 'You assigned a teacher', 'edit_student.php?userid=$user_id/#lessons');</script>";
  			}
  			//=============================== Assigning teacher END =============================






  			// ==================== Adding Attendance ============================
  			if(isset($_POST['remarks'])){

  				$the_stud_class_id	= $_POST['stud_class_id'];
  				$the_date 			= $_POST['the_date']; 
  				$remarks 			= $_POST['remarks'];

  				if($the_stud_class_id == 0){
  					echo "<script>sweetAlert('error', 'Cannot be done', 'No teacher assigned', 'edit_student.php?userid=$user_id');</script>";
  				}

  				else{
  					$query = "INSERT INTO attendance_tbl (Stud_class_Id, Date_att, Time_att, User_Id, Remarks) ";
	  				$query .="VALUES ('$the_stud_class_id', '$the_date', curtime(), '$user_id', '$remarks') ";

	  				$query_add_attendance = mysqli_query($con, $query);

	  				confirmQuery($query_add_attendance);

	  				$query2 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
					$query2 .="VALUES (curdate(), curtime(), '$fullname2 marked as $remarks - administrator', '$user_id') ";
					$add_to_logs = mysqli_query($con, $query2);

					confirmQuery($add_to_logs);

	  				echo "<script>sweetAlert('success', 'Success', 'Attendance was recorded', 'edit_student.php?userid=$user_id');</script>";
  				}
  				

  			}
  			//"Checked by" not finished
  			// ========================== Adding Attendance END =====================
	
	  	?>







  		<div class = "container-fluid">	

  			<div class = "margin"></div>

  			<div class="row">

  				<div class="col-sm-12">

		  			<div class="panel panel-default">

		  				<div class="panel-header">

				          	<div class="row">

					            <div class="col-sm-4">

					                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='students.php'"><span class="fa fa-arrow-left"></span></button>

					            </div>

				            	<div class="col-sm-4">

				              		<center><h3 class="cap">Student Information</h3></center>

				            	</div>

				            	<div class="col-sm-4"></div>

				          	</div>

				        </div>

				        <div class="panel-body">

							<div class="col-sm-3" onclick="location.href='add_profile_pic.php?userid=<?php echo $user_id; ?>&sex=<?php echo $sex; ?>&profileimg=<?php echo $profile_img; ?>';">

								<?php profileImg($profile_img, $sex); ?>

			            	</div><br>

			            	<div class="col-sm-4">

			            		<table class="table">

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

			            	<div class="col-sm-5">

			            		<table class="table">
			            			
			            			<thead class="cap">

			            				<th colspan = "2"><label>Contact Information</label></th>

			            			</thead>

			            			<tbody>

			            				<tr>
			            					<td><strong>Address: </strong></td>
			            					<td><?php echo $address; ?></td>
			            				</tr>

			            				<tr>
			            					<td><strong>Contact Number: </strong></td>
			            					<td><?php echo $contactno; ?></td>
			            				</tr>

			            				<tr>
			            					<td><strong>Status</strong></td>
			            					<td>
			            						<?php

													if($status == 'Pending'){
														echo "<p><span class='label label-info'>$status</span></p>";
													}
													else if($status == 'Official'){
														echo "<p><span class='label label-success'>$status</span></p>";
													}
													if($status == 'Declined'){
														echo "<p><span class='label label-danger'>$status</span></p>";
													}
												?>
											
											</td>
			            				</tr>

			            			</tbody>

			            		</table>

			            		<table class = "table">
		            			
			            			<thead class="cap">

			            				<th colspan = "2"><label>Account</label></th>

			            			</thead>

			            			<tbody>

			            				<tr>
			            					<td><strong>Status: </strong></td>

			            					<?php

				            					if($verified == 1){
				            						echo "<td><label class='label label-success'>Verified</label></td>";
				            					}
				            					else{
				            						echo "<td><label class='label label-danger'>Not Verified</label></td>";
				            					}

			            					?>
			            					
			            				</tr>

			            			</tbody>

		            			</table>

			            	</div>

						</div>

						<div class="panel-footer" id="lessons">
							
							<div class="text-right">
		           				<a class = "btn btn-primary" onclick = "location.href='stud_profile_settings.php?userid=<?php echo $user_id; ?>';">Edit</a>
		           			</div>

						</div>

					</div>

				</div>

			</div>






				<div class="panel panel-default">
					
					<div class="panel-body">
						
						<ul class="nav nav-pills nav-justified">
						  	<li class="active" style="border: 1px solid gray"><a data-toggle="pill" href="#menu1">Lesson & Schedule</a></li>
						  	<li style="border: 1px solid gray"><a data-toggle="pill" href="#menu2">Attendance Records</a></li>
						  	<li style="border: 1px solid gray"><a data-toggle="pill" href="#menu3">Payment and Balances</a></li>
						  	<li style="border: 1px solid gray"><a data-toggle="pill" href="#menu4">Achievements</a></li>
						  	<li style="border: 1px solid gray"><a data-toggle="pill" href="#menu5">Activity Logs</a></li>
						</ul>

						<div class="tab-content">



	<!--- =================== Lesson =================== --->

  	<div id="menu1" class="tab-pane fade in active"><br>

		<div class="col-sm-6">	

			<div class="panel panel-default">

				<div class="panel-header">
					<center>
						<h3 class="cap">Lesson 
							<a href="#" data-toggle="modal" data-target="#myModal" class="text-right" title="Edit Account"></a>
						</h3>
					</center>
				</div>

				<?php

					$query_selected_class = selectedClass($user_id);

					confirmQuery($query_selected_class);

					while($row = mysqli_fetch_assoc($query_selected_class)){

						$lesson_Id 		= escape($row['Lesson_Id']);
						$lesson_desc	= escape($row['Lesson_desc']);
						$lesson_amount 	= escape($row['Amount']);
						$nooflesson 	= escape($row['No_of_lesson']);
						$day_id 		= escape($row['Day_Id']);
						$day 			= escape($row['Day']);
						$time 			= escape($row['Time']);
						$time_id 		= escape($row['Time_Id']);
						$time_end 		= escape($row['Time_end']);
						$icon 			= escape($row['Icon']);
						$randSalt 		= escape($row['randSalt']);

						$full_time = "$time - $time_end $randSalt";
					}

				?>

				<div class="panel-body">

					<div class="col-sm-3">

						<?php 

							if(isset($icon)){

								?>

								<center><img src="../images/lessons/Icon/<?php echo $icon; ?>" class="img-circle img-responsive" alt="photo" id="profileimg"></center>

								<?php
							}

							else{

								?>

								<center><img src="../images/lessons/Icon/Guitar.png" class="img-circle img-responsive" alt="photo" id="profileimg"></center>

								<?php
							}

						?>
						
					</div>

					<div class="col-sm-9">

						<div class="table-responsive">

							<table class="table">

								<tbody>

									<?php 

										if(isset($lesson_desc) && isset($lesson_desc) && isset($lesson_desc)){

											?>

											<tr>	
												<td><b>Lesson: </b></td>
												<td><?php echo $lesson_desc; ?></td>
											</tr>

											<tr>
												<td><b>Sessions: </b></td>
												<td><?php echo $nooflesson; ?> Lessons</td>
											</tr>

											<tr>
												<td><b>Price: </b></td>
												<td><?php echo number_format($lesson_amount,2); ?> PHP</td>
											</tr>

											<?php

										}

										else{

											?>

											<tr>	
												<td><b>Lesson: </b></td>
												<td>---</td>
											</tr>

											<tr>
												<td><b>Sessions: </b></td>
												<td>---</td>
											</tr>

											<tr>
												<td><b>Price: </b></td>
												<td>---</td>
											</tr>

											<?php
										}

									?>

								</tbody>

							</table>

						</div>

					</div>

				</div>

				<div class="panel-footer">

					<div class="text-right">

						<?php 

							if(isset($lesson_Id)){

								?>

								<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="change_lesson_btn">Change</a>

								<?php
							}

						?>

					</div>

				</div>

			</div>

			<?php include "includes/edit_class.php"; ?>

		</div>

		<!--- =================== Lesson END =================== --->





		<!---=================== Schedule ===================--->
		<div class="col-sm-6">	

			<div class="panel panel-default">

				<div class="panel-header">
					<center><h3 class="cap">Class Schedule</h3></center>
				</div>

				<div class="panel-body">

					<table class="table table-responsive table-bordered table-hover">

						<thead class="cap">
							<th>Day</th>
							<th>Time</th>
							<th>Teacher</th>
							<th><center>Action</center></th>
						</thead>

						<tbody>

							<tr>
								<td>

									<?php
										if(isset($day)){ 
											echo $day; 
										}
										else{
											echo "None";
										}
									?>
										
								</td>

								<td>

									<?php 
										if(isset($full_time)){
											echo $full_time; 
										}
										else{
											echo "None";
										}
									?>
										
								</td>

								<?php

									if(isset($lesson_Id)){

										$query_stud_lesson = studClass($user_id, $lesson_Id);

										confirmQuery($query_stud_lesson);

										$count = mysqli_num_rows($query_stud_lesson);

										if($count > 0){

											while($row = mysqli_fetch_assoc($query_stud_lesson)){

												$stud_class_Id  = escape($row['Stud_class_Id']);
												$class_Id 		= escape($row['Class_Id']);
												$teacher_id 	= escape($row['Teacher_Id']);
												$t_last_name 	= escape($row['T_Last_name']);
												$t_first_name 	= escape($row['T_First_name']);
												$t_middle_name 	= escape($row['T_Middle_name']);

												$t_fullname = "".$t_first_name. " " .$t_last_name. "";

												echo "<td>";
												echo "<a href='edit_teacher.php?teacherid=$teacher_id'>$t_fullname</a>";
												echo "</td>";
											}

										}

										else{
											echo "<td>None</td>";
										}

										?>

										<td>
											<center><a href="" class = "btn btn-default" data-toggle="modal" data-target="#assignTeacher" id = "assign_teacher_btn">Assign</a>
											<a href="view_schedule.php?lesson=<?php echo $lesson_Id; ?>&teacher=<?php echo $teacher_id; ?>" class = "btn btn-warning" id = "view_sched_btn">View</a></center>
										</td>

										<?php

									}

									else{
										echo "<td>No teacher</td>";
										echo "<td><center>---<center></td>";
									}
								?>

								

							</tr>

						</tbody>
						
					</table>

				</div>

				<div class="panel-footer">

					<div class="text-right">

						<?php 

							if(isset($lesson_Id)){

								?>

								<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#changeSched" id="change_sched_btn">Change</a>

								<?php

							}

						?>

					</div>

				</div>

			</div>

		</div>
		

		<?php include "includes/edit_sched.php"; ?>
		<?php include "includes/assign_teacher.php"; ?>

	</div>

	<!--- =================== Schedule END ========================== --->





	<!--- =================== Attendance =================== --->

	<div id="menu2" class="tab-pane fade"><br>
						    
		<div class="table-responsive">

			<table class = "table table-hover table-bordered" id = "standardDesc">

				<thead class="cap">
					<tr>
						<th>No.</th>
						<th>Date</th>
						<th>Time</th>
						<th>Lesson</th>
						<th>Teacher</th>
						<th>Remarks</th>
						<th>Action</th>
					</tr>
				</thead>

				<div class="row">

					<div class="col-sm-4"></div>

					<div class="col-sm-4"></div>

					<div class="col-sm-4 text-right">
						<a href="#" class = "btn btn-success" id = "attendance_btn" data-toggle="modal" data-target="#addAttendance">Add</a>
						<a href="#" class = "hidden" id = "complete_btn">Complete</a>
						<a href ="print_student_attendance.php?branchid=<?php echo $branch_id; ?>&userid=<?php echo $user_id;?>" class = 'btn btn-primary' id = 'print' target='_blank'>Print</a>
					</div>

				</div>

				<tbody>

					<?php

						if($status == 'Pending' || $status == 'Declined'){

							echo "<script>document.getElementById('attendance_edit').className='hidden';</script>";
							echo "<script>document.getElementById('attendance_btn').className='hidden';</script>";
							echo "<script>document.getElementById('print').className = 'hidden';</script>";
						}

						$att_count = attendanceCount($user_id);

						$count_records = mysqli_num_rows($att_count);

						if(isset($nooflesson)){

							if($count_records == $nooflesson){

								echo "<script>document.getElementById('attendance_btn').className = 'hidden';</script>";

								echo "<script>sweetAlertParam('info', 'Course Completed', 'Do you want to add $firstname to graduates?', 'Yes', 'No', 'Success', '$firstname was added to Graduates', '', 'add_candidate.php?userid=$user_id', '#');</script>";

								echo "<center><p class='cap'>Lessons taken: <h3 style='color: green'><b>".$count_records."/".$nooflesson."</b></h3></p><center>";
							}

							else if($count_records > 0){

								echo "<center><p class='cap'>Lessons taken: <h3 style='color: green'><b>".$count_records."/".$nooflesson."</b></h3></p><center>";

							}

							else if($count_records == NULL){

								echo "<script>document.getElementById('print').className = 'hidden';</script>";

								echo "<center><p class='cap'>Lessons taken: <h3 style='color: #d02737'><b>".$count_records."/".$nooflesson."</b></h3></p><center>";
							}	
						}

						$query_stud_att = studAttendance($user_id);

						confirmQuery($query_stud_att);

						$n = 1;

						while($row = mysqli_fetch_assoc($query_stud_att)){

							$att_Id 		= escape($row['Att_Id']);
							$date 			= escape($row['Date_att']);
							$time_att 		= escape($row['Time_att']);
							$remarks 		= escape($row['Remarks']);
							$lesson_desc 	= escape($row['Lesson_desc']);
							$no_of_lesson 	= escape($row['No_of_lesson']);

							$teacher_id 	= escape($row['Teacher_Id']);
			  				$t_lastname 	= escape($row['T_Last_name']);
			  				$t_firstname 	= escape($row['T_First_name']);
			  				$t_middlename 	= escape($row['T_Middle_name']);

							$the_lesson 	= "$lesson_desc - $no_of_lesson Lessons";
							$the_teacher	= "$t_firstname $t_middlename $t_lastname";

							echo "<tr>";
							echo "<td>".$n++."</td>";
							echo "<td>".date('M d, Y', strtotime($date))."</td>";
							echo "<td>".date('h:i A', strtotime($time_att))."</td>";
							echo "<td>$the_lesson</td>";
							echo "<td><a href='edit_teacher.php?teacherid=$teacher_id'>$the_teacher</a></td>";

							if($remarks == 'Present'){
								echo "<td class='alert alert-success'>$remarks</td>";
							}
							else if($remarks == 'Forfeited'){
								echo "<td class='alert alert-danger'>$remarks</td>";
							}
							else if($remarks == 'Excused'){
								echo "<td class='alert alert-warning'>$remarks</td>";
							}

							echo "<td>";

							if($date != date('Y-m-d')){
								echo "Not Available ";
							}

							else if($date == date('Y-m-d')){

								?>

								<a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?studatt=<?php echo $att_Id; ?>&studattid=<?php echo $user_id; ?>');">Delete</a>

								<?php

							}

							echo "</td>";

							echo "</tr>";

						}

					?>

					</tbody>

				</table>

			</div>

		<?php include "includes/add_attendance.php"; ?>

	</div>

	<!---================== Attendance END =================== --->







	<!---================== Payment Balances =================== --->

  	<div id="menu3" class="tab-pane fade"><br>

	<table class="table table-responsive table-bordered table-hover" id="standardAsc">

		<thead class="cap">
			<th>No</th>
			<th>Date</th>
			<th>Time</th>
			<th>OR</th>
			<th>AR</th>
			<th>Cash</th>
			<th>Discount</th>
			<th>Change</th>
			<th>Balance</th>
			<th>Payment</th>
			<th>Action</th>
		</thead>

		<div class="row">

			<div class="col-sm-4"></div>

			<div class="col-sm-4"></div>

			<div class="col-sm-4 text-right">
				<a href="" class="btn btn-success" id="pay_btn" data-toggle="modal" data-target="#paymentModal">Pay</a>
				<a href ='print_student_payments.php?branchid=<?php echo $branch_id; ?>&userid=<?php echo $user_id; ?>' class = 'btn btn-primary' id="balance_print" target="_blank">Print</a>
			</div>

		</div><br>
		
		<tbody>

			<?php

				if(!isset($lesson_Id)){
					echo "<script>document.getElementById('pay_btn').className = 'hidden';</script>";
				}

				$query_stud_balances = studBalances($user_id);

				$count_trans = mysqli_num_rows($query_stud_balances);
				
				confirmQuery($query_stud_balances);

				if($count_trans == NULL){

					echo "<script>document.getElementById('balance_print').className = 'hidden';</script>";

				}

				else{

					$n = 1;

					while($row = mysqli_fetch_assoc($query_stud_balances)){

						$trans_Id 		= escape($row['Transaction_Id']);
						$or_no 			= escape($row['OR_no']);
						$ar_no 			= escape($row['AR_no']);
						$trans_date 	= escape($row['Date']);
						$trans_time 	= escape($row['Trans_time']);
						$amount_paid	= escape($row['Cash_tendered']);
						$balance 		= escape($row['Total_balance']);
						$b_discount		= escape($row['Discount']);
						$b_change 		= escape($row['The_change']);
						$payment 		= escape($row['Payment']);

						echo "<tr>";
						echo "<td>".$n++."</td>";
						echo "<td>".date('M d, Y', strtotime($trans_date))."</td>";
						echo "<td>".date('h:i A', strtotime($trans_time))."</td>";
						echo "<td><a href='SB_receipt_or.php?transid=$trans_Id' target='_blank'>$or_no</a></td>";
			        	echo "<td><a href='SB_receipt_ar.php?transid=$trans_Id' target='_blank'>$ar_no</a></td>";
						echo "<td>".number_format($amount_paid,2)." PHP</td>";
						echo "<td>$b_discount %</td>";
						echo "<td>".number_format($b_change,2)." PHP</td>";
						echo "<td>".number_format($balance,2)." PHP</td>";

						echo "<td>$payment</td>";
						echo "<td>";

							if($trans_date != date('Y-m-d')){
								echo "Not Available ";
							}
							
							else if($trans_date == date('Y-m-d')){

								?>

								<a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?studpay=<?php echo $trans_Id; ?>&studpayid=<?php echo $user_id; ?>');">Delete</a>

								<?php
							}

						echo "</td>";
						echo "</tr>";
						
					}

					//Cash Tendered (No Discount)
					$sum_cash_tendered = "SELECT SUM(Cash_tendered - The_change) AS Total FROM stud_balances ";
					$sum_cash_tendered .="WHERE randSalt9 = 1 AND User_Id = '{$user_id}' ";

					$query_sum_cash_tendered = mysqli_query($con, $sum_cash_tendered);

					confirmQuery($query_sum_cash_tendered);

					while($row = mysqli_fetch_assoc($query_sum_cash_tendered)){

						$total_cash_tendered = escape($row['Total']);
					}
					//Cash Tendered (No Discount) END

				}
				
			?>

		</tbody>
		
	</table><br>

	<div class="text-right">

		<p>Total Balance: 

		<b style="font-size:20px; color: #d02737">

		<?php

			if(isset($balance) || isset($lesson_amount)){

				if(isset($total_cash_tendered) && isset($lesson_amount)){

					if($total_cash_tendered >= $lesson_amount){
						echo "<span class='label label-success'>Paid</span>";
						echo "<script>document.getElementById('pay_btn').className = 'hidden';</script>";
					}

					else{
						
						$sum = $lesson_amount - $total_cash_tendered;

						if($sum == 0){
							echo "<span class='label label-success'>Paid</span>";
							echo "<script>document.getElementById('pay_btn').className = 'hidden';</script>";
						}
						
						else{
							echo "P" .number_format($sum,2). "";
						}
						
					}
				}

				else{

					if(isset($total_cash_tendered)){

						if($total_cash_tendered == 0){

							if(isset($lesson_amount)){
								echo "P".$lesson_amount. "";
							}
							
							else{
								echo "P0";
							}
						}
					}

					else{
						echo "P".number_format($lesson_amount,2). "";
					}
				}
				
			}

		?>

		</b>

		</p>

	</div>

  </div>

  <!---================== Payment Balances END =================== --->

  <!-- ===================== Achievements ============================  -->

  	<div id="menu4" class="tab-pane fade"><br>

  		<div class="table-responsive">

  			<table class="table table-bordered table-hover" id="achievements">

  				<thead class="cap">
  					<th>No.</th>
  					<th>Lesson</th>
  					<th>Date Started</th>
  					<th>Date Completed</th>
  					<th>Action</th>
  				</thead>

  				<tbody>

  					<?php 

  						$query = "SELECT user_info_tbl.Last_name, ";
						$query .="user_info_tbl.User_Id, ";
						$query .="lessons_tbl.Lesson_desc, ";
						$query .="lessons_tbl.No_of_lesson, ";
						$query .="selected_class_tbl.Selected_class_Id, ";
						$query .="selected_class_tbl.Date_completed, ";
						$query .="selected_class_tbl.Date_started ";
						$query .="FROM user_info_tbl LEFT JOIN ";
						$query .="selected_class_tbl ON ";
						$query .="selected_class_tbl.User_Id ";
						$query .="= user_info_tbl.User_Id LEFT JOIN ";
						$query .="lessons_tbl ON selected_class_tbl.Lesson_Id ";
						$query .="=lessons_tbl.Lesson_Id WHERE ";
						$query .="user_info_tbl.User_Id = '$user_id' AND ";
						$query .="selected_class_tbl.Status = 'Completed'";

						$achievements = mysqli_query($con, $query);

						confirmQuery($achievements);

						$n = 1;

						while($row = mysqli_fetch_assoc($achievements)){

							$stud_Id 		= escape($row['User_Id']);
							$graduate_Id 	= escape($row['Selected_class_Id']);
							$lesson_descr 	= escape($row['Lesson_desc']);
							$lesson_number 	= escape($row['No_of_lesson']);
							$the_lesson 	= "$lesson_descr - $lesson_number Lessons";
							$date_started 	= $row['Date_started'];
							$date_completed = $row['Date_completed'];

							echo "<tr>";
  							echo "<td>".$n++."</td>";
  							echo "<td>$the_lesson</td>";
  							echo "<td>".date('F d, Y', strtotime($date_started))."</td>";
  							echo "<td>".date('F d, Y', strtotime($date_completed))."</td>";
  							echo "<td><center><a href='cert_of_completion.php?studid=$stud_Id&branchid=$branch_id&gradid=$graduate_Id' class='btn btn-success' id='print' target='_blank'>Print</a></td>";
  							echo "</tr>";

						}

  					?>

  				</tbody>

  			</table>

  		</div>

  	</div>







  	<!-- ============================== Activity Logs ========================= -->
  	<div id="menu5" class="tab-pane fade"><br>

  		<div class="table-responsive">

  			<table class="table table-bordered table-hover" id="logs">

  				<thead class="cap">
  					<th>No.</th>
  					<th>Date</th>
  					<th>Time</th>
  					<th>Detail</th>
  				</thead>

  				<tbody>
  					<?php

  						$query_activities = tableQuery_3('activity_log', 'User_Id', $user_id);

  						confirmQuery($query_activities);

  						$n = 1;

  						while($row = mysqli_fetch_assoc($query_activities)){

  							$act_date 	= escape($row['Date']);
  							$act_time 	= escape($row['Time']);
  							$act_detail	= escape($row['Detail']);

  							echo "<tr>";
  							echo "<td>".$n++."</td>";
  							echo "<td>".date('F d, Y', strtotime($act_date))."</td>";
  							echo "<td>".date('h:i A', strtotime($act_time))."</td>";
  							echo "<td>$act_detail</td>";
  							echo "</tr>";
  						}

  					?>
  				</tbody>

  			</table>

  		</div>


  	</div>

						</div>
						

					</div>

				</div>

  		</div>

  		<?php include "includes/payment_modal.php"; ?>



  		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

  		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  		<script src = "../assets/parsely/parsley.js"></script>

  		<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>

  		<script src="../assets/js/select2.full.min.js"></script>



  		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->



		<!-- <script src = "../assets/validator/validator.js"></script>

		<script src = "../assets/validator/validate.js"></script> -->

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script type="text/javascript">

			$(document).ready(function(){

				$('#standardDesc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

				$('#standardAsc').DataTable({
					select: true,
					"order": [[ 0, "asc" ]]
				});

				$('#achievements').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

				$('#logs').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

				$("#select2").select2({
			      allowClear: true
			    });
		      
			    $('#orno').parsley();

			    window.ParsleyValidator.addValidator('checkor', {
			      validateString: function(value)
			      {
			        return $.ajax({
			          url:'fetch_or.php',
			          method:"POST",
			          data:{orno:value},
			          dataType:"json",
			          success:function(data)
			          {
			            return true;
			          }
			        });
			      }
			    });

			    $('#arno').parsley();

			    window.ParsleyValidator.addValidator('checkar', {
			      validateString: function(value)
			      {
			        return $.ajax({
			          url:'fetch_ar.php',
			          method:"POST",
			          data:{arno:value},
			          dataType:"json",
			          success:function(data)
			          {
			            return true;
			          }
			        });
			      }
			    });

		  	});

		  	$('input').keyup(function(){ // run anytime the value changes

			    var balance 	= Number($('#balance').val()); // get value of field
			    var discount 	= $('#pay_discount').val();
			    var amount  	= parseFloat($('#pay_amount').val()); // convert it to a float
			    var change 		= Number($('#pay_change').val());

			    var total = (balance - amount);

			    var discounted = amount-((amount * discount) / 100);

			    var final_change = (amount - discounted);

			    var change_2 = (amount - balance);

			    if(amount > balance){

			    	document.getElementById('total_balance').innerHTML = 0;
			    	document.getElementById('total_balance_2').value = 0;

			    	if(discount != 0){

			    		var sum = change_2 + final_change;

						document.getElementById('pay_change').value = sum || 0;
				    	document.getElementById('pay_change2').value = sum || 0;
				    	
				    }

				    //If there are discount
				    else{

				    	//Display the change
				    	document.getElementById('pay_change').value = change_2 || 0;
				    	document.getElementById('pay_change1').value = change_2 || 0;
				     	document.getElementById('pay_change2').value = change_2 || 0;
				     	//End
				    }

			    }

			    else{

			    	//Display total balance
				    document.getElementById('total_balance').innerHTML = total || 0 + " PHP";
				    document.getElementById('total_balance_2').value = total || 0 + " PHP";
				    //End

			    	if(discount != 0){

						document.getElementById('pay_change').value = final_change || 0;
				    	document.getElementById('pay_change2').value = final_change || 0;
			    	}
			    	else{

			    		document.getElementById('pay_change').value = 0;
				    	document.getElementById('pay_change2').value = 0;
			    	}

			    	
				}

			});

			$('#clear').click(function(){
          	
          		var balance 	= Number($('#balance').val());

	          	document.getElementById('orno').value = '';
	          	document.getElementById('arno').value = '';
	          	document.getElementById('pay_amount').value = '';
	          	document.getElementById('pay_discount').value = '0';
	          	document.getElementById('pay_change2').value = '0';
	          	document.getElementById('total_balance').innerHTML = balance;

	        });

	        $('.lessondd').change(function(){

				var lessonid = $('.lessondd').val();

				$.ajax({

					url:'fetch_amount.php',
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

			});

		</script>

  	</body>

  	<?php include "../includes/footer.php"; ?>

</html>


