(function($){
	"use strict";
	
	$(document).ready(function(){
		//Tooltip
		$('[data-toggle="tooltip"]').tooltip();

		// Popover
		$('[data-toggle="popover"]').popover();

		// Back to top 
		// @link http://bootsnipp.com/snippets/featured/link-to-top-page
		$(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        $('#back-to-top').tooltip('show');
	});

	// Window load event with minimum delay
	// @https://css-tricks.com/snippets/jquery/window-load-event-with-minimum-delay/
	(function fn() {
		fn.now = +new Date;
		$(window).load(function() {
			if (+new Date - fn.now < 500) {
				setTimeout(fn, 500);
			}
		});
	})();
})(jQuery);