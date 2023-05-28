<?php

    require('../assets/fpdf/fpdf.php');

    include "../includes/db.php";
    include "../includes/functions.php";

    class myPDF extends FPDF{



        function Header(){

    		$this->SetFont('Arial','B', 14);
            $this->Cell(250,5,'EUPHONY MUSIC CENTER',0,0,'C');
            $this->Ln();
    	        
        }



        function Branch($con){

        	if(isset($_GET['transid'])){

        		$trans_id = $_GET['transid'];

        		$query = "SELECT * FROM stud_balances WHERE Transaction_Id = '$trans_id' ";
        		$query_trans = mysqli_query($con, $query);

        		while($row = mysqli_fetch_assoc($query_trans)){

                    $stud_Id        = escape($row['User_Id']);
        			$trans_date 	= escape($row['Date']);
        			$the_balance 	= escape($row['The_balance']);
                    $discount       = escape($row['Discount']);
                    $cash           = escape($row['Cash_tendered']);

        			$this->SetFont('Times','', 9);
    				$this->Cell(290,30, date('M d, Y', strtotime($trans_date)), 0, 0, 'C');
    				$this->Ln(5);
    				$this->Cell(170,30, number_format($cash,2), 0, 0, 'C');
    				$this->Ln(5);
                    $this->Ln(5);
    				$this->Cell(170,30, $discount . " %", 0, 0, 'C');
    				$this->Ln(5);
    				$this->Cell(170,30, number_format($cash,2), 0, 0, 'C');
    				$this->Ln(5);
    				// $this->Cell(204,30, , 0, 0, 'C');
    				$this->Ln(5);
    				$this->Cell(290,30, number_format($the_balance,2). ' PHP', 0, 0, 'C');
                    
        		}

        		if($query_trans == TRUE){

        			$query2 = "SELECT SC.Stud_class_Id, SC.Class_Id, SC.User_Id, C.Class_Id, C.Tea_less_Id, ";
                    $query2 .="C.Day, C.Time, C.Status, TL.Tea_less_Id, TL.Teacher_Id, TL.Lesson_Id, T.Teacher_Id, ";
                    $query2 .="L.Lesson_Id, L.Lesson_desc, L.Amount, ";
                    $query2 .="L.No_of_lesson FROM stud_class_tbl as SC, class_tbl as C, ";
                    $query2 .="teacher_lesson_tbl as TL, teacher_tbl as T, lessons_tbl as L ";
                    $query2 .="WHERE SC.Class_Id = C.Class_Id AND TL.Teacher_Id = T.Teacher_Id AND ";
                    $query2 .="TL.Lesson_Id = L.Lesson_Id AND C.Tea_less_Id = TL.Tea_less_Id AND ";
                    $query2 .="SC.User_Id = '{$stud_Id}' AND SC.randSalt2 = 1 ";

                    $query_class = mysqli_query($con, $query2);

        			while($row2 = mysqli_fetch_assoc($query_class)){

                        $lesson_desc    = $row2['Lesson_desc'];
                        $lesson_amount  = number_format($row2['Amount'],2);
                        $no_of_lesson   = $row2['No_of_lesson'];

                        $the_lesson     = "$lesson_desc - $no_of_lesson Lessons / Price: $lesson_amount PHP";

                        $this->Ln(5);
                        $this->Cell(250,30, $the_lesson, 0, 0, 'C');
        			}
        			
        		}
        	}

        }

        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}', 0, 0, 'C');

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
    $pdf->AddPage('P', 'A4', 0);
    $pdf->Branch($con);
    //$pdf->viewTable($con);
    $pdf->Output();

?>