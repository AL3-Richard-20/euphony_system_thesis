<?php
	
	session_start();
	include "includes/db.php";

	if(isset($_GET['vkey']) && isset($_GET['id'])){

		$last_id 	= $_GET['id'];
		$vkey 		= $_GET['vkey'];

		$query = "SELECT verified,vkey, User_Id FROM user_login WHERE ";
		$query .="verified = 0 AND vkey = '$vkey' AND User_Id = '$last_id'";

		$verification_query = mysqli_query($con, $query);

		$count = mysqli_num_rows($verification_query);

		if($count > 0){

			$query2 = "UPDATE user_login SET verified = 1 WHERE vkey = '$vkey' AND User_Id = '$last_id' ";
			$update_acc = mysqli_query($con, $query2);

			if($update_acc){

				$_SESSION['user_id'] 	= $last_id;
	            $_SESSION['user_role'] 	= 'Student';

	            echo "<script>location.href='student/index.php';</script>";

			}
			else{
				echo $mysqli->error;
			}
		}
		else{
			echo "This account is invalid or already verified";
		}

	}
	else{

		die("Something went wrong");
		
	}

?>

<!DOCTYPE html>

<html>

	<head>

		<title></title>

	</head>

	<body>

	</body>

</html>