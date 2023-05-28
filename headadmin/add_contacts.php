
<!---Includes-->
<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/headadmin_header.php"; ?>
<?php include "includes/headadmin_header_bottom.php"; ?>
<?php include "includes/headadmin_navigation.php"; ?>
<?php include "includes/functions.php"; ?>
<!---Includes END-->

<!DOCTYPE html>

<html lang = "en">

	<head>
		
    	<title>Euphony | Content Management System</title>

		<style>
			.image-responsive{
				width: 100%;
			}
		</style>

	</head>

	<body>

		<div class = "container">

			<div class = "margin"></div>

			<?php

		    	if(isset($_POST['contact_address'])){

		    		$contact_location 	= escape($_POST["contact_location"]);
		        	$contact_email 		= escape($_POST["contact_email"]);
		        	$contact_address 	= escape($_POST["contact_address"]);
		        	$contact_phone		= escape($_POST["contact_phone"]);
		        	$contact_label	 	= escape($_FILES["contact_label"]['name']);
		        	$contact_label_temp	= $_FILES["contact_label"]['tmp_name'];
		        	
		    		move_uploaded_file($contact_label_temp, "../images/extras/$contact_label");

		    		$query = "INSERT INTO contact_us_tbl(Location, Phone_no, Email, Label, Address) ";
		    		$query .= "VALUES('$contact_location','$contact_phone','$contact_email','$contact_label','$contact_address')";

		    		$query_add_contacts = mysqli_query($con, $query);

		    		confirmQuery($query_add_contacts);

		    		echo "<script>sweetAlert('success', 'Successfully Added!', 'Check the preview below', 'contact_us.php');</script>";

		    	}

		    ?>

      		<form method = "POST" enctype = "multipart/form-data" novalidate>

          		<div class="panel panel-default">

          			<div class="panel-header">
          				<center><h3>Add Contact Information</h3></center><br>
          			</div>

					<div class='panel-body'>

    					<div class = "col-sm-4">
    						<div class="item">
      							<img src = "../images/default/contact_raw.jpg" class = "image-responsive" id = "image"><br><br>
      							<input type = "file" name = "contact_label" onchange = "showImage.call(this)" required="required">
      						</div>
    					</div>

                        <div class = "col-sm-4">

                        	<div class="item">
	                          	<p>Location:</p>
	                          	<input type = "text" class = "form-control" name = "contact_location" required="required">
                          	</div>

                          	<div class="item">
                          		<p>Phone Number:</p>
                          		<input type = "text" class = "form-control" name = "contact_phone" required="required">	
                          	</div>

                        </div>

                        <div class= "col-sm-4">

                        	<div class="item">
        	                	<p>Email:</p>
            	            	<input type = "text" class = "form-control" name = "contact_email" required="required">
            	            </div>

            	            <div class="item">
	            	            <p>Address:</p>
	            	            <input type = "text" class = "form-control" name = "contact_address" required="required">
	            	        </div>

                        </div>

		            </div>

		            <div class = "panel-footer">
		            	<div class = "text-right">
		            		<button type = "submit" class = "sendbtn" id = "send">Save</button>
          					<button type = "button" class = "regbtn" onclick = "location.href='contact_us.php';">Cancel</button>
          				</div>
		            </div>

		        </div>

		    </form>

		</div>

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