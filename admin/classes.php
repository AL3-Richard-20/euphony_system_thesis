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



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Class Schedules</title>

	</head>

	<!-- #1f262e -->
	<body>

		<div class = "container-fluid">

			<?php include "includes/admin_navigation.php"; ?>	
			
			<div class = "margin"></div>

			<?php

				if(isset($_GET['day']) && isset($_GET['time'])){

					$the_day = $_GET['day'];
					$the_time = $_GET['time'];

					if($the_time == 13){

						$the_time = 1;
					}
					else if($the_time == 14){

						$the_time = 2;
					}
					else if($the_time == 15){

						$the_time = 3;
					}
					else if($the_time == 16){

						$the_time = 4;
					}
					else if($the_time == 17){

						$the_time = 5;
					}
					else if($the_time == 18){

						$the_time = 6;
					}
					else if($the_time == 19){

						$the_time = 7;
					}
					else if($the_time == 20){

						$the_time = 8;
					}
					// else if($the_time == 21){

					// 	$the_time = 9;
					// }
					// else if($the_time == 22){

					// 	$the_time = 10;
					// }
					// else if($the_time == 23){

					// 	$the_time = 11;
					// }
					// else if($the_time == 24){

					// 	$the_time = 12;
					// }
				}
				else{

					echo "<script>location.href='../';</script>";
				}

				if(isset($_GET['addpresent'])){

					$stud_class_Id = $_GET['addpresent'];

					$query = "INSERT INTO attendance_tbl (stud_class_Id, Date_att, ";
					$query .="Time_att, User_Id, Remarks) ";
					$query.="VALUES ('$stud_class_Id', curdate(), curtime(), '$user_id', 'Present')";

					$present_att = mysqli_query($con, $query);

					confirmQuery($present_att);

				}

				if(isset($_GET['addexcused'])){

					$stud_class_Id = $_GET['addexcused'];

					$query = "INSERT INTO attendance_tbl (stud_class_Id, Date_att, ";
					$query .="Time_att, User_Id, Remarks) ";
					$query.="VALUES ('$stud_class_Id', curdate(), curtime(), '$user_id', 'Excused')";

					$excused_att = mysqli_query($con, $query);

					confirmQuery($excused_att);

				}

				if(isset($_GET['addforfeit'])){

					$stud_class_Id = $_GET['addforfeit'];

					$query = "INSERT INTO attendance_tbl (stud_class_Id, Date_att, ";
					$query .="Time_att, User_Id, Remarks) ";
					$query.="VALUES ('$stud_class_Id', curdate(), curtime(), '$user_id', 'Forfeited')";

					$forfeit_att = mysqli_query($con, $query);

					confirmQuery($forfeit_att);

				}

				if(isset($_GET['present'])){

					$stud_class_Id = $_GET['present'];

					$query = "UPDATE attendance_tbl SET Remarks  = 'Present', ";
					$query .="Time_att = curtime() ";
					$query .="WHERE stud_class_Id = '{$stud_class_Id}' AND Date_att = curdate()";

					$present_att = mysqli_query($con, $query);

					confirmQuery($present_att);

				}

				if(isset($_GET['excused'])){

					$stud_class_Id = $_GET['excused'];

					$query = "UPDATE attendance_tbl SET Remarks  = 'Excused', ";
					$query .="Time_att = curtime() ";
					$query .="WHERE stud_class_Id = '{$stud_class_Id}' AND Date_att = curdate()";

					$excused_att = mysqli_query($con, $query);

					confirmQuery($excused_att);

				}

				if(isset($_GET['forfeit'])){

					$stud_class_Id = $_GET['forfeit'];

					$query = "UPDATE attendance_tbl SET Remarks  = 'Forfeited', ";
					$query .="Time_att = curtime() ";
					$query .="WHERE stud_class_Id = '{$stud_class_Id}' AND Date_att = curdate()";

					$forfeit_att = mysqli_query($con, $query);

					confirmQuery($forfeit_att);

				}

			?>

			<form method = "POST">

				<div class="panel panel-default">

					<div class="panel-header">

						<div class="row">

				            <div class="col-sm-4">

				                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

				            </div>

				            <div class="col-sm-4">
				              <center><h3 class="cap"><?php echo $the_day; ?> Class (Today)</h3></center>
				            </div>

				            <div class="col-sm-4"></div>

				        </div>

					</div>

					<div class="panel-body">

						<ul class="nav nav-pills">

						<?php 

							$query = "SELECT * FROM time_tbl";
							$query_all_time  = mysqli_query($con, $query);

							$n = 1;

							while($row = mysqli_fetch_assoc($query_all_time)){

								$time_id 	= escape($row['Time_Id']);
								$time 		= escape($row['Time']);
								$time_out 	= escape($row['Time_end']);
								$time_desc 	= escape($row['randSalt']);

								$full_time = "".$time. "-" .$time_out. " " .$time_desc. "";

								if($time == $the_time){
									echo "<li class='active'><a data-toggle='tab' href='#".$n++."'>$full_time</a></li>";
								}
								else if($time != $the_time){
									echo "<li><a data-toggle='tab' href='#".$n++."'>$full_time</a></li>";
								}
								
							}

							// if($the_time == 21 || $the_time == 22 || $the_time == 23 || $the_time == 24){
							// 	echo "<li class = 'active'><a data-toggle='tab' href='#dailyReports'>Reports (End Shift)</a></li>";
							// }

						?>

						<li><a data-toggle='tab' href='#dailyReports'>Reports (End Shift)</a></li>

						</ul>

						<div class="tab-content">	

							<!--Active -->
						  	<!-- <div class="tab-pane fade in active"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass" class = "table table-bordered table-hover">

					                  	<thead>
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Status</th>
					                    	<th class = "text-center">Action</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php 
					                  		//dailyClass($the_day, $the_time, $the_time);
					                  	?>


					                  </tbody>

					                </table>

					            </div>

						  	</div> -->
						  	<!--Active END -->

						  	<!--Reports -->
						  	<form method="POST">

							  	<div class="tab-pane fade in" id = "dailyReports"><br>

							  		<div class="row">
							  			<div class="col-sm-1">
							  				<center><img src="../images/default/Print2.png" style="height:70px"></center>
							  			</div>
							  			<div class="col-sm-11">
							  				<h3 class="cap">Reports</h3>
							  			</div>
							  		</div>

							  		<div class="col-sm-4">
								  		<div class="form-group">


								  			<h3>Class</h3><hr/>

							  				<a href="attendance.php">
								  				<p>
								  					Attendance Record
								  					<!-- <i class="fas fa-dot-circle text-success"></i> -->
								  				</p>
								  			</a>


							  				<a href="payments.php">
							  					<p>Payment Balances</p>
							  				</a>
							  				<a href="print_official_stud.php?branchid=<?php echo $branch_id; ?>">
							  					<p>Official Students</p>
							  				</a>


						  				</div>
					  				</div>

					  				<div class="col-sm-4">

						  				<div class="form-group">

						  					<h3>Inventory</h3><hr/>

							  				<a href="stock_in.php">
							  					<p>Stock In</p>
							  				</a>
							  				<a href="stock_out.php">
							  					<p>Stock Out</p>
							  				</a>
							  				<a href="print_stocks_on_hand.php?branchid=<?php echo $branch_id; ?>" target="_blank">
							  					<p>Stock on hand</p>
							  				</a>
							  				<a href="print_fast_moving.php?branchid=<?php echo $branch_id; ?>" target="_blank">
							  					<p>Fast Moving</p>
							  				</a>
							  				<a href="print_slow_moving.php?branchid=<?php echo $branch_id; ?>" target="_blank">
							  					<p>Slow Moving Products</p>
							  				</a>
							  				<a href="print_critical_stocks.php?branchid=<?php echo $branch_id; ?>" target="_blank">
							  					<p>Critical Stocks</p>
							  				</a>
							  			</div>

							  		</div>

							  		<div class="col-sm-4">

						  				<div class="form-group">

						  					<h3>Sales</h3><hr/>

							  				<a href="daily_sales.php">
							  					<p>Product Sales Report</p>
							  				</a>
							  				<a href="payments.php">
							  					<p>Lesson Sales Report</p>
							  				</a>

							  			</div>

							  		</div>

							  		<!-- <div class="col-sm-4">
						  				<div class="form-group">
									  		<h3>Logs</h3>
							  				<a href="#">
							  					<s>Activity Log</s>
							  				</a><br>
							  				<a href="#">
							  					<s>User Log</s>
							  				</a>
							  			</div>
							  		</div> -->

							  	</div>

						  	</form>
						  	<!--Reports END -->

							<!-- 9-10 AM -->
						  	<div id="1" class="tab-pane fade in active"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass1" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '9', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 9-10 AM END -->

						  	<!-- 10-11 AM -->
						  	<div id="2" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass2" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '10', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 10-11 AM END -->

						  	<!--11-12 AM -->
						  	<div id="3" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass3" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '11', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 11-12 AM END -->

						  	<!--12-1 PM -->
						  	<div id="4" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass4" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '12', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 12-1 PM END -->

						  	<!--1-2 PM -->
						  	<div id="5" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass5" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '1', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 1-2 PM END -->

						  	<!--2-3 PM -->
						  	<div id="6" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass6" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '2', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 2-3 PM END -->

						  	<!--3-4 PM -->
						  	<div id="7" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass7" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '3', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 3-4 PM END -->

						  	<!--4-5 PM -->
						  	<div id="8" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass8" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '4', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 4-5 PM END -->

						  	<!--5-6 PM -->
						  	<div id="9" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass9" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '5', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 5-6 PM END -->

						  	<!--6-7 PM -->
						  	<div id="10" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass10" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '6', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 6-7 PM END -->

						  	<!--7-8 PM -->
						  	<div id="11" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass11" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '7', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 7-8 PM END -->

						  	<!--8-9 PM -->
						  	<div id="12" class="tab-pane fade in"><br>
						  		
						  		<div class = "table-responsive">

					                <table id = "dailyclass12" class = "table table-bordered table-hover">

					                  	<thead class="cap">
					                    	<th>#</th>
					                    	<th>Student</th>
					                    	<th>Lesson</th>
					                    	<th>Teacher</th>
					                    	<th>Lessons Taken</th>
					                    	<th>Balance</th>
					                    	<th>Remarks</th>
					                    	<th class = "text-center">Attendance</th>
					                    	<th>Pay</th>
					                  	</thead>

					                  	<tbody>

					                  	<?php dailyClass($the_day, $the_time, '8', $branch_id); ?>

					                  </tbody>

					                </table>

					            </div>

						  	</div>
						  	<!-- 8-9 PM END -->

						</div>

					</div>

				</div>

			</form>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->



		<script src = "../assets/js/date_time.js"></script>	

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script type="text/javascript">
			
			$('#dailyclass').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass1').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass2').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass3').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass4').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass5').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass6').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass7').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass8').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass9').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass10').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass11').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

			$('#dailyclass12').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

		</script>

		<!-- <script>
			window.onload = the_date('the_date');
        	window.onload = day('today');
        	// window.onload = date_time('day');
        </script> -->

	</body>

</html>