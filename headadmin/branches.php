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

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Branches</title>

	</head>

	<body>

		<!---Table--->
		<div class='container'>

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class = "margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

					<div class="row">

			            <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='content_management.php'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Branches</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>
					
				</div>

				<div class="panel-body">

		      		<div class = "text-right">
		      			<a href="add_branch.php" title= "Add" class="btn btn-success btn-md">Add</a>
		      		</div><br> 

		     		<div class = "table-responsive">   

		        		<table class = 'table table-bordered table-hover' id="standardDesc">

		          			<thead class="cap">
		            			<tr>
		                			<th>No</th>
		                            <th>Branch</th>
		                            <th>Address</th>
		                            <th>Administrator</th>
		                            <th>Level</th>
		                            <th>Action</th>
		              			</tr>
		          			</thead>

		          			<tbody>

		          			<?php
		      					
		      					$query = "SELECT * FROM branches_tbl WHERE randSalt3 = 1";

		          				$query_branches = mysqli_query($con, $query);

		          				confirmQuery($query_branches);

						        while($row 	= mysqli_fetch_array($query_branches)){

						        	$branchid 		= escape($row["Branch_Id"]);
						        	$branchdesc 	= escape($row["Branch_desc"]);
						        	$branchlocation = escape($row["Branch_location"]);
						        	$branch_level	= escape($row["Level"]);

							        echo "<tr>";
				                    echo "<td>$branchid</td>";
				                    echo "<td>$branchdesc</td>";
				                    echo "<td>$branchlocation</td>";

				                    $query2 ="SELECT user_info_tbl.Branch_Id, ";
				                    $query2 .="user_info_tbl.First_name, user_info_tbl.Last_name ";
				                    $query2 .="FROM user_info_tbl LEFT JOIN user_login ON ";
				                    $query2 .="user_info_tbl.User_Id = user_login.User_Id ";
				                    $query2 .="WHERE user_info_tbl.Branch_Id = '$branchid' ";
				                    $query2 .="AND user_login.Level = 'Administrator' AND ";
				                    $query2 .="user_info_tbl.Status = 1";

				                    $query_admin = mysqli_query($con, $query2);

				                    confirmQuery($query_admin);

				                    $row = mysqli_fetch_assoc($query_admin);

				                    $administrator 	= $row['First_name']." ".$row['Last_name'];

				                    if($administrator == " "){
				                    	echo "<td>None</td>";
				                    }
				                    else{
				                    	echo "<td>$administrator</td>";
				                    }

				                    echo "<td>$branch_level</td>";
				                    echo "<td>";
				                    echo "<a href='edit_branches.php?branchid=$branchid' title= 'Edit' class='btn btn-primary btn-md'>Edit</a> ";

				                    ?>

				                    <a href="#" onclick="deleting('action.php?deletebranchid=<?php echo $branchid; ?>');" title="Delete" class="btn btn-danger btn-md">Delete</a>

				                    <?php

				                  	echo "</td>";
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

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->


		<script>
			
			$(document).ready(function(){

				$('#standardDesc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

			})

		</script>

	</body>

</html>