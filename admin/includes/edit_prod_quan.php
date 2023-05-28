



	<div id="editQuantity<?php echo $prod_id; ?>" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Edit Quantity</h3></center>
	      </div>


	      <div class="modal-body">

	      	<input type="hidden" name="prod_Id" value = "<?php echo $prod_id; ?>">
	      	<input type="hidden" name="sales_Id" value = "<?php echo $sales_id; ?>">
	      	<input type="hidden" name="old_quantity" value = "<?php echo $order_quantity; ?>">

	      	<div class="item">
	        	<p>Quantity</p>
	        	<input type="number" class= "form-control input-lg" name="edited_quantity" value = "<?php echo $order_quantity; ?>" required="required">
	        </div>

	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id = "send">Save</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>