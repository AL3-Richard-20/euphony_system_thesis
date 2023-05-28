<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

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

		<title>Euphony | Products</title>

	</head>

	<body>

			<div class="container">

				<?php include "includes/navigation_2.php"; ?>

				<div class="margin"></div>

				<div class="row">

					<div class="panel panel-default">
						
						<div class="panel-header">

							<div class="row">

					            <div class="col-sm-4">

					                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="history.back()"><span class="fa fa-arrow-left"></span></button>

					            </div>

					            <div class="col-sm-4">
					              <center><h3 class="cap">Our Products</h3></center>
					            </div>

					            <div class="col-sm-4"></div>

					        </div>

						</div>

						<div class="panel-body">

							<center><p>Go to our nearest stores to purchase these items!</p></center><hr/>

							<div class="row">

								<div class="col-sm-12">

									<div class="col-sm-4">
										
										<p><b>Branch</b></p>

										<select class="form-control" id="branch_filter">

											<option value="All">Select Here</option>

											<?php

												$query = "SELECT * FROM branches_tbl";
							                    
							                    $query_branch = mysqli_query($con, $query);

							                    foreach($query_branch as $row)
							                    {
							                    	$branch_id 		 = $row['Branch_Id'];
							                    	$branch_desc 	 = $row['Branch_desc']; 

							                    	echo "<option value='$branch_id'>$branch_desc</option>";
						                    	}

											?>

										</select>

									</div>

									<div class="col-sm-4">
										
										<p><b>Category</b></p>

										<select class="form-control" id="category_filter">

											<option value="All">Select Here</option>
											<option value="All">All</option>

											<?php

												$query = "SELECT * FROM category_tbl";
							                    $query_categories = mysqli_query($con, $query);

							                    foreach($query_categories as $row)
							                    {
							                    	$category_id = $row['Category_Id'];
							                    	$category_title = $row['Category_title'];

							                    	echo "<option value='$category_id'>$category_title</option>";

							                    }

											?>

										</select>

									</div>

									<div class="col-sm-4">

										<p style="color:white"><b>Search</b></p>

						  				<input type="text" class="form-control" name="search_box" id="search_box" placeholder="Search Here">

					  				</div>

					  			</div>

			  				</div><hr>

				            <div class="col-sm-12">

				                <div class="filter_data">

				                </div>

				            </div>

						</div>

					</div>

	        </div>

		</div>

		<script src = "assets/jquery/1.12.0/jquery.min.js"></script>

		<script src = "assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>



		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script>
	
			$(document).ready(function(){

			    filter_data();

			    function filter_data(search, branch, category){
			    	
			        var all 		= get_filter('all');

			        $.ajax({

			            url:"fetch_data.php",
			            method:"POST",
			            data:{
			            	action:"fetch_data", 
			            	branch:branch, 
			            	category:category,
			            	search:search
			            },
			            success:function(data){
			                $('.filter_data').html(data);
			            }

			        });

			    }

			    function get_filter(class_name){

			        var filter = [];

			        $('.'+class_name+':checked').each(function(){
			            filter.push($(this).val());
			        });

			        return filter;
			    }

			    $('.common_selector').click(function(){
			        filter_data();
			    });


			    $('#search_box').keyup(function(){

			    	var query = $('#search_box').val();

			    	var query1 = $('#branch_filter').val();
			    	var query2 = $('#category_filter').val();

			    	if(query1 != ""){
			    		filter_data(query, query1);
			    	}
			    	else if(query2 != ""){
						filter_data(query, '', query2);
					}

					else if(query1 != "" && query2 != ""){
						filter_data(query, query1, query2);
					}

			    	else if(query1 == "" && query2 == ""){
						filter_data(query);
					}

				});




				$('#branch_filter').change(function(){

					var query1 = $('#branch_filter').val();

					var query = $('#search_box').val();
					var query2 = $('#category_filter').val();

					// if(query != ""){
					// 	filter_data(query, query1);
					// }
					// else{
					// 	filter_data(' ', query1);
					// }

					if(query != ""){
			    		filter_data(query, query1);
			    	}
			    	else if(query2 != ""){
						filter_data('', query1, query2);
					}

					else if(query != "" && query2 != ""){
						filter_data(query, query1, query2);
					}

			    	else if(query == "" && query2 == ""){
						filter_data(query1);
					}

				});


				$('#category_filter').change(function(){

					var query2 = $('#category_filter').val();

					var query = $('#search_box').val();
					var query1 = $('#branch_filter').val();
					
					if(query1 != ""){
			    		filter_data('', query1, query2);
			    	}
			    	else if(query != ""){
						filter_data(query, '', query2);
					}

					else if(query != "" && query1 != ""){
						filter_data(query, query1, query2);
					}

			    	else{
						filter_data('', '', query2);
					}

				});


			});

		</script>

	</body>

</html>