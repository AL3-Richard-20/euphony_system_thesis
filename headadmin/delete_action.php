<?php
	
	session_start();
	include "../includes/db.php";
	include "includes/functions.php";

	if(isset($_GET['dailyprodsalesid']) && isset($_GET['branchid'])){

		$the_branch_Id = escape($_GET['branchid']);
		$prod_sales_Id = escape($_GET['dailyprodsalesid']);

		$query  	= "UPDATE sales_tbl SET Status = 0 WHERE Sales_Id = '$prod_sales_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='overall_daily.php?branchid=".$the_branch_Id."';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['dailylesssalesid']) && isset($_GET['branchid'])){

		$the_branch_Id = escape($_GET['branchid']);
		$less_sales_Id = escape($_GET['dailylesssalesid']);

		$query  	= "UPDATE stud_balances SET Status = 0 WHERE Transaction_Id = '$less_sales_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='overall_daily.php?branchid=".$the_branch_Id."';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['monthlyprodsalesid']) && isset($_GET['branchid'])){

		$the_branch_Id = escape($_GET['branchid']);
		$prod_sales_Id = escape($_GET['monthlyprodsalesid']);

		$query  	= "UPDATE sales_tbl SET Status = 0 WHERE Sales_Id = '$prod_sales_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='overall_monthly.php?branchid=".$the_branch_Id."';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['monthlylesssalesid']) && isset($_GET['branchid'])){

		$the_branch_Id = escape($_GET['branchid']);
		$less_sales_Id = escape($_GET['monthlylesssalesid']);

		$query  	= "UPDATE stud_balances SET Status = 0 WHERE Transaction_Id = '$less_sales_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='overall_monthly.php?branchid=".$the_branch_Id."';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['yearlyprodsalesid']) && isset($_GET['branchid'])){

		$the_branch_Id = escape($_GET['branchid']);
		$prod_sales_Id = escape($_GET['yearlyprodsalesid']);

		$query  = "UPDATE sales_tbl SET Status = 0 WHERE Sales_Id = '$prod_sales_Id' ";
		$inactive = mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='overall_yearly.php?branchid=".$the_branch_Id."';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['yearlylesssalesid']) && isset($_GET['branchid'])){

		$the_branch_Id = escape($_GET['branchid']);
		$less_sales_Id = escape($_GET['yearlylesssalesid']);

		$query  = "UPDATE stud_balances SET Status = 0 WHERE Transaction_Id = '$less_sales_Id' ";
		$inactive = mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='overall_yearly.php?branchid=".$the_branch_Id."';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

?>