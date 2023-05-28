<?php
	
	include "../includes/db.php";
	include "includes/functions.php";

	if(isset($_GET['deletebranchid'])){
		
		$the_branch_Id = escape($_GET['deletebranchid']);

		$query 				= "UPDATE branches_tbl SET randSalt3 = 0 WHERE Branch_Id = '$the_branch_Id' ";
		$inactive_branch 	= mysqli_query($con, $query);

		confirmQuery($inactive_branch);

		echo "<script>location.href='branches.php';</script>";
	}

	else if(isset($_GET['deletegalleryid'])){

		$the_g_id = escape($_GET['deletegalleryid']);

		$query 			= "DELETE FROM gallery WHERE G_Id = '$the_g_id' ";
		$delete_image 	= mysqli_query($con, $query);

		echo "<script>location.href='gallery.php';</script>";
	}

	else if(isset($_GET['deletegallerycat'])){

		$the_gc_id = escape($_GET['deletegallerycat']);

		$query 				= "UPDATE gallery_category SET Status = 0 WHERE GC_Id = '$the_gc_id' ";
		$delete_category 	= mysqli_query($con, $query);

		confirmQuery($delete_category);

		if($delete_category){

			echo "<script>location.href='gallery_categories.php';</script>";

		}
		else{
			echo "<script>location.href='index.php';</script>";
		}
	}

	else if(isset($_GET['deletelesson'])){

		$the_lesson_id = escape($_GET['deletelesson']);

		$query = "UPDATE lessons_tbl SET Status = 0 WHERE Lesson_Id = '$the_lesson_id' ";
		$delete_lesson = mysqli_query($con, $query);

		confirmQuery($delete_lesson);

		if($delete_lesson){
			echo "<script>location.href='services.php';</script>";
		}
		else{
			echo "<script>location.href='index.php';</script>";
		}
	}

	else if(isset($_GET['deleteservice'])){

		$the_service_id = escape($_GET['deleteservice']);

		$query = "UPDATE services_tbl SET Status = 0 WHERE service_Id = '$the_service_id' ";
		$delete_service = mysqli_query($con, $query);

		confirmQuery($delete_service);

		if($delete_service){
			echo "<script>location.href='services.php';</script>";
		}
		else{
			echo "<script>location.href='index.php';</script>";
		}
	}

	else if(isset($_GET['delproddisp'])){

		$the_prod_id = escape($_GET['delproddisp']);

		$query = "UPDATE products_tbl SET randSalt3 = 0 WHERE Prod_Id = '$the_prod_id' ";
		$remove = mysqli_query($con, $query);

		confirmQuery($remove);

		if($remove){
			echo "<script>location.href='products.php';</script>";
		}
		else{
			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['inactiveadmin'])){

		$the_admin_id = escape($_GET['inactiveadmin']);

		$query = "UPDATE user_info_tbl SET Status = 0 WHERE User_Id = '$the_admin_id' ";
		$inactive_admin = mysqli_query($con, $query);

		confirmQuery($inactive_admin);

		if($inactive_admin){

			echo "<script>location.href='administrators.php';</script>";
		}
		
		else{
			echo "<script>location.href='index.php';</script>";
		}
	}

	else if(isset($_GET['deletecat'])){

		$the_cat_Id = escape($_GET['deletecat']);

		$query = "UPDATE category_tbl SET Status = 0 WHERE Category_Id = '$the_cat_Id' ";
		$inactive = mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='categories.php';</script>";
		}

		else{
			echo "<script>location.href='index.php';</script>";
		}
	}

	else if($_POST['action'] == 'add_cat'){

		if(isset($_POST['cattitle'])){

			$cat_title = $_POST['cattitle'];

			$query ="INSERT INTO gallery_category (Description, Date_created, Time_created, Status) ";
			$query .="VALUES ('$cat_title', curdate(), curtime(), 1) ";

			$add_cat = mysqli_query($con, $query);

			confirmQuery($add_cat);

			if($add_cat){

				echo json_encode(['1']);
			}
			else{

				echo json_encode(['2']);
			}

		}

		else{

			echo json_encode(['3']);
		}

	}



	if($_POST['action'] == 'branch_filter'){

		if(isset($_POST['branchid'])){

			$the_branch_Id = $_POST['branchid'];

			$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
			$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
			$query .= "SD.Quantity, SD.Prod_Id, SUM(SD.Quantity) AS TotalQuantity FROM products_tbl as P, ";
			$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B, sales_detail as SD ";
			$query .= "WHERE P.Prod_Id = PI.Prod_Id and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id and PI.Branch_Id = '$the_branch_Id' ";
			$query .= "and SD.Prod_Id = P.Prod_Id  GROUP BY P.Prod_Id ORDER BY SUM(SD.Quantity) DESC";

			$query_fast_moving = mysqli_query($con, $query);

			confirmQuery($query_fast_moving);

			$n = 1;

			$output ='';

			$count = mysqli_num_rows($query_fast_moving);

			if($count > 0){

				while($row = mysqli_fetch_assoc($query_fast_moving)){

					$prod_Id 		= $row["Prod_Id"];
		          	$prod_name 		= $row["Prod_name"];
		          	$prod_brand 	= $row["Prod_brand"];
		          	$prod_price 	= $row["Prod_price"];
		          	$prod_desc 		= $row["Prod_desc"];
		          	$prod_status 	= $row["Status"];
		          	$prod_image 	= $row["Prod_image"];
		          	$prod_quantity 	= $row['Quantity'];
		          	$prod_cat_id 	= $row['Category_Id'];
		          	$prod_category 	= $row['Category_title'];
		          	$total_orders 	= $row['TotalQuantity'];

		          	if($total_orders >= 7){

		          	 	$output .= "<tr>";
	                  	$output .= "<td>".$n++."</td>";
	                  	$output .= "<td>$prod_name</td>";
	                  	$output .= "<td>$prod_brand</td>";
	                  	$output .= "<td>".number_format($prod_price,2)."</td>";

	                  	if($prod_status == 'Top Seller'){
	                  		$output .= "<td><span class='label label-success'>$prod_status</span></td>";
	                  	}
	                  	else{
	                  		$output .= "<td>$prod_status</td>";
	                  	}

	                  	$output .= "<td><center><img src = '../images/products/$prod_image' class = 'imagesize'></center></td>";
	                  	$output .= "<td>$total_orders</td>";
	                  	$output .= "</tr>";
	                }

				}

			}

			else if ($count == NULL){

				$output .= "<tr>";
              	$output .= "<td colspan='7'><center>No results</center></td>";
              	$output .= "</tr>";
			}

			echo json_encode([$output]);
		}
	}



	if($_POST['action'] == 'add_category'){

		if(isset($_POST['cattitle'])){

			$cat_title = $_POST['cattitle'];

			$query = "INSERT INTO category_tbl (Category_title, Date_added, ";
			$query .="Time_added, Status) VALUES ('$cat_title', curdate(), ";
			$query .="curtime(), 1) ";

			$insert_cat = mysqli_query($con, $query);

			confirmQuery($insert_cat);

			if($insert_cat){

				echo json_encode(['1']);
			}	

			else{

				echo json_encode(['2']);
			}
		}

		else{

			echo json_encode(['3']);
		}
	}



	if($_POST['action'] == 'admin_account'){

		if(isset($_POST['lastid']) && isset($_POST['email']) && isset($_POST['password'])){

			$last_id 	= $_POST['lastid'];
			$email 	 	= $_POST['email'];
			$password 	= $_POST['password'];

			$new_password 	= password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

			$vkey = md5(time() .$email);

			$query = "SELECT Email, verified FROM user_login WHERE ";
			$query .="Email = '".trim($email)."' AND verified = 1";

			$check = mysqli_query($con, $query);

			confirmQuery($check);

			$count = mysqli_num_rows($check);

			if($count > 0){

				echo json_encode(['4']);
			}

			else{

				$query2 = "INSERT INTO user_login (User_Id, Email, Password, ";
				$query2 .="Level, Date_started, vkey, verified, createdate) ";
				$query2 .="VALUES ('$last_id', '$email', '$new_password', ";
				$query2 .="'Administrator', curdate(), '$vkey', 0, now()) ";

				$add_admin = mysqli_query($con, $query2);

				confirmQuery($add_admin);

				if($add_admin){

					// require_once('../assets/PHPMailer/PHPMailerAutoload.php');

	    //         	$mail = new PHPMailer();

					// $mail->isSMTP(); //Disable this when in production (000webhost.com) -Richard
					// $mail->SMTPAuth = true;
					// $mail->SMTPSecure = 'ssl';
					// $mail->Host = 'smtp.gmail.com';
					// $mail->Port = '465';
					// $mail->isHTML();
					// $mail->Username = 'monterorichard09@gmail.com';
					// $mail->Password = 'nickconrado1';

					// // Content
					// $mail->SetFrom('Euphony Music Center and Studio');
					// $mail->Subject = 'Email Verification';
					// $mail->Body = 'Thank you for your time. <br> You can now verify an account.<br> Just click this link <a href="verify.php?vkey='.$vkey.'&id='.$last_id.'">Register Account </a>';
					// // Content END

					// // Receiver
					// $mail->AddAddress($email);
					// // Receiver END

					// if($mail->Send()){

						echo json_encode(['1']);

					// }

					// else{

						// echo json_encode(['2']);
					// }
				}

				else{
					echo json_encode(['3']);
				}
			}
			
		}

		else{
			echo json_encode(['4']);
		}

	}
?>