<?php

	//Query Table
	function queryTable($table){

		global $con;

		$query 	= "SELECT * FROM $table";
		$result = mysqli_query($con,$query);

		return $result;

	}
	//Query Table END

	//Table Query_3_param
	function tableQuery_3($table, $column, $id){

		global $con;

		$query 	= "SELECT * FROM $table WHERE $column = '$id'";
		$result = mysqli_query($con, $query);

		return $result;

	}

	//Real escape string
	function escape($string){

		global $con;

		return mysqli_real_escape_string($con, trim($string));
	}
	//Real escape string END

	//Confirm Query
	function confirmQuery($string){

		global $con;

		if(!$string){

			die("ERROR" . mysqli_error($con));
		}
	}

	function profileImg($profileimg, $sex, $user_id){

		global $con;

		if($profileimg == NULL){

			if($sex == 'Male'){

				echo "<center><img src = '../images/profile_img/Vector_1.png' class = 'img-circle img-responsive' alt = 'photo' id = 'profileimg'></center>";
			}
			else if($sex == 'Female'){

				echo "<center><img src = '../images/profile_img/Vector_2.png' class = 'img-circle img-responsive' alt = 'photo' id = 'profileimg'></center>";
			}
		}
		else{

			echo "<center><img src = '../images/profile_img/$profileimg' class = 'img-circle img-responsive' alt = 'photo' id = 'profileimg'></center>";
		}
	}

	//Query HeadAdmin Profile       
	function headadminProfile($user_id){

		global $con;

		$query =  "SELECT user_login.Email, user_login.Password, user_login.verified, branches_tbl.Branch_desc, branches_tbl. ";
		$query .= "Branch_location, branches_tbl.Branch_image, branches_tbl.Level, user_info_tbl.Branch_Id, ";
		$query .= "user_info_tbl.Last_name, user_info_tbl.First_name, user_info_tbl.Middle_name, ";
		$query .= "user_info_tbl.Sex, user_info_tbl.Address, user_info_tbl.Contact_no, ";
		$query .= "user_info_tbl.Profile_img, user_info_tbl.Age, user_login.Date_started, ";
		$query .= "user_info_tbl.Birthdate, user_info_tbl.Nationality, user_info_tbl.User_Id ";
		$query .= "FROM user_info_tbl LEFT JOIN branches_tbl ON ";
		$query .= "user_info_tbl.Branch_Id = branches_tbl.Branch_Id LEFT JOIN user_login ";
		$query .= "ON user_info_tbl.User_Id = user_login.User_Id WHERE user_info_tbl.User_Id = '{$user_id}'";

		$result = mysqlI_query($con, $query);

		return $result;
	}
	////Query HeadAdmin Profile

	//For Category list in Product List
	function fill_category(){

		global $con;

		$query 			= "SELECT * FROM category_tbl WHERE Status = 1";
		$query_category = mysqli_query($con, $query);

		while($row = mysqli_fetch_array($query_category)){

			$category_id    = $row['Category_Id'];
			$category_title = $row['Category_title'];

			echo "<option value = '$category_id'>{$category_title}</option>";
		}
	}
	//END

	// Count Records
	function countRecords($table){

		global $con;

		$query 				= "SELECT * FROM $table";
		$query_record_count = mysqli_query($con, $query);
		$count_record 		= mysqli_num_rows($query_record_count);

		echo "<div><h1>{$count_record}</h1></div>";
		
	}
	// Count Records END

	//Max ID for Products
	function max_Id($field, $table){

		global $con;

		$max 		= "SELECT max($field)+1 AS ID FROM $table";
		$resultId 	= $con->query($max);
		$rowId 		= $resultId->fetch_assoc();
		$maxvalue 	= $rowId['ID'];

		echo $maxvalue;

	}

	// To deermine Slow and Fast Moving Products
	function movingProducts(){

		global $con;

		$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
		$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
		$query .= "SD.Quantity, SD.Prod_Id, SUM(SD.Quantity) AS TotalQuantity FROM products_tbl as P, ";
		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B, sales_detail as SD ";
		$query .= "WHERE P.Prod_Id = PI.Prod_Id and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
		$query .= "and SD.Prod_Id = P.Prod_Id  GROUP BY P.Prod_Id ORDER BY SUM(SD.Quantity) DESC";

		$result = mysqli_query($con, $query);

		return $result;

	}
	//END

	//Sales Today
	function sales_Today(){

		global $con;

		$query = "SELECT SUM(Cash - Cash_change) as Sales FROM sales_tbl ";
		$query .="WHERE Date = curdate()";
		
		$query_sales_today = mysqli_query($con, $query);

		while($row = mysqli_fetch_assoc($query_sales_today)){

			$sales = $row['Sales'];

			echo "<div><center><h1 style='font-size: 40px'>".number_format($sales,2)." PHP</h1></center></div>";
		}

	}
	//Sales Today END


?>