/**
 * Created by candradwaskito on 11/22/15.
 */

//$(window).load(function(){
//    $("#navbar-main").sticky({ topSpacing: 0 });
//});

$("#navbar-main").sticky({ topSpacing: 0 });

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

