$(document).ready(function() {
	function gd(year, month, day) {
	    return new Date(year, month, day).getTime();
	}

	if ($("#chart-visitor").length) {
		var d1 = [
			[gd(2014, 1, 0), 20],
			[gd(2014, 2, 0), 30],
			[gd(2014, 3, 0), 10],
			[gd(2014, 4, 0), 145],
			[gd(2014, 5, 0), 57],
			[gd(2014, 6, 0), 34]
		];

		var options = {
			xaxis: {
				mode: 'time',
				tickColor: '#fff',
				minTickSize: [1, "day"],
				timeformat: "%a"
			},
	    }

		$.plot($("#chart-visitor"), [ d1 ], options);
	}

	if ($("#chart-post").length) {
		var d1 = [
			[gd(2014, 1, 0), 10],
			[gd(2014, 2, 0), 70],
			[gd(2014, 3, 0), 10],
			[gd(2014, 4, 0), 10],
			[gd(2014, 5, 0), 45],
			[gd(2014, 6, 0), 10]
		];

		var options = {
			xaxis: {
				mode: 'time',
				tickColor: '#fff',
				minTickSize: [1, "day"],
				timeformat: "%a"
			},
	    }

		$.plot($("#chart-post"), [ d1 ], options);
	}

	$('.myflot .flot-daterange').daterangepicker({
		ranges: {
		    'Today': [moment(), moment()],
		    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
		    'Last 7 Days': [moment().subtract('days', 6), moment()],
		    'Last 30 Days': [moment().subtract('days', 29), moment()],
		    'This Month': [moment().startOf('month'), moment().endOf('month')],
		    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
      	},
		startDate: moment().subtract('days', 29),
		endDate: moment()
	}, 
	function(start, end) {
		$('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	})
})