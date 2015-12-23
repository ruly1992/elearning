$(document).ready(function () {
    $('.input-tags').select2({
        tags: true,
        tokenSeparators: [',']
    })

    $('select.select2').select2()

    $('.btn-visit-home').on('click', function (e) {
        e.preventDefault();
        var url = $(this).data('href'); 
        window.open(url, '_blank');
    })

    $('.btn-delete').on('click', function () {
        return confirm('Are you sure?');
    })

    $('.datetimepicker').datetimepicker({
        format: 'YYYY/MM/DD HH:mm:ss'
    })

    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    })

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target);

        if (window.JSON) {
            return (window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            return ('JSON browser support required for this demo.');
        }
    };

    $('#nestable-category').nestable({ /* config options */ })
    $('#nestable-category').on('change', function (e) {
        // var nestable = $(this).nestable('serialize');
        var nestable = updateOutput(e);

        $.ajax({
            url: siteurl + '/kategori/nestable',
            data: {nestable_json: nestable},
            success: function (response) {
                console.log(response)
                // document.write(response)
            }
        })
    })
    
    $('#article').DataTable();
    $('#publish').DataTable();

    $('.iframe-btn').fancybox({ 
        'width'     : 900,
        'height'    : 600,
        'type'      : 'iframe',
        'autoScale' : false,
        fitToView: false,
        autoSize: false,
        autoDimensions: false,
    });

    $('.switch-input.ajax').on('change', function () {
        var id      = $(this).val();
        var type    = this.checked ? 'private' : 'public';

        $.ajax({
            url: siteurl + '/article/json/type',
            data: {
                id: id,
                type: type,
            },
            success: function (response) {
                
            }
        })
    })

    $('.open-schedule').on('click', function () {
        var input_schedule = $('.input-schedule');
        input_schedule.append('<input type="hidden" name="with_schedule" value="1">')

        input_schedule.show('slow')
    })

    $('.close-schedule').on('click', function () {
        var input_schedule = $('.input-schedule');
        input_schedule.find('[name="with_schedule"]').remove()

        input_schedule.hide('slow')

        return false;
    })

    var url = siteurl + '/user/wilayah';var loading = 'Loading...';
    $(document).ready(function () {
        $('#kota').remoteChained({
            parents: '#provinsi',
            url: url,
            loading : loading
        })

        $('#kecamatan').remoteChained({
            parents: '#provinsi, #kota',
            url: url,
            loading : loading
        })

        $('#desa').remoteChained({
            parents: '#provinsi, #kota, #kecamatan',
            url: url,
            loading : loading
        })
    })
})