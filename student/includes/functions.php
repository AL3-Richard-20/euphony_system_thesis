<?php

	//Table Query_1_param END
	function escape($string){

		global $con;

		return mysqli_real_escape_string($con, trim($string));
	}

	//confirm query
	function confirmQuery($final_query){

		global $con;

		if(!$final_query){

			die("ERROR" . mysqli_error($con));
		}
	}

	//count records
	function count_records($final_query, $output){

		global $con;

		$count_records = mysqli_num_rows($final_query);

		if($count_records == NULL){

			// echo "<td class='column100 column4' data-column='column4'>$message</td>";

			echo $output;
		}
	}

	function tableNull($query, $colspan, $message){

		global $con;

		$count = mysqli_num_rows($query);

		if($count == NULL){

			echo "<tr>";
			echo "<td colspan = '$colspan'><center>$message</center></td>";
			echo "</tr>";
		}
	}

	//For Lessons at Registration Form
	function fill_lesson(){

		global $con;

		$query 			= "SELECT * FROM lessons_tbl WHERE Status = 1";
		$query_lessons 	= mysqli_query($con, $query);

		while($row = mysqli_fetch_array($query_lessons)){

			$lesson_id 		= $row['Lesson_Id'];
			$lesson_amount 	= $row['Amount'];
			$lesson_desc	= $row['Lesson_desc'];
			$lesson_no 		= $row['No_of_lesson'];

			$the_lesson = "".$lesson_desc. " - " .$lesson_no. " Lessons";

			echo "<option value = '$lesson_id'>$the_lesson</option>";
		}

	}
	//For Lessons at Registration Form END

	function dayQuery(){

		global $con;

		$query = "SELECT * FROM days_tbl";
		$query_days = mysqli_query($con, $query);

		while($row = mysqli_fetch_array($query_days)){

			$id 	= $row['Day_Id'];
			$day 	= $row['Day'];

			echo "<option value = '$id'>$day</option>";
		}
	}

	function timeQuery(){

		global $con;

		$query = "SELECT * FROM time_tbl";
		$query_time = mysqli_query($con, $query);

		while($row = mysqli_fetch_array($query_time)){

			$id 		= $row['Time_Id'];
			$time 		= $row['Time'];
			$time_end 	= $row['Time_end'];
			$randSalt 	= $row['randSalt'];

			$the_time 	= "$time - $time_end $randSalt"; 

			echo "<option value = '$id'>$the_time</option>";
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

	function profileImg($profileimg, $sex){

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
	

	//Student Information

	function studInfo($user_id){

		global $con;

		$query = "SELECT UI.User_Id, UI.Branch_Id, UI.Last_name, UI.First_name, UI.Middle_name, UI.Address, ";
		$query .="UI.Contact_no, UI.Birthdate, UI.Age, UI.Sex, UI.Nationality, UI.Profile_img, UL.Email, ";
		$query .="UL.Password, UL.Level, UL.Date_started, B.Branch_Id, B.Branch_desc, B.Branch_location, ";
		$query .="B.Branch_image, B.Level, ";
		$query .="SS.User_Id, SS.Status FROM user_info_tbl as UI, user_login as UL, ";
		$query .="branches_tbl as B, stud_status_tbl as SS WHERE UI.User_Id = UL.User_Id AND ";
		$query .="UI.Branch_Id = B.Branch_Id AND SS.User_Id = UI.User_Id AND UI.User_Id = '$user_id'";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function studBalances($user_id){

		global $con;

		$query = "SELECT stud_balances.Date, stud_balances.Cash_tendered, ";
		$query .="stud_balances.The_change, stud_balances.The_balance, ";
		$query .="stud_balances.Total_balance, stud_balances.Trans_time FROM user_info_tbl ";
		$query .="LEFT JOIN stud_balances ON user_info_tbl.User_Id = stud_balances.User_Id ";
		$query .="WHERE stud_balances.User_Id = '{$user_id}' ORDER BY ";
		$query .="stud_balances.Transaction_Id DESC LIMIT 1";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function selectedClass($user_id){

		global $con;

		$query = "SELECT SC.Lesson_Id, SC.the_Day, SC.the_Time, L.Lesson_desc, L.Amount, L.No_of_lesson, L.Icon, ";
		$query .="D.Day, D.Day_Id, T.Time, T.Time_Id, T.randSalt, T.Time_end ";
		$query .="FROM selected_class_tbl as SC, lessons_tbl as L, "; 
		$query .="days_tbl as D, time_tbl as T WHERE SC.Lesson_Id = L.Lesson_Id AND SC.the_Day = D.Day_Id ";
		$query .="AND SC.the_Time = T.Time_Id AND SC.User_Id = '{$user_id}' AND SC.Status = 'New'";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function studClass($user_id, $lesson_id){

		global $con;

		$query = "SELECT L.Amount, T.Teacher_Id, T.T_Last_name, T.T_First_name, T.T_Middle_name ";
		$query .="FROM stud_class_tbl as SC, class_tbl as C, teacher_lesson_tbl as TL, ";
		$query .="teacher_tbl as T, lessons_tbl as L WHERE SC.Class_Id = C.Class_Id ";
		$query .="AND TL.Teacher_Id = T.Teacher_Id AND TL.Lesson_Id = L.Lesson_Id ";
		$query .="AND TL.Lesson_Id = '{$lesson_id}' AND C.Tea_less_Id = TL.Tea_less_Id ";
		$query .="aND SC.User_Id = '{$user_id}' AND SC.randSalt2 = 1";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function attendanceCount($user_id){

		global $con;

		$query = "SELECT A.Date_att, A.Remarks, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
		$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
		$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
		$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
		$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND SC.User_Id = '{$user_id}' ";
		$query .="AND NOT A.Remarks = 'Excused'";

 		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function studAttendance($user_id){

		global $con;

		$query = "SELECT A.Date_att, A.Time_att,A.Remarks, T.Teacher_Id, T.T_Last_name, ";
		$query .="T.T_First_name, T.T_Middle_name, L.Lesson_Id, L.Lesson_desc, ";
		$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
		$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
		$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
		$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND SC.User_Id = '{$user_id}' ";
		$query .="ORDER BY A.Date_att DESC";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

?>