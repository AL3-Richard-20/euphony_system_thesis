
$(document).ready(function(){  

	//================================= Messages =================================

	// function load_unseen_notification(view = ''){

	// 	$.ajax({
	// 		url:"fetch_messages.php",
	// 		method:"POST",
	// 		data:{view:view},
	// 		dataType:"json",
	// 		success:function(data){

	// 		$('.messages').html(data.notification);
	// 		if(data.unseen_notification > 0){
	// 				$('.count2').html(data.unseen_notification);
	// 		}
	// 		}
	// 	});
	// }

	// load_unseen_notification();

	//  $(document).on('click', '.dropdown-toggle', function(){
	//   	$('.count2').html('');
	//   	load_unseen_notification('yes');
	// });

	// setInterval(function(){ 
	//   load_unseen_notification();; 
	// }, 5000);

	//================================= Messages END =================================






	







	/// ================================== Data Table ==================================			
	$('#standardDesc').DataTable({
		select: true,
		"order": [[ 0, "desc" ]]
	});

	$('#standardAsc').DataTable({
		select: true,
		"order": [[ 0, "asc" ]]
	});

	$('#pos').DataTable({
		select: true,
		"order": [[ 0, "asc" ]],
		"lengthMenu":[[1],[1]],
		"bSort": false
	});
	/// ================================== Data Table END==================================





	/// ================================== Select2 ==================================
	$("#select2").select2({
      allowClear: true
    });
    /// ================================== Select2 END ==================================


	$('[data-toggle="popover"]').popover();

	//To Populate Textbox
	$("#lessondd").on("change", function(){
		var lessonAmount = this.value;
		var amountField = $("#amount input")[0];
		$(amountField).val(lessonAmount);
	});
	
	// ================================== Up Arrow ==================================
  	var offset = 250;
	var duration = 500;

	$(window).scroll(function(){

		if($(this).scrollTop() > offset){
			$('.up-arrow').fadeIn(duration);
		}
		else{
			$('.up-arrow').fadeOut(duration);
		}

	});

	$('up-arrow').click(function(){
		$('body').animate({scrollTop: 0}, duration);
	});

	// ================================== Up Arrow END ==================================


});

