<?php

	require('../assets/fpdf/fpdf.php');

	include "../includes/db.php";
	include "../includes/functions.php";

	class myPDF extends FPDF{



	    function Header(){

			$this->SetFont('Arial','B', 14);
	        $this->Cell(276,5,'Euphony Music Center & Studio',0,0,'C');
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
			        $this->Cell(276,10, $branch_desc, 0, 0, 'C');
			        $this->Ln();
			        $this->SetFont('Times','', 12);
			        $this->Cell(276,5, $branch_location, 0, 0, 'C');
			        $this->Ln();
			        $this->SetFont('Times','', 12);
			        $this->Cell(276,10,$phone_no, 0, 0, 'C');
			        $this->Ln(20);
			        $this->SetFont('Times','B', 12);
			        $this->Cell(276,10, 'STUDENT PAYMENT RECORDS', 0, 0, 'C');
			        $this->Ln(20);
			        $this->SetFont('Times','', 12);
			        $this->Cell(276,5,'Payment record as of', 0, 0, 'C');
			        $this->Ln();

		         	if(isset($_GET['date'])){

		        		$the_date  = $_GET['date'];

		        		if($the_date == 'Today'){
			        		$this->SetFont('Times','B', 12);
			        		$this->Cell(276,10, date("F d, Y", strtotime("Today")), 0, 0, 'C');
			        		$this->Ln(15);
			        	}
			        	else{
			        		$this->SetFont('Times','B', 12);
			        		$this->Cell(276,10, date("F d, Y", strtotime($the_date)), 0, 0, 'C');
			        		$this->Ln(15);
			        	}

			        }
			    }

			}
	    }

	    function Footer(){
	        $this->SetY(-15);
	        $this->SetFont('Arial','',8);
	        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}', 0, 0, 'C');

	    }







	    function tableHeader(){

	        //Table Header 
	        $this->SetFont('Times','B', 12);
	        $this->Cell(10, 10, 'No.', 1, 0, 'C');
	        $this->Cell(50, 10, 'STUDENT', 1, 0, 'C');
	        $this->Cell(20, 10, 'O.R', 1, 0, 'C');
	        $this->Cell(20, 10, 'A.R', 1, 0, 'C');
	        $this->Cell(40, 10, 'CASH', 1, 0, 'C');
	        $this->Cell(40, 10, 'CHANGE', 1, 0, 'C');
	        $this->Cell(30, 10, 'DISCOUNT', 1, 0, 'C');
	        $this->Cell(40, 10, 'TOTAL BALANCE', 1, 0, 'C');
	        $this->Cell(30, 10, 'PAYMENT', 1, 0, 'C');
	        $this->Ln();
	        //Table Header END
	    }

	    function paymentBalancesTable($con){

	    	$branch_id = $_SESSION['branchid'];

	    	if(isset($_GET['date'])){

			    $the_date  = $_GET['date'];

			    if($the_date == 'Today'){

			    	$query = "SELECT SB.The_balance, SB.Cash_tendered, SB.Total_balance, SB.Discount, ";
			    	$query .="SB.OR_no, SB.AR_no, SB.Payment, ";
					$query .="SB.The_change, U.First_name, U.Middle_name, U.Last_name, U.User_Id ";
					$query .="FROM stud_balances as SB, user_info_tbl as U ";
					$query .="WHERE SB.User_Id = U.User_Id AND U.Branch_Id = '$branch_id' AND SB.Date = curdate()";
			    }

			    else{

			    	$query = "SELECT SB.The_balance, SB.Cash_tendered, SB.Total_balance, SB.Discount, ";
			    	$query .="SB.OR_no, SB.AR_no, SB.Payment, ";
					$query .="SB.The_change, U.First_name, U.Middle_name, U.Last_name, U.User_Id ";
					$query .="FROM stud_balances as SB, user_info_tbl as U ";
					$query .="WHERE SB.User_Id = U.User_Id AND U.Branch_Id = '$branch_id' AND SB.Date = '$the_date'";
				
				}
			}
			
	    	$query_all_present = mysqli_query($con, $query);

	    	$count1 = mysqli_num_rows($query_all_present);

			if($count1 == NULL){

	        	$this->Cell(280, 10, 'None', 1, 0, 'C');

	        }
	        else{

		    	$n = 1;

		    	while($row = mysqli_fetch_assoc($query_all_present)){
					
					$stud_id 			= $row['User_Id'];
					$stud_firstname 	= $row['First_name'];
					$stud_middlename 	= $row['Middle_name'];
					$stud_lastname 		= $row['Last_name'];

					$the_student 		= "$stud_firstname $stud_middlename $stud_lastname";

					$or_no 				= $row['OR_no'];
					$ar_no 				= $row['AR_no'];

					$the_balance 		= $row['The_balance'];
					$cash_tendered 		= $row['Cash_tendered'];
					$total_balance 		= $row['Total_balance'];
					$discount 			= $row['Discount'];
					$the_change 		= $row['The_change'];
					$payment 			= $row['Payment'];

		    		$this->SetFont('Times','', 12);
		    		$this->Cell(10, 10, $n++, 1, 0, 'C');
			        $this->Cell(50, 10, $the_student, 1, 0, 'C');
					$this->Cell(20, 10, $or_no, 1, 0, 'C');
					$this->Cell(20, 10, $ar_no, 1, 0, 'C');
			        $this->Cell(40, 10, number_format($cash_tendered,2) . " PHP", 1, 0, 'C');
			        $this->Cell(40, 10, number_format($the_change,2) . " PHP", 1, 0, 'C');
			        $this->Cell(30, 10, number_format($discount,2) . " PHP", 1, 0, 'C');
			        $this->Cell(40, 10, number_format($total_balance,2) . " PHP", 1, 0, 'C');
			        $this->Cell(30, 10, $payment, 1, 0, 'C');
			        $this->Ln();
			    }
			}
	    }




	    function signature(){

	        $this->Ln(20);
	        $this->SetFont('Times','', 12);
	        $this->Cell(480, 10,'____________________', 0, 0, 'C');
	        $this->Ln();
	        $this->Cell(480, 10,'Signature over printed name', 0, 0, 'C');
	        $this->Ln(15);

	    }
	    

	}

	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L', 'A4', 0);
	$pdf->Branch($con);
	$pdf->tableHeader();
	$pdf->paymentBalancesTable($con);
	$pdf->signature();
	$pdf->Output();

?>