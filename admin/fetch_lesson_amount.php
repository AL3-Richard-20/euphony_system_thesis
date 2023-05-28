<?php
	
	include "../includes/db.php";
	include "includes/functions.php";

	if($_POST['action'] == 'amount'){

		if(isset($_POST['lessonid'])){

			$the_lesson_id = escape($_POST['lessonid']);

			$query = "SELECT Amount FROM lessons_tbl WHERE Lesson_Id = '$the_lesson_id' ";
			$fetch_amount = mysqli_query($con, $query);

			confirmQuery($fetch_amount);

			$row = mysqli_fetch_assoc($fetch_amount);

			$the_amount = $row['Amount'];

			if($the_amount){
				echo json_encode([number_format($the_amount,2)]);
			}

			else{
				echo json_encode(['Error']);
			}
		}

		else{
			echo json_encode(['Item has been missing']);
		}
	}

	else{
		echo json_encode(['No id fetched']);
	}

?>