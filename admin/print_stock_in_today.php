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

        	$this->SetFont('Times','', 13);
    		$this->Cell(0,10, 'Stock in products as of', 0, 0, 'C');
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
                    $this->Cell(0,10, date("F d, Y", strtotime($the_date)), 0, 0, 'C');
                    $this->Ln(15);
                }
            }

            //Table Header 
            $this->SetFont('Times','B', 12);
            $this->Cell(10, 10, 'NO.', 1, 0, 'C');
            $this->Cell(40, 10, 'TIME', 1, 0, 'C');
            $this->Cell(70, 10, 'PRODUCT', 1, 0, 'C');
            $this->Cell(50, 10, 'BRAND', 1, 0, 'C');
            $this->Cell(40, 10, 'PRICE', 1, 0, 'C');
            $this->Cell(30, 10, 'STOCK IN', 1, 0, 'C');
            $this->Cell(30, 10, 'STOCKS', 1, 0, 'C');
            $this->Ln();
            //Table Header END
        }

        function attendanceTable($con){

            $branch_id = $_SESSION['branchid'];

            if(isset($_GET['date'])){

                $the_date  = $_GET['date'];

                if($the_date == 'Today'){

                    $query = "SELECT stock_in.Prod_Id, stock_in.Date, stock_in.Time, ";
                    $query .="stock_in.Quantity_In, products_tbl.Prod_Id, products_tbl.Prod_name, products_tbl.Prod_price, ";
                    $query .="products_tbl.Prod_brand, prod_invt_tbl.Quantity FROM stock_in ";
                    $query .="LEFT JOIN products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id WHERE prod_invt_tbl.Branch_Id = '{$branch_id}' AND stock_in.Date = curdate()";
                }
                else{

                	$query = "SELECT stock_in.Prod_Id, stock_in.Date, stock_in.Time, ";
                    $query .="stock_in.Quantity_In, products_tbl.Prod_Id, products_tbl.Prod_name, products_tbl.Prod_price, ";
                    $query .="products_tbl.Prod_brand, prod_invt_tbl.Quantity FROM stock_in ";
                    $query .="LEFT JOIN products_tbl ON stock_in.Prod_Id = products_tbl.Prod_Id LEFT JOIN prod_invt_tbl ON products_tbl.Prod_Id = prod_invt_tbl.Prod_Id WHERE prod_invt_tbl.Branch_Id = '{$branch_id}' AND stock_in.Date = '$the_date' ";
                }
            }

            $query_stock_in = mysqli_query($con, $query);

            $n = 1;

            while($row = mysqli_fetch_array($query_stock_in)){

                $prod_Id        = escape($row["Prod_Id"]);
                $prod_name      = escape($row["Prod_name"]);
                $prod_brand     = escape($row["Prod_brand"]);
                $prod_price     = escape($row['Prod_price']);
                $prod_quantity  = escape($row['Quantity']);
                $time_in        = escape($row['Time']);
                $quantity_in    = escape($row['Quantity_In']);

                $this->SetFont('Times','', 12);
                $this->Cell(10, 10, $n++, 1, 0, 'C');
                $this->Cell(40, 10, date('h:i A', strtotime($time_in)), 1, 0, 'C');
                $this->Cell(70, 10, $prod_name, 1, 0, 'C');
                $this->Cell(50, 10, $prod_brand, 1, 0, 'C');
                $this->Cell(40, 10, number_format($prod_price,2) . " PHP", 1, 0, 'C');
                $this->Cell(30, 10, $quantity_in, 1, 0, 'C');
                $this->Cell(30, 10, $prod_quantity, 1, 0, 'C');
                $this->Ln();

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
    $pdf->tableHeader($con);
    $pdf->attendanceTable($con);
    $pdf->signature();
    $pdf->Output();

?>