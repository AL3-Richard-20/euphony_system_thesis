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

		<link rel = "stylesheet"  type="text/css" href="../assets/datatables/datatables.min.css"/>

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Logs</title>

	</head>

	<body>

		<?php

			if(isset($_POST['date_filter'])){

				$date_filter = $_POST['date_filter'];

			}
			else{
				$date_filter = "Today";
			}
			
		?>

		<!---Table--->
		<div class='container-fluid'>

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

					<div class="row">

			            <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Activity Logs</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>
					
				</div>

				<div class="panel-body">

					<form method="POST">

						<div class="row">
	    					<div class="col-sm-4">	
	    						<input type="date" name="date_filter" class="form-control">
	    					</div>
	    					<div class="col-sm-4"><button class = "btn btn-primary">Apply</button></div>
	    				</div><br>

	    			</form>

	    			<div class="row">

	    				<div class="text-center">
		    				<?php

		    					if(isset($date_filter)){

						            if($date_filter != 'Today'){

						            	echo "<p>Activity Log as of</p>";

						            	echo "<b>".date('F d, Y',strtotime($date_filter))."</b>";
						            	
						            }
						        }
		    				?>

		    			</div>

	    			</div>

		     		<div class = 'table-responsive'>   

		        		<table class = 'table table-bordered table-hover' id="standardAsc">

		          			<thead class="cap">
		            			<tr>
		                			<th>No</th>
		                            <th>Date</th>
		                            <th>Time</th>
		                            <th>Detail</th>
		                            <th>User</th>
		              			</tr>
		          			</thead>

		          			<tbody>

		          			<?php
		          				
		          				if($date_filter == 'Today'){

		          					$query = "SELECT activity_log.Date, activity_log.Time, ";
			          				$query .="activity_log.Detail, user_info_tbl.Last_name, ";
			          				$query .="user_info_tbl.Middle_name, user_info_tbl.First_name ";
			          				$query .="FROM activity_log LEFT JOIN user_info_tbl ON ";
			          				$query .="activity_log.User_Id = user_info_tbl.User_Id ";
			          				$query .="ORDER BY activity_log.Trans_Id DESC";

		          				}

		          				else{

			          				$query = "SELECT activity_log.Date, activity_log.Time, ";
			          				$query .="activity_log.Detail, user_info_tbl.Last_name, ";
			          				$query .="user_info_tbl.Middle_name, user_info_tbl.First_name ";
			          				$query .="FROM activity_log LEFT JOIN user_info_tbl ON ";
			          				$query .="activity_log.User_Id = user_info_tbl.User_Id ";
			          				$query .="WHERE activity_log.Date = '$date_filter' ";
			          				$query .="ORDER BY activity_log.Trans_Id DESC";
			          			}

						        $query_activities = mysqli_query($con, $query);

						        confirmQuery($query_activities);

						        $n = 1;

						        while($row 	= mysqli_fetch_array($query_activities)){

						        	$act_date 	 = escape($row['Date']);
						        	$act_time 	 = escape($row['Time']);
						        	$detail   	 = escape($row['Detail']);
						        	$last_name 	 = escape($row['Last_name']);
						        	$first_name  = escape($row['First_name']);
						        	$middle_name = escape($row['Middle_name']);

						        	$fullname = "$first_name $middle_name $last_name";

							        echo "<tr>";
				                    echo "<td>".$n++."</td>";
				                    echo "<td>".date('F d, Y', strtotime($act_date))."</td>";
				                    echo "<td>".date('h:i A', strtotime($act_time))."</td>";
				                    echo "<td>$detail</td>";
				                    echo "<td>$fullname</td>";
				                  	echo "</tr>";

						        }

						    ?>

						    </tbody>

				        </table>

					</div>

				</div>

			</div>

		</div>	
		<!---Table END--->

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/datatables/datatables.min.js"></script>

		<<!-- script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<script>
			

		$(document).ready(function(){

			$('#standardAsc').DataTable({
				select: true,
				"order": [[ 0, "asc" ]]
			});

		});

		</script>

	</body>

</html>