$(function () {
    $('.top-submit-artikel').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top 10 Submit Artikel Terbanyak'
        },
        subtitle: {
            text: 'Desa Membangun'
        },
        xAxis: {
            categories: [
                'Paijo',
                'Tarjono',
                'Yeyem',
                'Ayuh',
                'Mayang',
                'Parmin',
                'Septiana',
                'Octa',
                'Noviantina',
                'Mawar'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Artikel '
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jumlah Artikel',
            data: [10, 70, 106, 129, 144, 176, 216, 194, 95, 54]

        }]
    });

    $('.top-aktif-kelas').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top 10 Aktif DiKelas'
        },
        subtitle: {
            text: 'Desa Membangun'
        },
        xAxis: {
            categories: [
                'Paijo',
                'Tarjono',
                'Yeyem',
                'Ayuh',
                'Septiana',
                'Octa',
                'Mayang',
                'Parmin',
                'Noviantina',
                'Mawar'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Kelas'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jumlah Kelas Di Ikuti ',
            data: [250, 70, 106, 129, 144, 176, 216, 194, 95, 54]

        }]
    });
});