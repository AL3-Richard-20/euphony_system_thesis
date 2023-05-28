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

		<link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

		<link rel = "stylesheet"  type="text/css" href="../assets/datatables/datatables.min.css"/>

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->




		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Gallery</title>

	</head>

	<body>

		<?php 

			if(isset($_GET['gid'])){

				$g_id_delete = escape($_GET['gid']);

				$query = "DELETE FROM gallery WHERE G_Id = '{$g_id_delete}'";
				$query_delete_g = mysqli_query($con, $query);

				confirmQuery($query_delete_g);

				if($query_delete_g == 1){
					
					echo "<script>sweetAlert('success', 'Successfully Deleted!', 'You removed a photo from gallery', 'gallery.php');</script>";
				}
			}

		?>

		<!---For Branches Table CMS--->

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
			              <center><h3 class="cap">Gallery</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>
					
				</div>

				<div class="panel-body">

		      		<div class = "text-right">
		      			<a href="gallery_categories.php" title= "Categories" class="btn btn-primary btn-md">Category</a>
		      			<a href="add_gallery.php" title= "Add" class="btn btn-success btn-md">Add</a>
		      		</div><br> 

		     		<div class = 'table-responsive'>   

		        		<table class = 'table table-bordered table-hover' id="standardDesc">

		          			<thead class="cap">
		            			<tr>
		                			<th>No</th>
		                			<th>Description</th>
		                            <th>Category</th>
		                            <th>Date Modified</th>
		                			<th>Time Modified</th>
		                            <th>Image</th>
		                            <th>Action</th>
		              			</tr>
		          			</thead>

		          			<tbody>

		          			<?php
		          				
								$query = "SELECT gallery.G_Id, gallery.Description as GD, ";
								$query .="gallery.Image, gallery_category.GC_Id, gallery. Date_added, ";
								$query .="gallery_category.Description as GCD, gallery.Time_added, ";
								$query .="gallery_category.Date_created FROM gallery LEFT JOIN ";
								$query .="gallery_category ON gallery.GC_Id =  ";
								$query .="gallery_category.GC_Id ";

						        $query_gallery_imgs = mysqli_query($con, $query);

						        $n = 1;

						        while($row 	= mysqli_fetch_array($query_gallery_imgs)){

						        	$g_Id 		= escape($row['G_Id']);
									$g_desc 	= $row['GD'];
									$gc_desc 	= escape($row['GCD']);
									$g_image 	= escape($row['Image']);
									$date_added = escape($row['Date_added']);
									$time_added = escape($row['Time_added']);

							        echo "<tr>";
							        echo "<td>".$n++."</td>";
				                    echo "<td>$g_desc</td>";
				                    echo "<td>$gc_desc</td>";
				                    echo "<td>".date('F d, Y', strtotime($date_added))."</td>";
				                    echo "<td>".date('h:i A', strtotime($time_added))."</td>";
				                    echo "<td><center><img src='../images/gallery/$g_image' class='img-responsive' width='100'></center></td>";
				                    echo "<td>";
				                    echo "<a href='edit_gallery.php?gid=$g_Id' title= 'Edit' class='btn btn-primary btn-md'>Edit</a> ";

				                    ?>

				                    <a href="#" onclick="deleting('action.php?deletegalleryid=<?php echo $g_Id; ?>');" title="Delete" class="btn btn-danger btn-md">Delete</a>

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
			<!---Accordion END--->

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/datatables/datatables.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

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