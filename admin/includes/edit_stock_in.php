

	<div id="editStockIn<?php echo $prod_Id; ?>" class="modal fade" role="dialog">

	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">


		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<center><h3 class="modal-title cap">Edit Stock In</h3></center>
		      	</div>


		      	<div class="modal-body">

			      	<?php 

			      		if(isset($prod_Id) && isset($quantity_in)){

			      			?>

		      				<input type="hidden" class= "form-control input-lg" name="s_prod_id" value="<?php echo $prod_Id; ?>" >

		      				<input type="hidden" class="form-control input-lg" name="old_quantity" value="<?php echo $quantity_in; ?>" >

		      				<p>Quantity</p>
			        		<input type="number" class= "form-control input-lg" name="edited_quantity" value="<?php echo $quantity_in; ?>" >

		      				<?php

		      			}

		      		?>
		        
		    	</div>


		    	<div class="modal-footer">
		      		<button type="submit" name="editstockin" class="btn btn-success btn-lg" id="send">Save</button>
		        	<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
		    	</div>
		    </div>
	  	</div>
	</div>

