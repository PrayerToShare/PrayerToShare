define(['jquery', 'domReady', 'modules/Prayer'], function($, domReady, Prayer) {
    var page = {
        initPostBehavior: function(element) {
            $(element).on('focus', function() {
                if (!$(this).val().length) {
                    $(this).toggleClass('active');
                    $(this).siblings('.actions').removeClass('is-hidden');
                }
            }).on('blur', function() {
                if (!$(this).val().length) {
                    $(this).toggleClass('active');
                    $(this).siblings('.actions').addClass('is-hidden');
                }
            }).on('change keyup keydown', function() {
                page.postHeightChange($(element));
            });
        },

        postHeightChange: function(element) {
            var shadow;
            if (!$('.post-expand').length) {
                shadow = $('<div class="post-expand"></div>');
                $('body').append($(shadow));
            } else {
                shadow = $('.post-expand');
            }
            var val = $(element).val()
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/&/g, '&amp;')
                .replace(/\n/g, '<br/>');
            $(shadow).css({
                'line-height': $(element).css('line-height'),
                'padding': '10px 12px',
                'width': $(element).outerWidth() + 'px',
                'font-size': $(element).css('font-size'),
                'position': 'absolute',
                'left': '-10000px',
                'bottom': 0
            });
            $(shadow).html(val);
            var height = $(shadow).outerHeight() + parseInt($(shadow).css('line-height'));
            $(element).css('height', height + 'px');
        },

        initMenuSlide: function() {
            $('.header_links li').hover(function() {
                $('.menu',this).slideDown(200);
                $(this).addClass('hover');
            },function() {
                $('.menu',this).slideUp(200);
                $(this).removeClass('hover');
            });
        },

        init: function() {
            domReady(function() {
                page.initPostBehavior($('.new-post'));
                page.initMenuSlide();
            });
        }
    };

    page.init();
});
