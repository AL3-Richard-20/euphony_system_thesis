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

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>	



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

		<title>Euphony | Categories</title>

	</head>

	<body>

		<?php

			if(isset($_POST['category_name'])){

				$edited_category_id 	= $_POST['category_id'];
				$edited_category_name 	= $_POST['category_name'];

				$query = "UPDATE category_tbl SET ";
				$query .="Category_title = '$edited_category_name', ";
				$query .="Date_added = curdate(), Time_added = curtime() ";
				$query .="WHERE Category_Id = '{$edited_category_id}'";

				$query_update_cat = mysqli_query($con, $query);

				confirmQuery($query_update_cat);

				if($query_update_cat){

					echo "<script>sweetAlert('success', 'Successfully Updated', 'You update a category', 'categories.php');</script>";
				}

			}

		?>

		<?php include "includes/headadmin_navigation.php"; ?>

		<div class="margin"></div>

		<div class = "container">
				
			<div class = "panel panel-default">

				<div class = "panel-header">
					
					<div class="row">

		              <div class="col-sm-4">

		                  <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

		              </div>

		              <div class="col-sm-4">
		                <center><h3 class="cap">Categories</h3></center>
		              </div>

		              <div class="col-sm-4"></div>

		            </div>

				</div>

				<div class = "panel-body">

					<div class="row">

						<div class="col-sm-4"></div>

						<div class="col-sm-4"></div>

						<div class="col-sm-4">
							<div class="text-right">
								<a href="#" class="btn btn-success" data-toggle="modal" data-target="#addCategory">Add</a>
							</div>
						</div>

					</div><br>

        			<form method="POST" novalidate>

            			<div class = "table-responsive">

                			<table class = "table table-bordered table-hover" id="standardDesc">

                				<thead class="cap">
                					<tr>
                						<th>No</th>
                						<th>Category</th>
                						<th>Date Modified</th>
                						<th>Time Modified</th>
                						<th>Action</th>
                					</tr>
                				</thead>

                				<tbody>
                					
                					<?php

                						$query = "SELECT * FROM category_tbl WHERE Status = 1";
									    $query_all_category = mysqli_query($con, $query);

									    confirmQuery($query_all_category);

									    $n = 1;

									    while($row = mysqli_fetch_assoc($query_all_category)){

									    	$category_id 	= escape($row['Category_Id']);
									    	$category_title = escape($row['Category_title']);
									    	$date_added	 	= escape($row['Date_added']);
									    	$time_added	 	= escape($row['Time_added']);

									    	echo "<tr>";
									        echo "<td>".$n++."</td>";
									        echo "<td>$category_title</td>";
									        echo "<td>".date('F d,Y', strtotime($date_added))."</td>";
									        echo "<td>".date('h:i A', strtotime($time_added))."</td>";
									        echo "<td>";
									        echo "<a href='' class='btn btn-primary' data-toggle='modal' data-target='#editCategory$category_id'>Edit</a> ";

									        ?>

									        <a href="#" onclick="deleting('action.php?deletecat=<?php echo $category_id; ?>');" title="Delete" class="btn btn-danger btn-md">Delete</a>

									        <?php

									        echo "</td>";

									        include "includes/edit_category.php";

									        echo "</tr>";

									        

									    }
                					?>

                				</tbody>
           
                			</table>

                		</div>

                	</form>

            	</div>

        	</div>

    	</div>

    	<?php include "includes/add_category.php"; ?>

    	<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script type = "text/javascript"  src = "../assets/datatables/datatables.min.js"></script>



		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

		<script>
			
			$(document).ready(function(){

				$('#standardDesc').DataTable({
					select: true,
					"order": [[ 0, "desc" ]]
				});

			});

			$('#add_cat_form').submit(function(e){

				e.preventDefault();

				var category = $('#new_category').val();

				$.ajax({

					url:"action.php",
					method:"POST",
					data:{
						cattitle:category,
						action:"add_category"
					},

					success:function(data){

						var result = JSON.parse(data)

						if(result == '1'){

							sweetAlert('success', 'Successfully Added', 'You added a new category', 'categories.php');
						}
						else if(result == '2'){
							
							sweetAlert('error', 'Suomething went wrong', 'Try again', 'categories.php');
						}
						else if(result == '3'){
							
							sweetAlert('info', 'Item has been missing', 'Try again', 'categories.php');
						}

					}
				});

			})

		</script>

	</body>

</html>