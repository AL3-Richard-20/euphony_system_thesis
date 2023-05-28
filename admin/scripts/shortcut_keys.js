
$(document).ready(function(){  

	$(document).bind('keydown', 'm', function(){

        $("#menu").modal();

    });

    $(document).bind('keydown', 'h', function(){

        $("#helpModal").modal();

    });

    // $(document).bind('keydown', 'l', function(){

    //     location.href='lock_screen_exe.php';

    // });

});