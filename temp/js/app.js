(function($){
	"use strict";
	
	$(document).ready(function(){
		$('.entry').find('img').parent('a').addClass('imgwrap');

		var windowResize = function() {
			if ( document.documentElement.clientWidth < 768 ) {
				
			}
		};

		$(window).resize(windowResize);
		windowResize();
	});

	// Window load event with minimum delay
	// @https://css-tricks.com/snippets/jquery/window-load-event-with-minimum-delay/
	(function fn() {
		fn.now = +new Date;
		$(window).load(function() {
			if (+new Date - fn.now < 100) {
				setTimeout(fn, 100);
			}
		});
	})();
})(jQuery);