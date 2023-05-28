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

		<link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

		<script src = "../assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->

		<script src = "scripts/functions.js"></script>

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    	<title>Euphony | Edit Branch</title>

	</head>

	<body>

		<?php

			if(isset($_GET['branchid'])){

				$branch_id = $_GET['branchid'];

				$query = "SELECT * FROM branches_tbl WHERE Branch_Id = '$branch_id'";
	  			$query_edit_branch = mysqli_query($con, $query);

	  			while($row = mysqli_fetch_assoc($query_edit_branch)){

	  				$branch_id 		 = escape($row["Branch_Id"]);
	  				$branch_desc 	 = escape($row["Branch_desc"]);
		        	$branch_location = escape($row["Branch_location"]);
		        	$branch_image 	 = escape($row["Branch_image"]);
		        	$branch_level	 = escape($row["Level"]);
		        	$contact_number  = escape($row['Phone_no']);
		        	$contact_email 	 = escape($row['Email']);
		        	$branch_image_2  = escape($row['Branch_image_2']);	

		        }

		        $query2 = "SELECT user_login.User_Id, user_login.Level, ";
        		$query2 .="user_info_tbl.User_Id, user_info_tbl.Branch_Id, ";
        		$query2 .="user_info_tbl.Last_name, user_info_tbl.First_name, ";
        		$query2 .="user_info_tbl.Middle_name FROM user_login LEFT JOIN ";
        		$query2 .="user_info_tbl ON user_login.User_Id = ";
        		$query2 .="user_info_tbl.User_Id WHERE user_login.Level = ";
        		$query2 .="'Administrator' AND user_info_tbl.Branch_Id = '$branch_id'";
        		$query2 .="AND user_info_tbl.Status = 1";

		        $query_the_admin = mysqli_query($con, $query2);

		        confirmQuery($query_the_admin);

		        while($row2 = mysqli_fetch_assoc($query_the_admin)){

		        	$f_admin_Id 			= escape($row2['User_Id']);
        			$f_admin_lastname 		= escape($row2['Last_name']);
        			$f_admin_firstname 		= escape($row2['First_name']);
        			$f_admin_middlename 	= escape($row2['Middle_name']);

        			$f_admin = "$f_admin_firstname $f_admin_middlename $f_admin_lastname";
				}
	    	}

	    	if(isset($_POST['branch_location'])){

	    		$branch_location 	= escape($_POST['branch_location']);
	    		$branch_desc 		= escape($_POST['branch_desc']);
	    		$branch_level 		= escape($_POST['branch_level']);

	    		$contact_number 	= escape($_POST['contact_number']);
	    		$contact_email 		= escape($_POST['contact_email']);

	    		// Branch Administrator
	    		$branch_admin_Id = escape($_POST['administrator']);

	    		$query = "UPDATE branches_tbl SET ";
	    		$query .="Branch_location = '{$branch_location}', ";
	    		$query .="Branch_desc = '{$branch_desc}', ";
	    		$query .="Level = '{$branch_level}', ";  
	    		$query .="Phone_no = '{$contact_number}', ";  
	    		$query .="Email = '{$contact_email}' "; 
	    		$query .="WHERE Branch_Id = '{$branch_id}' ";

	    		$query_update_branch = mysqli_query($con, $query);

	    		confirmQuery($query_update_branch);

	    		if($query_update_branch == 1){

	    			$query2 = "UPDATE user_info_tbl SET Branch_Id = '$branch_id' ";
	    			$query2 .="WHERE User_Id = '$branch_admin_Id' ";

	    			$query_set_admin = mysqli_query($con, $query2);

	    			confirmQuery($query_set_admin);

	    			echo "<script>sweetAlert('success', 'Successfully Updated!', 'You updated a branch', 'branches.php');</script>";
	    		}

	    	}

	    ?>

		<div class = "container-fluid">

			<?php include "includes/headadmin_navigation.php"; ?>

			<div class = "margin"></div>

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
					              <center><h3 class="cap">Edit Branch</h3></center>
					            </div>

					            <div class="col-sm-4"></div>

					        </div>

	          			</div>

						<div class='panel-body'>

							<!-- <legend><b>Branch Information</b></legend> -->
							<div class="col-sm-12">
								<label>Branch Information</label>
							</div><br><br>

							<div class="col-sm-6">

								<div class="item">
		                          	<p>Branch:</p>
		                          	<input type = "text" class = "form-control" name = "branch_desc" value = "<?php echo $branch_desc; ?>" required="required">
	                          	</div>

	                          	<div class="item">
		                          	<p>Branch Address:</p>
		                          	<input type = "text" class = "form-control" name = "branch_location" value = "<?php echo $branch_location; ?>" required="required">
		                        </div>

		                        <div class="item">
		        	                <p>Branch Level:</p>
		            	            <input type = "text" class = "form-control" name = "branch_level" value = "<?php echo $branch_level; ?>" required="required">
		            	        </div>

		            	    </div>

	            	        <!-- <legend><b>Contact Information</b></legend> -->

	            	        <div class="col-sm-6">

		            	        <div class="item">
		        	                <p>Contact Number:</p>
		            	            <input type = "number" class = "form-control" name = "contact_number" value = "<?php echo $contact_number; ?>" required="required">
		            	        </div>

		            	        <div class="item">
		        	                <p>Email:</p>
		            	            <input type = "email" class = "form-control" name = "contact_email" value = "<?php echo $contact_email; ?>" required="required">
		            	        </div>

		            	        <div class="item">
		        	                <p>Administrator:</p>
		            	            <select class="form-control" name = "administrator">

		            	            	<?php

		            	            		if(isset($f_admin_Id)){

		            	            			echo "<option value='$f_admin_Id'>$f_admin</option>";
		            	            		}
		            	            		else{
		            	            			echo "<option value=''>Select Here</option>";
		            	            		}

		            	            	?>
		            	            	

		            	            	<?php

		            	            		$query = "SELECT user_login.User_Id, user_login.Level, ";
		            	            		$query .="user_info_tbl.User_Id, user_info_tbl.Branch_Id, ";
		            	            		$query .="user_info_tbl.Last_name, user_info_tbl.First_name, ";
		            	            		$query .="user_info_tbl.Middle_name FROM user_login LEFT JOIN ";
		            	            		$query .="user_info_tbl ON user_login.User_Id = ";
		            	            		$query .="user_info_tbl.User_Id WHERE user_login.Level = ";
		            	            		$query .="'Administrator' AND user_info_tbl.Status = 1 AND NOT ";
		            	            		$query .="user_info_tbl.User_Id = '$f_admin_Id' ";

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
			            		<button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button>
			            		<button type="button" class="btn btn-default btn-lg" onclick="location.href='branches.php';">Cancel</button>
			            	</div>
			            </div>

			        </div>

			    </div>



			    <div class="col-sm-3">
			        	
			        <div class="panel panel-default">	

						<div class='panel-body'>

							<label>Branch Image</label><br>

	    					<img src = "../images/branches/<?php echo $branch_image; ?>" class = "img-responsive" id = "image"><br>

    						<a href="edit_branch_image.php?branchid=<?php echo $branch_id; ?>&branchimg=<?php echo $branch_image; ?>" class = "btn btn-primary">Edit Image</a>

    						<hr>

    						<label>Contact Image</label><br>

    						<img src = "../images/contact/<?php echo $branch_image_2; ?>" class = "img-responsive" id = "image"><br>

    						<a href="add_contact_image.php?branchid=<?php echo $branch_id; ?>&branchimg=<?php echo $branch_image_2; ?>" class = "btn btn-primary">Edit Image</a>

			            </div>

			        </div>
			        
			    </div>

		    </form>

		</div>

		<script type = "text/javascript"  src = "../assets/jquery/1.12.0/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<script type = "text/javascript"  src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script type = "text/javascript"  src = "../assets/validator/validator.js"></script>

		<script type = "text/javascript"  src = "../assets/validator/validate.js"></script>

		<script>
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