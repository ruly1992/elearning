$(document).ready(function () {
	$(window).scroll(function() {
	    if ($("#navbar-main").offset().top > 150) {
	        $("#navbar-main").addClass("top-nav-collapse border");
	        $("#navbar-main").find('.navbar-brand').show();
	        $("#navbar-main").find('.header-top-right').show();
	    } else {
	        $("#navbar-main").removeClass("top-nav-collapse border");
	        $("#navbar-main").find('.navbar-brand').hide();
	        $("#navbar-main").find('.header-top-right').hide();
	    }
	});
});



