<?php 

	//Escape String
	function escape($string){

		global $con;

		return mysqli_real_escape_string($con, trim($string));

	}

	//Confirm Query
	function confirmQuery($string){

		global $con;

		if(!$string){

			die("ERROR" . mysqli_error($con));
		}
	}

	//Table Query_1_param
	function tableQuery($table){

		global $con;

		$query = "SELECT * FROM $table";
		$result = mysqli_query($con, $query);

		return $result;

	}

	//Table Query_3_param
	function tableQuery_3($table, $column, $id){

		global $con;

		$query = "SELECT * FROM $table WHERE $column = '$id'";
		$result = mysqli_query($con, $query);

		return $result;

	}

	//For Category list in Product List
	function fill_category(){

		global $con;

		$query 				= "SELECT * FROM category_tbl";
		$query_categories 	= mysqli_query($con, $query);

		while($row = mysqli_fetch_assoc($query_categories)){

			$category_Id 	= $row['Category_Id'];
			$category_title = $row['Category_title'];

			echo "<option value = '$category_Id'>$category_title</option>";
		}
	}
	//END

	//For Branch list in Product List
	function fill_branch(){

		global $con;

		$query 				= "SELECT * FROM branches_tbl";
		$query_all_branch 	= mysqli_query($con, $query);

		while($row = mysqli_fetch_assoc($query_all_branch)){

			$branch_Id   = $row['Branch_Id'];
			$branch_desc = $row['Branch_desc'];

			echo "<option value = '$branch_Id'>$branch_desc</option>";
		} 
	}
	//END

	//For Lessons at Registration Form
	function fill_lesson(){

		global $con;

		$output = '';
		$query 				= "SELECT * FROM lessons_tbl";
		$query_all_lessons 	= mysqli_query($con, $query);

		while($row = mysqli_fetch_array($query_all_lessons)){

			$lesson_id 		= $row['Lesson_Id'];
			$lesson_amount 	= $row['Amount'];
			$lesson_desc	= $row['Lesson_desc'];
			$no_of_lessons  = $row['No_of_lesson'];

			$output .= "<option value = '$lesson_id'>$lesson_desc" . " - " . "$no_of_lessons" . " Lessons". "</option>";
		}

		return $output;

	}

	//For the lesson information
	function studentEnrolled($lesson_id){

		global $con;

		$query = "SELECT stud_status_tbl.Status, selected_class_tbl.user_Id FROM ";
		$query .="stud_status_tbl LEFT JOIN selected_class_tbl ON ";
		$query .="stud_status_tbl.User_Id = selected_class_tbl.User_Id WHERE ";
		$query .="stud_status_tbl.Status = 'Official' AND selected_class_tbl.Status = 'New' ";
		$query .="AND selected_class_tbl.Lesson_Id = '$lesson_id' ";

		$students_enrolled = mysqli_query($con, $query);

		confirmQuery($students_enrolled);

		$count = mysqli_num_rows($students_enrolled);

		return $count;
	}
	//For the lesson information END

	function graduatedStudents($lesson_id){

		global $con;

		$query = "SELECT stud_status_tbl.Status, selected_class_tbl.user_Id FROM ";
		$query .="stud_status_tbl LEFT JOIN selected_class_tbl ON ";
		$query .="stud_status_tbl.User_Id = selected_class_tbl.User_Id WHERE ";
		$query .="selected_class_tbl.Status ='Completed' AND ";
		$query .="selected_class_tbl.Lesson_Id = '$lesson_id' ";

		$students_graduated = mysqli_query($con, $query);

		confirmQuery($students_graduated);

		$count = mysqli_num_rows($students_graduated);

		return $count;

	}

	//For Lessons at Registration Form END

	//Max ID for Students
	// function student_Id(){

	// 	global $con;

	// 	$query = "SELECT * FROM stud_tbl";
	// 	$query_stud_num = mysqli_query($con, $query);
	// 	$count = mysqli_num_rows($query_stud_num);

	// 	$max 		= "SELECT max(Stud_Id)+1 AS ID FROM stud_tbl";
	// 	$resultId 	= $con->query($max);
	// 	$rowId 		= $resultId->fetch_assoc();
	// 	$maxvalue 	= $rowId['ID'];

	// 	if($count == NULL){

	// 		echo "<input class = 'hidden' type = 'text' name = 'stud_id' value = '1'>";
	// 	}
	// 	else{

	// 		echo "<input class = 'hidden' type = 'text' name = 'stud_id' value = '$maxvalue'>";
	// 	}

	// }

	//Max ID for User_tbl
	// function User_Id(){

	// 	global $con;

	// 	$query = "SELECT * FROM users_tbl";
	// 	$query_user_num = mysqli_query($con, $query);
	// 	$count = mysqli_num_rows($query_user_num);

	// 	$max 		= "SELECT max(User_Id)+1 AS ID FROM users_tbl";
	// 	$resultId 	= $con->query($max);
	// 	$rowId 		= $resultId->fetch_assoc();
	// 	$maxvalue 	= $rowId['ID'];

	// 	if($count == NULL){

	// 		echo "<input class = 'hidden' type = 'text' name = 'user_id' value = '1'>";
	// 	}
	// 	else{

	// 		echo "<input class = 'hidden' type = 'text' name = 'user_id' value = '$maxvalue'>";
	// 	}

	// }
?>