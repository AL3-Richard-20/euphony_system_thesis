<?php
	
	session_start();
	include "../includes/db.php";
	include "includes/functions.php";

	if(isset($_GET['studid'])){

		$the_stud_Id = escape($_GET['studid']);

		$query  	= "UPDATE stud_status_tbl SET Status = 'Declined' WHERE User_Id = '$the_stud_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='students.php';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['studatt']) && isset($_GET['studattid']) ){

		$stud_att_Id  		= escape($_GET['studatt']);
		$the_stud_att_Id 	= escape($_GET['studattid']);

		$query  	= "DELETE FROM attendance_tbl WHERE Att_Id = '$stud_att_Id' ";
		$del_att 	= mysqli_query($con, $query);

		confirmQuery($del_att);

		if($del_att){

			echo "<script>location.href='edit_student.php?userid=$the_stud_att_Id';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['studpay']) && isset($_GET['studpayid']) ){

		$stud_pay_Id  		= escape($_GET['studpay']);
		$the_stud_pay_Id 	= escape($_GET['studpayid']);

		$query   		= "DELETE FROM stud_balances WHERE Transaction_Id = '$stud_pay_Id' ";
		$delete_trans 	= mysqli_query($con, $query);

		confirmQuery($delete_trans);

		if($delete_trans){

			echo "<script>location.href='edit_student.php?userid=$the_stud_pay_Id';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['teacherid'])){

		$the_teacher_Id = escape($_GET['teacherid']);

		$query  	= "UPDATE teacher_tbl SET Status = 0 WHERE Teacher_Id = '$the_teacher_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){
			echo "<script>location.href='teachers.php';</script>";
		}

		else{
			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['teacherless']) && isset($_GET['tealessid']) ){

		$teacher_Id 	= escape($_GET['tealessid']);
		$tea_less_Id 	= escape($_GET['teacherless']);

		$query  	= "UPDATE teacher_lesson_tbl SET Status = 0 WHERE tea_less_Id = '$tea_less_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='edit_teacher.php?teacherid=$teacher_Id';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['prodid'])){

		$the_prod_Id = escape($_GET['prodid']);

		$query  	= "UPDATE products_tbl SET Status_2 = 0 WHERE Prod_Id = '$the_prod_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='inventory.php';</script>";
		}

		else{
			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['prodsalesid'])){

		$prod_sales_Id = escape($_GET['prodsalesid']);

		$query  	= "UPDATE sales_tbl SET Status = 0 WHERE Sales_Id = '$prod_sales_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='daily_sales.php';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['lesssalesid'])){

		$less_sales_Id = escape($_GET['lesssalesid']);

		$query  	= "UPDATE stud_balances SET Status = 0 WHERE Transaction_Id = '$less_sales_Id' ";
		$inactive 	= mysqli_query($con, $query);

		confirmQuery($inactive);

		if($inactive){

			echo "<script>location.href='payments.php';</script>";
		}

		else{

			echo "<script>location.href='index.php';</script>";
		}

	}

	else if(isset($_GET['classid']) && isset($_GET['teacher'])){

		$the_class_Id 	= escape($_GET['classid']);
		$the_teacher 	= escape($_GET['teacher']);

		$query = "DELETE FROM class_tbl WHERE Class_Id = '$the_class_Id' ";

		$delete_class = mysqli_query($con, $query);

		confirmQuery($delete_class);

		if($delete_class){

			echo "<script>location.href='edit_teacher_schedule.php?teacherid=$the_teacher';</script>";
		}
		else{

			echo "<script>location.href='index.php';</script>";
		}
	}

	else if(isset($_GET['delsale']) && isset($_GET['delprod'])){

		$del_sale_Id = $_GET['delsale'];
        $del_prod_Id = $_GET['delprod'];

        $query = "SELECT sales_detail.Sales_Id, sales_detail.Prod_Id, sales_detail.Quantity, sales_tbl.Date, ";
        $query .="prod_invt_tbl.Quantity as AQuantity, sales_detail.Quantity as QQuantity ";
        $query .="FROM sales_detail LEFT JOIN sales_tbl ON sales_detail.Sales_Id = sales_tbl.Sales_Id LEFT JOIN ";
        $query .="prod_invt_tbl ON prod_invt_tbl.Prod_Id = sales_detail.Prod_Id ";
        $query .="WHERE sales_detail.Sales_Id = '$del_sale_Id' AND ";
        $query .="sales_detail.Prod_Id = '$del_prod_Id' AND sales_tbl.Date = curdate()";

        $query_info = mysqli_query($con, $query);

        confirmQuery($query_info);  

        while($row = mysqli_fetch_assoc($query_info)){

          	$the_sales_Id     = $row['Sales_Id'];
          	$the_prod_Id      = $row['Prod_Id'];
          	$order_quantity   = $row['QQuantity'];
          	$actual_quantity  = $row['AQuantity'];

          	$formula = ($actual_quantity + $order_quantity);

          	$query2 = "UPDATE prod_invt_tbl SET Quantity = '$formula' WHERE Prod_Id = '$the_prod_Id' ";
          	$query_update = mysqli_query($con, $query2);

          	confirmQuery($query_update);

          	if($query_update == 1){

            	$query3 = "DELETE FROM sales_detail WHERE Sales_Id = '$del_sale_Id' AND Prod_Id = '$del_prod_Id' ";
            	$query_del = mysqli_query($con, $query3);

            	confirmQuery($query_del);

            	echo "<script>location.href='POS.php';</script>";

          	}

        }

	}


	else if(isset($_GET['void'])){

		$void_sales_id = $_GET['void'];

        $query = "UPDATE sales_tbl SET randSalt4 = 2 WHERE Sales_Id = '$void_sales_id' ";

        $query_void_transaction = mysqli_query($con, $query);

        confirmQuery($query_void_transaction);



        $query2 = "SELECT * FROM sales_detail WHERE Sales_Id = '$void_sales_id' ";

        $query_one_b_one = mysqli_query($con, $query2);

        confirmQuery($query_one_b_one);

        

        while($row = mysqli_fetch_assoc($query_one_b_one)){

          	$the_prod_id  = escape($row['Prod_Id']);
         	$the_quantity = escape($row['Quantity']);

          	$query3 = "SELECT Quantity FROM prod_invt_tbl WHERE Prod_Id = '$the_prod_id' ";
          	$query_prod_quan = mysqli_query($con, $query3);

          	confirmQuery($query_prod_quan);

          	while($row2 = mysqli_fetch_assoc($query_prod_quan)){

            	$og_quantity = $row2['Quantity'];

          	}

          	if($query_prod_quan){

            	$formula = (int)$the_quantity + (int)$og_quantity;

            	$query4 = "UPDATE prod_invt_tbl SET Quantity = '$formula' WHERE ";
            	$query4 .="Prod_Id = '$the_prod_id' ";

            	$return_stock = mysqli_query($con, $query4);

            	confirmQuery($return_stock);

          	}

        }

        $_SESSION['salesid'] = null;

        // echo "<script>sweetAlert('success', 'Transaction Cancelled', 'You voided the transaction', 'start_POS.php');</script>";

        echo "<script>location.href='start_POS.php';</script>";
	}

?>