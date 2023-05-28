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

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Achievements</title>

		<style type="text/css">

			.history {
			    padding-left: 55px;
			    position: relative;
			}

			.history-box {
			    padding: 7px 30px 30px;
			    background: #fff;
			    box-shadow: 0px 0px 15px rgba(51, 51, 51, 0.08);
			    position: relative;
			    margin: 0 0 30px;
			    border: 1px solid #e4e4e4;
			    z-index: 1;
			    transition: all 0.3s ease;
			    border-radius: 3px;
			}

			.history-box:hover {
			    border-color: #a3c85e;
			}

			.history-box:hover h5 {
			    color: #a3c85e;
			}

			.history-box .icon {
			    font-size: 26px;
			    width: 60px;
			    height: 60px;
			    display: inline-block;
			    text-align: center;
			    line-height: 45px;
			    color: #fff;
			    background-color: #a3c85e;
			    border-radius: 0;
			    position: absolute;
			    left: -56px;
			    top: 0px;
			    border: 7px solid #fff;
			    box-shadow: -7px 0px 15px rgba(51, 51, 51, 0.08);
			}

			.history-box label {
			    position: relative;
			    font-size: 14px;
			    letter-spacing: 2px;
			    margin: 0px 0 10px -33px;
			    padding: 0 14px 0 8px;
			    height: 46px;
			    line-height: 46px;
			    color: #fff;
			    background-color: #a3c85e;   
			}

			.history-box span {
			    font-size: 14px;
			    color: #888;
			    letter-spacing: 1px;
			    margin-left: 12px;
			    padding-top: 15px;
			    display: inline-block;
			    vertical-align: top;
			}

			.history-box h5{
			    margin: 0;
			    padding: 8px 0 12px;
			    font-size: 16px;
			    color: #696666;
			    font-weight: 600;
			    letter-spacing: 1px;
			    transition: all 0.3s ease;
			}

			.history-box p {
			    margin: 0;
			    left: 1px;
			}

			.history-box .history-box-icon i {
			    position: absolute;
			    font-size: 150px;
			    top: 30px;
			    right: 30px;
			    z-index: -1;
			    opacity: 0;
			    display: inline-block;
			    overflow: hidden;
			    transition: all 0.3s ease;
			}

			.history-box:hover .history-box-icon i {
			    opacity: 0.05;
			}

			.history-box:after {
			    content: "";
			    left: -30px;
			    width: 3px;
			    background: #d3e5b2;
			    position: absolute;
			    top: 20px;
			    bottom: -30px;
			    z-index: -1;
			    box-shadow: 0px 0px 15px rgba(51, 51, 51, 0.08);
			}

			.history-box:last-child:after {
			    display: none;
			    margin-bottom: 0px;
			}

			.history-box:last-child {
			    margin-bottom: 0px;
			}
		</style>

	</head>

	<body>

		<?php include "includes/student_navigation.php"; ?>
		
		<div class = "margin"></div>

		<div class="container-fluid">

			<div class="panel panel-default">

				<div class="panel-header">
					
					<div class="row">

						<div class="col-sm-4">

		                  	<button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

		              	</div>

		              	<div class="col-sm-4">
		              		
		              		<center><h3 class="cap">My Achievements</h3></center>

		              	</div>

	              	</div>

				</div>
				
				<div class="panel-body">
					
					<div class="history mt-30">

						<?php 

							$query = "SELECT lessons_tbl.Lesson_desc, selected_class_tbl.Date_completed, ";
							$query .="lessons_tbl.No_of_lesson FROM lessons_tbl LEFT JOIN ";
							$query .="selected_class_tbl ON lessons_tbl.Lesson_Id = ";
							$query .="selected_class_tbl.Lesson_Id WHERE ";
							$query .="selected_class_tbl.User_Id = '$user_id' ";
							$query .="AND selected_class_tbl.Status = 'Completed'";

							$query_info = mysqli_query($con, $query);

							confirmQuery($query_info);

							$count = mysqli_num_rows($query_info);

							if($count == NULL){

								echo "<div class='history-box'>";
								echo "<i class='icon fa fa-graduation-cap'></i>";
								echo "<label class=''></label>";
								echo "<span>Completed Lesson</span>";
								echo "<h5>No results yet</h5>";
								echo "</div>";

							}

							else{
								
								while($row = mysqli_fetch_assoc($query_info)){

									$lesson_desc 	= escape($row['Lesson_desc']);
									$no_of_lesson 	= escape($row['No_of_lesson']);			

									$the_lesson = "$lesson_desc - $no_of_lesson Lessons";

									$date_completed = escape($row['Date_completed']);

									echo "<div class='history-box'>";
									echo "<i class='icon fa fa-graduation-cap'></i>";
									echo "<label class=''>".date('F d, Y', strtotime($date_completed))."</label>";
									echo "<span>Completed Lesson</span>";
									echo "<h5>$the_lesson</h5>";
									echo "</div>";
								}
							}

						?>

					</div>

				</div>

			</div>

		</div>

		<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

	</body>

</html>