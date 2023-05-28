
	<div id="addScheduleTeacher" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Add Schedule</h3></center>
	      </div>


	      <div class="modal-body">

	      	<div class="item">
		        <p>Day</p>
		        <select class = "form-control input-lg required" name = "add_day">
		        	<option value="">Select Day Here</option>
		        	<?php dayQuery(); ?>
		        </select>
		    </div>

		    <div class="item">
		        <p>Time</p>
		        <select class = "form-control input-lg required" name = "add_time">
		        	<option value="">Select Time Here</option>
		        	<?php timeQuery(); ?>
		        </select>
	        </div>

	        <div class="item">
		        <p>Lesson</p>
		        <select class = "form-control input-lg required" name ="lesson">
		        	<option value="">Select Lesson Here</option>
		        	<?php

		        		$query_teacher_lessons = teacherLesson($teacher_id);

		        		confirmQuery($query_teacher_lessons);

		        		while($row = mysqli_fetch_assoc($query_teacher_lessons)){

		        			$tea_less_id 	= escape($row['Tea_less_Id']);
		        			$lesson_desc 	= escape($row['Lesson_desc']);
		        			$lesson_amount 	= escape($row['Amount']);
		        			$no_of_lessons 	= escape($row['No_of_lesson']);

		        			$the_lesson = "$lesson_desc - $no_of_lessons Lessons";

		        			echo "<option value = '$tea_less_id'>$the_lesson</option>";
		        		}

		        	?>
		        </select>
		    </div>

	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>