$(window).scroll(function() {
    if ($("#navbar-main").offset().top > 50) {
        $("#navbar-main").addClass("top-nav-collapse");
    } else {
        $("#navbar-main").removeClass("top-nav-collapse");
    }
});

