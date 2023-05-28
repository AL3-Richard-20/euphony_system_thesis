<form method = "POST" novalidate>

	<div id="addLesson" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Add Lesson</h3></center>
	      </div>


	      <div class="modal-body">

	      	<div class="item">
		        <p>Lesson</p>
		        <select class = "form-control required" name = "add_lesson" id="select2" style="width: 100%">
		        	<option value="">Select a Lesson Here</option>
		        	<?php fill_lesson(); ?>
		        </select>
	        </div>

	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id = "send">Add</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>

</form>