<?php
	
	session_start();
	include "../includes/db.php";
	include "includes/functions.php";
	include "includes/session.php";

	if($_POST['action'] == 'add_prod_pic'){

		if(isset($_POST['image']) && isset($_POST['prodid'])){

			$the_prod_Id 	= $_POST['prodid'];
			$data  			= $_POST['image'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/products/'.$imageName, $data);

			$query = "UPDATE products_tbl SET Prod_image = '$imageName' ";
			$query .="WHERE Prod_Id = '$the_prod_Id' ";

			$update_img = mysqli_query($con, $query);

			confirmQuery($update_img);

			if($update_img){

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




	else if($_POST['action'] == 'profile_pic'){

		if(isset($_POST['image']) && isset($_POST['userid'])){

			$the_user_Id 	= $_POST['userid'];
			$data 			= $_POST['image'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/profile_img/'.$imageName, $data);

			$query = "UPDATE user_info_tbl SET Profile_img = '$imageName' ";
			$query .="WHERE User_Id = '$the_user_Id'";

			$update_profile_pic = mysqli_query($con, $query);

			confirmQuery($update_profile_pic);

			if($update_profile_pic){

				$query2 = "INSERT INTO activity_log (Date, Time, Detail, User_Id) ";
				$query2 .="VALUES (curdate(), curtime(), 'Changed profile picture (Administrator)', '$user_id') ";
				$add_to_logs = mysqli_query($con, $query2);

				confirmQuery($add_to_logs);

				if($add_to_logs){
					echo json_encode(['1']);
				}

			}
			else{
				echo json_encode(['2']);
			}
		}

		else{
			echo json_encode(['3']);
		}

	}




	else if($_POST['action'] == 'prod_sales'){

		$query = "SELECT * FROM sales_tbl WHERE Branch_Id = ";
		$query .="'$branch_id' AND Status = 1 AND randSalt4 = 1 ";
		
		if(isset($_POST['f_month'])){

			$the_month = $_POST['f_month'];

			$query .="AND MONTH(Date) = '$the_month' ";
		}
		else{
			$query .="AND MONTH(Date) = MONTH(curdate()) ";
		}




		// if(isset($_POST['day'])){

		// 	$the_day = $_POST['day'];

		// 	$query .="AND DATE(Date) = '$the_day' ";
		// }

		// else{
		// 	$query .="AND DATE(Date) = DATE(curdate()) ";
		// }




		if(isset($_POST['f_year'])){

			$the_year = $_POST['f_year'];

			$query .="AND YEAR(Date) = '$the_year' ";
		}

		else{
			$query .="AND YEAR(Date) = YEAR(curdate()) ";
		}





		$query_prod_sales = mysqli_query($con, $query);

		confirmQuery($query_prod_sales);

		$count1 = mysqli_num_rows($query_prod_sales); 

		if($count1 > 0){

			$output = "";

			$n = 1;

			while($row = mysqli_fetch_assoc($query_prod_sales)){

				$sales_Id		= escape($row['Sales_Id']);
				$trans_date 	= escape($row['Date']);
				$customer 		= escape($row['Sold_to']);
				$OR_no			= escape($row['OR_no']);
				$AR_no			= escape($row['AR_no']);
				$subtotal 		= escape($row['Subtotal']);
				$total_discount	= escape($row['Total_discount']);
				$total 			= escape($row['Total']);
				$cash 			= escape($row['Cash']);
				$change 		= escape($row['Cash_change']);
				$payment 		= escape($row['Payment']);

				$output .= "<tr>";
				$output .= "<td>".$n++."</td>";
				$output .= "<td>".date('M d, Y', strtotime($trans_date))."</td>";
				$output .= "<td><a href='receipt_or.php?salesid=$sales_Id' target='_blank'>$OR_no</a></td>";
				$output .= "<td><a href='receipt_ar.php?salesid=$sales_Id' target='_blank'>$AR_no</a></td>";
				$output .= "<td>".number_format($subtotal,2)." PHP</td>";
				$output .= "<td>$total_discount %</td>";
				$output .= "<td>".number_format($total,2)." PHP</td>";
				$output .= "<td>".number_format($cash,2)." PHP</td>";
				$output .= "<td>".number_format($change,2)." PHP</td>";
				$output .= "<td>$payment</td>";
				$output .= "<td>";

				if($trans_date != date('Y-m-d')){
					$output .= "Not Available ";
				}

				else{

					$output .= "<a href='#' title='Delete' class='btn btn-danger btn-sm' onclick='deleting('delete_action.php?prodsalesid=$sales_Id; ');'>Delete</a>";

				}

				$output .= "</td>";
				$output .= "</tr>";
			}

		}

		else{
			$output.= "<script>document.getElementById('print').className = 'hidden';</script>";
		}

		echo json_encode([$output]);
	}




	else if($_POST['action'] == 'teacher_profile_pic'){

		if(isset($_POST['image']) && isset($_POST['teacherId'])){

			$teacher_Id 	= $_POST['teacherId'];
			$data  			= $_POST['image'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/profile_img/'.$imageName, $data);

			$query = "UPDATE teacher_tbl SET T_Profile_img = '$imageName' ";
			$query .="WHERE Teacher_Id = '$teacher_Id'";

			$update_profile_pic = mysqli_query($con, $query);

			confirmQuery($update_profile_pic);

			if($update_profile_pic){

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




	else if($_POST['action'] == 'lockscreen'){

		if(isset($_POST['userid']) && isset($_POST['password'])){

			$the_user_Id 	= $_POST['userid'];
			$password 		= $_POST['password'];

			$query = "SELECT Password FROM user_login ";
			$query .="WHERE User_Id = '$the_user_Id' ";

			$query_info = mysqli_query($con, $query);

			$row = mysqli_fetch_assoc($query_info);

			$rlpassword = $row['Password'];

			if(password_verify($password, $rlpassword)){

				$_SESSION['auth'] == 'unlocked';
				
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

?>