(function($) {
    "use strict";

    $(document).ready(function() {
        //Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Popover
        $('[data-toggle="popover"]').popover();

        // Multi-level bootstrap submenu
        $('.dropdown-submenu > a').on("click", function(e) {
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
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