$(document).ready(function () {
	var metadata = ['title', 'creator', 'subject', 'description', 'publisher', 'contributor', 'date', 'type', 'format', 'identifier', 'source'];

	if ($('.awesomplete').length) {
		new Awesomplete('.awesomplete', {
			list: metadata
		})
	
		$('.awesomplete').on('awesomplete-selectcomplete', function (e) {
			// 
		})
	}

	$('.btn-false').on('click', function () {
		return false;
	})
})