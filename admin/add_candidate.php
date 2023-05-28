<?php

	include "../includes/db.php";
	include "includes/functions.php";

	if(isset($_GET['userid'])){

		$stud_Id = escape($_GET['userid']);

		$query1 = "SELECT SUM(stud_balances.Cash_tendered - stud_balances.The_change) as Total, ";
		$query1 .="selected_class_tbl.Lesson_Id, lessons_tbl.Amount FROM stud_balances LEFT JOIN ";
		$query1 .="selected_class_tbl ON stud_balances.User_Id = selected_class_tbl.User_Id LEFT JOIN ";
		$query1 .="lessons_tbl ON selected_class_tbl.Lesson_Id = lessons_tbl.Lesson_Id WHERE ";
		$query1 .="selected_class_tbl.User_Id = '$stud_Id' and randSalt9 = 1 ";

		$query_info = mysqli_query($con, $query1);

		confirmQuery($query_info);

		while($row = mysqli_fetch_assoc($query_info)){

			$total_spendings 	= $row['Total'];
			$lesson_amount 		= $row['Amount'];

			$formula = $total_spendings - $lesson_amount;

			if($formula == 0){

				$queryn1 = "UPDATE stud_balances SET randSalt9 = '0' WHERE User_Id = '$stud_Id' ";
				$clear_payments1 = mysqli_query($con, $queryn1);

				confirmQuery($clear_payments1);

			}

			//If there are excess (Transfering Money)

			else{

				$queryn = "UPDATE stud_balances SET randSalt9 = '0' WHERE User_Id = '$stud_Id' ";
				$clear_payments = mysqli_query($con, $queryn);

				confirmQuery($clear_payments);

				if($clear_payments == 1){

					$query2 = "INSERT INTO stud_balances (User_Id, OR_no, AR_no, ";
					$query2 .="The_balance, Date, Trans_time, Cash_tendered, ";
					$query2 .="Total_balance, Discount, The_change, Checked_by, ";
					$query2 .="Payment, randSalt9, Status) ";
					$query2 .="VALUES ('$stud_Id', '', '', '', curdate(), curtime(), ";
					$query2 .="'$formula', '', '', '', '', 'Transfer', 1, 1)";

					$query_transfer_money = mysqli_query($con, $query2);

					confirmQuery($query_transfer_money);
				}
			}
		}

		$query3 = "UPDATE selected_class_tbl SET Status = 'Completed', Date_completed = curdate() ";
		$query3 .="WHERE User_Id = '$stud_Id' ";

		$query_add = mysqli_query($con, $query3);

		confirmQuery($query_add);

		if($query_add == 1){

			$query4 = "DELETE FROM attendance_tbl WHERE User_Id = '$stud_Id' ";
			
			$clear_attendance = mysqli_query($con, $query4);

			confirmQuery($clear_attendance);

			echo "<script>location.href='lesson_passers.php';</script>";

		}
	
	}

?>