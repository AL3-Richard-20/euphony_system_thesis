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

        	if(isset($_GET['salesid'])){

        		$sales_id = $_GET['salesid'];

        		$query = "SELECT * FROM sales_tbl WHERE Sales_Id = '$sales_id' ";
        		$query_trans = mysqli_query($con, $query);

        		while($row = mysqli_fetch_assoc($query_trans)){

        			$trans_date 	= escape($row['Date']);
        			$total 			= escape($row['Total']);

        			$this->SetFont('Times','', 9);
    				$this->Cell(290,30, date('M d, Y', strtotime($trans_date)), 0, 0, 'C');
    				$this->Ln(5);
    				$this->Cell(150,30, '', 0, 0, 'C');
    				$this->Ln(5);
    				$this->Cell(150,30, '', 0, 0, 'C');
    				$this->Ln(5);
    				$this->Cell(150,30, '', 0, 0, 'C');
    				$this->Ln(5);
    				$this->Cell(150,30, 'the sum of:', 0, 0, 'C');
    				$this->Ln(5);
    				$this->Cell(290,30, number_format($total,2). " PHP", 0, 0, 'C');

        		}

        		if($query_trans == TRUE){

        			$query2 = "SELECT sales_detail.Prod_Id, sales_detail.Price, ";
                    $query2 .="sales_detail.Quantity, products_tbl.Prod_name ";
                    $query2 .="FROM sales_detail LEFT JOIN products_tbl ";
                    $query2 .="ON sales_detail.Prod_Id = products_tbl.Prod_Id WHERE ";
                    $query2 .="sales_detail.Sales_Id = '$sales_id' ";
        			$query_all_items = mysqli_query($con, $query2);

        			while($row2 = mysqli_fetch_assoc($query_all_items)){

                        $order_prod_name  = $row2['Prod_name'];
                        $order_quantity   = $row2['Quantity'];

               			$this->Ln(5);
    					$this->Cell(204,30, $order_quantity. " " .$order_prod_name. ",", 0, 0, 'C');
    					

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