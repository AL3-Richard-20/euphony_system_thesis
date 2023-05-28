$(document).ready(function(){

	$('[data-toggle="popover"]').popover();

	$(".owl-carousel").owlCarousel();

	$('.single-item').slick({
		slidesToScroll: 1,
		adaptiveHeight: true,
		arrows: true,
	});

	//For Smooth Scrolling
	$(".navbar a, .up-arrow[href='#myPage']").on('click', function(event) {
  		event.preventDefault();
  		var hash = this.hash;	
  		$('html, body').animate({
    		scrollTop: $(hash).offset().top
  			}, 900, function(){
    			window.location.hash = hash;
    	});
  	});

  	//For Up Arrow
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

	//For Up Arrow END

	//For Slide Animations
	$(window).scroll(function(){

	  $(".slideanim").each(function(){

	    var pos = $(this).offset().top;
	    var winTop = $(window).scrollTop();

	    if (pos < winTop + 600) {
	      $(this).addClass("slide");
	    }

	  });

	});
	//For Slide Animations END

	//For Logo
  	var offset = 250;
	var duration = 500;

	$(window).scroll(function(){

		if($(this).scrollTop() > offset){
			$('.logo').fadeIn(duration);
		}
		else{
			$('.logo').fadeOut(duration);
		}

	});

	$('logo').click(function(){
		$('body').animate({scrollTop: 0}, duration);
	});
	
	//For Logo END

});

