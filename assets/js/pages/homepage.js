define(['jquery', 'domReady', 'modules/Prayer'], function($, domReady, Prayer) {
    var page = {
        initFormSlide: function() {
            $('.toggle-login').on('click', function(e) {
                e.preventDefault();
                $(this).parents('.slide-container').animate({
                    'right': '-=1018px'
                }, 500, function() {
                    // when done - possibly initialize other events?
                });
            });
            $('.toggle-register').on('click', function(e) {
                e.preventDefault();
                $(this).parents('.slide-container').animate({
                    'right': '+=1018px'
                }, 500, function() {
                    // when done - possibly initialize other events?
                });
            });
        },

        init: function() {
        	domReady(function() {
                page.initFormSlide();
        	});
        }
    };

    init: page.init();
});
