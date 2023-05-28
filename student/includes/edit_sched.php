<form method = "POST">

	<div id="changeSched" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Change Schedule</h3></center>
	      </div>


	      <div class="modal-body">

	        <p>Day</p>
	        <select class = "form-control input-lg" name = "edit_day">
	        	<option value = "<?php echo $day_id; ?>">
	        		<?php echo $day; ?>
				</option>
	        	<?php dayQuery(); ?>
	        </select><br>

	        <p>Time</p>
	        <select class = "form-control input-lg" name = "edit_time">
	        	<option value = "<?php echo $time_id; ?>">
	        		<?php echo $full_time; ?>
				</option>
	        	<?php timeQuery(); ?>
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