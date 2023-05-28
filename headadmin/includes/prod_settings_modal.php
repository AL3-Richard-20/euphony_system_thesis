
	<div id="prodSett<?php echo $prod_sett_Id; ?>" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Change the reorder point</h3></center>
	      </div>


	      <div class="modal-body">

	      	<div class="item">
	      		<input type="hidden" name="the_prod_sett_Id" value="<?php echo $prod_sett_Id; ?>">	
	      	</div>

	        <div class="item">
	        	<input type="number" name="based_no" class="form-control" value = "<?php echo $number; ?>" required>
	        </div>

	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id = "send sett<?php echo $n++; ?>">Save</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>

