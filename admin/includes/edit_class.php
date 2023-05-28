

<form method = "POST">

	<div id="myModal" class="modal fade" role="dialog">

	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">


		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<center><h3 class="modal-title cap">Change Lesson</h3></center>
		     	 </div>


		      	<div class="modal-body">

			      	<div class="item">
				        <p>Lesson</p>
				        <select class="form-control input-lg lessondd" name="lesson" id="select2 cl" style="width:100%">

				        	<?php
				        		if(isset($lesson_desc) && isset($nooflesson)){
				        			echo "<option value = '$lesson_Id'>";
						        	echo "$lesson_desc - $nooflesson Lessons";
									echo "</option>";
				        		}
				        	?>
				        	
				        	<?php fill_lesson(); ?>
				        </select>
				    </div>

				    <p>Amount</p>
					<h3 id="amount" style="color:green; font-weight: bold;">0</h3><br>
			        
		      	</div>


		      	<div class="modal-footer">
		      		<button type = "submit" class = "btn btn-success btn-lg" id = "send el">Save</button>
		        	<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
		      	</div>

		    </div>

	  	</div>

	</div>

</form>