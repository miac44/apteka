$( document ).ready(function() {
	function setYMapsHeight() {
	    $('#YMapsID').css({
	        height: $(window).height()-173 + 'px'
	    });
	}
	setYMapsHeight();
	$(window).resize( setYMapsHeight );
});
