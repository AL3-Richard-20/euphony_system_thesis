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

      	$this->SetFont('Times','B', 12);
          $this->Cell(0, 10, 'SLOW MOVING PRODUCTS', 0, 0, 'C');
          $this->Ln(15);

          $this->SetFont('Times','', 12);
          $this->Cell(480, 10, 'Date: ' . date('F d, Y', strtotime("Today")), 0, 0, 'C');
          $this->Ln(15);

          //Table Header 
          $this->SetFont('Times','B', 12);
          $this->Cell(10, 10, 'NO.', 1, 0, 'C');
          $this->Cell(70, 10, 'PRODUCT', 1, 0, 'C');
          $this->Cell(60, 10, 'BRAND', 1, 0, 'C');
          $this->Cell(50, 10, 'PRICE', 1, 0, 'C');
          $this->Cell(50, 10, 'STATUS', 1, 0, 'C');
          $this->Cell(30, 10, 'ORDERS', 1, 0, 'C');
          $this->Ln();
          //Table Header END
      }

      function slowMovingProducts($con){

      	$the_branch_Id = $_SESSION['branchid'];

      	$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
    		$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
    		$query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level FROM products_tbl as P, ";
    		$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id ";
    		$query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
    		$query .= "and PI.Branch_Id = '$the_branch_Id' ORDER BY P.Prod_Id ASC";

  		  $query_slow_moving = mysqli_query($con, $query);

  		  $n = 1;

  		  while($row = mysqli_fetch_assoc($query_slow_moving)){

  			  $prod_Id 		     = $row["Prod_Id"];
        	$prod_name 		   = $row["Prod_name"];
        	$prod_brand 	   = $row["Prod_brand"];
        	$prod_price 	   = $row["Prod_price"];
        	$prod_desc 		   = $row["Prod_desc"];
        	$prod_status 	   = $row["Status"];
        	$prod_image 	   = $row["Prod_image"];
        	$prod_quantity 	 = $row['Quantity'];
        	$prod_cat_id 	   = $row['Category_Id'];
        	$prod_category 	 = $row['Category_title'];

        	$query2 = "SELECT SUM(Quantity) as TotalOrders ";
        	$query2 .="FROM sales_detail WHERE Prod_Id = '$prod_Id' ";
        	$query_orders = mysqli_query($con, $query2);

          confirmQuery($query_orders);

        	while($row = mysqli_fetch_assoc($query_orders)){
        		
        		$total_orders = $row['TotalOrders'];
        	}

          $query2 = "SELECT * FROM product_settings ";
          $query2 .="WHERE Prod_sett_Id = 2";
          $query_prod_settings = mysqli_query($con, $query2);

          while($row2 = mysqli_fetch_assoc($query_prod_settings)){
            $number = escape($row2['Number']);
          }

          if($total_orders < $number){

            $this->SetFont('Times','', 12);
            $this->Cell(10, 10, $n++, 1, 0, 'C');
            $this->Cell(70, 10, $prod_name , 1, 0, 'C');
            $this->Cell(60, 10, $prod_brand, 1, 0, 'C');
            $this->Cell(50, 10, number_format($prod_price,2) . " PHP", 1, 0, 'C');
            $this->Cell(50, 10, $prod_status, 1, 0, 'C');
          
            if($total_orders == NULL){
              $this->Cell(30, 10, '0', 1, 0, 'C');
              $this->Ln();
            }
            else{
              $this->Cell(30, 10, $total_orders, 1, 0, 'C');
              $this->Ln();
            }
                  
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
  $pdf->tableHeader($con);
  $pdf->slowMovingProducts($con);
  $pdf->signature();
  $pdf->Output();

?>