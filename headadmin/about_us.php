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

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<link rel = "stylesheet"  type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    	<title>Euphony | About Us</title>

		<style> .image-responsive{width: 100%;}</style>

	</head>

	<body>
		
		<?php

			//For About Us Table (CMS)

			$about_us_query = tableQuery_3('about_us_tbl', 'Id', 1);

			while($row = mysqli_fetch_array($about_us_query)){

				$about_us_content 	= $row['Content'];
				$about_us_image		= escape($row['Image']);

			}

			if(isset($_POST['about_content'])){

				$about_content  	= $_POST['about_content'];
				$mission_content 	= $_POST['mission'];
				$vision_content 	= $_POST['vision'];

				$query = "UPDATE about_us_tbl SET Content = '{$about_content}'";

				$query_update_about = mysqli_query($con, $query);

				confirmQuery($query_update_about);

				if($query_update_about == 1){

					$query2 = "UPDATE about_us_tbl SET Content = '{$mission_content}' WHERE Id = 2";
					$update_content_mission = mysqli_query($con, $query2);

					confirmQuery($update_content_mission);
				}

				if($update_content_mission == 1){

					$query3 = "UPDATE about_us_tbl SET Content = '{$vision_content}' WHERE Id = 3";
					$update_content_vision = mysqli_query($con, $query3);

					confirmQuery($update_content_vision);

					echo "<script>sweetAlert('success', 'Successfully Updated!', 'Check the preview below', 'about_us.php');</script>";
				}

			}

		?>

		<div class="container-fluid">

			<?php include "includes/headadmin_navigation.php" ?>

			<div class="margin"></div>

			<form method = "POST" enctype = "multipart/form-data" novalidate>

      			<div class="col-sm-9">

	          		<div class="panel panel-default">	

	          			<div class="panel-header">
	          				
	          				<div class="row">

					            <div class="col-sm-4">

					                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='content_management.php'"><span class="fa fa-arrow-left"></span></button>

					            </div>

					            <!-- <div class="col-sm-4"><br>
				                  	<button type = "button" class = "btn btn-default btn-lg" style = "float: left" onclick = "location.href='euphonymusiccenter.000webhostapp.com/index.php'"><span class = "fa fa-arrow-left"></span></button>
				              	</div> -->

					            <div class="col-sm-4">
					              <center><h3 class="cap">Edit About, Mission & Vision</h3></center>
					            </div>

					            <div class="col-sm-4"></div>

					        </div>

	          			</div>

						<div class='panel-body'>

							<legend><b>About</b></legend>

							<?php

								if(isset($about_us_content)){

									?>

										<textarea class="form-control" name="about_content" id="about_content" rows="10" onKeyDown="limitText(this.form.about_content, 928, 929)" style="font-size: 17px; text-align: justify;"><?php echo $about_us_content; ?></textarea><br>

									<?php
								}

								else{

									?>

										<textarea class="form-control" name="about_content" id="about_content" rows="10" onKeyDown="limitText(this.form.about_content, 928, 929)" style="font-size: 17px"></textarea><br>

									<?php

								}

							?>

							<div class="text-right">
								<p>Maximum characters: 
								<strong style="color:green; font-size: 20px" id="inputted1">0</strong> / <strong style="color:green; font-size: 20px">930</strong></p>
							</div>



	            	        <legend><b>Mission</b></legend>

	            	        <?php

		              			$query_mission = tableQuery_3("about_us_tbl", "Id", 2);

		              			confirmQuery($query_mission);

		              			while($row = mysqli_fetch_assoc($query_mission)){

		              				$id 		= escape($row["Id"]);
		              				$mission 	= $row["Content"];

		              			}

		              			$count_record = mysqli_num_rows($query_mission);

		              			if($count_record == NULL){

		              				?>

		              				<textarea class="form-control" name='mission' id='mission' rows='10' onKeyDown='limitText(this.form.mission, 928, 929)' style="font-size: 17px; text-align: justify;"></textarea><br>

		              				<?php

		              			}

		              			else{

		              				?>

		              				<textarea class="form-control" name='mission' id='mission' rows='10' onKeyDown='limitText(this.form.mission, 928, 929)' style="font-size: 17px; text-align: justify;"><?php echo $mission; ?></textarea><br>

		              				<?php
		              			}

		              		?>

		              		<div class="text-right">
								<p>Maximum characters: 
								<strong style="color:green; font-size: 20px" id="inputted2">0</strong> / <strong style="color:green; font-size: 20px">930</strong></p>
							</div>




		              		<legend><b>Vision</b></legend>

		              		 <?php

		              			$query_vision = tableQuery_3("about_us_tbl", "Id", 3);

		              			while($row = mysqli_fetch_assoc($query_vision)){

		              				$id 		= escape($row["Id"]);
		              				$vision 	= $row["Content"];

		              			}

		              			$count_record = mysqli_num_rows($query_vision);

		              			if($count_record == NULL){

		              				?>

		              				<textarea class="form-control" name='vision' id='vision' rows='10' onKeyDown='limitText(this.form.vision, 928, 929)' style="font-size: 17px; text-align: justify;"></textarea><br>

		              				<?php

		              				echo "<textarea class = 'ckeditor' name = 'vision' rows = '5'></textarea><br>";
		              			}

		              			else{

		              				?>

		              				<textarea class="form-control" name='vision' id='vision' rows='10' onKeyDown='limitText(this.form.vision, 928, 929)' style="font-size: 17px; text-align: justify;"><?php echo $vision; ?></textarea><br>

		              				<?php

		              			}

		              		?>

		              		<div class="text-right">
								<p>Maximum characters: 
								<strong style="color:green; font-size: 20px" id="inputted3">0</strong> / <strong style="color:green; font-size: 20px">930</strong></p>
							</div>

			            </div>

			        </div>

			    </div>

			    <div class="col-sm-3">
			        	
			        <div class="panel panel-default">	

						<div class='panel-body'>

							<label>Image</label><br>

	    					<?php

	    						if(isset($about_us_image)){

	    							echo "<img src = '../images/about/$about_us_image' class = 'image-responsive' id = 'image'><br>";

	    							if($about_us_image == NULL){

										echo "<img src = '../images/default/About_alt.jpg' class = 'image-responsive' id = 'image'><br>";
									}
	    						}
	    						else{
	    							echo "<img src = '../images/default/About_alt.jpg' class = 'image-responsive' id = 'image'><br>";
	    						}
								

							?><br>

    						<div class="item">

	    						<a href="croppie_about.php" class = "btn btn-primary">Upload a photo</a>

    						</div>

    						<button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button>

    						<!-- <button class = "btn btn-default btn-lg" onclick="location.href='../index.php#Branches';">Preview</button> -->

			            </div>

			        </div>
			        
			    </div>

		    </form>

		</div>	

		<!---Table END--->


		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/ckeditor/ckeditor.js" type = "text/javascript"></script>

		<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

		<script>
			
			$(document).ready(function(){

				//About Us
				var content1 = $('#about_content').val();
				var count1 	= content1.length;

				document.getElementById('inputted1').innerHTML = count1;

				$('#about_content').keyup(function(){

					var content1 = $('#about_content').val();
					var count1 	= content1.length;

					document.getElementById('inputted1').innerHTML = count1; 
				})
				//About Us END

				//Mission
				var content2 = $('#mission').val();
				var count2 	= content2.length;

				document.getElementById('inputted2').innerHTML = count2;

				$('#mission').keyup(function(){

					var content2 = $('#mission').val();
					var count2 	= content2.length;

					document.getElementById('inputted2').innerHTML = count2; 
				})
				//Mission END

				//vision
				var content3 = $('#vision').val();
				var count3 	= content3.length;

				document.getElementById('inputted3').innerHTML = count3;

				$('#vision').keyup(function(){

					var content3 = $('#vision').val();
					var count3 	= content3.length;

					document.getElementById('inputted3').innerHTML = count3; 
				})
				//vision END

			})	

		</script>

	</body>

</html>