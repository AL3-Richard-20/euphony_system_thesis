<?php

//fetch_data.php

include "includes/db.php";
include "includes/functions.php";

if(isset($_POST["action"])){

 	$query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
	$query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
	$query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level FROM products_tbl as P, ";
	$query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id and P.Status_2 = 1 ";
	$query .= "and PI.Branch_Id = B.Branch_Id and P.Category_Id = C.Category_Id ";

	if(isset($_POST['all'])){

	}
	
	else{

		if(isset($_POST['category'])){

			$the_category 	= $_POST["category"];

			if($the_category != 'All'){
				
				$query .="and P.Category_Id ='".$the_category."' ";
			}
		}

		if(isset($_POST['branch'])){

			$the_branch 	= $_POST["branch"];

			if($the_branch != 'All'){

				$query .= "and PI.Branch_Id ='".$the_branch."' ";
			}
		}

		if(isset($_POST['search'])){

			$search 	= $_POST["search"];
			$query .= "and Prod_name LIKE '%".str_replace(' ', '%', $search)."%' ";
		}
	}

	
 	$query_product = mysqli_query($con, $query);

 	confirmQuery($query_product);

 	$total_row = mysqli_num_rows($query_product);

 	$output = '';

 	if($total_row > 0){

  		foreach($query_product as $row){

		   	$output .= "<div class='col-sm-3'>";	
		   	$output .= "<div class='panel panel-default text-center'>";
			$output .= "<div class='panel-body'>";
  			$output .= "<center><img src = 'images/products/".$row['Prod_image']."' class = 'img-responsive' id = 'sampleSize'></center>";
  			$output .= "<p>" .number_format($row['Prod_price'],2)." PHP</p>";
			$output .= "</div>";
			$output .= "<div class='panel-footer'>";
			$output .= "<center><strong><a href='product_details.php?prodid=".$row['Prod_Id']."'><p class='ellip'>".$row['Prod_name']."</p></a></strong></center>";
			$output .= "<center><p><em>".$row['Status']."</em></p><center>";
			$output .= "</div>";
			$output .= "</div>";
		   	$output .= '</div>';

		}
 	}

	else{

	  	$output = '<center><h3>No results found</h3></center>';

	}

 	echo $output;

	}

?>