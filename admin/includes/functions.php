<?php
	
	//Table Query_1_param
	function tableQuery($table){

		global $con;

		$query 	= "SELECT * FROM $table";
		$result = mysqli_query($con, $query);

		return $result;

	}

	//Table Query_3_param
	function tableQuery_3($table, $column, $id){

		global $con;

		$query 	= "SELECT * FROM $table WHERE $column = '{$id}'";
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

	//Query Admin Profile           CHECK
	function adminProfile($id){

		global $con;

		$query =  "SELECT user_login.Email, branches_tbl.Branch_desc, branches_tbl. ";
		$query .= "Branch_location, branches_tbl.Branch_image, branches_tbl.Level, user_info_tbl.Branch_Id, ";
		$query .= "user_info_tbl.Last_name, user_info_tbl.First_name, user_info_tbl.Middle_name, ";
		$query .= "user_info_tbl.Sex, user_info_tbl.Address, user_info_tbl.Contact_no, ";
		$query .= "user_info_tbl.Profile_img, user_info_tbl.Age, user_login.Date_started, ";
		$query .= "user_info_tbl.Birthdate, user_info_tbl.Nationality, user_info_tbl.User_Id ";
		$query .= "FROM user_info_tbl LEFT JOIN branches_tbl ON ";
		$query .= "user_info_tbl.Branch_Id = branches_tbl.Branch_Id LEFT JOIN user_login ";
		$query .= "ON user_info_tbl.User_Id = user_login.User_Id WHERE user_info_tbl.User_Id = '{$id}'";

		$result = mysqli_query($con, $query);

		return $result;
	}
	////Query Admin Profile

	//Query Student Profile
	function studInfo($user_id){

		global $con;

		$query = "SELECT UI.User_Id, UI.Branch_Id, UI.Last_name, UI.First_name, UI.Middle_name, UI.Address, ";
		$query .="UI.Contact_no, UI.Birthdate, UI.Age, UI.Sex, UI.Nationality, UI.Profile_img, UL.Email, UL.verified, ";
		$query .="UL.Password, UL.Level, UL.Date_started, B.Branch_Id, B.Branch_desc, B.Branch_location, ";
		$query .="B.Branch_image, B.Level, ";
		$query .="SS.User_Id, SS.Status FROM user_info_tbl as UI, user_login as UL, ";
		$query .="branches_tbl as B, stud_status_tbl as SS WHERE UI.User_Id = UL.User_Id AND ";
		$query .="UI.Branch_Id = B.Branch_Id AND SS.User_Id = UI.User_Id AND UI.User_Id = '{$user_id}'";

		$result = mysqli_query($con, $query);
		
		return $result;
	}
	//Query Student Profile END

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

	function studBalances($user_id){

		global $con;

		$query = "SELECT user_info_tbl.First_name, user_info_tbl.Middle_name, user_info_tbl.Last_name, ";
		$query .="stud_balances.Transaction_Id, stud_balances.Date, stud_balances.Cash_tendered, ";
		$query .="stud_balances.AR_no, stud_balances.OR_no, stud_balances.Discount, stud_balances.The_change, stud_balances.Payment, ";
		$query .="stud_balances.Total_balance, stud_balances.Trans_time FROM user_info_tbl ";
		$query .="LEFT JOIN stud_balances ON user_info_tbl.User_Id = stud_balances.User_Id ";
		$query .="WHERE stud_balances.User_Id = '{$user_id}' AND randSalt9 = 1 ";
		$query .="ORDER BY stud_balances.Transaction_Id ";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function studAttendance($user_id){

		global $con;

		$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.User_Id, A.Remarks, SC.Stud_class_Id, A.Att_Id, ";
		$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
		$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
		$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
		$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
		$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
		$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
		$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
		$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND SC.User_Id = '{$user_id}' ";
		$query .="ORDER BY A.Date_att";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function attendanceCount($user_id){

		global $con;

		$query = "SELECT A.Stud_class_Id, A.Date_att, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
		$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
		$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
		$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
		$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
		$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
		$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
		$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
		$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND SC.User_Id = '{$user_id}' ";
		$query .="AND NOT A.Remarks = 'Excused'";

 		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function teacherAttendance($id){

		global $con;

		$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
		$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
		$query .="U.Last_name, U.First_name, U.Middle_name, U.User_Id, ";
		$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
		$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, user_info_tbl as U, ";
		$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
		$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
		$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND SC.User_Id = U.User_Id ";
		$query .="AND TL.Teacher_Id = '{$id}' ORDER BY A.Date_att DESC";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function studClass($user_id, $lesson_id){

		global $con;

		$query = "SELECT SC.Stud_class_Id, SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, ";
		$query .="C.Day, C.Time, C.Status, TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, ";
		$query .="T.T_Last_name, T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, ";
		$query .="T_Address, T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
		$query .="L.No_of_lesson FROM stud_class_tbl as SC, class_tbl as C, ";
		$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L ";
		$query .="WHERE SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
		$query .="TL.Lesson_Id = L.Lesson_Id AND C.Tea_less_Id = TL.Tea_less_Id AND ";
		$query .="TL.Lesson_Id = '{$lesson_id}' AND ";
		$query .="SC.User_Id = '{$user_id}' AND SC.randSalt2 = 1 ";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function teacherInfo($teacher_Id){

		global $con;

		$query = "SELECT T.T_Last_name, T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, ";
		$query .="T.T_Age, T.T_Address, T.T_Nationality, T.T_Contact_no, T.T_Profile_img, ";
		$query .="TB.Teacher_Id FROM teacher_tbl as T, teacher_branch_tbl as TB WHERE ";
		$query .=" T.Teacher_Id = TB.Teacher_Id AND T.Teacher_Id = '{$teacher_Id}'";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function teacherLesson($teacher_Id){

		global $con;

		$query = "SELECT TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, L.Lesson_Id, L.Lesson_desc, ";
		$query .="L.Amount, L.No_of_lesson FROM teacher_lesson_tbl as TL, lessons_tbl as L ";
		$query .="WHERE TL.Lesson_Id = L.Lesson_Id AND TL.Teacher_Id = '{$teacher_Id}' ";
		$query .="AND TL.Status = 1";

		$result = mysqli_query($con, $query);
		
		return $result;
	}

	function dailyClass($the_day, $the_time, $time, $branch_id){

		global $con;

		$query = "SELECT SC.Stud_class_Id, SC.Class_Id, SC.randSalt2, C.Day, C.Time, TL.Teacher_Id, ";
		$query .="TL.Lesson_Id, L.Lesson_Id, L.Lesson_desc, L.No_of_lesson, L.Amount, ";
		$query .="T.Teacher_Id, T.T_Last_name, T.T_First_name, T.T_Middle_name, ";
		$query .="D.Day_Id, D.Day, TT.Time_Id, TT.Time, U.User_Id, U.Branch_Id, ";
		$query .="U.Last_name, U.First_name, U.Middle_name FROM stud_class_tbl as SC, ";
		$query .="class_tbl as C, teacher_lesson_tbl as TL, lessons_tbl as L, selected_class_tbl as SSC, ";
		$query .="teacher_tbl as T, days_tbl as D, time_tbl as TT, user_info_tbl as U ";
		$query .="WHERE SC.Class_Id = C.Class_Id AND C.Tea_less_Id = TL.Tea_less_Id AND ";
		$query .="TL.Lesson_Id = L.Lesson_Id AND C.Day = D.Day_Id AND C.Time = TT.Time_Id AND ";
		$query .="SC.User_Id = U.User_Id AND SSC.User_Id = U.User_Id AND SC.randSalt2 = 1 AND ";
		$query .="U.Branch_Id = '$branch_id' AND TL.Teacher_Id = T.Teacher_Id AND D.Day = '{$the_day}'  ";
		$query .="AND TT.Time = '{$time}' AND SSC.Status = 'New'";

		$query_all_students = mysqli_query($con, $query);

		$n = 1;

		while($row = mysqli_fetch_assoc($query_all_students)){

			//stud_tbl
			$stud_id 		= escape($row['User_Id']);
  			$lastname 		= escape($row['Last_name']);
  			$firstname 		= escape($row['First_name']);
  			$middlename 	= escape($row['Middle_name']);
  			$lesson_Id 		= escape($row['Lesson_Id']);
			$lesson_desc	= escape($row['Lesson_desc']);
			$lesson_amount 	= escape($row['Amount']);
			$nooflesson 	= escape($row['No_of_lesson']);
			$stud_class_Id 	= escape($row['Stud_class_Id']);

			$teacher_id 	= escape($row['Teacher_Id']);
  			$t_lastname 	= escape($row['T_Last_name']);
  			$t_firstname 	= escape($row['T_First_name']);
  			$t_middlename 	= escape($row['T_Middle_name']);

  			$fullname 		= "$firstname $lastname";
  			$the_lesson 	= "$lesson_desc - $nooflesson Lessons";
  			$the_teacher	= "$t_firstname $t_lastname";



  			// Table Data
  			echo "<tr>";
  			echo "<td>".$n++."</td>";
  			echo "<td><a href = 'edit_student.php?userid=$stud_id'>$fullname</a></td>";
  			echo "<td>$the_lesson</td>";
  			echo "<td><a href= 'edit_teacher.php?teacherid=$teacher_id'>$the_teacher</a></td>";



  			//Attendance Count
  			$query_attendance1 = attendanceCount($stud_id);
	  		$count_attendance1 = mysqli_num_rows($query_attendance1);

	  		confirmQuery($query_attendance1);
	  		
  			echo "<td>$count_attendance1</td>";
  			//Attendance Count END


  			// Stud Balances
  			$query_stud_balances = studBalances($stud_id);
										
			confirmQuery($query_stud_balances);

			while($row = mysqli_fetch_assoc($query_stud_balances)){

				$or_no 			= escape($row['OR_no']);
				$ar_no 			= escape($row['AR_no']);
				$trans_date 	= escape($row['Date']);
				$trans_time 	= escape($row['Trans_time']);
				$amount_paid	= escape($row['Cash_tendered']);
				$balance 		= escape($row['Total_balance']);
				$b_firstname 	= escape($row['First_name']);
				$b_lastname 	= escape($row['Last_name']);	
				$b_middlename 	= escape($row['Middle_name']);
				$b_discount		= escape($row['Discount']);
				$b_change 		= escape($row['The_change']);
				
			}

			//Cash Tendered
			$sum_cash_tendered = "SELECT SUM(Cash_tendered) AS Total FROM stud_balances ";
			$sum_cash_tendered .="WHERE User_Id = '{$stud_id}'";

			$query_sum_cash_tendered = mysqli_query($con, $sum_cash_tendered);

			while($row = mysqli_fetch_assoc($query_sum_cash_tendered)){

				$total_cash_tendered = escape($row['Total']);

				$_SESSION['total_cash_tendered'] = $total_cash_tendered;
			}

			confirmQuery($query_sum_cash_tendered);
			//Cash Tendered END

			//Discounts
			$sum_discounts = "SELECT SUM(Discount) AS Total_discounts FROM stud_balances ";
			$sum_discounts .="WHERE User_Id = '{$stud_id}'";

			$query_sum_discounts = mysqli_query($con, $sum_discounts);

			while($row = mysqli_fetch_assoc($query_sum_discounts)){

				$total_discounts = escape($row['Total_discounts']);

				$_SESSION['total_discounts'] = $total_discounts;
			}

			confirmQuery($query_sum_discounts);
			//Discounts END

			//Change
			$sum_change = "SELECT SUM(The_change) AS Total_change FROM stud_balances ";
			$sum_change .="WHERE User_Id = '{$stud_id}'";

			$query_sum_change = mysqli_query($con, $sum_change);

			while($row = mysqli_fetch_assoc($query_sum_change)){

				$total_change = escape($row['Total_change']);

				$_SESSION['total_change'] = $total_change;
			}

			confirmQuery($query_sum_change);
			//Change END

			$total_spendings = (int)$_SESSION['total_cash_tendered'] - (int)$_SESSION['total_discounts'] - (int)$_SESSION['total_change'];

			$_SESSION['total_spendings'] = $total_spendings;

			if(isset($balance) || isset($lesson_amount)){

				if($_SESSION['total_spendings'] > $lesson_amount){
					echo "<td><span class='label label-success'>Paid</span></td>";
				}

				else{
					
					$sum = ($lesson_amount - $_SESSION['total_spendings']);

					if($sum == 0){
						echo "<td><span class='label label-success'>Paid</span></td>";
						echo "<script>document.getElementById('pay_btn').className = 'hidden';</script>";
					}
					else{
						echo "<td>" .number_format($sum,2). "</td>";	
					}
					
				}
			}
			
			else{

				if(isset($lesson_amount)){
					echo "<td>".$lesson_amount. "</td>";
				}
				else{
					echo "<td>0</td>";
				}
			}
  			//END


  			//Check attendance for today
  			$query2 = "SELECT * FROM attendance_tbl WHERE Stud_class_Id = {$stud_class_Id} AND Date_att = curdate()";
  			
  			$check_att = mysqli_query($con, $query2);

  			//count attendance
  			$count_records = mysqli_num_rows($check_att);

  			//if null
			if($count_records == NULL){

				echo "<td><center><p>---</p></center></td>";

				//if no attendance

				echo "<td class = 'text-center'>";
				;

				if($count_attendance1 == $nooflesson){
					echo "<a href='add_candidate.php?userid=$stud_id' class='btn btn-success' id='complete_btn'>Complete Now</a> ";
					// echo "<a href ='#' class = 'btn btn-primary' id = 'print' style = 'color:white'>Print</a>";
				}
				else{
					echo "<a href='classes.php?day=$the_day&time=$the_time&addpresent=$stud_class_Id' class = 'btn btn-success' id='present'>Present</a> ";
	  				echo "<a href='classes.php?day=$the_day&time=$the_time&addexcused=$stud_class_Id' class = 'btn btn-warning' id='excused'>Excused</a> ";
	  				echo "<a href='classes.php?day=$the_day&time=$the_time&addforfeit=$stud_class_Id' class = 'btn btn-danger' id='forfeit'>Forfeit</a> ";
				}
	  			
	  			echo "</td>";


	  			echo "<td>";
	  			echo "<a href='edit_student.php?userid=$stud_id/#balances' class = 'btn btn-success' id = 'pay_btn'>Pay</a> ";
	  			echo "</td>";

			}

			else{

	  			while($row = mysqli_fetch_assoc($check_att)){

	  				$date_att 	= $row['Date_att'];
	  				$remarks 	= $row['Remarks'];

		  			if($remarks == 'Present'){
						echo "<td><p><span class='label label-success'>$remarks</span></p></td>";
					}
					else if($remarks == 'Excused'){
						echo "<td><p><span class='label label-warning'>$remarks</span></p></td>";
					}
					else if($remarks == 'Forfeited'){
						echo "<td><p><span class='label label-danger'>$remarks</span></p></td>";
					}

	  			}

	  			//if there are attendance

				echo "<td class = 'text-center'>";
				echo "<a href='#' class = 'hidden' id = 'complete_btn'>Complete</a> ";
				echo "<a href ='#' class = 'hidden' id = 'print' style = 'color:white'>Print</a>";

				if($count_attendance1 == $nooflesson){
					echo "<a href='add_candidate.php?userid=$stud_id' class = 'btn btn-success' id = 'complete_btn'>Complete Now</a> ";
					// echo "<a href ='#' class = 'btn btn-primary' id = 'print' style = 'color:white'>Print</a>";
				}
				else{
		  			echo "<a href='classes.php?day=$the_day&time=$the_time&present=$stud_class_Id' class = 'btn btn-success' id='present'>Present</a> ";
		  			echo "<a href='classes.php?day=$the_day&time=$the_time&excused=$stud_class_Id' class = 'btn btn-warning' id='excused'>Excused</a> ";
		  			echo "<a href='classes.php?day=$the_day&time=$the_time&forfeit=$stud_class_Id' class = 'btn btn-danger' id='forfeit'>Forfeit</a> ";

		  		}

	  			echo "</td>";
	  			echo "<td>";
	  			echo "<a href='edit_student.php?userid=$stud_id/#balances' class = 'btn btn-success' id= 'pay_btn'>Pay</a> ";
	  			echo "</td>";
	  		}

  			echo "</tr>";

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

	function filterSchedules($filtered_lesson, $filtered_teacher, $day, $time){

		global $con;

		$query = "SELECT C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, TL.Tea_less_Id, ";
		$query .= "TL.Teacher_Id, TL.Lesson_Id, D.Day, T.Time, ";
		$query .= "L.Lesson_Id, L.Lesson_desc, L.No_of_lesson, SC.Stud_class_Id, SC.Class_Id, ";
		$query .= "SC.User_Id, SC.randSalt2, U.User_Id, U.Last_name, U.First_name ";
		$query .= "FROM class_tbl as C, teacher_lesson_tbl as TL, days_tbl as D, time_tbl as T, ";
		$query .= "lessons_tbl as L, stud_class_tbl as SC, user_info_tbl as U ";
		$query .= "WHERE C.Class_Id = SC.Class_Id AND C.Tea_less_Id = TL.Tea_less_Id AND "; 
		$query .= "TL.Lesson_Id = L.Lesson_Id AND SC.User_Id = U.User_Id AND TL.Lesson_Id = '$filtered_lesson' ";
		$query .= "AND C.Day = D.Day_Id AND C.Time = T.Time_Id AND SC.randSalt2 = 1 AND ";
		$query .= "TL.Teacher_Id = '$filtered_teacher' AND C.Day = '$day' AND C.Time = '$time' ";

		$result = mysqli_query($con, $query);

		return $result;
	}

	function viewTeachersched($teacher_id, $day, $time){

		global $con;

		$query = "SELECT C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, TL.Tea_less_Id, ";
		$query .= "TL.Teacher_Id, TL.Lesson_Id, D.Day, T.Time, ";
		$query .= "L.Lesson_Id, L.Lesson_desc, L.No_of_lesson, SC.Stud_class_Id, SC.Class_Id, ";
		$query .= "SC.User_Id, SC.randSalt2, U.User_Id, U.Last_name, U.First_name ";
		$query .= "FROM class_tbl as C, teacher_lesson_tbl as TL, days_tbl as D, time_tbl as T, ";
		$query .= "lessons_tbl as L, stud_class_tbl as SC, user_info_tbl as U ";
		$query .= "WHERE C.Class_Id = SC.Class_Id AND C.Tea_less_Id = TL.Tea_less_Id AND "; 
		$query .= "TL.Lesson_Id = L.Lesson_Id AND SC.User_Id = U.User_Id AND ";
		$query .= "C.Day = D.Day_Id AND C.Time = T.Time_Id AND SC.randSalt2 = 1 AND ";
		$query .= "TL.Teacher_Id = '$teacher_id' AND C.Day = '$day' AND C.Time = '$time' ";

		$result = mysqli_query($con, $query);

		return $result;
	}

	function editTeachersched($teacher_id){

		global $con;

		$query = "SELECT C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, TL.Tea_less_Id, ";
		$query .= "TL.Teacher_Id, TL.Lesson_Id, D.Day, T.Time, TT.Time, TT.Time_end, TT.randSalt, ";
		$query .= "TT.Time_Id, D.Day_Id, L.Lesson_Id, L.Lesson_desc, L.No_of_lesson ";
		$query .= "FROM class_tbl as C, teacher_lesson_tbl as TL, days_tbl as D, time_tbl as T, ";
		$query .= "lessons_tbl as L, time_tbl as TT ";
		$query .= "WHERE C.Tea_less_Id = TL.Tea_less_Id AND "; 
		$query .= "TL.Lesson_Id = L.Lesson_Id AND C.Time = TT.Time_Id AND ";
		$query .= "C.Day = D.Day_Id AND C.Time = T.Time_Id AND ";
		$query .= "TL.Teacher_Id = '$teacher_id' ORDER BY D.Day_Id ASC";

		$result = mysqli_query($con, $query);

		return $result;
	}

	function viewTeachersched2($final_query){

		global $con;

		while($row = mysqli_fetch_assoc($final_query)){

			$user_id		 = escape($row['User_Id']);
			$stud_last_name  = escape($row['Last_name']);
			$stud_first_name = escape($row['First_name']);
			$lesson 		 = escape($row['Lesson_desc']);
			$no_of_lesson	 = escape($row['No_of_lesson']);

			$the_lesson_desc = "$lesson - $no_of_lesson Lessons";

			echo "<td class='column100 column3' data-column='column3'><center><a href = 'edit_student.php?userid=$user_id/#attendance' title='Lesson' data-toggle='popover' data-trigger='hover' data-content='$the_lesson_desc' data-placement='bottom'>$stud_first_name $stud_last_name</a></center></td>";

		}
		// data-toggle='modal' data-target='#viewStudent'
	}

	// POS
	function POSproductList($branch_id){

		global $con;

		$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
		$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
		$query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level FROM products_tbl as P, ";
		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id ";
		$query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
		$query .= "and PI.Branch_Id = '$branch_id' and NOT PI.Quantity = 0 and P.Status_2 = 1 ";
		$query .= "ORDER BY P.Prod_Id DESC ";

		$result = mysqli_query($con, $query);

		return $result;
	}

	//Inventory
	function productList($branch_id){

		global $con;

		$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
		$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
		$query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level FROM products_tbl as P, ";
		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id ";
		$query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
		$query .= "and PI.Branch_Id = '$branch_id' and P.Status_2 = 1 ";
		$query .= "ORDER BY P.Prod_Id DESC ";

		$result = mysqli_query($con, $query);

		return $result;
	}

	function stocksOnHand($branch_id){

		global $con;

		$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
		$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
		$query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level FROM products_tbl as P, ";
		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id ";
		$query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
		$query .= "and PI.Branch_Id = '$branch_id' AND NOT PI.Quantity = 0 AND P.Status_2 = 1 ";
		$query .= "ORDER BY P.Prod_Id DESC ";

		$result = mysqli_query($con, $query);

		return $result;
	}

	//Inventory
	function productListId($branch_Id, $prod_Id){

		global $con;

		$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
		$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
		$query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level FROM products_tbl as P, ";
		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id ";
		$query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id and P.Status_2 = 1 ";
		$query .= "and PI.Branch_Id = '$branch_Id' and P.Prod_Id = '$prod_Id'";

		$result = mysqli_query($con, $query);

		return $result;
	}

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

	//For Lessons at Registration Form
	function fill_lesson(){

		global $con;

		$query 			= "SELECT * FROM lessons_tbl";
		$query_lessons 	= mysqli_query($con, $query);

		while($row = mysqli_fetch_array($query_lessons)){

			$lesson_id 		= $row['Lesson_Id'];
			$lesson_amount 	= $row['Amount'];
			$lesson_desc	= $row['Lesson_desc'];
			$lesson_no 		= $row['No_of_lesson'];

			echo "<option value = '$lesson_id'>$lesson_desc " . "-" . "$lesson_no" . " Lessons" . "</option>";
		}

	}
	//For Lessons at Registration Form END

	//For Category list in Product List
	function fill_category(){

		global $con;

		$query = "SELECT * FROM category_tbl WHERE Status = 1";
		$query_category = mysqli_query($con, $query);

		while($row = mysqli_fetch_array($query_category)){

			$category_id    = $row['Category_Id'];
			$category_title = $row['Category_title'];

			echo "<option value = '$category_id'>{$category_title}</option>";
		}
	}
	//END

	//Count Official Students
	function official_students($branch_id){

		global $con;

		$query = "SELECT user_info_tbl.Branch_Id, user_info_tbl.User_Id, stud_status_tbl.Status ";
		$query .= "FROM user_info_tbl LEFT JOIN stud_status_tbl ON ";
		$query .= "user_info_tbl.User_Id = stud_status_tbl.User_Id WHERE user_info_tbl.Branch_Id ";
		$query .= "= '{$branch_id}' and stud_status_tbl.Status = 'Official'";
		$query_official_students = mysqli_query($con, $query); 
		$count_official_students = mysqli_num_rows($query_official_students);

		echo "<div><h1>{$count_official_students}</h1></div>";

	}
	//Count Official Students END

	//Count Pending Students
	function pending_students($branch_id){

		global $con;

		$query = "SELECT user_info_tbl.Branch_Id, user_info_tbl.User_Id, stud_status_tbl.Status ";
		$query .= "FROM user_info_tbl LEFT JOIN stud_status_tbl ON ";
		$query .= "user_info_tbl.User_Id = stud_status_tbl.User_Id WHERE user_info_tbl.Branch_Id ";
		$query .= "= '{$branch_id}' and stud_status_tbl.Status = 'Pending'";
		$query_pending_students = mysqli_query($con, $query); 
		$count_pending_students = mysqli_num_rows($query_pending_students);

		echo "<div><h1>{$count_pending_students}</h1></div>";

	}
	//Count Pending Students END

	//Count Pending Students
	function declined_students($branch_id){

		global $con;

		$query = "SELECT user_info_tbl.Branch_Id, user_info_tbl.User_Id, stud_status_tbl.Status ";
		$query .= "FROM user_info_tbl LEFT JOIN stud_status_tbl ON ";
		$query .= "user_info_tbl.User_Id = stud_status_tbl.User_Id WHERE user_info_tbl.Branch_Id ";
		$query .= "= '{$branch_id}' and stud_status_tbl.Status = 'Declined'";
		$query_declined_students = mysqli_query($con, $query); 
		$count_declined_students = mysqli_num_rows($query_declined_students);

		echo "<div><h1>{$count_declined_students}</h1></div>";

	}
	//Count Pending Students END

	//Count Teachers
	function count_teachers($branch_id){

		global $con;

		$query = "SELECT teacher_tbl.Teacher_Id, teacher_branch_tbl.Branch_Id FROM ";
		$query .="teacher_tbl LEFT JOIN teacher_branch_tbl ON ";
		$query .="teacher_tbl.Teacher_Id = teacher_branch_tbl.Teacher_Id ";
		$query .="LEFT JOIN branches_tbl ON branches_tbl.Branch_Id = teacher_branch_tbl.Branch_Id ";
		$query .="WHERE teacher_branch_tbl.Branch_Id = '$branch_id'";

		$query_count_teachers 	= mysqli_query($con, $query); 
		$count_teachers 		= mysqli_num_rows($query_count_teachers);
		
		echo "<div><h1>{$count_teachers}</h1></div>";

	}
	//Count Teachers END

	//Product Sales Today
	function prodSales_Today($branch_id){

		global $con;

		$query = "SELECT SUM(Total) as Sales FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
		$query .="AND Date = curdate() AND randSalt4 = 1";
		$query_sales_today = mysqli_query($con, $query);

		while($row = mysqli_fetch_assoc($query_sales_today)){

			$sales = $row['Sales'];

			echo "<div><center><h1>P".number_format($sales,2)."</h1></center></div>";
		}

	}
	//Product Sales Today END

	//Lesson Sales Today
	function lessonSales_Today($branch_id){

		global $con;

		$query = "SELECT SUM(stud_balances.Cash_tendered - stud_balances.The_change) as Total, stud_balances.Date ";
		$query .="FROM stud_balances LEFT JOIN user_info_tbl ON stud_balances.User_Id = user_info_tbl.User_Id ";
		$query .="WHERE user_info_tbl.Branch_Id = '$branch_id' ";
		$query .="AND stud_balances.Date = curdate()";
		$query_sales_today = mysqli_query($con, $query);

		while($row = mysqli_fetch_assoc($query_sales_today)){

			$sales = $row['Total'];

			echo "<div><center><h1>P".number_format($sales,2)."</h1></center></div>";
		}

	}
	//Lesson Sales Today END

	//Overall Sales Today
	function overAllSales($branch_id){

		global $con;

		//Lesson Sales
		$query = "SELECT SUM(stud_balances.Cash_tendered - stud_balances.The_change) as Total1, stud_balances.Date ";
		$query .="FROM stud_balances LEFT JOIN user_info_tbl ON stud_balances.User_Id = user_info_tbl.User_Id ";
		$query .="WHERE user_info_tbl.Branch_Id = '$branch_id' ";
		$query .="AND stud_balances.Date = curdate() ";
		$query_sales_today = mysqli_query($con, $query);

		confirmQuery($query_sales_today);

		while($row = mysqli_fetch_assoc($query_sales_today)){

			$lessonsales 	= $row['Total1'];
		}
		//Lesson Sales END

		//Product Sales
		$query2 = "SELECT SUM(Total) as Total2 FROM sales_tbl WHERE Branch_Id = '$branch_id' ";
		$query2 .="AND Date = curdate() AND randSalt4 = 1";
		$query_prod_sales_today = mysqli_query($con, $query2);

		while($row = mysqli_fetch_assoc($query_prod_sales_today)){

			$productsales = $row['Total2'];
			
		}
		//Product Sales END

		$formula = $lessonsales + $productsales;

		echo "<div><center><h1>P".number_format($formula, 2)."</h1></center></div>";

	}
	//Overall Sales Today END


	// To determine Fast Moving Products
	function movingProducts($branch_id, $order, $limit){

		global $con;

		$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
		$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
		$query .= "SD.Quantity, SD.Prod_Id, SUM(SD.Quantity) AS TotalQuantity FROM products_tbl as P, ";
		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B, sales_detail as SD ";
		$query .= "WHERE P.Prod_Id = PI.Prod_Id and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
		$query .= "and SD.Prod_Id = P.Prod_Id and P.Status_2 = 1 and PI.Branch_Id = '$branch_id' ";
		$query .= "GROUP BY P.Prod_Id ORDER BY SUM(SD.Quantity) $order LIMIT $limit";

		$result = mysqli_query($con, $query);

		return $result;

	}
	//END

	// Slow Moving
	function slowMoving($branch_id, $limit){

		global $con;

		$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, ";
		$query .= "P.Prod_image, P.Status, P.Prod_price, P.Prod_desc, C.Category_Id, ";
		$query .= "PI.Quantity, B.Branch_Id FROM products_tbl as P, ";
		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B ";
		$query .= "WHERE P.Prod_Id = PI.Prod_Id and P.Category_Id = C.Category_Id ";
		$query .= "and PI.Branch_Id = B.Branch_Id and PI.Branch_Id = '$branch_id' ";
		$query .= "and P.Status_2 = 1 ORDER BY P.Prod_Id ";
		$query .= "ASC LIMIT $limit";

		$result = mysqli_query($con, $query);

		return $result;
	}
	// END

	// Critical Stocks
	function criticalStocks($branch_id, $number, $limit){

		global $con;

		$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
		$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
		$query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level FROM products_tbl as P, ";
		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id ";
		$query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id and PI.Branch_Id ";
		$query .= "= '$branch_id' and P.Status_2 = 1 and ";
		$query .= "PI.Quantity <= $number ORDER BY P.Prod_Id ASC LIMIT $limit";

		$result = mysqli_query($con, $query);

		return $result;
	}
	// END

	//Max ID for Products
	function max_Id(){

		global $con;

		$max 		= "SELECT max(Prod_Id)+1 AS ID FROM products_tbl";
		$resultId 	= $con->query($max);
		$rowId 		= $resultId->fetch_assoc();
		$maxvalue 	= $rowId['ID'];

		echo $maxvalue;

	}

    //Max ID for Products END

	function max_Id_two(){

		global $con;

		$max 		= "SELECT max(Category_Id)+1 AS ID FROM category_tbl";
		$resultId 	= $con->query($max);
		$rowId 		= $resultId->fetch_assoc();
		$maxvalue 	= $rowId['ID'];

		echo $maxvalue;

	}

	function prodSett($id){

		global $con;

		$query = "SELECT * FROM product_settings ";
      	$query .="WHERE Prod_sett_Id = $id";
      	$query_prod_settings = mysqli_query($con, $query);

      	$result = mysqli_query($con, $query);

		return $result;
      	
	}

	function messageInfo($user_id){

		global $con;

		$query = "SELECT user_info_tbl.Last_name, user_info_tbl.First_name, ";
	 	$query .="user_info_tbl.Middle_name, user_info_tbl.Profile_img, messages.Mess_Id, ";
	 	$query .="messages.Sender, messages.Date, messages.Time, messages.Status, messages.Title, ";
	 	$query .="messages.Description, messages.Receiver FROM user_info_tbl LEFT JOIN messages ON ";
	 	$query .="user_info_tbl.User_Id = messages.Sender WHERE messages.Receiver = '$user_id' ";

	 	$result = mysqli_query($con, $query);

		return $result;	
	}

	function mostEnrolled($branch_id){

		global $con;

		$query = "SELECT COUNT(SC.Lesson_Id) as Total, L.Lesson_desc, L.Lesson_Id, L.Cover_image, ";
		$query .="L.Amount, L.No_of_lesson FROM user_info_tbl as U, lessons_tbl as L, ";
		$query .="selected_class_tbl as SC, branches_tbl as B WHERE SC.User_Id = U.User_Id ";
		$query .="AND U.Branch_Id = B.Branch_Id AND SC.Lesson_Id = L.Lesson_Id ";
		$query .="AND U.Branch_Id = '$branch_id' GROUP BY L.Lesson_Id ";
		$query .="ORDER BY COUNT(SC.Lesson_Id)";

		$result = mysqli_query($con, $query);

		return $result;
	}

?>