$(document).ready(function () {
	$('#favorit').stick_in_parent({
		// offset_top: 60,
		.on('sticky_kit:bottom', function(e) {
		    $(this).parent().css('position', 'static');
		})
		.on('sticky_kit:unbottom', function(e) {
		    $(this).parent().css('position', 'relative');
		})
	}); 	
});