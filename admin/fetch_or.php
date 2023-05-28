<?php

	//fetch.php;

	if(isset($_POST["orno"])){

	 	$connect = new PDO("mysql:host=localhost; dbname=euphony", "root", "");

	 	$query = "SELECT * FROM sales_tbl WHERE OR_no = '".trim($_POST["orno"])."' ";
	 	$statement = $connect->prepare($query);
	 	$statement->execute();
	 	$total_row = $statement->rowCount();

	 	$query2 = "SELECT * FROM stud_balances WHERE OR_no = '".trim($_POST["orno"])."' ";
	 	$statement2 = $connect->prepare($query2);
	 	$statement2->execute();
	 	$total_row_2 = $statement2->rowCount();

	 	if($total_row == 0 && $total_row_2 == 0){
	  		$output = array(
	   			'success' => true
	  		);

	  		echo json_encode($output);
	 	}
	}

?>