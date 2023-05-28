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

		<title>Euphony | Gallery</title>

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

				                <a href="#" onclick="history.back()" class="btn btn-default btn-lg" style="float: left"><span class="fa fa-arrow-left"></span></a>

				            </div>

				            <div class="col-sm-4">
				              <center><h3 class="cap">Gallery</h3></center>
				            </div>

				            <div class="col-sm-4"></div>

				        </div>

					</div>

					<div class="panel-body"><br>

						<!-- <form method="POST">

							<div class="row">

								<div class="col-sm-4">
									<div class="item">

										<select class="form-control required" name="filter_gallery">

											<option value="">Select Here</option>
											<option value="All">All</option>

											<?php

												$gallery_categories = tableQuery('gallery_category');

												confirmQuery($gallery_categories);

												while($row = mysqli_fetch_assoc($gallery_categories)){

													$gc_Id 		= escape($row['GC_Id']);
													$gc_desc	= escape($row['Description']);

													echo "<option value='$gc_Id'>$gc_desc</option>";
												}

											?>
										</select>
										
									</div>	
								</div>	

								<div class="col-sm-1">
									<button  type="submit" class="btn btn-primary">Apply</button>
								</div>
							</div>

						</form> -->

						<!-- div class="text-center">
							<?php

								if(isset($_POST['filter_gallery'])){

									$filtered_gc_desc = $_POST['filter_gallery'];

									echo "<h3 id='h3'>$filtered_gc_desc</h3>";
								}
								else{
									echo "<h3 id='h3'>All</h3>";
								}

							?>	
						</div> -->

						<?php

							$per_page = 9;

	                        if(isset($_GET['page'])){

	                            $page = $_GET['page'];
	                        }
	                        else{

	                            $page = "";
	                        }

	                        if($page == 0 || $page == 1){

	                            $page_1 = 0;
	                            
	                        }
	                        else{

	                            $page_1 = ($page * $per_page) - $per_page;
	                        }


	                        $gallery_query_count = "SELECT * FROM gallery";
                        	$find_count       = mysqli_query($con, $gallery_query_count);

                        	confirmQuery($find_count);

                        	$count            = mysqli_num_rows($find_count);

                        	$count = ceil($count / 9);

                        	$query = "SELECT * FROM gallery LIMIT $page_1, $per_page";

                        	$select_all_gallery_query = mysqli_query($con, $query);

                        	confirmQuery($select_all_gallery_query);

                        	while($row = mysqli_fetch_assoc($select_all_gallery_query)){

                        		$g_Id 		= escape($row['G_Id']);
								$g_desc 	= $row['Description'];
								$g_image 	= escape($row['Image']);
								$date 		= escape($row['Date_added']);
								$time 		= escape($row['Time_added']);

								echo "<div class='col-sm-4'>";
								echo "<div class='grid_item'>";
								echo "<div class='gallery_dtl'>";
								echo "<img src='images/gallery/$g_image' class='img-responsive'>";
								echo "<div class='gallery_info'>";
								echo "<div class='galleryinfo_wrap'>";
						    	echo "<p>$g_desc</p>";
						    	echo "<p>Date: ".date('F d, Y', strtotime($date))."</p>";
						    	echo "</div>";
								echo "</div>";
								echo "</div>"; 
								echo "</div>";
								echo "</div>";

                        	}

						?>

					</div>

					<ul class = "pager">

			            <?php

			                for($i=1; $i <= $count; $i++){

			                    if($i == $page){

			                        echo "<li><a class = 'active_link' href='gallery.php?page={$i}'>$i</a></li>";

			                    }
			 
			                    else{

			                        echo "<li><a href='gallery.php?page={$i}'>$i</a></li>";

			                    }   
			                }
			            ?>

			        </ul>

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