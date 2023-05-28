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
		        $this->SetFont('Times','', 13);
		        $this->Cell(0,5,'Attendance Record as of', 0, 0, 'C');
		        $this->Ln();

		        if(isset($_GET['date'])){

		        	$the_date  = $_GET['date'];

		        	if($the_date == 'Today'){
		        		$this->SetFont('Times','B', 12);
		        		$this->Cell(0,10, date("F d, Y", strtotime("Today")), 0, 0, 'C');
		        		$this->Ln(15);
		        	}
		        	else{
		        		$this->SetFont('Times','B', 12);
		        		$this->Cell(0,10, date('F d, Y', strtotime($the_date)), 0, 0, 'C');
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







    function presentStudents(){

        $this->SetFont('Times','B', 14);
        $this->Cell(0, 10,'PRESENT STUDENTS', 0, 0, 'C');
        $this->Ln(15);

        //Table Header 
        $this->SetFont('Times','B', 12);
        $this->Cell(10, 10, 'NO.', 1, 0, 'C');
        $this->Cell(60, 10, 'TIME', 1, 0, 'C');
        $this->Cell(70, 10, 'STUDENT', 1, 0, 'C');
        $this->Cell(60, 10, 'LESSON', 1, 0, 'C');
        $this->Cell(70, 10, 'TEACHER', 1, 0, 'C');
        $this->Ln();
        //Table Header END
    }

    function presentStudentsTable($con){

    	$branch_id = $_SESSION['branchid'];

    	if(isset($_GET['date'])){

		    $the_date  = $_GET['date'];

		    if($the_date == 'Today'){

		    	$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
				$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
				$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
				$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
				$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
				$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
				$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
				$query .="user_info_tbl as U, ";
				$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
				$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
				$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND A.Remarks = 'Present' ";
				$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = curdate() ";
				$query .="ORDER BY A.Time_att";
			}

			else{

				$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
				$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
				$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
				$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
				$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
				$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
				$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
				$query .="user_info_tbl as U, ";
				$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
				$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
				$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND A.Remarks = 'Present' ";
				$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = '$the_date' ";
				$query .="ORDER BY A.Time_att";
			}

		}

    	$query_all_present = mysqli_query($con, $query);

    	$count_records = mysqli_num_rows($query_all_present);

    	if($count_records == NULL){

        	$this->Cell(270, 10, 'None', 1, 0, 'C');

        }

        else{

	    	$n = 1;

	    	while($row = mysqli_fetch_assoc($query_all_present)){
				
				$stud_firstname 	= $row['First_name'];
				$stud_middlename 	= $row['Middle_name'];
				$stud_lastname 		= $row['Last_name'];

				$the_student 		= "$stud_lastname, $stud_firstname $stud_middlename";

				$lesson_desc 		= $row['Lesson_desc'];
				$lesson_no 			= $row['No_of_lesson'];
				$the_lesson 		= "$lesson_desc - $lesson_no Lessons";

				$t_lastname 		= $row['T_Last_name'];
				$t_first_name 		= $row['T_First_name'];
				$t_middlename 		= $row['T_Middle_name'];
				$the_teacher 		= "$t_first_name $t_middlename $t_lastname";

				$time_att 			= $row['Time_att'];

	    		$remarks 			= $row['Remarks'];

	    		$this->SetFont('Times','', 12);
	    		$this->Cell(10, 10, $n++, 1, 0, 'C');
	    		$this->Cell(60, 10, date('h:i A', strtotime($time_att)), 1, 0, 'C');
		        $this->Cell(70, 10, $the_student, 1, 0, 'C');
		        $this->Cell(60, 10, $the_lesson, 1, 0, 'C');
		        $this->Cell(70, 10, $the_teacher, 1, 0, 'C');
		        $this->Ln();
		    }
		}
    }






    function absentStudents(){

        $this->Ln();
        $this->SetFont('Times','B', 14);
        $this->Cell(0, 10,'ABSENT STUDENTS', 0, 0, 'C');
        $this->Ln(15);

        //Table Header 
        $this->SetFont('Times','B', 12);
        $this->Cell(10, 10, 'NO.', 1, 0, 'C');
        $this->Cell(60, 10, 'TIME', 1, 0, 'C');
        $this->Cell(70, 10, 'STUDENT', 1, 0, 'C');
        $this->Cell(60, 10, 'LESSON', 1, 0, 'C');
        $this->Cell(70, 10, 'TEACHER', 1, 0, 'C');
        $this->Ln();
        //Table Header END
    }

    function forfeitedStudentsTable($con){

    	$branch_id = $_SESSION['branchid'];

		if(isset($_GET['date'])){

		    $the_date  = $_GET['date'];

			if($the_date == 'Today'){

		    	$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
				$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
				$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
				$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
				$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
				$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
				$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
				$query .="user_info_tbl as U, ";
				$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
				$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
				$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND A.Remarks = 'Forfeited' ";
				$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = curdate() ";
				$query .="ORDER BY A.Time_att";
			}

			else{

				$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
				$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
				$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
				$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
				$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
				$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
				$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
				$query .="user_info_tbl as U, ";
				$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
				$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
				$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND A.Remarks = 'Forfeited' ";
				$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = '$the_date' ";
				$query .="ORDER BY A.Time_att";
			}
		}

    	$query_all_absent = mysqli_query($con, $query);

    	$count_records = mysqli_num_rows($query_all_absent);

    	if($count_records == NULL){

        	$this->Cell(270, 10, 'None', 1, 0, 'C');

        }
        
        else{

	    	$n = 1;

	    	while($row = mysqli_fetch_assoc($query_all_absent)){
				
				$stud_firstname 	= $row['First_name'];
				$stud_middlename 	= $row['Middle_name'];
				$stud_lastname 		= $row['Last_name'];

				$the_student 		= "$stud_lastname, $stud_firstname $stud_middlename";

				$lesson_desc 		= $row['Lesson_desc'];
				$lesson_no 			= $row['No_of_lesson'];
				$the_lesson 		= "$lesson_desc - $lesson_no Lessons";

				$t_lastname 		= $row['T_Last_name'];
				$t_first_name 		= $row['T_First_name'];
				$t_middlename 		= $row['T_Middle_name'];
				$the_teacher 		= "$t_first_name $t_middlename $t_lastname";

				$time_att 			= $row['Time_att'];

	    		$remarks 			= $row['Remarks'];

	    		$this->SetFont('Times','', 12);
	    		$this->Cell(10, 10, $n++, 1, 0, 'C');
	    		$this->Cell(60, 10, date('h:i A', strtotime($time_att)), 1, 0, 'C');
		        $this->Cell(70, 10, $the_student, 1, 0, 'C');
		        $this->Cell(60, 10, $the_lesson, 1, 0, 'C');
		        $this->Cell(70, 10, $the_teacher, 1, 0, 'C');
		        $this->Ln();
		    }
		}
    }







    function excusedStudents(){

        $this->Ln();
        $this->SetFont('Times','B', 14);
        $this->Cell(0, 10,'EXCUSED STUDENTS', 0, 0, 'C');
        $this->Ln(15);

        //Table Header 
        $this->SetFont('Times','B', 12);
        $this->Cell(10, 10, 'NO.', 1, 0, 'C');
        $this->Cell(60, 10, 'TIME', 1, 0, 'C');
        $this->Cell(70, 10, 'STUDENT', 1, 0, 'C');
        $this->Cell(60, 10, 'LESSON', 1, 0, 'C');
        $this->Cell(70, 10, 'TEACHER', 1, 0, 'C');
        $this->Ln();
        //Table Header END
    }

    function excusedStudentsTable($con){

    	$branch_id = $_SESSION['branchid'];

    	if(isset($_GET['date'])){

		    $the_date  = $_GET['date'];

			if($the_date == 'Today'){

		    	$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
				$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
				$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
				$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
				$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
				$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
				$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
				$query .="user_info_tbl as U, ";
				$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
				$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
				$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND A.Remarks = 'Excused' ";
				$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = curdate() ";
				$query .="ORDER BY A.Time_att";
			}

			else{

				$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.Att_Id, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
				$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
				$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
				$query .="U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Branch_Id, ";
				$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
				$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
				$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
				$query .="user_info_tbl as U, ";
				$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
				$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
				$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND A.Remarks = 'Excused' ";
				$query .="AND U.Branch_Id = '$branch_id' AND SC.User_Id = U.User_Id AND Date_att = '$the_date' ";
				$query .="ORDER BY A.Time_att";
			}

		}

    	$query_all_excused = mysqli_query($con, $query);

    	$count_records = mysqli_num_rows($query_all_excused);

    	if($count_records == NULL){

        	$this->Cell(270, 10, 'None', 1, 0, 'C');

        }
        
        else{

	    	$n = 1;

	    	while($row = mysqli_fetch_assoc($query_all_excused)){
				
				$stud_firstname 	= $row['First_name'];
				$stud_middlename 	= $row['Middle_name'];
				$stud_lastname 		= $row['Last_name'];

				$the_student 		= "$stud_lastname, $stud_firstname $stud_middlename";

				$lesson_desc 		= $row['Lesson_desc'];
				$lesson_no 			= $row['No_of_lesson'];
				$the_lesson 		= "$lesson_desc - $lesson_no Lessons";

				$t_lastname 		= $row['T_Last_name'];
				$t_first_name 		= $row['T_First_name'];
				$t_middlename 		= $row['T_Middle_name'];
				$the_teacher 		= "$t_first_name $t_middlename $t_lastname";

				$time_att 			= $row['Time_att'];

	    		$remarks 			= $row['Remarks'];

	    		$this->SetFont('Times','', 12);
	    		$this->Cell(10, 10, $n++, 1, 0, 'C');
	    		$this->Cell(60, 10, date('h:i A', strtotime($time_att)), 1, 0, 'C');
		        $this->Cell(70, 10, $the_student, 1, 0, 'C');
		        $this->Cell(60, 10, $the_lesson, 1, 0, 'C');
		        $this->Cell(70, 10, $the_teacher, 1, 0, 'C');
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
$pdf->presentStudents();
$pdf->presentStudentsTable($con);
$pdf->absentStudents();
$pdf->forfeitedStudentsTable($con);
$pdf->excusedStudents();
$pdf->excusedStudentsTable($con);
//$pdf->viewTable($con);
$pdf->Output();

?>