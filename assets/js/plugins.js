//------------------------------preloader----------------------
(function($){
  'use strict';
    $(window).on('load', function () {
        if ($(".loading").length > 0)
        {
            $(".loading").fadeOut("slow");
        }
    });
})(jQuery)



 /*-------------------------wow animation customization-------------------*/
 var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       300,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null // optional scroll container selector, otherwise use window
  }
);
wow.init();



/*-----------------footer animation offset customized----------------------*/
 var wow = new WOW(
  {
    boxClass:     'foot',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:      50,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null // optional scroll container selector, otherwise use window
  }
);
wow.init();




/*-----------------smooth scroll top--------------------*/
$(document).ready(function(){
 $(window).scroll(function(){
 if ($(this).scrollTop() > 100) {
 $('.scrollup').fadeIn();
  } else {
 $('.scrollup').fadeOut();
}
});
 $('.scrollup').click(function(){
 $("html, body").animate({ scrollTop: 0 }, 600);
 return false;
 });
});
