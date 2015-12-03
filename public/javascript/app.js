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