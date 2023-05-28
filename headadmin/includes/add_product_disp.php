
<form method="POST" novalidate>

	<div id="addProduct" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">


	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center><h3 class="modal-title cap">Add Product</h3></center>
	      </div>


	      <div class="modal-body">

	        <div class="item">
	        	
	        	<select class="form-control addprod" name="addprod" id="select2" style="width:100%">

	        		<option value="">Select Here</option>

		        	<?php

		        		$query = "SELECT * FROM products_tbl WHERE NOT Status = 'Not Available'";

		        		$query_disp_prod = mysqli_query($con, $query);

		        		confirmQuery($query_disp_prod);

						while($row = mysqli_fetch_assoc($query_disp_prod)){

							$prod_Id      = escape($row["Prod_Id"]);
	                      	$prod_name    = escape($row["Prod_name"]);
	                      	$prod_status  = escape($row["Status"]);

	                      	echo "<option value='$prod_Id'>$prod_name - $prod_status</option>";
						}

		        	?>

	        	</select>

	        </div>

	      </div>


	      <div class="modal-footer">
	      	<button type="submit" class="btn btn-success btn-lg" id="send proddisp">Add</button>
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	      </div>


	    </div>

	  </div>

	</div>

</form>

