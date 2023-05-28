<?php
	
	session_start();
	include "../includes/db.php";
	include "includes/functions.php";
	include "includes/session.php";

	if($_POST['action'] == 'profile_img'){

		if(isset($_POST['image']) && isset($_POST['userid'])){

			$the_user_Id 	= $_POST['userid'];
			$data 			= $_POST['image'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/profile_img/'.$imageName, $data);

			$query = "UPDATE user_info_tbl SET Profile_img = '$imageName' ";
			$query .="WHERE User_Id = '$the_user_Id' ";

			$update_profile_img = mysqli_query($con, $query);

			confirmQuery($update_profile_img);

			if($update_profile_img == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['2']);
			}
		}

		else{

			echo json_encode(['3']);
		}

	}



	if($_POST['action'] == 'admin_profile_img'){

		if(isset($_POST['image']) && isset($_POST['adminuserid'])){

			$admin_user_Id 	= $_POST['adminuserid'];
			$data 			= $_POST['image'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/profile_img/'.$imageName, $data);

			$query = "UPDATE user_info_tbl SET Profile_img = '$imageName' ";
			$query .="WHERE User_Id = '$admin_user_Id' ";

			$update_profile_img = mysqli_query($con, $query);

			confirmQuery($update_profile_img);

			if($update_profile_img == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['2']);
			}
		}

		else{

			echo json_encode(['3']);
		}

	}


	if($_POST['action'] == 'about_img'){

		if(isset($_POST['image'])){

			$data = $_POST['image'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/about/'.$imageName, $data);

			$query = "UPDATE about_us_tbl SET Image = '$imageName' ";
			$query .="WHERE Id = 1 ";

			$update_about_img = mysqli_query($con, $query);

			confirmQuery($update_about_img);

			if($update_about_img == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['2']);
			}
		}

		else{

			echo json_encode(['3']);
		}

	}



	if($_POST['action'] == 'branch_image'){

		if(isset($_POST['image']) && isset($_POST['lastid'])){

			$data   	= $_POST['image'];
			$last_id 	= $_POST['lastid'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/branches/'.$imageName, $data);

			$query = "UPDATE branches_tbl SET Branch_image = '$imageName' ";
			$query .="WHERE Branch_Id = '$last_id' ";

			$update_branch_img = mysqli_query($con, $query);

			confirmQuery($update_branch_img);

			if($update_branch_img == 1){

				echo json_encode(['add_contact_image.php?branchid='.$last_id.'&branchimg=']);
			}

			else{
				echo json_encode(['Item has been missing']);
			}
		}

		else{

			echo json_encode(['Item has been missing']);
		}

	}

	if($_POST['action'] == 'edit_branch_image'){

		if(isset($_POST['image']) && isset($_POST['lastid'])){

			$data   	= $_POST['image'];
			$last_id 	= $_POST['lastid'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/branches/'.$imageName, $data);

			$query = "UPDATE branches_tbl SET Branch_image = '$imageName' ";
			$query .="WHERE Branch_Id = '$last_id' ";

			$update_branch_img = mysqli_query($con, $query);

			confirmQuery($update_branch_img);

			if($update_branch_img == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['Item has been missing']);
			}
		}

		else{

			echo json_encode(['Item has been missing']);
		}

	}



	if($_POST['action'] == 'contact_image'){

		if(isset($_POST['image']) && isset($_POST['lastid'])){

			$data   	= $_POST['image'];
			$last_id 	= $_POST['lastid'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/contact/'.$imageName, $data);

			$query = "UPDATE branches_tbl SET Branch_image_2 = '$imageName' ";
			$query .="WHERE Branch_Id = '$last_id'";

			$update_contact_img = mysqli_query($con, $query);

			confirmQuery($update_contact_img);

			if($update_contact_img == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['Item has been missing']);
			}

		}

		else{

			echo json_encode(['Item has been missing']);
		}

	}



	if($_POST['action'] == 'gallery_image'){

		if(isset($_POST['image']) && isset($_POST['gid'])){

			$data   = $_POST['image'];
			$g_id 	= $_POST['gid'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/gallery/'.$imageName, $data);

			$query = "UPDATE gallery SET Image = '$imageName', ";
			$query .="Date_added = curdate(), Time_added = curtime() ";
			$query .="WHERE G_Id = '$g_id'";

			$update_gallery_img = mysqli_query($con, $query);

			confirmQuery($update_gallery_img);

			if($update_gallery_img == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['Item has been missing']);
			}

		}

		else{

			echo json_encode(['Item has been missing']);
		}

	}



	if($_POST['action'] == 'lesson_image'){

		if(isset($_POST['image']) && isset($_POST['lastid'])){

			$data   	= $_POST['image'];
			$last_id 	= $_POST['lastid'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/lessons/Cover/'.$imageName, $data);

			$query = "UPDATE lessons_tbl SET Cover_image = '$imageName' ";
			$query .="WHERE Lesson_Id = '$last_id'";

			$update_lesson_img = mysqli_query($con, $query);

			confirmQuery($update_lesson_img);

			if($update_lesson_img == 1){

				echo json_encode(['add_lesson_icon.php?lessid='.$last_id.'&lessimg=']);
			}

			else{
				echo json_encode(['2']);
			}

		}

		else{

			echo json_encode(['3']);
		}

	}



	if($_POST['action'] == 'lesson_icon'){

		if(isset($_POST['image']) && isset($_POST['lastid'])){

			$data   	= $_POST['image'];
			$last_id 	= $_POST['lastid'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/lessons/Icon/'.$imageName, $data);

			$query = "UPDATE lessons_tbl SET Icon = '$imageName' ";
			$query .="WHERE Lesson_Id = '$last_id'";

			$update_lesson_icon = mysqli_query($con, $query);

			confirmQuery($update_lesson_icon);

			if($update_lesson_icon == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['2']);
			}

		}

		else{

			echo json_encode(['3']);
		}

	}

	if($_POST['action'] == 'edit_lesson_image'){

		if(isset($_POST['image']) && isset($_POST['lastid'])){

			$data   	= $_POST['image'];
			$last_id 	= $_POST['lastid'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/lessons/Cover/'.$imageName, $data);

			$query = "UPDATE lessons_tbl SET Cover_image = '$imageName' ";
			$query .="WHERE Lesson_Id = '$last_id'";

			$update_lesson_img = mysqli_query($con, $query);

			confirmQuery($update_lesson_img);

			if($update_lesson_img == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['2']);
			}

		}

		else{

			echo json_encode(['3']);
		}

	}



	if($_POST['action'] == 'service_image'){

		if(isset($_POST['image']) && isset($_POST['lastid'])){

			$data   	= $_POST['image'];
			$last_id 	= $_POST['lastid'];

			$image_array_1 = explode(';', $data);
			$image_array_2 = explode(',', $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time().'.png';

			file_put_contents('../images/services/'.$imageName, $data);

			$query = "UPDATE services_tbl SET image = '$imageName' ";
			$query .="WHERE service_Id = '$last_id'";

			$update_service_img = mysqli_query($con, $query);

			confirmQuery($update_service_img);

			if($update_service_img == 1){

				echo json_encode(['1']);
			}

			else{
				echo json_encode(['2']);
			}

		}

		else{

			echo json_encode(['3']);
		}

	}

?>