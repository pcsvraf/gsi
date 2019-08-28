$(document).ready(function(){
	var altura = $('.table').offset().top;
	
	$(window).on('scroll', function(){
		if ( $(window).scrollTop() > altura ){
			$('.table').addClass('menu-fixed');
		} else {
			$('.table').removeClass('menu-fixed');
		}
	});
 
});

