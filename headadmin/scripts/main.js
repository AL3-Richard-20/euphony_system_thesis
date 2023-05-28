
$(document).ready(function(){

	$('#standardDesc').DataTable({
		select: true,
		"order": [[ 0, "desc" ]]
	});

	$('#standardAsc').DataTable({
		select: true,
		"order": [[ 0, "asc" ]]
	});

	$('#lessons').DataTable({
		select: true,
		"order": [[ 0, "desc" ]]
	});

	$('#services').DataTable({
		select: true,
		"order": [[ 0, "desc" ]]
	});

	$("#select2").select2({
      	placeholder: "Select a product here",
      	allowClear: true
    });

});