<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

	<head>

    <meta charset = "utf-8">

    <meta name = "viewport" content = "width=device-width, initial-scale=1">



    <link rel = "stylesheet" type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

    <link rel = "stylesheet" type="text/css" href = "../assets/font/css/all.min.css">

    <link rel = "stylesheet" type="text/css" href="../assets/datatables/datatables.min.css"/>

    <link rel = "stylesheet" type="text/css" href="../assets/select2/select2.min.css"/>

    <link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

    <script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



    <script src = "scripts/functions.js"></script>

    <link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    <title>Euphony | Edit Schedule</title>

  </head>

	<body>

    <?php include "includes/admin_navigation.php"; ?>


		<?php

      if(isset($_GET['teacherid'])){

        $teacher_id = escape($_GET['teacherid']);

      }

      if(isset($_POST['add_day'])){

        $selected_day     = $_POST['add_day'];
        $selected_time    = $_POST['add_time'];
        $selected_lesson  = $_POST['lesson'];

        $query = "SELECT C.Class_Id, C.Tea_less_Id, C.Day, C.Time, C.Status, TL.Tea_less_Id, ";
        $query .= "TL.Teacher_Id, TL.Lesson_Id, D.Day, T.Time, TT.Time, TT.Time_end, TT.randSalt, ";
        $query .= "TT.Time_Id, D.Day_Id, L.Lesson_Id, L.Lesson_desc ";
        $query .= "FROM class_tbl as C, teacher_lesson_tbl as TL, days_tbl as D, time_tbl as T, ";
        $query .= "lessons_tbl as L, time_tbl as TT ";
        $query .= "WHERE C.Tea_less_Id = TL.Tea_less_Id AND "; 
        $query .= "TL.Lesson_Id = L.Lesson_Id AND C.Time = TT.Time_Id ";
        $query .= "AND C.Day = D.Day_Id AND C.Time = T.Time_Id AND TL.Teacher_Id = '$teacher_id' ";
        $query .= "AND TT.Time_Id = '$selected_time' AND D.Day_Id = '$selected_day' ";

        $query_classes = mysqli_query($con, $query);

        confirmQuery($query_classes);

        $count_records = mysqli_num_rows($query_classes);

        if($count_records == NULL){

          $query2 = "INSERT INTO class_tbl (Tea_less_Id, Day, Time, Status) ";
          $query2 .="VALUES ('$selected_lesson', '$selected_day', '$selected_time', 'Available')";

          $add_teacher_class = mysqli_query($con, $query2);

          // echo "<script>sweetAlert('success', 'Successfully Added', 'You added a new schedule', 'edit_teacher_schedule.php?teacherid=$teacher_id');</script>";

          echo "<script>sweetAlertSide('success', 'Successfully Added');</script>";
        }

        while($row = mysqli_fetch_assoc($query_classes)){

          $day_id       = $row['Day_Id'];
          $time_id      = $row['Time_Id'];
          $lesson_id    = $row['Lesson_Id'];

          if($day_id == $selected_day and $time_id == $selected_time){

            // echo "<script>sweetAlert('error', 'Class already exist', 'Try other day and time', 'edit_teacher_schedule.php?teacherid=$teacher_id');</script>";

            echo "<script>sweetAlertSide('error', 'Class already exist');</script>";

          }

        }

      }

    ?>

		<div class="container-fluid">

      <div class="margin"></div>

			<div class="panel panel-default">

				<div class="panel-header">

          <div class="row">

            <div class="col-sm-4"><br>

                <button type = "button" class = "btn btn-default btn-lg" style = "float: left" onclick = "location.href='edit_teacher.php?teacherid=<?php echo $teacher_id; ?>'"><span class= "fa fa-arrow-left"></span></button>

            </div>

            <div class="col-sm-4">

                <center><h3 class="cap">Edit Teacher Schedule</h3></center>

            </div>

            <div class="col-sm-4"></div>

          </div>

				</div><br>

				<form method = "POST">

					<div class = "panel-body">

            <div class = "text-right">
              <a href = "" title= "Add" class="btn btn-success btn-sm" data-toggle = "modal" data-target = "#addScheduleTeacher">Add</a>
            </div><br>     

       			<table class = "table table-responsive table-bordered table-hover" id = "standardAsc">

       				<thead class="cap">
     					  <th>No.</th>
     					  <th>Day</th>
     					  <th>Time</th>
     					  <th>Student</th>
                <th>Lesson</th>
     					  <th>Status</th>
     					  <th>Action</th>
       				</thead>

       				<tbody>

       				<?php

					      $query_classes = editTeachersched($teacher_id);

     					  $n = 1;

     						while($row = mysqli_fetch_assoc($query_classes)){

     							$day          = escape($row['Day']);
     							$time         = escape($row['Time']);
                  $time_end     = escape($row['Time_end']);
                  $randSalt     = escape($row['randSalt']);
     							$status       = escape($row['Status']);
                  $class_id     = escape($row['Class_Id']);
                  $lesson_id    = escape($row['Lesson_Id']);
                  $lesson_desc  = escape($row['Lesson_desc']);
                  $no_of_lesson = escape($row['No_of_lesson']);

                  $the_time     = "$time - $time_end $randSalt";

                  $the_lesson   = "$lesson_desc - $no_of_lesson Lessons"; 

     							echo "<tr>";
     							echo "<td>".$n++."</td>";
     							echo "<td>$day</td>";
     							echo "<td>$the_time</td>";

                  echo "<td>";

                  $query_student = "SELECT * FROM stud_class_tbl WHERE ";
                  $query_student .="randSalt2 = 1 AND Class_Id = '$class_id' ";
                  $student_query = mysqli_query($con, $query_student);

                  confirmQuery($student_query);

                  $count = mysqli_num_rows($student_query);

                  if($count != NULL){

                    while($row = mysqli_fetch_assoc($student_query)){

                      $student_id = escape($row['User_Id']);

                      $get_stud_info = studInfo($student_id);

                      while($row = mysqli_fetch_assoc($get_stud_info)){

                        $stud_fname = escape($row['First_name']);
                        $stud_mname = escape($row['Middle_name']);
                        $stud_lname = escape($row['Last_name']);

                        $the_full_name = "$stud_fname $stud_mname $stud_lname";

                        echo "<a href= 'edit_student.php?userid=$student_id'>$the_full_name</a>";
                      
                      }

                    }

                  }

                  else{
                    
                    echo "---";

                  }
                  

                  echo "</td>";

                  echo "<td>$the_lesson</td>";
     							echo "<td>$status</td>";
     							echo "<td>";

                  if($count == NULL){

                    ?>
                    
                    <a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?classid=<?php echo $class_id; ?>&teacher=<?php echo $teacher_id; ?>');">Delete</a>

                    <?php

                  }

                  else{

                    echo "<center>---</center>";

                  }

     							echo "</td>";
     							echo "</tr>";
                }

       				?>

       				</tbody>

       			</table>

        	</div>

          <?php include "includes/add_sched_teacher.php"; ?>

    	  </form>

	    </div>

    </div>

    <script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

    <script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>

    <script src="../assets/js/select2.full.min.js"></script>



    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script> -->



    <script src = "../assets/validator/validator.js"></script>

    <script src = "../assets/validator/validate.js"></script>

    <script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

    <script src = "scripts/shortcut_keys.js"></script>

    <script>
      
      $(document).ready(function(){

        $('#standardDesc').DataTable({
          select: true,
          "order": [[ 0, "desc" ]]
        });

        $('#standardAsc').DataTable({
          select: true,
          "order": [[ 0, "asc" ]]
        });

        $("#select2").select2({
            allowClear: true
          });

      });

    </script>

	</body>
	
</html>