(function($){
	"use strict";
	
	$(document).ready(function(){
		$('.entry').find('img').parent('a').addClass('imgwrap');

		var windowResize = function() {
			if ( document.documentElement.clientWidth > 768 ) {
				$('.navbar .dropdown, .navbar .dropdown-submenu').hover(function() {
		            $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

		        }, function() {
		            $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

		        });

		        $('.navbar .dropdown > a').click(function(){
		            location.href = this.href;
		        });
			}
		};

		$(window).resize(windowResize);
		windowResize();

		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
		    // Avoid following the href location when clicking
		    event.preventDefault(); 
		    // Avoid having the menu to close when clicking
		    event.stopPropagation(); 
		    // If a menu is already open we close it
		    //$('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
		    // opening the one you clicked on
		    $(this).parent().addClass('open');

		    var menu = $(this).parent().find("ul");
		    var menupos = menu.offset();
		  
		    if ((menupos.left + menu.width()) + 30 > $(window).width()) {
		        var newpos = - menu.width();      
		    } else {
		        var newpos = $(this).parent().width();
		    }
		    menu.css({ left:newpos });

		});
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