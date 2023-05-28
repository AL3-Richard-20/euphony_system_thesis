
$(document).ready(function(){  

	$('#standardDesc').DataTable({
		select: true,
		"order": [[ 0, "desc" ]]
	});

	$('#standardAsc').DataTable({
		select: true,
		"order": [[ 0, "asc" ]]
	});

});