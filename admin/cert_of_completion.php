<?php

require('../assets/fpdf/fpdf.php');

include "../includes/db.php";
include "../includes/functions.php";

class myPDF extends FPDF{

    function Header(){

        $this->Ln(30);
		$this->SetFont('Arial','B', 30);
        $this->Cell(0,5,'Certificate of Completion',0,0,'C');
        $this->Ln(10);
	        
    }


    function body($con){

        $this->Ln(10);
        $this->SetFont('Arial','', 17);
        $this->Cell(0,5,'This is awarded to',0,0,'C');
        $this->Ln(20);

        if(isset($_GET['studid']) && isset($_GET['gradid'])){

            $grad_Id = $_GET['gradid'];
            $the_stud_id = $_GET['studid'];

            $query = "SELECT selected_class_tbl.Lesson_Id, selected_class_tbl.Date_completed, user_info_tbl.Last_name, user_info_tbl.First_name, ";
            $query .="user_info_tbl.Middle_name, lessons_tbl.Lesson_desc, lessons_tbl.No_of_lesson ";
            $query .="FROM selected_class_tbl LEFT JOIN user_info_tbl ON selected_class_tbl.User_Id = ";
            $query .="user_info_tbl.User_Id LEFT JOIN lessons_tbl ON selected_class_tbl.Lesson_Id = ";
            $query .="lessons_tbl.Lesson_Id WHERE selected_class_tbl.User_Id = '$the_stud_id' AND selected_class_tbl.Selected_class_Id = '$grad_Id'";

            $query_info = mysqli_query($con, $query);

            confirmQuery($query_info);

            while($row = mysqli_fetch_assoc($query_info)){

                $last_name      = $row['Last_name'];
                $first_name     = $row['First_name'];
                $middle_name    = $row['Middle_name'];

                $fullname       = "$first_name $middle_name $last_name";

                $lesson_desc    = $row['Lesson_desc'];
                $no_of_lesson   = $row['No_of_lesson'];

                $date_completed = $row['Date_completed'];

                $the_lesson     = "$lesson_desc - $no_of_lesson Lessons";

                $this->SetFont('Arial','', 40);
                $this->Cell(0, 5, $fullname, 0,0, 'C');
                $this->Ln(15);
                $this->SetFont('Arial','', 17);
                $this->Cell(0, 5, 'for completing the', 0,0, 'C');
                $this->Ln(10);
                $this->Cell(0, 5, $the_lesson, 0,0, 'C');
                $this->Ln(10);
                
                if(isset($_GET['branchid'])){

                    $branch_id = $_GET['branchid'];
                    $_SESSION['branchid'] = $branch_id;

                    $query = "SELECT * FROM branches_tbl WHERE Branch_Id = '$branch_id'";
                    $query_branch = mysqli_query($con, $query);

                    while($row = mysqli_fetch_assoc($query_branch)){

                        $branch_desc        = $row['Branch_desc'];
                        $branch_location    = $row['Branch_location'];
                        $phone_no           = $row['Phone_no'];

                    }
                }

                $this->Cell(0,5, "@" . $branch_desc . " - " . $branch_location, 0, 0, 'C');
                $this->Ln(10);
                $this->Cell(0,5, date('F d, Y', strtotime($date_completed)), 0, 0, 'C');

            }
        }

    }


    function Footer(){
        $this->Ln(30);
        $this->SetFont('Times','', 17);
        $this->Cell(480, 10,'____________________', 0, 0, 'C');
        $this->Ln();
        $this->Cell(480, 10,'Erlinda M. Albay', 0, 0, 'C');
        $this->Ln(10);
        $this->SetFont('Times','', 17);
        $this->Cell(480, 10,'General Manager', 0, 0, 'C');
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}', 0, 0, 'C');

    }
    

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->body($con);
$pdf->Output();

?>