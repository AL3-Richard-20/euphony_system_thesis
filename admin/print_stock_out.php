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
    		$this->Cell(0,10, 'Stock out products as of', 0, 0, 'C');
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
            $this->Cell(60, 10, 'CUSTOMER', 1, 0, 'C');
            $this->Cell(60, 10, 'PRODUCT', 1, 0, 'C');
            $this->Cell(60, 10, 'BRAND', 1, 0, 'C');
            $this->Cell(50, 10, 'PRICE', 1, 0, 'C');
            $this->Cell(30, 10, 'QUANTITY', 1, 0, 'C');
            $this->Ln();
            //Table Header END
        }

        function stockOutTable($con){

            $branch_id = $_SESSION['branchid'];

            if(isset($_GET['date'])){

                $the_date  = $_GET['date'];

                if($the_date == 'Today'){

                    $query = "SELECT sales_tbl.Sold_to, sales_detail.Prod_Id, ";
    				$query .="sales_detail.Price, sales_detail.Quantity, ";
    				$query .="products_tbl.Prod_name, products_tbl.Prod_brand ";
    				$query .="FROM sales_tbl LEFT JOIN sales_detail ON ";
    				$query .="sales_tbl.Sales_Id = sales_detail.Sales_Id ";
    				$query .="LEFT JOIN products_tbl ON sales_detail.Prod_Id ";
    				$query .="= products_tbl.Prod_Id WHERE sales_tbl.Branch_Id ";
    				$query .="= '$branch_id' AND Date = curdate() ";
                }
                else{

                	$query = "SELECT sales_tbl.Sold_to, sales_detail.Prod_Id, ";
    				$query .="sales_detail.Price, sales_detail.Quantity, ";
    				$query .="products_tbl.Prod_name, products_tbl.Prod_brand ";
    				$query .="FROM sales_tbl LEFT JOIN sales_detail ON ";
    				$query .="sales_tbl.Sales_Id = sales_detail.Sales_Id ";
    				$query .="LEFT JOIN products_tbl ON sales_detail.Prod_Id ";
    				$query .="= products_tbl.Prod_Id WHERE sales_tbl.Branch_Id ";
    				$query .="= '$branch_id' AND Date = '{$the_date}' ";
                }
            }

            $query_stock_out = mysqli_query($con, $query);

            $n = 1;

            while($row = mysqli_fetch_array($query_stock_out)){

                $prod_Id      	= escape($row["Prod_Id"]);
              	$prod_name    	= escape($row["Prod_name"]);
              	$prod_brand   	= escape($row["Prod_brand"]);
              	$price 			= escape($row['Price']);
              	$quantity 		= escape($row['Quantity']);
              	$customer 		= escape($row['Sold_to']);

              	$this->SetFont('Times','', 12);
    	        $this->Cell(10, 10, $n++, 1, 0, 'C');
    	        $this->Cell(60, 10, $customer, 1, 0, 'C');
    	        $this->Cell(60, 10, $prod_name, 1, 0, 'C');
    	        $this->Cell(60, 10, $prod_brand, 1, 0, 'C');
    	        $this->Cell(50, 10, number_format($price,2) . " PHP", 1, 0, 'C');
    	        $this->Cell(30, 10, $quantity, 1, 0, 'C');
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
    $pdf->stockOutTable($con);
    $pdf->signature();
    $pdf->Output();

?>