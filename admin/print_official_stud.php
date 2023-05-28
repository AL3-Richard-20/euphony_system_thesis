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
  		  $this->Cell(0,10, 'OFFICIAL STUDENTS', 0, 0, 'C');
  		  $this->Ln(20);
        $this->SetFont('Times','', 12);
      	$this->Cell(490, 5, 'Date: '. date('F d, Y', strtotime("Today")), 0, 0, 'C');

          $this->Ln(10);

          //Table Header 
          $this->SetFont('Times','B', 12);
          $this->Cell(10, 10, 'NO.', 1, 0, 'C');
          $this->Cell(60, 10, 'STUDENT', 1, 0, 'C');
          $this->Cell(60, 10, 'ADDRESS', 1, 0, 'C');
          $this->Cell(50, 10, 'CONTACT NO.', 1, 0, 'C');
          $this->Cell(50, 10, 'LESSON', 1, 0, 'C');
          $this->Cell(40, 10, 'DATE STARTED', 1, 0, 'C');
          $this->Ln();
          //Table Header END
      }

      function studentTable($con){

      	$branch_id = $_SESSION['branchid'];

      	$query = "SELECT U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Address, ";
        	$query .= "U.Contact_no, U.Sex, SS.Date_started, SS.Status, L.Lesson_desc, SC.Lesson_Id, ";
        	$query .= "L.No_of_lesson ";
        	$query .= "FROM user_info_tbl as U, lessons_tbl as L, selected_class_tbl as SC, ";
        	$query .= "stud_status_tbl as SS WHERE U.User_Id = SC.User_Id AND ";
        	$query .= "SC.Lesson_Id = L.Lesson_Id AND U.Branch_Id = '{$branch_id}' ";
        	$query .= "AND SS.User_Id = SC.User_Id AND SS.Status = 'Official' ";
        	$query .= "ORDER BY SS.User_Id DESC ";

        	$query_all = mysqli_query($con, $query);

        	$n = 1;

        	while($row = mysqli_fetch_assoc($query_all)){

            	$last_name    = $row["Last_name"];
            	$first_name   = $row["First_name"];
            	$middle_name  = $row["Middle_name"];
            	$address      = $row["Address"];
            	$mobile_no    = $row["Contact_no"];
           	$lesson       = $row['Lesson_desc'];
           	$no_of_lesson = $row['No_of_lesson']; 
            	$status       = $row["Status"];
            	$date_started = $row['Date_started'];

            	$fullname 	= "$first_name $middle_name $last_name";
            	$the_lesson = "$lesson - $no_of_lesson Lessons";

            	$this->SetFont('Times','', 12);
          	$this->Cell(10, 10, $n++, 1, 0, 'C');
          	$this->Cell(60, 10, $fullname, 1, 0, 'C');
          	$this->Cell(60, 10, $address, 1, 0, 'C');
          	$this->Cell(50, 10, $mobile_no, 1, 0, 'C');
          	$this->Cell(50, 10, $the_lesson, 1, 0, 'C');
          	$this->Cell(40, 10, date('F d, Y', strtotime($date_started)), 1, 0, 'C');
          	$this->Ln();

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
  $pdf->studentTable($con);
  //$pdf->viewTable($con);
  $pdf->Output();

?>