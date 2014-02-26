/** AUTO GROW PLUGIN **/
(function($) {
    $.fn.autogrow = function(options) {
        this.filter('textarea').each(function() {
            var $this       = $(this),
                minHeight   = $this.height(),
                lineHeight  = $this.css('lineHeight');
            var shadow = $('<div></div>').css({
                position:   'absolute',
                top:        -10000,
                left:       -10000,
                width:      $(this).width(),
                fontSize:   '11px',
                fontFamily: $this.css('fontFamily'),
                lineHeight: 'normal',
                resize:     'none'
            }).appendTo(document.body);
            var update = function() {
                var val = this.value.replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/&/g, '&amp;')
                                    .replace(/\n/g, '<br/>');
                shadow.html(val);
                $(this).css('height', Math.max(shadow.height(), minHeight));
            };
            $(this).change(update).keyup(update).keydown(update);
            update.apply(this);
        });
        return this;
};})(jQuery);


$(document).ready(function() {
	$('.post_textarea').focus(function(){
		if (this.value === this.defaultValue) {
			this.value = '';
			$(this).removeClass('off');
		}
	}).blur(function() {
		if (this.value === '') {
			this.value = this.defaultValue;
			$(this).addClass('off');
		}
	}).autogrow();
	
	$('.header_links li').hover(function() {
		$('.menu',this).slideDown(200);
		$(this).addClass('hover');
	},function() {
		$('.menu',this).slideUp(200);
		$(this).removeClass('hover');
	});
});
