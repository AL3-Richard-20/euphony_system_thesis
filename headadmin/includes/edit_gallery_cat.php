	<div id="editGalleryCat<?php echo $gc_id; ?>" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Edit Category</h3></center>
	      </div>


	      <div class="modal-body">

	      	<div class="item">
	      		<input type="hidden" name="edit_category_Id" id="edit_category_Id" class="form-control" value="<?php echo $gc_id; ?>" required>
	      	</div>
	      	
	        <div class="item">
	        	<input type="text" name="edit_category_name" id="edit_category_name" class="form-control" value="<?php echo $gc_desc; ?>" required>
	        </div>

	      </div>


	      <div class="modal-footer">
	      	<button type="submit" class = "btn btn-success btn-lg" id="send">Save</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>

