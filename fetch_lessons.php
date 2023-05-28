<?php

	include "includes/db.php";
	include "includes/functions.php";

	$limit = 10;

	$page = 1;

	if($_POST['page'] > 1){

		$start 	= (($_POST['page'] - 1) * $limit);
		$page 	= $_POST['page']; 
	}
	else{
		$start = 0;
	}

	$query ="SELECT * FROM lessons_tbl ";

	if($_POST['query'] != '' && $_POST['query1'] != ''){

		$filter_session = $_POST['query1'];

		$query .='WHERE Lesson_desc LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';

		$query .='AND No_of_lesson = '.$filter_session.' ';
	}

	else if($_POST['query'] != '' && $_POST['query1'] == NULL){

		$query .='WHERE Lesson_desc LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
	}

	else if($_POST['query1'] != '' && $_POST['query'] == NULL){

		$filter_session = $_POST['query1'];

		$query .='WHERE No_of_lesson = '.$filter_session.' ';
	}

	
	$query .= 'ORDER BY Lesson_Id DESC ';

	$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

	$query_all = mysqli_query($con, $query);

	confirmQuery($query_all);

	$total_data = mysqli_num_rows($query_all);

	$query_all = mysqli_query($con, $filter_query);

	confirmQuery($query_all);

	$output ='<div class="col-sm-12">';
	$output .='<p>Total records - <b>'.$total_data.'</b></p><br>';
	$output .='</div>';

	if($total_data > 0){ 

		while($row = mysqli_fetch_assoc($query_all)){
			
			$lesson_Id      = $row['Lesson_Id'];
            $lesson_desc    = $row['Lesson_desc'];
            $lesson_amount  = $row['Amount'];
            $no_of_lesson   = $row['No_of_lesson'];
            $icon           = $row['Icon'];
            $cover_image    = $row['Cover_image'];
            $content 		= $row['Content'];

            $the_lesson = "$lesson_desc - $no_of_lesson Lessons";

			$output .='<div class="col-sm-6">';
		    $output .='<div class="panel panel-default">';
		    $output .='<div class="panel-body">';
		    $output .='<div class="col-sm-5">';
		    $output .='<br><img src="images/lessons/Cover/'.$cover_image.'" class="img-responsive">';
		    $output .='</div>';
		    $output .='<div class="col-sm-6">';
		    $output .='<br><p class="ellip"><b><a href="lesson_info.php?lessonid='.$lesson_Id.'">'.substr($the_lesson, 0,30).'</a></b></p>';

		    $output .='<table class="table">';
		    $output .='<tbody>';
		    $output .='<tr>';
		    $output .='<td>';
		    $output .='<p>Sessions:</p>';
		    $output .='<td>';
		    $output .='<td>';
		    $output .='<b>'.$no_of_lesson.'</b>';
		    $output .='</td>';
		    $output .='</tr>';

		    $output .='<tr>';
		    $output .='<td>';
		    $output .='<p>Price: </p>';
		    $output .='<td>';
		    $output .='<td>';
		    $output .='<b style="color: green">'.number_format($lesson_amount,2).' PHP</b>';
		    $output .='</td>';
		    $output .='</tr>';

		    $output .='<tr>';
		    $output .='<td>';
		    $output .='<p>Rating: </p>';
		    $output .='<td>';
		    $output .='<td>';
		    $output .='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
		    $output .='</td>';
		    $output .='</tr>';

		    $output .='</tbody>';
		    $output .='</table>';


		    $output .='</div>';
		    $output .='</div>';
		    $output .='</div>';
		    $output .='</div>';

		}

		$output .='<div class="row">';
		$output .='<div align="center">';
		$output .='<ul class="pagination">';

		$total_links = ceil($total_data/$limit);

		$previous_link = '';

		$next_link = '';

		$page_link = '';

		if($total_links > 6){

			if($page < 5){

				for($count = 1; $count <= 5; $count++){

					$page_array[] = $count;
				}

				$page_array[] = '...';
				$page_array[] = $total_links;
			}

			else{

				$end_limit = $total_links - 5;

				if($page > $end_limit){

					$page_array[] = 1;
					$page_array[] = '...';

					for($count = $end_limit; $count <= $total_links; $count++){

						$page_array[] = $count;
					}
				}

				else{

					$page_array[] = 1;
					$page_array[] = '...';

					for($count = $page - 1; $count <= $page + 1; $count++){

						$page_array[] = $count;
					}

					$page_array[] = '...';
					$page_array[] = $total_links;
				}
			}

		}

		else{

			for($count = 1; $count <= $total_links; $count++){

				$page_array[] = $count;

			}

		}

		for($count = 0; $count < count($page_array); $count++){

			if($page == $page_array[$count]){

				$page_link .='<li class="page-item active">';
				$page_link .='<a class="page-link" href="#">'.$page_array[$count].' ';
				$page_link .='<span class="sr-only">(current)</span></a></li>';

				$previous_id = $page_array[$count] - 1;

				if($previous_id > 0){

					$previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
				}

				else{

					$previous_link = '<li class="page-item disabled_input disabled">';
					$previous_link .='<a class="page-link" href="#">Previous</a></li>';
				}

				$next_id = $page_array[$count] + 1;

				if($next_id >= $total_links){

					$next_link = '<li class="page-item disabled_input disabled">';
					$next_link .='<a class="page-link" href="#">Next</a></li>';
				}

				else{

					$next_link = '<li class="page-item"><a class="page-link" data-page_number="'.$next_id.'">Next</a></li>';
				}

			}

			else{

				if($page_array[$count] == '...'){

					$page_link .='<li class="page-item disabled_input disabled ">';
					$page_link .='<a class="page-link" href="#">...</a></li>';
					
				}

				else{

					$page_link.='<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>';
				}
			}
		}

		$output .=$previous_link . $page_link . $next_link;

		$output .='</ul>';	
	    $output .='</div>';
	    $output .='</div>';

	}

	else{
		 $output .='<h3>No Data Found</h3>';
	}

	
	echo $output;
?>