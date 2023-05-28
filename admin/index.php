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

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<link rel="stylesheet" href="../assets/slick/slick.css">

		<link rel="stylesheet" href="../assets/slick/slick-theme.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Administrator</title>

	</head>

	<body>

		<?php 

			$query_admin_info = adminProfile($user_id);

			confirmQuery($query_admin_info);

			while($row = mysqli_fetch_assoc($query_admin_info)){

				$branch_id 		 = escape($row['Branch_Id']);
				$lastname 		 = escape(substr($row['Last_name'], 0,20));
				$firstname 	 	 = escape(substr($row['First_name'], 0,15));
				$middlename 	 = escape(substr($row['Middle_name'], 0,20));
				$sex 			 = escape($row['Sex']);
				$address 		 = escape(substr($row['Address'], 0,35));
				$contact_no 	 = escape(substr($row['Contact_no'], 0,35));
				$profileimg 	 = escape($row['Profile_img']);
				$branch_desc 	 = escape(substr($row['Branch_desc'], 0,35));
				$branch_location = escape(substr($row['Branch_location'], 0,35));
				$branch_image 	 = escape($row['Branch_image']);
				$branch_level 	 = escape(substr($row['Level'], 0,35));

				$_SESSION['branch_id']  = $branch_id;
				$_SESSION['firstname']  = $firstname;
				$_SESSION['profileimg'] = $profileimg;

			}

			if(isset($_POST['day'])){

				$the_day 	= escape($_POST['day']);
				$the_time 	= escape($_POST['time']);
				// $the_date 	= escape($_POST['the_date']);
				
				$_SESSION['today'] = $the_day;

				echo "<script>location.href='classes.php?day=$the_day&time=$the_time&branchid=$branch_id'</script>";
			}

		?>

		<div class="container-fluid">

			<?php include "includes/admin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="row">

				<!--- ============== Most Enrolled ================== --->
				<div class="col-sm-6">

					<div class="panel panel-default">

						<div class="panel-header">
							<center><h3 class="cap">MOST ENROLLED</h3></center>
						</div>

						<div class="panel-body">

							<?php

								$most_enrolled = mostEnrolled($branch_id);

								confirmQuery($most_enrolled);

								while($row = mysqli_fetch_assoc($most_enrolled)){

									$lesson_Id 			= escape($row['Lesson_Id']);
									$lesson_desc		= escape($row['Lesson_desc']);
									$lesson_img 		= escape($row['Cover_image']);
									$nooflesson 		= escape($row['No_of_lesson']);
									$students_enrolled 	= escape($row['Total']);
								}

							?>

							<?php

								if(isset($lesson_desc) && isset($nooflesson) && isset($students_enrolled)){

									?>

									<div class = "col-sm-4">
										<center><img src = "../images/lessons/Cover/<?php echo $lesson_img; ?>" class = "img-responsive" alt = "photo"></center>
									</div>

									<div class = "col-sm-8">

										<table class="table">
											<tbody>
												<tr>
													<td><b>Lesson: &nbsp</b></td>
													<td><?php echo $lesson_desc; ?></td>
												</tr>
												<tr>
													<td><b>Sessions: &nbsp</b></td>
													<td><?php echo $nooflesson; ?></td>
												</tr>
												<tr>
													<td><b>Students Enrolled: &nbsp</b></td>
													<td><?php echo $students_enrolled; ?></td>
												</tr>
											</tbody>
										</table>

									</div>

									<?php
								}

								else{

									?>

									<div class = "col-sm-4">
										<center><img src = "../images/default/services_raw.jpg" class = "img-responsive" alt = "photo"></center>
									</div>

									<div class = "col-sm-8">

										<table class="table">

											<tbody>
												<tr>
													<td><b>Lesson: &nbsp</b></td>
													<td><center>---</center></td>
												</tr>
												<tr>
													<td><b>Sessions: &nbsp</b></td>
													<td><center>---</center></td>
												</tr>
												<tr>
													<td><b>Students Enrolled: &nbsp</b></td>
													<td><center>---</center></td>
												</tr>
											</tbody>

										</table>

									</div>

									<?php
								}

							?>

						</div>

						<div class="panel-footer">

							<div class="text-right">
								<button class = "btn btn-primary" onclick="location.href='lessons.php';">View</button>
							</div>

						</div>

					</div>

				</div>
				<!--- ============= Most Enrolled END ================ --->



				<!--- ============== Classes ================= --->
				<form method="POST">

					<div class="col-sm-6">

						<div class="panel panel-default">

							<div class="panel-header">
								<center><h3 class="cap">Classes (Today)</h3></center>
							</div>

							<div class="panel-body">

								<div class="col-sm-3">

				           			<center><img src = "../images/default/Class.jpg" class = "img-circle img-responsive" alt = "photo"></center>

				            	</div>

				            	<div class="col-sm-9">
				            		<center><h2 id = "date_time">Hello</h2></center>
				            	</div>

							</div><br>

							<div class="panel-footer">

								<div class="text-right">
									<input type="hidden" name="day" id="day">
									<input type="hidden" name="time" id="time">
									<button type = "submit" class = "btn btn-primary">View</button>
								</div>

							</div>

						</div>

					</div>
					
				</form>
				<!--- ============= Classes END ==================--->

			</div>




			<div class="row">

				<!--- =================== Official Students ==================--->
				<div class="col-sm-3">

					<div class="panel panel-default" onclick="location.href='students.php?status=Official';">

						<div class="panel-header">
							<center><h3 class="cap">OFFICIAL STUDENT/S</h3></center><br>
						</div>

						<div class = "panel-body">
							<div><center><?php echo official_students($branch_id); ?></center></div>
							<div class = "margin"></div>
						</div>

					</div>

				</div>
				<!--- =================== Official Students END ==================--->



				<!--- =================== Pending Students ====================--->
				<div class="col-sm-3">

					<div class="panel panel-default" onclick="location.href='students.php?status=Pending';">

						<div class="panel-header">
							<center><h3 class="cap">PENDING STUDENT/S</h3></center><br>
						</div>

						<div class = "panel-body">
							<div><center><?php echo pending_students($branch_id); ?></center></div>
							<div class = "margin"></div>
						</div>

					</div>

				</div>
				<!--- =================== Pending Students END ====================--->



				<!--- ===================== Declined Students ===================--->
				<div class="col-sm-3">

					<div class="panel panel-default" onclick="location.href='students.php?status=Declined';">

						<div class="panel-header">
							<center><h3 class="cap">DECLINED STUDENT/S</h3></center><br>
						</div>

						<div class = "panel-body">
							<div><center><?php echo declined_students($branch_id); ?></center></div>
							<div class = "margin"></div>
						</div>

					</div>

				</div>
				<!--- ===================== Declined Students END ===================--->



				<!---======================== Teachers ===========================--->
				<div class="col-sm-3">

					<div class="panel panel-default" onclick="location.href='teachers.php';">

						<div class="panel-header">
							<center><h3 class="cap">TEACHER/S</h3></center><br>
						</div>

						<div class="panel-body">
							<div><center><?php echo count_teachers($branch_id); ?></center></div>
							<div class="margin"></div>
						</div>

					</div>

				</div>
				<!---======================== Teachers END ===========================--->

			</div>

			


			<!-- ====================== Fast Moving Item =========================== --->
			<div class="container">

				<div class="row">

					<div class="single-item">

						<div class="col-sm-6">

							<div class="panel panel-default">

								<div class="panel-header">
									<center><h3 class="cap">FAST MOVING</h3></center><br>
								</div>

								<div class="panel-body">

									<?php

										$query_fast_moving = movingProducts($branch_id, 'DESC', 1);

										confirmQuery($query_fast_moving);

										$count_f_prod = mysqli_num_rows($query_fast_moving);

										if($count_f_prod > 0){

											while($row = mysqli_fetch_assoc($query_fast_moving)){

												$prod_Id 		= $row["Prod_Id"];
									          	$prod_name 		= $row["Prod_name"];
									          	$prod_brand 	= $row["Prod_brand"];
									          	$prod_price 	= $row["Prod_price"];
									          	$prod_desc 		= $row["Prod_desc"];
									          	$prod_status 	= $row["Status"];
									          	$prod_image 	= $row["Prod_image"];
									          	$prod_quantity 	= $row['Quantity'];
									          	$prod_cat_id 	= $row['Category_Id'];
									          	$prod_category 	= $row['Category_title'];
									          	$total_orders 	= $row['TotalQuantity'];

									          	$query_prod_settings = prodSett('1');

									          	confirmQuery($query_prod_settings);

									          	while($row2 = mysqli_fetch_assoc($query_prod_settings)){
									          		$number = escape($row2['Number']);
									          	}

									          	if($total_orders >= $number){
										          	echo '<div class = "col-sm-4">';
													echo '<center><img src = "../images/products/'.$prod_image.'" class = "img-responsive" style="height:100px" id = "zoomHover"></center>';
													echo '</div>';

													echo '<div class = "col-sm-8">';
													echo '<table class = "table">';
													echo '<tbody>';
													echo '<tr>';
													echo '<td><b>Product:</b></td>';
													echo '<td>'.$prod_name.'</td>';
													echo '</tr>';
													echo '<tr>';
													echo '<td><b>Brand:</b></td>';
													echo '<td>'.$prod_brand.'</td>';
													echo '</tr>';
													echo '<tr>';
													echo '<td><b>Price:</b></td>';
													echo '<td>'.number_format($prod_price,2).' PHP</td>';
													echo '</tr>';
													echo '<tr>';
													echo '<td><b>Status:</b></td>';
													echo '<td>'.$prod_status.'</td>';
													echo '</tr>';
													echo '</tbody>';
													echo '</table>';
													echo '</div>';
												}
												else{

													echo '<div class = "col-sm-4">';
													echo '<center><img src = "../images/products/" class = "img-responsive" style="height:100px" id = "zoomHover" alt=Image></center>';
													echo '</div>';

													echo '<div class = "col-sm-8">';
													echo '<table class = "table">';
													echo '<tbody>';
													echo '<tr>';
													echo '<td><b>Product:</b></td>';
													echo '<td>None</td>';
													echo '</tr>';
													echo '<tr>';
													echo '<td><b>Brand:</b></td>';
													echo '<td>None</td>';
													echo '</tr>';
													echo '<tr>';
													echo '<td><b>Price:</b></td>';
													echo '<td>0.00</td>';
													echo '</tr>';
													echo '<tr>';
													echo '<td><b>Status:</b></td>';
													echo '<td>None</td>';
													echo '</tr>';
													echo '</tbody>';
													echo '</table>';
													echo '</div>';
												}
											}

										}

										else{

											echo '<div class = "col-sm-4">';
											echo '<center><img src = "../images/default/product_raw.jpg" class = "img-responsive" style="height:100px" id = "zoomHover" alt=Image></center>';
											echo '</div>';

											echo '<div class = "col-sm-8">';
											echo '<table class = "table">';
											echo '<tbody>';
											echo '<tr>';
											echo '<td><b>Product:</b></td>';
											echo '<td>None</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Brand:</b></td>';
											echo '<td>None</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Price:</b></td>';
											echo '<td>0.00</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Status:</b></td>';
											echo '<td>None</td>';
											echo '</tr>';
											echo '</tbody>';
											echo '</table>';
											echo '</div>';
										}

									?>

							</div>

						<div class="panel-footer">
							<div class="text-right">
								<a href="fast_moving_products.php" class = "btn btn-primary">View</a>
							</div>
						</div>

					</div>

				</div>
				<!--================== Fast Moving Item END ==================--->





				<!-- ===================== Slow Moving Item ======================== --->
				<div class="col-sm-6">

					<div class="panel panel-default">

						<div class="panel-header">
							<center><h3 class="cap">SLOW MOVING</h3></center><br>
						</div>

						<div class="panel-body">
				
							<?php

								$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, ";
								$query .= "P.Prod_image, P.Status, P.Prod_price, P.Prod_desc, C.Category_Id, ";
								$query .= "PI.Quantity, B.Branch_Id FROM products_tbl as P, ";
								$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B ";
								$query .= "WHERE P.Prod_Id = PI.Prod_Id ";
								$query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
								$query .= "and PI.Branch_Id = '$branch_id' ORDER BY P.Prod_Id ";
								$query .= "ASC LIMIT 1";

								$query_slow_moving = mysqli_query($con, $query);

								confirmQuery($query_slow_moving);

								$count_s_prod = mysqli_num_rows($query_slow_moving);

								if($count_s_prod > 0){

									while($row = mysqli_fetch_assoc($query_slow_moving)){

										$prod_Id 		= $row["Prod_Id"];
							          	$prod_name 		= $row["Prod_name"];
							          	$prod_brand 	= $row["Prod_brand"];
							          	$prod_price 	= $row["Prod_price"];
							          	$prod_desc 		= $row["Prod_desc"];
							          	$prod_status 	= $row["Status"];
							          	$prod_image 	= $row["Prod_image"];
							          	$prod_quantity 	= $row['Quantity'];
							          	$prod_cat_id 	= $row['Category_Id'];

							          	$query = "SELECT SUM(Quantity) as TotalOrders ";
						              	$query .="FROM sales_detail WHERE Prod_Id = '$prod_Id' ";
						              	$query_orders = mysqli_query($con, $query);

						              	confirmQuery($query_orders);

						              	while($row = mysqli_fetch_assoc($query_orders)){

						              		$total_orders = $row['TotalOrders'];
						              	}

						              	$query_prod_settings = prodSett('2');

							          	confirmQuery($query_prod_settings);

							          	while($row2 = mysqli_fetch_assoc($query_prod_settings)){
							          		$number2 = escape($row2['Number']);
							          	}

						              	if($total_orders < $number2){

								          	echo '<div class = "col-sm-4">';
											echo '<center><img src = "../images/products/'.$prod_image.'" class = "img-responsive" style="height:100px" id = "zoomHover"></center>';
											echo '</div>';

											echo '<div class = "col-sm-8">';
											echo '<table class = "table">';
											echo '<tbody>';
											echo '<tr>';
											echo '<td><b>Product:</b></td>';
											echo '<td>'.$prod_name.'</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Brand:</b></td>';
											echo '<td>'.$prod_brand.'</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Price:</b></td>';
											echo '<td>'.number_format($prod_price,2).' PHP</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Status:</b></td>';
											echo '<td>'.$prod_status.'</td>';
											echo '</tr>';
											echo '</tbody>';
											echo '</table>';
											echo '</div>';
										}
										else{

											echo '<div class = "col-sm-4">';
											echo '<center><img src = "../images/products/" class = "img-responsive" style="height:100px" id = "zoomHover" alt=Image></center>';
											echo '</div>';

											echo '<div class = "col-sm-8">';
											echo '<table class = "table">';
											echo '<tbody>';
											echo '<tr>';
											echo '<td><b>Product:</b></td>';
											echo '<td>None</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Brand:</b></td>';
											echo '<td>None</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Price:</b></td>';
											echo '<td>0.00</td>';
											echo '</tr>';
											echo '<tr>';
											echo '<td><b>Status:</b></td>';
											echo '<td>None</td>';
											echo '</tr>';
											echo '</tbody>';
											echo '</table>';
											echo '</div>';
										}

									}

								}

								else{

									echo '<div class = "col-sm-4">';
									echo '<center><img src = "../images/default/product_raw.jpg" class = "img-responsive" style="height:100px" id = "zoomHover" alt=Image></center>';
									echo '</div>';

									echo '<div class = "col-sm-8">';
									echo '<table class = "table">';
									echo '<tbody>';
									echo '<tr>';
									echo '<td><b>Product:</b></td>';
									echo '<td>None</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Brand:</b></td>';
									echo '<td>None</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Price:</b></td>';
									echo '<td>0.00</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Status:</b></td>';
									echo '<td>None</td>';
									echo '</tr>';
									echo '</tbody>';
									echo '</table>';
									echo '</div>';

								}

								
							?>

						</div>

						<div class="panel-footer">
							<div class="text-right">
								<a href="slow_moving_products.php" class = "btn btn-primary">View</a>
							</div>
						</div>

					</div>

				</div>
				<!-- ===================== Slow Moving Item END ======================== --->



				<!-- ================= Critical Item ===================== --->
				<div class="col-sm-6">

					<div class="panel panel-default">

						<div class="panel-header">
							<center><h3 class="cap">CRITICAL STOCK/S</h3></center><br>
						</div>

						<div class="panel-body">
							
							<?php

								$query_critical_stocks = criticalStocks($branch_id, 3, 1);

								confirmQuery($query_critical_stocks);

								while($row = mysqli_fetch_assoc($query_critical_stocks)){

									$prod_Id 		= $row["Prod_Id"];
						          	$prod_name 		= $row["Prod_name"];
						          	$prod_brand 	= $row["Prod_brand"];
						          	$prod_price 	= $row["Prod_price"];
						          	$prod_desc 		= $row["Prod_desc"];
						          	$prod_status 	= $row["Status"];
						          	$prod_image 	= $row["Prod_image"];
						          	$prod_quantity 	= $row['Quantity'];
						          	$prod_cat_id 	= $row['Category_Id'];
						          	$prod_category 	= $row['Category_title'];

						          	echo '<div class = "col-sm-4">';
									echo '<center><img src = "../images/products/'.$prod_image.'" class = "img-responsive" style="height:100px" id = "zoomHover"></center>';
									echo '</div>';

									echo '<div class = "col-sm-8">';
									echo '<table class = "table">';
									echo '<tbody>';
									echo '<tr>';
									echo '<td><b>Product:</b></td>';
									echo '<td>'.$prod_name.'</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Brand:</b></td>';
									echo '<td>'.$prod_brand.'</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Price:</b></td>';
									echo '<td>'.number_format($prod_price,2).' PHP</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Status:</b></td>';
									echo '<td>'.$prod_status.'</td>';
									echo '</tr>';
									echo '</tbody>';
									echo '</table>';
									echo '</div>';
								}

								$count_record = mysqli_num_rows($query_critical_stocks);

								if($count_record == 0){

									echo '<div class = "col-sm-4">';
									echo '<center><img src = "../images/default/product_raw.jpg" class = "img-responsive" style="height:100px" id = "zoomHover" alt=Image></center>';
									echo '</div>';

									echo '<div class = "col-sm-8">';
									echo '<table class = "table">';
									echo '<tbody>';
									echo '<tr>';
									echo '<td><b>Product:</b></td>';
									echo '<td>None</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Brand:</b></td>';
									echo '<td>None</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Price:</b></td>';
									echo '<td>0.00</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<td><b>Status:</b></td>';
									echo '<td>None</td>';
									echo '</tr>';
									echo '</tbody>';
									echo '</table>';
									echo '</div>';
								}
							?>

						</div>

						<div class="panel-footer">
							<div class="text-right">
								<a href="critical_stocks.php" class = "btn btn-primary">View</a>
							</div>
						</div>

					</div>

				</div>
				<!-- ================= Critical Item END ===================== --->

			</div>
		
		</div>

	</div>
			



	<div class="row">

		<!---======================== Product Sales =======================--->
		<div class="col-sm-4">

			<div class="panel panel-default">

				<div class="panel-header">
					<center><h3 class="cap">SALES (PRODUCT)</h3></center><br>
				</div>

				<div class="panel-body">
					<div><?php prodSales_Today($branch_id); ?></div>
				</div>

				<div class="panel-footer">
					<div class="text-right">
						<a href="sales_menu.php" class="btn btn-primary">View</a>
					</div>
				</div>

			</div>

		</div>
		<!---======================== Product Sales END =======================--->



		<!---======================= Lesson Sales =======================--->
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-header">
					<center><h3 class="cap">SALES (LESSON)</h3></center><br>
				</div>
				<div class="panel-body">
					<div><?php lessonSales_Today($branch_id); ?></div>
				</div>
				<div class="panel-footer">
					<div class="text-right">
						<a href="lesson_sales_menu.php" class="btn btn-primary">View</a>
					</div>
				</div>
			</div>
		</div>
		<!--======================= Lesson Sales END =======================--->



		<!--- ==================== Overall Sales=================== --->
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-header">
					<center><h3 class="cap">OVERALL SALES (TODAY)</h3></center><br>
				</div>
				<div class="panel-body">
					<div><?php overAllSales($branch_id); ?></div>
				</div>
				<div class="panel-footer">
					<div class="text-right">
						<a href="overall_sales_menu.php" class="btn btn-primary">View</a>
					</div>
				</div>
			</div>
		</div>
		<!--- ==================== Overall Sales END=================== --->

	</div>

	<div class="row">
		
		<!-- ====================== Policy ============================== -->
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
		<!-- ===================== Policy END ============================== -->

	</div>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src = "../assets/slick/slick.min.js"></script>

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script src = "../assets/js/date_time.js"></script>

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/functions.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

		<script type="text/javascript">

        	window.onload = day('day');
        	window.onload = time('time');
        	window.onload = date_time('date_time');

        	$(document).ready(function(){

        		/// ================================== Slick Slider ==================================
				$('.single-item').slick({
					autoplay: true,
					autoplaySpeed: 3000,
					slidesToScroll: 1,
					adaptiveHeight: true,
					arrows: true
				});
				/// ================================== Slick Slider END ==============================
        	});
        	
        </script>

	</body>

	<?php include "../includes/footer.php"; ?>
	
</html>