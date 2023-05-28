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

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.css">

		<link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

		<script type = "text/javascript"  src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<!-- link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->


		<script type = "text/javascript"  src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    	<title>Euphony | Add Branch</title>

	</head>

	<body>

		<?php

	    	if(isset($_POST['branch_desc'])){

				$branch_location 	= escape($_POST['branch_location']);
	    		$branch_desc 		= escape($_POST['branch_desc']);
	    		$branch_level 		= escape($_POST['branch_level']);

	    		$contact_number 	= escape($_POST['contact_number']);
	    		$contact_email 		= escape($_POST['contact_email']);

	    		//branch image
	    		// $branch_image	 	= escape($_FILES["branch_image"]['name']);
	      //   	$branch_image_temp	= $_FILES["branch_image"]['tmp_name'];
	    		// move_uploaded_file($branch_image_temp, "../images/branches/$branch_image");
	    		//branch image END

	    		//contact_image
	    		// $contact_image	 	= escape($_FILES["contact_image"]['name']);
	      //   	$contact_image_temp	= $_FILES["contact_image"]['tmp_name'];
	    		// move_uploaded_file($contact_image_temp, "../images/contact/$contact_image");
	    		//contact_image END

	    		$assigned_admin = escape($_POST['administrator']);

	    		$query = "INSERT INTO branches_tbl ";
	    		$query .="(Branch_location, Branch_desc, Level, Phone_no, Email, randSalt3) ";
	    		$query .="VALUES('$branch_location','$branch_desc','$branch_level', '$contact_number', '$contact_email' ,'1')";

	    		$query_add_branch = mysqli_query($con, $query);

	    		confirmQuery($query_add_branch);

	    		$last_id = mysqli_insert_id($con);

	    		if(!empty($assigned_admin)){

	    			$query2 = "UPDATE user_info_tbl SET Branch_Id = '$last_id' ";
	    			$query2 .="WHERE User_Id = '$assigned_admin' ";
	    			$query_set_admin = mysqli_query($con, $query2);

	    			confirmQuery($query_set_admin);

	    			if($query_set_admin == 1){
						// echo "<script>sweetAlert('success', 'Successfully Added!', 'Check the preview below', 'branches.php');</script>";

						echo "<script>location.href='add_branch_image.php?branchid=$last_id';</script>";
					}
	    		}

	    		else{
	    			// echo "<script>sweetAlert('success', 'Successfully Added!', 'Check the preview', 'branches.php');</script>";

	    			echo "<script>location.href='add_branch_image.php?branchid=$last_id';</script>";
	    		}
	    		
	   	 	}

	    ?>

		<div class = "container-fluid">

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class="margin"></div>

      		<form method = "POST" enctype = "multipart/form-data" novalidate>

      			<div class="col-sm-9">

	          		<div class="panel panel-default">	

	          			<div class="panel-header">
	          				
	          				<div class="row">

					            <div class="col-sm-4">

					                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='branches.php'"><span class="fa fa-arrow-left"></span></button>

					                <!-- <button type = "button" class = "btn btn-default btn-lg" style = "float: left" onclick = "location.href='euphonymusiccenter.000webhostapp.com/branches.php'"><span class="fa fa-arrow-left"></span></button> -->

					            </div>

					            <div class="col-sm-4">
					              <center><h3 class="cap">Add Branch</h3></center>
					            </div>

					            <div class="col-sm-4"></div>

					        </div>

	          			</div>

						<div class='panel-body'>

							<div class="col-sm-12">
								<p><b>Step 1: </b>Branch Information</p>
							</div>

							<div class="col-sm-6">

								<br>

								<!-- <legend><b>Branch Information</b></legend> -->

								<div class="item">
		                          	<p>Branch:</p>
		                          	<input type = "text" class = "form-control" name = "branch_desc" required="required">
	                          	</div>

	                          	<div class="item">
		                          	<p>Address:</p>
		                          	<input type = "text" class = "form-control" name = "branch_location" required="required">
		                        </div>

		                        <div class="item">
		        	                <p>Branch Level:</p>
		            	            <input type = "text" class = "form-control" name = "branch_level" required="required">
		            	        </div>

		            	    </div>

		            	    <div class="col-sm-6">

		            	        <!-- <legend><b>Contact Information</b></legend> -->

		            	        <br>

		            	        <div class="item">
		        	                <p>Contact Number:</p>
		            	            <input type = "number" class = "form-control" name = "contact_number" required="required">
		            	        </div>

		            	        <div class="item">
		        	                <p>Email:</p>
		            	            <input type = "email" class = "form-control" name = "contact_email" required="required">
		            	        </div>

		            	        <div class="item">
		        	                <p>Administrator:</p>
		            	            <select class="form-control" name = "administrator">
		            	            	
		            	            	<option value="">Select Here</option>
		            	            	
		            	            	<?php

								    		$query = "SELECT user_login.User_Id, user_login.Level, ";
								    		$query .="user_info_tbl.User_Id, user_info_tbl.Branch_Id, ";
								    		$query .="user_info_tbl.Last_name, user_info_tbl.First_name, ";
								    		$query .="user_info_tbl.Middle_name FROM user_login LEFT JOIN ";
								    		$query .="user_info_tbl ON user_login.User_Id = ";
								    		$query .="user_info_tbl.User_Id WHERE user_login.Level = ";
								    		$query .="'Administrator' AND user_info_tbl.Status = 1";

		            	            		$query_admin = mysqli_query($con, $query);

		            	            		confirmQuery($query_admin);

		            	            		while($row = mysqli_fetch_assoc($query_admin)){

		            	            			$admin_Id 			= escape($row['User_Id']);
		            	            			$admin_lastname 	= escape($row['Last_name']);
		            	            			$admin_firstname 	= escape($row['First_name']);
		            	            			$admin_middlename 	= escape($row['Middle_name']);

		            	            			$the_admin = "$admin_firstname $admin_middlename $admin_lastname";

		            	            			echo "<option value='$admin_Id'>$the_admin</option>";

		            	            		}


		            	            	?>

		            	            </select>
		            	            
		            	        </div>

		            	    </div>

			            </div>

			            <div class="panel-footer">
			            	<div class="text-right">
			            		<button type = "submit" class = "btn btn-primary btn-lg" id = "send">Next</button>
			            		<button type="button" class="btn btn-default btn-lg" onclick="location.href='branches.php';">Cancel</button>
			            	</div>
			            </div>

			        </div>

			    </div>


			    <div class="col-sm-3">
			        	
			        <div class="panel panel-default">	

						<div class='panel-body'>

							<p><b>Step 2: </b>Branch Image</p><br>

	    					<img src = "../images/default/branch_raw.jpg" class = "img-responsive" id = "image"><br>

    						<p><b>Step 3: </b>Contact Image</p><br>

    						<img src = "../images/default/contact_raw.jpg" class = "img-responsive" id = "image"><br>

    						<!-- <button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button> -->

    						<!-- <button class = "btn btn-primary btn-lg" onclick="location.href='../index.php#Branches';">Preview</button> -->

			            </div>

			        </div>
			        
			    </div>

		    </form>

			</div>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>


		<script type="text/javascript">
		
			//Shows an images in Real-time before uploading
			function showImage(){

		 		if(this.files && this.files[0])
		 		{
		 			var obj = new FileReader();
		 			obj.onload = function(data){
		 				var image = document.getElementById("image");
		 				image.src = data.target.result;
		 				image.style.display = "block";
		 			}
		 			obj.readAsDataURL(this.files[0]);
		 		}
		 	}

		</script>
		
	</body>

</html>