(function($){
	"use strict";
	
	$(document).ready(function(){
		//Tooltip
		$('[data-toggle="tooltip"]').tooltip();

		// Popover
		$('[data-toggle="popover"]').popover();
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