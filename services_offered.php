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

		<title>Euphony | Services Offered</title>

	</head>

	<body>

		<?php

			if(isset($_GET['active']) == 'services'){

				$service_tab = 1;
			}

		?>

		<div class="container-fluid">

			<?php include "includes/navigation_2.php"; ?>

			<div class="margin"></div>

			<div class="panel panel-default">

				<input type="hidden" id="service_tab" value="<?php echo $service_tab; ?>">

				<div class="panel-header">

					<div class="row">

			            <div class="col-sm-4">

			                <a href="index.php#Services" class = "btn btn-default btn-lg" style = "float: left"><span class="fas fa-arrow-left"></span></a>

			            </div>

			            <div class="col-sm-4">
			              <center><h3 class="cap">Services Offered</h3></center>
			            </div>

			            <div class="col-sm-4">
			            </div>

			        </div>

				</div>	

				<div class="panel-body"><br>

					<ul class="nav nav-pills nav-justified">
					  <li class="active" id="li1"><a data-toggle="tab" href="#menu1">Lessons</a></li>
					  <li id="li2"><a data-toggle="tab" href="#menu2">Other Services</a></li>
					</ul><br>

					<div class="tab-content">

					  	<div id="menu1" class="tab-pane fade in active">

					  		<div class="row">
					  			
					  			<div class="col-sm-12">

					  				<div class="col-sm-4">
					  				
						  				<p><b>Session</b></p>

						  				<select class="form-control" id="session_filter">
						  					<option value="">Select price range here</option>
						  					<option value="12">12 Sessions</option>
						  					<option value="24">24 Sessions</option>
						  					<option value="36">36 Sessions</option>
						  					<option value="48">48 Sessions</option>
						  				</select>

						  				

					  				</div>

					  				<div class="col-sm-4"></div>

					  				<div class="col-sm-4">
					  				
						  				<p style="color: white;"><b>Search</b></p>

						  				<input type="text" class="form-control" name="search_box" id="search_box" placeholder="Search Here">

					  				</div>

					  			</div>

					  		</div><br>

					  		<div id="dynamic_content">
					  			
					  		</div>

					  	</div>

					  	<div id="menu2" class="tab-pane fade in">

					    	<?php

					          	$query_all_services = tableQuery('services_tbl');

					          	while($row = mysqli_fetch_assoc($query_all_services)){

						            $service_id 	= escape($row['service_Id']);
						          	$service_title 	= escape($row['title']);
						          	$service_image 	= escape($row['image']);
						          	$service_price 	= escape($row['price']);

						            echo "<div class='col-sm-6'>";
						            echo "<div class='panel panel-default'>";
						            echo "<div class='panel-body'>";
						            echo "<div class='col-sm-6'>";
						            echo "<br><img src='images/services/$service_image' class='img-responsive'>";
						            echo "</div>";
						            echo "<div class='col-sm-6'>";
						            echo "<br><p class='ellip'><b><a href='service_info.php?serviceid=$service_id'>".substr($service_title, 0,30)."</a></b></p>";

						            echo "<table class='table'>";
						            echo "<tbody>";

						            echo "<tr>";
						            echo "<td>";
						            echo "<p>Price: </p>";
						            echo "<td>";
						            echo "<td>";
						            echo "<b style='color: green'>".number_format($service_price,2)." PHP</b>";
						            echo "</td>";
						            echo "</tr>";

						            echo "<tr>";
						            echo "<td>";
						            echo "<p>Rating: </p>";
						            echo "<td>";
						            echo "<td>";
						            echo "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
						            echo "</td>";
						            echo "</tr>";

						            echo "</tbody>";
						            echo "</table>";


						            echo "</div>";
						            echo "</div>";
						            echo "</div>";
						            echo "</div>";
						        }
							?>

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

				function load_data(page, query = '', query1 =''){

					$.ajax({
						url:"fetch_lessons.php",
						method:"POST",
						data:{
							page:page,
							query:query,
							query1:query1
						},
						success:function(data){

							$('#dynamic_content').html(data);
						}
					})
				}

				load_data(1);




				$('#search_box').keyup(function(){

					var query = $('#search_box').val();
					var query1 = $('#session_filter').val();

					if(query1 != null){
						load_data(1, query, query1);
					}
					else{
						load_data(1, query);
					}	
				});


				$('#session_filter').change(function(){

					var query = $('#search_box').val();
					var query1 = $('#session_filter').val();
					
					if(query != null){
						load_data(1, query, query1);
					}
					else{
						load_data(1, query1);
					}	
				});




				$(document).on('click', '.page-link', function(){

					var page = $(this).data('page_number');
					var query = $('search_box').val();
					var query1 = $('#session_filter').val();

					if(query != null){
						load_data(page, query);
					}
					else if(query1 != null){
						load_data(page, '', query1);
					}
					else if(query != null && query1 != null){
						load_data(page, query, query1);
					}

				});
			})

		</script>

	</body>

	<?php include "includes/footer.php"; ?>

</html>