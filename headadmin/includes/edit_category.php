

	<div id="editCategory<?php echo $category_id; ?>" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Edit Category</h3></center>
	      </div>


	      <div class="modal-body">

	      	<div class="item">
	        	<p>Category</p>
	        	<input type="hidden" name="category_id" value = "<?php echo $category_id; ?>">
	        	<input type="text" name="category_name" class = "form-control" value="<?php echo $category_title; ?>" required="required">
	        </div>

	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>