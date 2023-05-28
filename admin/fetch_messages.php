<?php
	
	session_start();
	include "../includes/db.php";
	include "includes/session.php";

	//fetch.php;
	if(isset($_POST["view"])){

	 	$query = "SELECT user_info_tbl.Last_name, user_info_tbl.First_name, ";
	 	$query .="user_info_tbl.Middle_name, user_info_tbl.Profile_img, messages.Mess_Id, ";
	 	$query .="messages.Sender, messages.Date, messages.Time, messages.Status, messages.Title, ";
	 	$query .="messages.Description FROM user_info_tbl LEFT JOIN messages ON ";
	 	$query .="user_info_tbl.User_Id = messages.Sender WHERE messages.Receiver = '$user_id' ";
	 	$query .="ORDER BY messages.Mess_Id DESC ";
	 	$query .="LIMIT 5";

	 	$result = mysqli_query($con, $query);
	 	$output = '';
	 
	 	if(mysqli_num_rows($result) > 0){

	  		while($row = mysqli_fetch_array($result)){

	  			$S_lastname 	= $row['Last_name'];
	  			$S_firstname 	= $row['First_name'];
	  			$S_middlename 	= $row['Middle_name'];

	  			$fullname = "$S_firstname $S_lastname";

	  			$S_profile_img = $row['Profile_img'];

	   			$output .= '<li style="width: 230px">';
				$output .= '<a href="messages.php?messid='.$row['Mess_Id'].'" title="">';
				$output .= '<img src="../images/profile_img/'.$S_profile_img.'" alt="" style="width:20%">';
				$output .= '<div class="mesg-meta">';
				$output .= '<h6>'.$fullname.'</h6>';
				$output .= '<span>'.$row["Description"].'</span><br>';
				$output .= '<i>2 min ago</i>';
				$output .= '</div>';
				$output .= '</a>';

				if($row['Status'] == 0){
					$output .= '<span class="label label-success">New</span>';
				}

				$output .= '</li>';
	  		}
	 	}
	 	else{
	  		$output .= '<li style="width: 230px">';
			$output .= '<a href="#" title="">';
			$output .= '<div class="mesg-meta">';
			$output .= '<p>No Messages</p>';
			$output .= '</div>';
			$output .= '</a>';
			$output .= '</li>';
	 	}

	 	$output .= '<li style="width: 230px">';
		$output .= '<a href="compose_message.php" title="">';
		$output .= '<div class="mesg-meta">';
		$output .= '<hr/>';
		$output .= '<p>Compose Mail</p>';
		$output .= '</div>';
		$output .= '</a>';
		$output .= '</li>';
	 
		 $query_1 = "SELECT * FROM messages WHERE Receiver = '$user_id' ";
		 $query_1 .="AND Status = 0";

		 $result_1 	= mysqli_query($con, $query_1);

		 $count 	= mysqli_num_rows($result_1);

		 $data 		= array(
		  'notification'   => $output,
		  'unseen_notification' => $count
		 );

		echo json_encode($data);
	}
?>