$(document).ready(function () {
    tinymce.init({
        selector:'.editor',
        plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: " link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true ,
    });

    $('.cropit-custom-avatar').cropit({
        imageState: {
            src: baseurl + '/public/images/default_avatar_male.jpg',
        },
        onOffsetChange: function (offset) {
            var inputImagedata  = $('input.cropit-custom-avatar-imagedata')
            var imageData       = $('.cropit-custom-avatar').cropit('export')

            inputImagedata.val(imageData)
        }
    });

    $('.cropit-featured').cropit({
        imageState: {
            src: baseurl + '/public/images/portal/img-carousel-default.jpg',
        },
        onOffsetChange: function (offset) {
            var inputImagedata  = $('input.cropit-featured-imagedata')
            var imageData       = $('.cropit-featured').cropit('export')

            inputImagedata.val(imageData)
        }
    });

    $('.cropit-export').on('click', function () {
        var cropitSelector  = $(this).data('cropit-element')
        var cropitEl        = $(cropitSelector)
        var imgData         = cropitEl.cropit('export')

        window.open(imgData)

        return false
    })
})