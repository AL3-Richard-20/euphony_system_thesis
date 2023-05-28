<form method="POST" novalidate>

	<div id="paymentModal" class="modal fade" role="dialog">

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
      				<p>OR no.</p>
      				<input type="number" name="or_no" id="orno" class="form-control input-lg" required data-parsley-type="number" data-parsley-trigger="focusout" data-parsley-checkor data-parsley-checkor-message="OR number already exists" />
	      		</div>

	      		<div class="col-sm-6">
      				<p>AR no.</p>
      				<input type="number" name="ar_no" id="arno" class="form-control input-lg" required data-parsley-type="number" data-parsley-trigger="focusout" data-parsley-checkar data-parsley-checkar-message="AR number already exists" />
	      		</div>
	      			
	      	</div><br>

	      	<div class="row">

	      		<div class="col-sm-6">

	      			<p>Balance</p>

	      			<?php 

	      				if(isset($balance)){

	      					?>

	      					<input type="number" name="balance" id="balance" class="hidden" value="<?php echo (int)$balance; ?>">

	      					<?php

	      					echo "<input type='text' name='balance2' id='balance2' class='form-control input-lg disabled_input' value='".number_format($balance, 2)." '>";
	      				}

	      				else{

	      					if(isset($lesson_amount)){

	      						?>

	      						<input type="number" name="balance" id="balance" class="form-control input-lg disabled_input" value="<?php echo (int)$lesson_amount; ?>">

	      						<?php
	      					}
	      				}

	      			?>

				</div>

				<div class="col-sm-6">

	        		<p>Discount %</p>

	        		<input type="number" name="pay_discount" id="pay_discount" class="form-control input-lg" value="0"><br>

	        	</div>

			</div>

			<div class="row">
	        	
	        	<div class="col-sm-6">
	        		<div class="item">
			        	<p>Amount</p>
			        	<input type="number" name="pay_amount" id="pay_amount" class="form-control input-lg" required="required">
		        	</div>
				</div>
				

	        	<div class="col-sm-6">
	        		<p>Change</p>

	        		<input type="number" name="pay_change" id="pay_change" class="hidden" value="0">

	        		<input type="number" name="pay_change1" id="pay_change1" class="hidden" value="0">

	        		<input type="number" name="pay_change2" id="pay_change2" class="form-control input-lg disabled_input" value="0"><br>

	        	</div>

	        </div>

	        <hr/>

	        <div class="row">

	        	<div class="col-sm-6">

	        		<p>Payment</p>

	        		<form>
					  	<input type="radio" name="payment" value="Cash" checked> Cash &nbsp
					  	<input type="radio" name="payment" value="Cheque"> Cheque
					</form>				

	        	</div>

	        	<div class="col-sm-6">
		        	<div class="text-right">
		        		<p>Total Balance</p>
		        		<input type="number" name="total_balance_2" id="total_balance_2" class="hidden">

		        		<h3 id = "total_balance">

		        			<?php 

		        				if(isset($balance)){
		        					echo number_format($balance,2) . " PHP"; 
		        				}

		        				else{

		        					if(isset($lesson_amount)){
		        						echo number_format($lesson_amount,2) . " PHP";
		        					} 
		        				}
		        			?>

		        		</h3>
		        	</div>
	        	</div>

	        </div>

	      </div>


	      <div class="modal-footer">
	      	<button type="submit" class="btn btn-success btn-lg" id="send">Pay</button>
	        <button type="button" class="btn btn-default btn-lg" id="clear">Clear</button>
	      </div>


	    </div>

	  </div>

	</div>

</form>


