<form method = "POST">

	<div id="addAttendance" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Add Attendance</h3></center>
	      </div>


	      <div class="modal-body">

	      	<div class="item">
	        	<input type="hidden" name="stud_class_id" value = "<?php echo $stud_class_Id; ?>" required="required">
	        </div>

	        <div class="item">
	        	<p>Date</p>
	        	<input type="date" name="the_date" class="form-control input-lg" required="required">
	        </div>

	        <div class="item">
	        	<p>Remarks</p>
	        	<select class="form-control input-lg required" name="remarks">
	        		<option value="">Select Here</option>
	        		<option value="Present">Present</option>
	        		<option value="Excused">Excused</option>
	        		<option value="Forfeited">Forfeit</option>
	        	</select>
	        </div>



	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id="send att">Save</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>

</form>

