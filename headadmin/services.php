<?php session_start(); ?>
<?php include "../includes/db.php";?>
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

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Services Offered</title>

		<style> .image-size{height: 60px;width: 90px;}</style>

	</head>

	<body>

		<?php

			if(isset($_GET['active']) == 'services'){

				$service_tab = 1;
			}

		?>

		<div class="container">

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">
				
				<div class="panel-header">

					<div class="row">

			            <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='content_management.php'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			            	<center><h3 class="cap">Services Offered</h3></center>
			            </div>

			        </div>

				</div>

				<input type="hidden" id="service_tab" value="<?php echo $service_tab; ?>">

				<div class="panel-body">

					<ul class="nav nav-pills nav-justified">
					  	<li id="li1" class="active"><a data-toggle="pill" href="#menu1">Lesson/s</a></li>
					  	<li id="li2"><a data-toggle="pill" href="#menu2">Other Services</a></li>
					</ul>

					<div class="tab-content">

					  	<div id="menu1" class="tab-pane fade in active"><br>
					
							<div class = "text-right">
				      			<a href="add_lessons.php" title= "Add" class="btn btn-success btn-md">Add</a>
				      		</div><br>

				      		<div class = 'table-responsive'>  

				        		<table class = 'table table-bordered table-hover' id = "lessons">

				          			<thead class="cap">
				            			<tr>
				                			<th>ID</th>
				                            <th>Description</th>
				                            <th>Price</th>
				                            <th>Action</th>
				              			</tr>
				          			</thead>

				          			<?php

				                        $query_all_lessons = tableQuery_3('lessons_tbl', 'Status', 1);

								        while($row = mysqli_fetch_array($query_all_lessons)){
								          		
								          	$lesson_id 		= escape($row['Lesson_Id']);
								          	$lesson_desc 	= escape($row['Lesson_desc']);
								          	$amount 		= escape($row['Amount']);
								          	$no_of_lesson 	= escape($row['No_of_lesson']);

								          	$the_lesson = "$lesson_desc - $no_of_lesson Lessons";

							          		echo "<tr>";
								            echo "<td>{$lesson_id}</td>";
								            echo "<td>$the_lesson</td>";
								            echo "<td>".number_format($amount,2)." PHP</td>";
								            echo "<td>";
								            echo "<a href='edit_lessons.php?lessonid=$lesson_id' title= 'Edit' class='btn btn-primary btn-md'>Edit</a> ";

								            ?>

								            <a href="#" onclick="deleting('action.php?deletelesson=<?php echo $lesson_id; ?>');" title="Delete" class="btn btn-danger btn-md">Delete</a>

								            <?php

								            echo "</td>";
								            echo "</tr>";
								        }
				          			?>

						        </table>

							</div>
					<!---Table for Services Offered END--->

					</div>

					<div id="menu2" class="tab-pane fade in"><br>

						<div class = "text-right">
							<a href="add_services.php" title= "Add" class="btn btn-success btn-md">Add</a>
						</div><br>

					<!---Table for Services Offered--->
	     			<div class = 'table-responsive'>  

		        		<table class = 'table table-bordered table-hover' id="services">

		          			<thead class="cap">
		            			<tr>
		                			<th>ID</th>
		                            <th>Description</th>
		                            <th>Image</th>
		                            <th>Price</th>	
		                            <th>Action</th>
		              			</tr>
		          			</thead>

		          			<?php

						        $query_all_services = tableQuery_3('services_tbl', 'Status', 1);

						        while($row = mysqli_fetch_array($query_all_services)){
						          	
						          	$service_id 	= escape($row['service_Id']);
						          	$service_title 	= escape($row['title']);
						          	$service_image 	= escape($row['image']);
						          	$service_price 	= escape($row['price']);

					          		echo "<tr>";    	
									echo "<td>{$service_id}</td>";
									echo "<td>{$service_title}</td>";
									echo "<td>'<img src = '../images/services/$service_image' class = 'image-size'>'</td>";
									echo "<td>".number_format((int)$service_price,2)." PHP</td>";
									echo "<td>";
									echo "<a href='edit_services.php?serviceid=$service_id' title= 'Edit' class='btn btn-primary btn-md'>Edit</a> ";

									?>

									<a href="#" onclick="deleting('action.php?deleteservice=<?php echo $service_id; ?>');" title="Delete" class="btn btn-danger btn-md">Delete</a>

									<?php

									echo "</td>";
									echo "</tr>";
					        	}

		          			?>

				        </table>

					</div>

				</div>

			</div>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript"  src = "../assets/datatables/datatables.min.js"></script>

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<script>
			
			$(document).ready(function(){

				$('#lessons').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

				$('#services').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

				var service = $('#service_tab').val();

				if(service == 1){
					$('#li1').removeClass('active');
					$('#li1').removeAttr('href data-toggle');
					$('#li1').removeClass('active');
					$('#menu1').removeClass('active');
					$('#li2').addClass('active');
					$('#menu2').addClass('active');
					$('#li2').attr('href', '#menu2');
					$('#li2').attr('data-toggle', 'pill');
				}

			});

		</script>

	</body>

</html>