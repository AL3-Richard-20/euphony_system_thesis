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

		<link rel = "stylesheet"  type="text/css" href = "../assets/datatables/datatables.min.css"/>

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<title>Euphony | Categories</title>

	</head>

	<body>

		<?php 

			// if(isset($_POST['category_name'])){

			// 	$category_name = escape($_POST['category_name']);

			// 	$query = "INSERT INTO gallery_category (Description, Date_created, Time_created) ";
			// 	$query .="VALUES ('$category_name', curdate(), curtime())";

			// 	$query_add_category = mysqli_query($con, $query);

			// 	confirmQuery($query_add_category); 

			// 	if($query_add_category == 1){

			// 		echo "<script>sweetAlert('success', 'Successfully Added!', 'You added a category for gallery', 'gallery_categories.php');</script>";
			// 	}

			// }

			// if(isset($_POST['edit_category_name'])){

			// 	$the_category_Id 	= escape($_POST['edit_category_Id']);
			// 	$the_category_name 	= escape($_POST['edit_category_name']);

			// 	$query = "UPDATE gallery_category SET Description = '$the_category_name' ";
			// 	$query .="WHERE GC_Id = '$the_category_Id' ";

			// 	$query_update_category = mysqli_query($con, $query);

			// 	confirmQuery($query_update_category);

			// 	if($query_update_category){	

			// 		echo "<script>sweetAlert('success', 'Successfully Updated!', 'You update a category for gallery', 'gallery_categories.php');</script>";
			// 	}


			// }

		?>

		<div class='container'>

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

					<div class="row">

			            <div class="col-sm-4">

			                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='gallery.php'"><span class="fa fa-arrow-left"></span></button>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Categories</h3></center>
			            </div>

			            <div class="col-sm-4"></div>

			        </div>
					
				</div>

				<div class="panel-body">

		      		<div class = "text-right">
		      			<a href="#" title= "Add" class="btn btn-success btn-md" data-toggle="modal" data-target="#addGalleryCat">Add</a>
		      		</div><br> 

		      		<?php include "includes/add_gallery_cat.php"; ?>

		     		<div class = "table-responsive">   

		        		<table class = 'table table-bordered table-hover' id="standardDesc">

		          			<thead class="cap">
		            			<tr>
		                			<th>No</th>
		                            <th>Description</th>
		                            <th>Date Modified</th>
		                            <th>Time Modified</th>
		                            <th>Action</th>
		              			</tr>
		          			</thead>

		          			<tbody>

		          			<?php
		          			
						        $query_gallery_categories = tableQuery_3('gallery_category', 'Status', 1);;

						        confirmQuery($query_gallery_categories);

						        $n = 1;

						        while($row 	= mysqli_fetch_array($query_gallery_categories)){

						        	$gc_id 			= escape($row["GC_Id"]);
						        	$gc_desc 		= escape($row["Description"]);
						        	$date_created 	= escape($row["Date_created"]);
						        	$time_created 	= escape($row["Time_created"]);

						        	echo "<form method='POST' novalidate>";
							        echo "<tr>";
				                    echo "<td>".$n++."</td>";
				                    echo "<td>$gc_desc</td>";
				                    echo "<td>".date('F d, Y', strtotime($date_created))."</td>";
				                    echo "<td>".date('h:i A', strtotime($time_created))."</td>";
				                    echo "<td>";
				                    echo "<a href='#' title='Edit' class='btn btn-primary btn-md' data-toggle='modal' data-target='#editGalleryCat$gc_id'>Edit</a> ";

				                    ?>

				                    <a href="#" onclick="deleting('action.php?deletegallerycat=<?php echo $gc_id; ?>');" title="Delete" class="btn btn-danger btn-md">Delete</a>

				                    <?php

				                  	echo "</td>";
				                  	echo "</tr>";

				                  	include "includes/edit_gallery_cat.php";
				                  	
				                  	echo "</form>";

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

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/datatables/datatables.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

		<script>

			$(document).ready(function(){

				$('#standardDesc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});
			})
			
			$('#add_cat').submit(function(e){

				e.preventDefault();

				var cat_title = $('#category_name').val();

				if(cat_title == ""){

					alert('Please fill out the field');
				}

				else{

					$.ajax({

						url:"action.php",
						method:"POST",
						data:{
							cattitle:cat_title,
							action:'add_cat'
						},
						success:function(data){

							var result = JSON.parse(data);

							if(result == '1'){
								sweetAlert('success', 'Saved Successfully', 'You added a new category', 'gallery_categories.php');
							}
							else if(result == '2'){
								sweetAlert('error', 'Something went wrong', 'Try again', 'gallery_categories.php');
							}
							else if(result == '3'){
								sweetAlert('info', 'Item has been missing', '', 'gallery_categories.php');
							}
						}

					})

				}

			})

		</script>

	</body>

</html>