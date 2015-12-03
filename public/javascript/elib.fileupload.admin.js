$(function () {
    var fileupload = $('#fileuploader').uploadFile({
        url: $('#fileuploader').data('url'),
        fileName: 'filemedia',
        multiple: true,
        autoSubmit: false,
        statusBarWidth: '100%',
        dragdropWidth: '100%',
        showPreview: true,
        previewHeight: "100px",
        previewWidth: "100px",

        afterUploadAll: function(obj)
        {
            console.log(obj)
            var responses = obj.responses;
            var ids = jQuery.map(responses, function (json, index) {
                var data = jQuery.parseJSON(json)
                return data[0].id
            })

            // window.location.href = siteurl + 'elibrary/edits/' + $('#fileuploader').data('category-id');
            window.location.href = siteurl + 'elibrary/edits?media_id=' + ids.join(',');
        },
    })

    $("#extrabutton").click(function() {
        fileupload.startUpload();
    });
});