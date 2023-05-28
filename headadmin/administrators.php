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

		<link rel = "stylesheet"  type="text/css" href = "../assets/datatables/datatables.min.css"/>

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Administrators</title>

	</head>

	<body>

		<?php 

			if(isset($_GET['delete_branch_id'])){

				$branch_id_delete = escape($_GET['delete_branch_id']);

				$query = "DELETE FROM branches_tbl WHERE Branch_Id = '{$branch_id_delete}'";
				$query_delete_branch = mysqli_query($con, $query);

				if(!$query_delete_branch){

					die("ERROR" . mysqli_error($con));
					
				}
			}

		?>

		<!---For Branches Table CMS--->

		<!---Table--->
		<div class='container'>

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class = "margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

					<div class="row">

			            <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Administrator/s</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>
					
				</div>

				<div class="panel-body">

		      		<div class = "text-right">
		      			<a href="add_admin.php" title= "Add" class="btn btn-success btn-md">Add</a>
		      		</div><br> 

		     		<div class = 'table-responsive'>   

		        		<table class = 'table table-bordered table-hover' style = "background-color: #fff;" id="standardDesc">

		          			<thead class="cap">
		            			<tr>
		                			<th>No</th>
		                            <th>Name</th>
		                            <th>Branch</th>
		                            <th>Action</th>
		              			</tr>
		          			</thead>

		          			<tbody>

		          			<?php

        	            		$query = "SELECT user_login.User_Id, user_login.Level, ";
        	            		$query .="user_info_tbl.User_Id, user_info_tbl.Branch_Id, ";
        	            		$query .="user_info_tbl.Last_name, user_info_tbl.First_name, ";
        	            		$query .="user_info_tbl.Middle_name, user_login.Date_started, "; 
        	            		$query .="branches_tbl.Branch_desc FROM user_login LEFT JOIN ";
        	            		$query .="user_info_tbl ON user_login.User_Id = ";
        	            		$query .="user_info_tbl.User_Id LEFT JOIN branches_tbl ";
        	            		$query .="ON user_info_tbl.Branch_Id = branches_tbl.Branch_Id ";
        	            		$query .="WHERE user_login.Level = 'Administrator' AND ";
        	            		$query .="user_info_tbl.Status = 1";

        	            		$query_admin = mysqli_query($con, $query);

        	            		confirmQuery($query_admin);

        	            		$n = 1;

        	            		while($row = mysqli_fetch_assoc($query_admin)){

        	            			$admin_Id 			= escape($row['User_Id']);
        	            			$admin_lastname 	= escape($row['Last_name']);
        	            			$admin_firstname 	= escape($row['First_name']);
        	            			$admin_middlename 	= escape($row['Middle_name']);

        	            			$the_admin = "$admin_firstname $admin_middlename $admin_lastname";

        	            			$admin_branch_Id 	= escape($row['Branch_Id']);
        	            			$admin_branch_desc 	= escape($row['Branch_desc']);

        	            			echo "<tr>";
        	            			echo "<td>".$n++."</td>";
        	            			echo "<td><a href='admin_view_profile.php?userid=$admin_Id'>$the_admin</a></td>";
        	            			echo "<td><a href='edit_branches.php?branchid=$admin_branch_Id'>$admin_branch_desc</a></td>";
        	            			echo "<td>";
        	            			echo "<a href='admin_view_profile.php?userid=$admin_Id' class='btn btn-primary'>View</a> ";
        	            			?>

        	            			<a href="#" onclick="deleting('action.php?inactiveadmin=<?php echo $admin_Id; ?>');" title="Delete" class="btn btn-danger btn-md">Delete</a>

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

		<<!-- script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

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