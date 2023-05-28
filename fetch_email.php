<?php
	
	if(isset($_POST["email"])){

	 	$con = new PDO("mysql:host=localhost; dbname=euphony", "root", "");

	 	$query = "SELECT Email, verified FROM user_login WHERE Email = '".trim($_POST["email"])."' ";
	 	$statement = $con->prepare($query);
	 	$statement->execute();
	 	$total_row = $statement->rowCount();

	 	if($total_row == 0 ){
	  		$output = array(
	   			'success' => true
	  		);

	  		echo json_encode($output);
	 	}
	}

?>