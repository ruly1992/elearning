/**
 * Created by candradwaskito on 11/22/15.
 */

//$(window).load(function(){
//    $("#navbar-main").sticky({ topSpacing: 0 });
//});

$("#navbar-main").sticky({ topSpacing: 0 });

$('.btn-delete').on('click', function () {
	return confirm('Anda yakin mau menghapus?');
})

$('.btn-reply').on('click', function () {
    var parent = $(this).data('parent')
    var inputp = $('input[name=parent]')

    inputp.val(parent)
})

// if the tabs are in a narrow column in a larger viewport
    $('.sidebar-tabs').tabCollapse({
        tabsClass: 'visible-tabs',
        accordionClass: 'hidden-tabs'
    });

    // if the tabs are in wide columns on larger viewports
    $('.content-tabs').tabCollapse();

    // initialize tab function
    $('.nav-tabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // slide to top of panel-group accordion
    $('.panel-group').on('shown.bs.collapse', function() {
        var panel = $(this).find('.in');
        $('html, body').animate({
            scrollTop: panel.offset().top + (-60)
        }, 500);
    });