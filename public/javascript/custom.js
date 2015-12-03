$(document).ready(function () {
    $('.input-tags').select2({
        tags: true,
        tokenSeparators: [',']
    })

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

    // $('.fileinput').on('clear.bs.fileinput', function () {
    //     // $(this).find('input[type=hidden]').val('')
    // })
    
    // $('.fileinput').on('change.bs.fileinput', function () {
    //     // $(this).find($('[name="remove_featured_image"]')).remove()
    // })

    $('.iframe-btn').fancybox({ 
        'width'     : 900,
        'height'    : 600,
        'type'      : 'iframe',
        'autoScale' : false,
        fitToView: false,
        autoSize: false,
        autoDimensions: false,
    });
    
    tinymce.init({
        selector:'.editor',
        plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true ,
           
        external_filemanager_path:baseurl+"filemanager/",
        filemanager_title:"Responsive Filemanager" ,
        external_plugins: { "filemanager" : "./../../../admin/filemanager/plugin.min.js"},
        relative_urls: false,
        remove_script_host : false
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

    // $('.switch-input.ajax').on('change', function(){
    //     var id      = $(this).val();
    //     var status    = this.checked ? 'unapprove' : 'approve';

    //     $.ajax({
    //         url: siteurl + '/comment/comment_json/status',
    //         data: {
    //             id: id,
    //             status: status,
    //         },
    //         success: function (response){

    //         }
    //     })
    // })

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