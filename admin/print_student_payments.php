<?php

	require('../assets/fpdf/fpdf.php');

	include "../includes/db.php";
	include "../includes/functions.php";

	class myPDF extends FPDF{



	    function Header(){

			$this->SetFont('Arial','B', 14);
	        $this->Cell(0,5,'Euphony Music Center & Studio',0,0,'C');
	        $this->Ln();
		        
	    }



	    function Branch($con){

	    	if(isset($_GET['branchid'])){

				$branch_id = $_GET['branchid'];
				$_SESSION['branchid'] = $branch_id;

				$query = "SELECT * FROM branches_tbl WHERE Branch_Id = '$branch_id'";
				$query_branch = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($query_branch)){

					$branch_desc 		= $row['Branch_desc'];
					$branch_location 	= $row['Branch_location'];
					$phone_no 			= $row['Phone_no'];

					$this->SetFont('Times','', 12);
			        $this->Cell(0,10, $branch_desc, 0, 0, 'C');
			        $this->Ln();
			        $this->SetFont('Times','', 12);
			        $this->Cell(0,5, $branch_location, 0, 0, 'C');
			        $this->Ln();
			        $this->SetFont('Times','', 12);
			        $this->Cell(0,10,$phone_no, 0, 0, 'C');
			        $this->Ln(20);
			    }

			}
	    }

	    function Footer(){
	        $this->SetY(-15);
	        $this->SetFont('Arial','',8);
	        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}', 0, 0, 'C');

	    }



	    function tableHeader($con){

	    	$this->SetFont('Times','B', 14);
			$this->Cell(0,10, 'STUDENT PAYMENT RECORDS', 0, 0, 'C');
			$this->Ln(20);

			if(isset($_GET['userid'])){

				$user_id = $_GET['userid'];

				$query = "SELECT UI.User_Id, UI.Branch_Id, UI.Last_name, UI.First_name, UI.Middle_name, UI.Address, ";
				$query .="UI.Contact_no, UI.Birthdate, UI.Age, UI.Sex, UI.Nationality, UI.Profile_img, UL.Email, ";
				$query .="UL.Password, UL.Level, UL.Date_started, B.Branch_Id, B.Branch_desc, B.Branch_location, ";
				$query .="B.Branch_image, B.Level, ";
				$query .="SS.User_Id, SS.Status FROM user_info_tbl as UI, user_login as UL, ";
				$query .="branches_tbl as B, stud_status_tbl as SS WHERE UI.User_Id = UL.User_Id AND ";
				$query .="UI.Branch_Id = B.Branch_Id AND SS.User_Id = UI.User_Id AND UI.User_Id = '{$user_id}'";

				$query_stud_info = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($query_stud_info)){

					$lastname 		= $row['Last_name'];
			  		$firstname 		= $row['First_name'];
			  		$middlename 	= $row['Middle_name'];

			  		$fullname = "$firstname $middlename $lastname";

			  		$this->SetFont('Times','B', 12);
	    			$this->Cell(20, 5, 'Full Name: ', 0, 0, 'C');
	    			$this->SetFont('Times','', 12);
	        		$this->Cell(50, 5, $fullname, 0, 0, 'C');
				}

			}

	        $this->SetFont('Times','', 12);
	    	$this->Cell(370, 5, 'Date: '. date('F d, Y', strtotime("Today")), 0, 0, 'C');

	        $this->Ln(10);

	        //Table Header 
	        $this->SetFont('Times','B', 12);
	        $this->Cell(10, 10, 'NO.', 1, 0, 'C');
	        $this->Cell(30, 10, 'DATE', 1, 0, 'C');
	        $this->Cell(30, 10, 'TIME', 1, 0, 'C');
	        $this->Cell(30, 10, 'O.R', 1, 0, 'C');
	        $this->Cell(30, 10, 'A.R', 1, 0, 'C');
	        $this->Cell(30, 10, 'CASH', 1, 0, 'C');
	        $this->Cell(30, 10, 'DISCOUNT', 1, 0, 'C');
	        $this->Cell(30, 10, 'CHANGE', 1, 0, 'C');
	        $this->Cell(30, 10, 'BALANCE', 1, 0, 'C');
	        $this->Cell(30, 10, 'PAYMENT', 1, 0, 'C');
	        $this->Ln();
	        //Table Header END
	    }

	    function paymentsTable($con){

	    	if(isset($_GET['userid'])){

	    		$user_id = $_GET['userid'];

	    		$query = "SELECT user_info_tbl.Last_name, user_info_tbl.First_name, user_info_tbl.Middle_name, ";
				$query .="stud_balances.Transaction_Id, stud_balances.Date, stud_balances.Cash_tendered, ";
				$query .="stud_balances.AR_no, stud_balances.OR_no, stud_balances.Payment, ";
				$query .="stud_balances.Discount, stud_balances.The_change, stud_balances.Trans_time, ";
				$query .="stud_balances.Total_balance, stud_balances.The_balance FROM user_info_tbl ";
				$query .="LEFT JOIN stud_balances ON user_info_tbl.User_Id = stud_balances.User_Id ";
				$query .="WHERE stud_balances.User_Id = '{$user_id}' ORDER BY stud_balances.Transaction_Id ";

				$query_stud_balances = mysqli_query($con, $query);

				$n = 1;

				while($row = mysqli_fetch_assoc($query_stud_balances)){

					$trans_date 	= $row['Date'];
					$trans_time 	= $row['Trans_time'];
					$or_no 			= $row['OR_no'];
					$ar_no 			= $row['AR_no'];
					$amount_paid	= $row['Cash_tendered'];
					$total_balance 	= $row['Total_balance'];
					$the_balance 	= $row['The_balance'];
					$the_change 	= $row['The_change'];
					$discount 		= $row['Discount'];
					$payment 		= $row['Payment'];

					$this->SetFont('Times','', 12);
			        $this->Cell(10, 10, $n++, 1, 0, 'C');
			        $this->Cell(30, 10, date('M d, Y', strtotime($trans_date)), 1, 0, 'C');
			        $this->Cell(30, 10, date('h:i A', strtotime($trans_time)), 1, 0, 'C');
			        $this->Cell(30, 10, $or_no, 1, 0, 'C');
			        $this->Cell(30, 10, $ar_no, 1, 0, 'C');
			        $this->Cell(30, 10, number_format($amount_paid,2), 1, 0, 'C');
			        $this->Cell(30, 10, number_format($discount,2), 1, 0, 'C');
			        $this->Cell(30, 10, number_format($the_change,2), 1, 0, 'C');
			        $this->Cell(30, 10, number_format($total_balance,2), 1, 0, 'C');
			        $this->Cell(30, 10, $payment, 1, 0, 'C');
			        $this->Ln();
	        	}
	    	}
			
	    }


	    function signature(){

	        $this->Ln();
	        $this->SetFont('Times','', 12);
	        $this->Cell(0, 10,'____________________', 0, 0, 'C');
	        $this->Ln();
	        $this->Cell(0, 10,'Mila Delin M. Torres', 0, 0, 'C');
	        $this->Ln(15);

	    }
	    

	}

	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L', 'A4', 0);
	$pdf->Branch($con);
	$pdf->tableHeader($con);
	$pdf->paymentsTable($con);
	//$pdf->viewTable($con);
	$pdf->Output();

?>