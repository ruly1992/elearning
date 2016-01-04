$(document).ready(function () {
	$(window).scroll(function() {
	    if ($("#navbar-main").offset().top > 150) {
	        $("#navbar-main").addClass("top-nav-collapse border navbar-brand");
	        $("#navbar-main").find('.navbar-brand').show();
	        $("#navbar-main").find('.header-top-right').show();
	    } else {
	        $("#navbar-main").removeClass("top-nav-collapse border navbar-brand");
	        $("#navbar-main").find('.navbar-brand').hide();
	        $("#navbar-main").find('.header-top-right').hide();
	    }
	});

	  // //hide boxex 
	  // $("#navbar-main").find(".navbar-brand").hide();
	  // //init scrolling event heandler
	  // $(document).scroll(function(){
	  //   var docScroll = $(document).scrollTop(), 
	  //       boxCntOfset = $(".navbar-brand").offset().top > 250;
	  //   //when rich top of boxex than fire
	  //   if(docScroll >= boxCntOfset ) {
	  //     $("#first").fadeIn(400)
	  //   } else {
	  //    $("#first").fadeOut(400)
	  //   }
	  // })   

});



