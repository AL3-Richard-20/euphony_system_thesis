<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<!-- <?php //include "includes/sessions.php"; ?> -->

<!DOCTYPE html>

<html lang = "en">

  	<head>

		<meta charset = "utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1">



		<link rel = "stylesheet" href = "assets/bootstrap/3.3.6/css/bootstrap.min.css">

		<link rel = "stylesheet" href = "assets/font/css/all.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet" href = "includes/style.css">

  		<title>Euphony | Lesson Information</title>

  	</head>

	<body>

		<?php

			if(isset($_GET['lessonid'])){

				$lesson_id = escape($_GET['lessonid']);

				$query_lesson = tableQuery_3('lessons_tbl', 'Lesson_Id', $lesson_id);

				confirmQuery($query_lesson);

				while($row = mysqli_fetch_assoc($query_lesson)){

					$lesson_desc 		= escape($row['Lesson_desc']);
					$lesson_amount		= escape(number_format($row['Amount'],2));
					$no_of_lesson 		= escape($row['No_of_lesson']);
					$icon 				= escape($row['Icon']);
					$cover_image 		= escape($row['Cover_image']);
					$content			= $row['Content'];	

					$the_lesson = "$lesson_desc - $no_of_lesson Lessons";
				}

			}

		?>

		<div class="container">

			<?php include "includes/navigation_2.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">
				
				<div class="panel-header">
					
					<div class="row">

			            <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="history.back()"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Lesson Information</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>
				</div><br>

				<div class="panel-body">
					
					<div class="row">

						<div class="col-sm-6">
							<img src="images/lessons/Cover/<?php echo $cover_image; ?>" class = "img-responsive" style="height:50%;width:100%;">
						</div>

						<div class="col-sm-6">

							<h3><b><?php echo $the_lesson; ?></b></h3>

							<table class="table"><br>
								<tbody>
									<tr>
										<td><p>Price:</p></td>
										<td><b style="color:green;"><?php echo $lesson_amount; ?> PHP</b></td>
									</tr>
									<tr>
										<td><p>Session:</p></td>
										<td><p><?php echo $no_of_lesson; ?></p></td>
									</tr>

									<tr>
										<td><p>Students Enrolled:</p></td>
										<td><p><?php echo studentEnrolled($lesson_id); ?></p></td>
									</tr>

									<tr>
										<td><p>Graduates:</p></td>
										<td><p><?php echo graduatedStudents($lesson_id); ?></p></td>
									</tr>
									<tr>
										<td><p>Rating:</p></td>
										<td><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
									</tr>
									<tr>
										<td><p></p></td>
									</tr>
								</tbody>
							</table><br>

							<p></p>

						</div>

					</div><br>

					<div class="row">

						<div class="col-sm-12">

							<div class="panel-group" id="accordion">

							  	<div class="panel panel-default">

							    	<div class="panel-heading">
							      		<h4 class="panel-title">
							        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><b>Details</b></a>
							      		</h4>
							    	</div>

							    	<div id="collapse1" class="panel-collapse collapse in">
							      		<div class="panel-body">
							      			<span style="white-space: pre-wrap; text-align: justify;"><?php echo $content; ?></span>
							      		</div>

							    	</div>

							  	</div>

							  	<div class="panel panel-default">

							    	<div class="panel-heading">
							      		<h4 class="panel-title">
							        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><b>Our Policy</b></a>
							      		</h4>
							    	</div>

							    	<div id="collapse2" class="panel-collapse collapse">

							      		<div class="panel-body">

							      			<?php 

							      				$query_policy = tableQuery('policy_tbl');

							      				while($row = mysqli_fetch_assoc($query_policy)){

							      					$policy_content = $row['Content'];

							      					echo "<span class='text-justify'>$policy_content</span>";
							      				}
							      			?>
							      			
							      		</div>

							    	</div>

							  	</div>

							</div>

						</div>

					</div>

				</div>

				<div class="panel-footer">
					<div class="text-right">
						<button class="btn btn-default" onclick="location.href='index.php#Services';">Go to homepage</button>
					</div>
				</div>

			</div>		
			
		</div>

		<script src = "assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

	</body>

	<?php include "includes/footer.php"; ?>

</html>