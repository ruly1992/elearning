$(document).ready(function() {
    function gd(year, month, day) {
        return new Date(year, month, day).getTime();
    }

    if ($("#chart-visitor").length) {
        var dataVisitor = [];

        function onDataReceivedVisitor(data) {
            dataVisitor = data;

            function flotVisitorDate(start, end) {
                var date    = start;
                var dateMax = end;

                $.plot($("#chart-visitor"), [ dataVisitor ], {
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d/%m/%Y",
                        min: date.valueOf(),
                        max: dateMax.valueOf()
                    }
                });
            }

            function flotVisitorDay(y, m, d) {
                var date    = moment([y, m-1, d]).hour(0);
                var dateMax = date.clone().endOf('day');

                $.plot($("#chart-visitor"), [ dataVisitor ], {
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "hour"],
                        timeformat: "%H",
                        min: date.valueOf(),
                        max: dateMax.valueOf()
                    }
                });
            }

            function flotVisitorWeekly(y, m, d) {
                var date    = moment([y, m-1, d]);
                var dateMax = date.clone().add(1, 'w');

                $.plot($("#chart-visitor"), [ dataVisitor ], {
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d/%m/%Y",
                        min: date.valueOf(),
                        max: dateMax.valueOf()
                    }
                });
            }

            flotVisitorDate(moment().startOf('month'), moment().endOf('month'));            

            $('.myflot .flot-daterange').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month')
            }, 
            function(start, end) {
                $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                flotVisitorDate(start, end);
            })
        }
        
        function fetchDataVisitor() {
            $.ajax({
                url: siteurl + '/api/visitor',
                success: onDataReceivedVisitor
            })
        }

        fetchDataVisitor();
    }

    if ($("#chart-post").length) {
        var dataPost = [];

        function onDataReceivedPost(data) {
            dataPost = data;

            function flotPostDate(start, end) {
                var date    = start;
                var dateMax = end;

                $.plot($("#chart-post"), [ dataPost ], {
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d/%m/%Y",
                        min: date.valueOf(),
                        max: dateMax.valueOf()
                    }
                });
            }

            function flotPostDay(y, m, d) {
                var date    = moment([y, m-1, d]).hour(0);
                var dateMax = date.clone().endOf('day');

                $.plot($("#chart-Post"), [ dataPost ], {
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "hour"],
                        timeformat: "%H",
                        min: date.valueOf(),
                        max: dateMax.valueOf()
                    }
                });
            }

            function flotPostWeekly(y, m, d) {
                var date    = moment([y, m-1, d]);
                var dateMax = date.clone().add(1, 'w');

                $.plot($("#chart-Post"), [ dataPost ], {
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d/%m/%Y",
                        min: date.valueOf(),
                        max: dateMax.valueOf()
                    }
                });
            }

            flotPostDate(moment().startOf('month'), moment().endOf('month'));            

            $('.myflot .flot-daterange-post').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month')
            }, 
            function(start, end) {
                $('#daterange-post span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                flotPostDate(start, end);
            })
        }
        
        function fetchDataPost() {
            $.ajax({
                url: siteurl + '/api/post',
                success: onDataReceivedPost
            })
        }

        fetchDataPost();
    }
})