<form method = "POST">

	<div id="assignTeacher" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Assign Teacher</h3></center>
	      </div>


	      <div class="modal-body">

	        <p>Day</p>
	        <input type="text" class = "form-control input-lg" name="day" value = "<?php echo $day; ?>" disabled><br>

	        <p>Time</p>
	        <input type="text" class = "form-control input-lg" name="day" value = "<?php echo $full_time; ?>" disabled><br>

	        <p>Teacher</p>

	        <select class = "form-control input-lg" name = "assign_teacher" id="select2" style="width: 100%">	

	        	<?php 

					$query =  "SELECT C.Class_Id, T.T_Last_name, ";
					$query .= "T.T_First_name, T.T_Middle_name FROM ";
					$query .= "class_tbl as C, teacher_tbl as T, ";
					$query .= "teacher_lesson_tbl as TL, lessons_tbl as L ";
					$query .= "WHERE C.Tea_less_Id = TL.Tea_less_Id AND ";
					$query .= "T.Teacher_Id = TL.Teacher_Id AND TL.Lesson_Id = ";
					$query .= "L.Lesson_Id AND C.Day='".$day_id."' AND ";
					$query .= "C.Time='".$time_id."' AND ";
					$query .= "TL.Lesson_Id='".$lesson_Id."' AND ";	
					$query .= "C.Status='Available' AND T.Status=1";	

					$assign_teacher_query = mysqli_query($con, $query);

					confirmQuery($assign_teacher_query);

					$count = mysqli_num_rows($assign_teacher_query);

					if($count > 0){

						while($row = mysqli_fetch_assoc($assign_teacher_query)){

							$class_id 			 = escape($row['Class_Id']);
							$teacher_last_name 	 = escape($row['T_Last_name']);
							$teacher_first_name  = escape($row['T_First_name']);
							$teacher_middle_name = escape($row['T_Middle_name']);

							echo "<option value='$class_id'>$teacher_first_name $teacher_middle_name $teacher_last_name</option>";
							
						}
					}

					else{

						echo "<option>No Teacher Available</option>";
					}

            	?>

	        </select><br>

	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>

</form>