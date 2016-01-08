/**
 * Created by candradwaskito on 11/22/15.
 */

//$(window).load(function(){
//    $("#navbar-main").sticky({ topSpacing: 0 });
//});

$("#navbar-main").sticky({ topSpacing: 0 });

$('.btn-reply').on('click', function () {
    var parent = $(this).data('parent')
    var inputp = $('input[name=parent]')

    inputp.val(parent)
})

$('#navbarCollapse').on('show.bs.collapse', function (){
    $('#navbarCollapselogin').collapse('hide');
});
$('#navbarCollapselogin').on('show.bs.collapse', function (){
    $('#navbarCollapse').collapse('hide');
});

// private
$('#navbarCollapse').on('show.bs.collapse', function (){
    $('#navbarCollapselogout').collapse('hide');
});
$('#navbarCollapselogout').on('show.bs.collapse', function (){
    $('#navbarCollapse').collapse('hide');
});

