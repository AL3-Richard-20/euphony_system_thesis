<form method="POST" id="add_cat_form" novalidate>

	<div id="addCategory" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">

	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Add Category</h3></center>
	      </div>


	      <div class="modal-body">

	      	<div class="item">
				<input type="text" class="form-control" placeholder="Category Name" name="new_category" id="new_category" required="required">
			</div>

	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>

</form>