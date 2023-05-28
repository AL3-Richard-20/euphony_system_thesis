
	<div id="POSpayment" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">

	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Payment</h3></center>
	      </div>

	      <div class="modal-body">

	      	<div class="row">
	      		<div class="col-sm-6">
	      			<div class="item">
	      				<p>O.R Number</p>
	      				<input type="number" name="OR_no" id="orno" class = "form-control input-lg" required data-parsley-type="number" data-parsley-trigger="focusout" data-parsley-checkor data-parsley-checkor-message="OR number already exists" />
	      			</div>
	      		</div>

	      		<div class="col-sm-6">
	      			<div class="item">
	      				<p>A.R Number</p>
	      				<input type="number" name="AR_no" id="arno" class = "form-control input-lg" required data-parsley-type="number" data-parsley-trigger="focusout" data-parsley-checkor data-parsley-checkor-message="AR number already exists" />
	      			</div>
	      		</div>
	      	</div>

	        <input type='hidden' name='subtotal' id = 'subtotal' class = 'form-control input-lg' value = '<?php echo $the_subtotal; ?>'>

	        <div class="item">
            	<p>Discount %</p>
            	<input type="number" name="discount" id="discount" class="form-control input-lg" value = "0">
          	</div>

			<div class="item">
	        	<p>Cash</p>
	        	<input type="number" name="cash" id = "cash" class="form-control input-lg" required="required">
	        </div>

	        <div class="row">

	        	<div class="col-sm-4">

	        		<p>Payment</p>

	        		<form>
					  	<input type="radio" name="payment" value="Cash" checked> Cash &nbsp
					  	<input type="radio" name="payment" value="Cheque"> Cheque
					</form>				

	        	</div>

	        	<div class="col-sm-4">
		        	<div class="text-right">
		        		<p>Change</p>
		        		<h3 id = "change">0</h3>
		        		<input type="hidden" name="change" id = "change2">
		        	</div>
	        	</div>

	        	<div class="col-sm-4">
		        	<div class="text-right">
		        		<p>Total</p>
		        		<h3 id = "final_total"><?php echo number_format($the_subtotal,2); ?> PHP</h3>
		        		<input type="hidden" name="final_total" id="final_total2" value="<?php echo $the_subtotal; ?>">
		        	</div>
	        	</div>

	        </div>

	      </div>


	      <div class="modal-footer">
	      	<button type = "submit" class = "btn btn-success btn-lg" id = "send">Submit</button>
	        <button type = "button" class = "btn btn-default btn-lg" id="clear">Clear</button>
	      </div>


	    </div>

	  </div>

	</div>

