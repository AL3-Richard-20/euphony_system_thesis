
$(document).ready(function(){  

	//================================= Messages =================================

	function load_unseen_notification(view = ''){

		$.ajax({
			url:"fetch_messages.php",
			method:"POST",
			data:{view:view},
			dataType:"json",
			success:function(data){

			$('.messages').html(data.notification);
			if(data.unseen_notification > 0){
					$('.count2').html(data.unseen_notification);
			}
			}
		});
	}

	load_unseen_notification();

	 $(document).on('click', '.dropdown-toggle', function(){
	  	$('.count2').html('');
	  	load_unseen_notification('yes');
	});

	setInterval(function(){ 
	  load_unseen_notification();; 
	}, 5000);

	//================================= Messages END =================================

});