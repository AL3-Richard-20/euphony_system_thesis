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

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<link rel = "stylesheet" type="text/css" href = "../assets/font/css/all.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<link rel = "stylesheet"  type="text/css" href="../assets/datatables/datatables.min.css"/>

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

		<link rel = "stylesheet" type="text/css" href = "../includes/style.css">

		<script src = "scripts/functions.js"></script>

		<!-- Developer: Richard del S. Altre -->

  		<title>Euphony | Student</title>

  	</head>

	<body>

  		<?php 

  			// ========================= Changing Lesson =============================

  			if(isset($_POST['lesson'])){

  				$the_lesson = escape($_POST['lesson']);

  				$query = "UPDATE selected_class_tbl SET Lesson_Id = '{$the_lesson}' WHERE ";
  				$query .="User_Id = '{$user_id}'";

  				$query_update_lesson = mysqli_query($con, $query);

  				confirmQuery($query_update_lesson);

  				echo "<script>sweetAlert('success', 'Successfully Updated', 'You changed the lesson');</script>";
  			}

  			// ========================= Changing Lesson END =========================



  			// ========================= Changing Schedule =================================

  			else if(isset($_POST['edit_time'])){

  				$the_day 	= escape($_POST['edit_day']);
  				$the_time 	= escape($_POST['edit_time']);

  				$query = "UPDATE selected_class_tbl SET the_Day = '{$the_day}', the_Time = '{$the_time}' ";
  				$query .="WHERE User_Id = '{$user_id}'";

  				$query_update_schedule = mysqli_query($con, $query);

  				confirmQuery($query_update_schedule);

  				echo "<script>sweetAlert('success', 'Successfully Updated', 'You changed the schedule');</script>";
  			}

  			// ========================= Changing Schedule END =================================

		?>

		<div class="container-fluid">

			<div class = "margin"></div>

			<?php 

				// ========================= User Profile =================================

	  			if($_SESSION['user_id']){

					$user_id   = $_SESSION['user_id'];

					$query_selected_student = studInfo($user_id);

					confirmQuery($query_selected_student);

					$count1 = mysqli_num_rows($query_selected_student);

					if($count1 > 0){

			  			while($row = mysqli_fetch_array($query_selected_student)){

			  				//stud_tbl
				  			$lastname  		= escape($row['Last_name']);
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

				  			if($datestarted == date('Y-m-d')){

				  				echo "<script>sweetAlertSteps()</script>";
				  			}

			  			}

			  			$selected_class = "SELECT * FROM selected_class_tbl WHERE User_Id = '{$user_id}' ";
			  			$selected_class .="AND Status = 'New'";

			  			$query_all = mysqli_query($con, $selected_class);

			  			$count = mysqli_num_rows($query_all);

			  			if($count == NULL){

			  				echo "<script>location.href='registration_form.php?user_id=$user_id';</script>";
			  			}

			  		}

			  		else{

			  			echo "<script>alert('No results here')</script>";
			  		}

		  		}

	  			// ========================= User Profile END ===============================

		  		include "includes/student_navigation.php"; 

	  		?>

			<!---Account--->
			<div class ="col-sm-6">

				<div class = "panel panel-default">

					<div class = "panel-header">
						<center>
							<h3 class="cap">My Account
								<a href = "student_profile_settings.php?userid=<?php echo $user_id; ?>" class = "text-right" title = "Edit Account"><i class='fa fa-pencil-alt'></i></a>
							</h3>
						</center>
					</div>

					<div class="panel-body">

						<div class="col-sm-3">

							<?php profileImg($profileimg, $sex); ?>

						</div>

						<div class="col-sm-9">

							<div class="table-responsive">

								<table class="table">

									<tbody>

										<tr>
											<td><b>Name: </b></td>
											<td><?php echo "$firstname $middlename $lastname"; ?></td>
										</tr>

										<tr>
											<td><b>Date started:</b></td>
											<td><?php echo date('F d, Y', strtotime($datestarted)); ?></td>
										</tr>

										<?php

											if($status == 'Pending'){
												echo "<tr>";
												echo "<td><b>Status: </b></td>";
												echo "<td><b><p><span class='label label-info'>$status</span></p></b></td>";
												echo "</tr>";
											}
											else if($status == 'Official'){
												echo "<tr>";
												echo "<td><b>Status: </b></td>";
												echo "<td><b><p><span class='label label-success'>$status</span></p></b></td>";
												echo "</tr>";
											}
											if($status == 'Declined'){
												echo "<tr>";
												echo "<td><b>Status: </b></td>";
												echo "<td><b><p><span class='label label-danger'>$status</span></p></b></td>";
												echo "</tr>";
											}
										?>

									</tbody>

								</table>

							</div>
							
						</div>

					</div>

					<div class="panel-footer">

						<div class="text-right">
							<button class = "btn btn-primary" onclick = "location.href='view_profile.php?userid=<?php echo $user_id; ?>';">View</button>
						</div>

					</div>

				</div>

			</div>
			<!---Account END--->







			<!---Balances--->
			<div class ="col-sm-6">	

				<div class = "panel panel-default">

					<div class = "panel-header">
						<center><h3 class="cap">Payment Balances</h3></center>
					</div>

					<div class = "panel-body">

						<table class = "table table-responsive table-bordered table-hover">

							<thead class="cap">
								<th>Date</th>
								<th>Recent Balance</th>
								<th>Cash Tendered</th>
								<th>Total Balance</th>
							</thead>

							<p>Recent: </p>

							<tbody>

								<?php

									$query_stud_balances = studBalances($user_id);

									confirmQuery($query_stud_balances);

									tableNull($query_stud_balances, '4', 'No recent transactions');

									while($row = mysqli_fetch_assoc($query_stud_balances)){

										$trans_date 	= escape($row['Date']);
										$the_balance 	= escape($row['The_balance']);
										$amount_paid	= escape($row['Cash_tendered']);
										$balance 		= escape($row['Total_balance']);

										echo "<tr>";
										echo "<td>".date('M d, Y', strtotime($trans_date))."</td>";
										echo "<td>".number_format($the_balance,2)." PHP</td>";
										echo "<td>".number_format($amount_paid,2)." PHP</td>";
										echo "<td>".number_format($balance,2)." PHP</td>";
										echo "</tr>";
										
									}
								?>

							</tbody>
							
						</table>

					</div>

					<div class="panel-footer">

						<div class="row">

						<div class="col-sm-6">

							<p>Total Balance: 
								<b style = "font-size:20px; color: #d02737">

								<?php 

									if(isset($balance)){

										if($balance == 0){
											echo "<span class='label label-success'>Paid</span>";
										}

										else{	
											echo "" .number_format($balance,2). " PHP";
										}
									}

									else{

										$query = "SELECT selected_class_tbl.Lesson_Id, ";
										$query .="lessons_tbl.Amount FROM selected_class_tbl ";
										$query .="LEFT JOIN lessons_tbl ON selected_class_tbl.";
										$query .="Lesson_Id = lessons_tbl.Lesson_Id WHERE ";
										$query .="selected_class_tbl.User_Id = '$user_id' ";
										$query .="AND selected_class_tbl.Status = 'New' ";

										$query_lessamount = mysqli_query($con, $query);

										confirmQuery($query_lessamount);

										$row = mysqli_fetch_assoc($query_lessamount);

										$lessamount = $row['Amount'];

										echo "" .number_format($lessamount,2). " PHP";
										

									}

								?>

								</b>

							</p>

						</div>

						<div class="col-sm-2"></div>

						<div class="col-sm-4">
							<div class="text-right">
								<a href="payment_transactions.php" class="btn btn-primary">View</a>
							</div>
						</div>

						</div>

					</div>

				</div>

			</div>
			<!---Balances END--->



			<div class="col-sm-12">

				<ul class="nav nav-pills nav-justified">
				  	<li class="active" style="border: 1px solid gray"><a data-toggle="pill" href="#menu1">Lesson & Schedule</a></li>
				  	<li style="border: 1px solid gray"><a data-toggle="pill" href="#menu2">Attendance Records</a></li>
				  	<li style="border: 1px solid gray"><a data-toggle="pill" href="#menu3">Policy</a></li>
				</ul>

				<div class="tab-content">

				  	<div id="menu1" class="tab-pane fade in active"><br>

				  		<div class="col-sm-6">
				  			
				  			<div class = "panel panel-default">

								<div class = "panel-header">

									<center><h3 class="cap">Lesson </h3></center>

								</div>

								<div class = "panel-body">

									<?php

										$query_selected_class = selectedClass($user_id);

										confirmQuery($query_selected_class);

										while($row = mysqli_fetch_assoc($query_selected_class)){

											$lesson_Id 		= escape($row['Lesson_Id']);
											$lesson_desc	= escape($row['Lesson_desc']);
											$lesson_amount 	= escape($row['Amount']);
											$nooflesson 	= escape($row['No_of_lesson']);
											$icon 			= escape($row['Icon']);
											$day_id 		= escape($row['Day_Id']);
											$day 			= escape($row['Day']);
											$time_id 		= escape($row['Time_Id']);
											$time 			= escape($row['Time']);
											$time_end 		= escape($row['Time_end']);
											$randSalt 		= escape($row['randSalt']);

											$full_time = "$time - $time_end $randSalt";

										}

									?>

									<div class = "col-sm-3">
										<center><img src = "../images/lessons/Icon/<?php echo $icon; ?>" class = "img-circle img-responsive" alt = "photo" id = "profileimg"></center>
									</div>

									<div class = "col-sm-9">

										<div class="table-responsive">

											<table class="table">

												<tbody>

													<tr>
														<td><b>Lesson: </b></td>
														<td><?php echo $lesson_desc; ?> </td>
													</tr>

													<tr>
														<td><b>Sessions: </b></td>
														<td><?php echo $nooflesson; ?> </td>
													</tr>

													<tr>
														<td><b>Amount: </b></td>
														<td><?php echo number_format($lesson_amount,2); ?> PHP</td>
													</tr>

												</tbody>

											</table>

										</div>

									</div>

								</div>

								<?php include "includes/edit_class.php"; ?>

								<div class="panel-footer">

									<div class="text-right">
										<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="change_lesson_btn">Change</a>
									</div>

									<?php 

										if($status == 'Official'){

											echo "<script>document.getElementById('change_lesson_btn').className='hidden';</script>";
											
										}

									?>

								</div>

							</div>

				  		</div>

				  		<div class="col-sm-6">
				  			
				  			<div class = "panel panel-default">

								<div class = "panel-header">

									<center><h3 class="cap">Class Schedule</h3></center>

								</div>

								<div class = "panel-body"><br>

									<!-- <p style = "color: white">Schedule</p> -->

									<table class = "table table-responsive table-bordered table-hover">

										<thead class="cap">
											<th>Day</th>
											<th>Time</th>
											<th>Teacher</th>
										</thead>

										<tbody>

											<tr>
												<td><?php echo $day; ?></td>
												<td><?php echo $full_time; ?></td>

												<?php

													$query_stud_lesson = studClass($user_id, $lesson_Id);

													count_records($query_stud_lesson, '<td>None</td>');

													while($row = mysqli_fetch_assoc($query_stud_lesson)){

														$t_last_name 	= escape($row['T_Last_name']);
														$t_first_name 	= escape($row['T_First_name']);
														$t_middle_name 	= escape($row['T_Middle_name']);

														$t_fullname = "".$t_first_name. " " .$t_last_name. ""; 

														echo "<td>";
														echo $t_fullname;
														echo "</td>";
													}
												?>
												
											</tr>

										</tbody>
										
									</table><br>

								</div>

								<div class="panel-footer">

									<div class="text-right">
										<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#changeSched" id="change_sched_btn">Change</a>
									</div>

									<?php 

										if($status == 'Official'){

											echo "<script>document.getElementById('change_sched_btn').className='hidden';</script>";
											
										}

									?>

								</div>

							</div>

				  		</div>

				  	</div>

				  	<div id="menu2" class="tab-pane fade in"><br>

				  		<div class="col-sm-12">

							<div class="panel panel-default">
								
								<!-- <div class="panel-header">
									<center><h3>Attendance</h3></center>
								</div>	
 -->
								<div class="panel-body">
									
									<div class = "table-responsive">

										<table class = "table table-hover table-bordered" id="standardAsc">

											<thead class="cap">
												<tr>
													<th>No.</th>
						  							<th>Date</th>
						  							<th>Time</th>
						  							<th>Lesson</th>
						  							<th>Teacher</th>
						  							<th>Remarks</th>
												</tr>
											</thead>

											<tbody>

											<?php

												$att_count = attendanceCount($user_id);

						  						$count_records = mysqli_num_rows($att_count);

						  						if($count_records == 0){
						  							echo "<center><p class='cap'>Lessons taken: <h3 style='color: #d02737'><b>".$count_records."/".$nooflesson."</b></h3></p><center>";
						  						}
						  						else{
						  							echo "<center><p class='cap'>Lessons taken: <h3 style='color: green'><b>".$count_records."/".$nooflesson."</b></h3></p><center>";
						  						}
						  						

												$query_stud_att = studAttendance($user_id);

						  						confirmQuery($query_stud_att);

												$n = 1; 

												while($row = mysqli_fetch_assoc($query_stud_att)){

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
													echo "<td>".date('F d, Y', strtotime($date))."</td>";
													echo "<td>".date('h:i A', strtotime($time_att))."</td>";
													echo "<td>$the_lesson</td>";
													echo "<td>$the_teacher</td>";
													
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

											?>

											</tbody>

										</table>

									</div>

								</div>

							</div>

						</div>

				  	</div>

				  	<div id="menu3" class="tab-pane fade in"><br>

				  		<div class="col-sm-12">

							<div class="panel panel-default">

								<div class="panel-header">
									<center><h3 class="cap">Policy</h3></center>
								</div>

								<div class="panel-body">

									<?php

										$query_policy = tableQuery('policy_tbl');

										confirmQuery($query_policy);

										while($row = mysqli_fetch_assoc($query_policy)){

											$content = $row['Content'];

											echo "<p>$content</p>";
										}
									?>

								</div>

							</div>

						</div>

				  	</div>

				</div>

			</div>

			<?php include "includes/edit_sched.php"; ?>

		</div>



		

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<script src="../assets/js/select2.full.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->


		

		<script>
				
			$(document).ready(function(){

				$('#standardAsc').DataTable({
					select: true,
					"order": [[ 0, "asc" ]]
				});

				$("#select2").select2({
			      	allowClear: true
			    });

			});

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
						// alert(result);
					}
				})

			})

		</script>

  	</body>

  	<?php include "../includes/footer.php"; ?>

</html>