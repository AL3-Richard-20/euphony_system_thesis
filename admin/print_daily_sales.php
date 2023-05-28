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
		        $this->Cell(276,5,'PRODUCT SALES REPORT', 0, 0, 'C');
		        $this->Ln(20);
		        $this->SetFont('Times','', 12);
		        $this->Cell(276,5,'Sales Record as of', 0, 0, 'C');
		        $this->Ln();

	         	if(isset($_GET['date'])){

	        		$date_filter  = $_GET['date'];

	        		if($date_filter == 'Today'){
		        		$this->SetFont('Times','B', 12);
		        		$this->Cell(276,10, date('F d, Y', strtotime("Today")), 0, 0, 'C');
		        		$this->Ln(15);
		        	}
		        	else{
		        		$this->SetFont('Times','B', 12);
		        		$this->Cell(276,10, date('F d, Y', strtotime($date_filter)), 0, 0, 'C');
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
        $this->Cell(50, 10, 'CUSTOMER', 1, 0, 'C');
        $this->Cell(30, 10, 'DATE', 1, 0, 'C');
        $this->Cell(20, 10, 'O.R', 1, 0, 'C');
        $this->Cell(20, 10, 'A.R', 1, 0, 'C');
        $this->Cell(30, 10, 'TOTAL', 1, 0, 'C');
        $this->Cell(30, 10, 'DISCOUNT', 1, 0, 'C');
        $this->Cell(30, 10, 'CASH', 1, 0, 'C');
        $this->Cell(30, 10, 'CHANGE', 1, 0, 'C');
        $this->Cell(30, 10, 'PAYMENT', 1, 0, 'C');
        $this->Ln();
        //Table Header END
    }

    function salesTable($con){

    	$branch_id = $_SESSION['branchid'];

		if(isset($_GET['date'])){

	        $date_filter  = $_GET['date'];

	        if($date_filter == 'Today'){
	        	$query  ="SELECT * FROM sales_tbl ";
				$query .="WHERE Date = curdate() AND Branch_Id='$branch_id' AND randSalt4 = 1";
	        }

	        else{
	        	$query  ="SELECT * FROM sales_tbl ";
				$query .="WHERE Date = '$date_filter' AND Branch_Id='$branch_id' AND randSalt4 = 1";
	        }

	        $query_sales = mysqli_query($con, $query);

			$n = 1;

			while($row = mysqli_fetch_assoc($query_sales)){

				$trans_date 	= $row['Date'];
				$customer 		= $row['Sold_to'];
				$OR_no			= $row['OR_no'];
				$AR_no			= $row['AR_no'];
				// $subtotal 		= $row['Subtotal'];
				$total_discount	= $row['Total_discount'];
				$total 			= $row['Total'];
				$cash 			= $row['Cash'];
				$change 		= $row['Cash_change'];
				$payment 		= $row['Payment'];

				$this->SetFont('Times','', 12);
				$this->Cell(10, 10, $n++, 1, 0, 'C');
		        $this->Cell(50, 10, $customer, 1, 0, 'C');
		        $this->Cell(30, 10, date('M d, Y', strtotime($trans_date)), 1, 0, 'C');
		        $this->Cell(20, 10, $OR_no, 1, 0, 'C');
		        $this->Cell(20, 10, $AR_no, 1, 0, 'C');
		        $this->Cell(30, 10, number_format($total,2) . " PHP", 1, 0, 'C');
		        $this->Cell(30, 10, $total_discount . " %", 1, 0, 'C');
		        $this->Cell(30, 10, number_format($cash,2) . " PHP", 1, 0, 'C');
		        $this->Cell(30, 10, number_format($change,2) . " PHP", 1, 0, 'C');
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
$pdf->tableHeader();
$pdf->salesTable($con);
//$pdf->viewTable($con);
$pdf->Output();

?>