
<?php 

	if($_SESSION['user_role'] != 'Head Administrator'){

		header("location: ../index.php");
	}

	if(isset($_SESSION['user_id'])){
		$user_id   = $_SESSION['user_id'];
	}

	if(isset($_SESSION['branch_id'])){
		$branch_id = $_SESSION['branch_id'];
	}

	if(isset($_SESSION['firstname'])){
		$firstname = $_SESSION['firstname'];
	}

	if(isset($_SESSION['profileimg'])){
		$profileimg = $_SESSION['profileimg'];
	}

	if(isset($_SESSION['sex'])){
		$sex = $_SESSION['sex'];
	}

?>