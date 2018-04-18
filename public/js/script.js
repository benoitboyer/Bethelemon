       
$(document).ready(function() {
	
	var $navOffset = $('nav').position();
	var $wrapperHeight =$('.nav-wrapper').height('nav').outerHeight();

	$('.nav-wrapper').css('height',$wrapperHeight);

	$(window).scroll(function(){
		var $scrollPosition = $(window).scrollTop();

		if($scrollPosition >= $navOffset.top) {
			$('.navbar').addClass('fixed');
			$('nav').css("opacity","0.9");
		}

		else {
			$('nav').removeClass('fixed');
			$('nav').css("opacity","1");
		}
	});
});


