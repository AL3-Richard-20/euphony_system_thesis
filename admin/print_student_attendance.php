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
    		$this->Cell(0,10, 'ATTENDANCE RECORD', 0, 0, 'C');
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

                    $lastname       = $row['Last_name'];
                    $firstname      = $row['First_name'];
                    $middlename     = $row['Middle_name'];

                    $fullname = "$firstname $middlename $lastname";

                    $this->SetFont('Times','B', 12);
                    $this->Cell(20, 5, 'Full Name: ', 0, 0, 'C');
                    $this->SetFont('Times','', 12);
                    $this->Cell(50, 5, $fullname, 0, 0, 'C');
                }

            }

            $query2 = "SELECT A.Stud_class_Id, A.Date_att, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
            $query2 .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
            $query2 .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
            $query2 .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
            $query2 .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
            $query2 .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
            $query2 .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
            $query2 .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
            $query2 .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND SC.User_Id = '{$user_id}' ";
            $query2 .="AND NOT A.Remarks = 'Excused'";

            $att_count = mysqli_query($con, $query2);

            $count_att = mysqli_num_rows($att_count);

            if($count_att != NULL){
                $this->SetFont('Times','B', 12);
                $this->Cell(30, 5, 'Lessons Taken: ', 0, 0, 'C');
                $this->SetFont('Times','', 12);
                $this->Cell(10, 5, $count_att, 0, 0, 'C');
            }
            else{
                $this->SetFont('Times','B', 12);
                $this->Cell(30, 5, 'Lessons Taken: ', 0, 0, 'C');
                $this->SetFont('Times','', 12);
                $this->Cell(10, 5, '0', 0, 0, 'C');
            }
            
            $this->SetFont('Times','', 12);
        	$this->Cell(270, 5, 'Date: '. date('F d, Y', strtotime("Today")), 0, 0, 'C');

            $this->Ln(10);

            //Table Header 
            $this->SetFont('Times','B', 12);
            $this->Cell(10, 10, 'NO.', 1, 0, 'C');
            $this->Cell(40, 10, 'DATE', 1, 0, 'C');
            $this->Cell(40, 10, 'TIME', 1, 0, 'C');
            $this->Cell(60, 10, 'LESSON', 1, 0, 'C');
            $this->Cell(60, 10, 'TEACHER', 1, 0, 'C');
            $this->Cell(60, 10, 'REMARKS', 1, 0, 'C');
            $this->Ln();
            //Table Header END
        }

        function attendanceTable($con){

        	if(isset($_GET['userid'])){

        		$user_id = $_GET['userid'];

        		$query = "SELECT A.Stud_class_Id, A.Date_att, A.Time_att, A.User_Id, A.Remarks, SC.Stud_class_Id,  ";
    			$query .="SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, ";
    			$query .="TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, T.T_Last_name, ";
    			$query .="T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, T.T_Age, T.T_Address, ";
    			$query .="T.T_Nationality, T.T_Contact_no, L.Lesson_Id, L.Lesson_desc, L.Amount, ";
    			$query .="L.No_of_lesson FROM attendance_tbl as A, stud_class_tbl as SC, class_tbl as C, ";
    			$query .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L WHERE SC.Stud_class_Id ";
    			$query .="= A.Stud_class_Id AND SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
    			$query .="TL.Lesson_Id = L.Lesson_Id AND TL.Tea_less_Id = C.Tea_less_Id AND SC.User_Id = '{$user_id}' ";
    			$query .="ORDER BY A.Date_att";

    			$query_stud_att = mysqli_query($con, $query);

    			$n = 1;

    			while($row = mysqli_fetch_assoc($query_stud_att)){

    				$date 			= $row['Date_att'];
                    $time_att       = $row['Time_att'];
    				$remarks 		= $row['Remarks'];
    				$lesson_desc 	= $row['Lesson_desc'];
    				$no_of_lesson 	= $row['No_of_lesson'];

    				$teacher_id 	= $row['Teacher_Id'];
      				$t_lastname 	= $row['T_Last_name'];
      				$t_firstname 	= $row['T_First_name'];
      				$t_middlename 	= $row['T_Middle_name'];

    				$the_lesson 	= "$lesson_desc - $no_of_lesson Lessons";
    				$the_teacher	= "$t_firstname $t_middlename $t_lastname";

    				$this->SetFont('Times','', 12);
    				$this->Cell(10, 10, $n++, 1, 0, 'C');
           	 		$this->Cell(40, 10, date('F d, Y', strtotime($date)), 1, 0, 'C');
                    $this->Cell(40, 10, date('h:i A', strtotime($time_att)), 1, 0, 'C');
            		$this->Cell(60, 10, $the_lesson, 1, 0, 'C');
            		$this->Cell(60, 10, $the_teacher, 1, 0, 'C');
            		$this->Cell(60, 10, $remarks, 1, 0, 'C');
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
    $pdf->attendanceTable($con);
    //$pdf->viewTable($con);
    $pdf->Output();

?>