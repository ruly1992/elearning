$(function () {
    function fc(name, type, placeholder) {
        if (type == '')
            type = 'text';

        var input = $('<input>', {
            class: 'form-control',
            id: name,
            name: name,
            type: type,
            placeholder: placeholder
        })

        return input;
    }

    function fg(name, label, placeholder) {
        var fgroup = $('<div></div>', {
            class: 'form-group'
        })

        if (label) {
            var flabel = $('<label></label>', {
                class: 'control-label',
                for: name
            }).append(label)
        } else {
            var flabel = null;
        }

        var finput = fc(name)
        var result = fgroup.append(flabel).append(finput)

        return result;
    }

    function fa(name, size) {
        if (size == '')
            size = 'md';

        return $('<i></i>', {
            class: 'fa fa-' + name + ' fa-' + size
        })
    }

    function addMetaStatus(key, value) {
        var tr = $('<tr></tr>')
        var tdKey = $('<td></td>').append(key)
        var tdVal = $('<td></td>').append(fc('meta['+key+']'))
        var tdAct = $('<td></td>').append(
            $('<button></button>', {class: 'btn btn-danger btn-row-remove'}).append(
                fa('trash-o', 'xs')
            ))
        var result = tr.append(tdKey).append(tdVal).append(tdAct)

        result.on('click', '.btn-row-remove', function () {
            tr.remove()

            return false;
        })

        return result;
    }

    function tmeta() {
        var table = $('<table></table>', {class: 'table table-bordered table-hover table-metadata'})

        table.append(
            $('<thead></thead>').append(
                $('<tr></tr>')
                    .append(
                        $('<th></th>').append('Meta Key')
                    )
                    .append(
                        $('<th></th>').append('Meta Value')
                    )
                    .append(
                        $('<th></th>').append('&nbsp;')
                    )
            )
        )

        table.append(addMetaStatus('filename'))
        table.append(addMetaStatus('size'))

        return table;
    }

    var count = 0;
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

            window.location.href = siteurl + 'media/edit/' + ids.join('');
            // window.location.href = siteurl + 'media/show/' + $('#fileuploader').data('category-id');
        },

    //     customProgressBar: function(obj,s)
    //     {
    //         this.statusbar = $("<div class='ajax-file-upload-statusbar'></div>");
    //         this.preview = $("<img class='ajax-file-upload-preview' />").width(s.previewWidth).height(s.previewHeight).appendTo(this.statusbar).hide();
    //         this.filename = $("<div class='ajax-file-upload-filename'></div>").appendTo(this.statusbar);

    //         tabletmeta = tmeta().appendTo(this.statusbar)

    //         this.progressDiv = $("<div class='ajax-file-upload-progress'>").appendTo(this.statusbar).hide();
    //         this.progressbar = $("<div class='ajax-file-upload-bar'></div>").appendTo(this.progressDiv);

    //         addfield = $('<div></div>', {class: 'input-group'})
    //             .append(fc('keyadd'))
    //             .append($('<span></span>', {class: 'input-group-btn'})
    //                 .append($('<button></button>', {class: 'btn btn-primary add-row-meta'})
    //                     .append(fa('plus'))
    //                     .append('Tambah Meta')
    //                 )
    //             )
    //             .appendTo(this.statusbar)

    //         this.statusbar.on('click', '.add-row-meta', function () {
    //             var input = addfield.find('[name=keyadd]')
    //             var key = input.val()
    //             tabletmeta.find('tbody').append(addMetaStatus(key))
    //             input.val('')
    //         })

    //         this.abort = $("<div>" + s.abortStr + "</div>").appendTo(this.statusbar).hide();
    //         this.cancel = $("<button class='btn btn-danger'>" + s.cancelStr + "</button>").appendTo(this.statusbar).hide();
    //         this.done = $("<div>" + s.doneStr + "</div>").appendTo(this.statusbar).hide();
    //         this.download = $("<div>" + s.downloadStr + "</div>").appendTo(this.statusbar).hide();
    //         this.del = $("<div>" + s.deletelStr + "</div>").appendTo(this.statusbar).hide();
            
    //         this.abort.addClass("custom-red");
    //         this.done.addClass("custom-green");
    //         this.download.addClass("custom-green");            
    //         this.cancel.addClass("custom-red");
    //         this.del.addClass("custom-red");

    //         if(count++ %2 ==0)
    //             this.statusbar.addClass("even");
    //         else
    //             this.statusbar.addClass("odd"); 
            
    //         return this;
    //     }
    })

    $("#extrabutton").click(function() {
        fileupload.startUpload();
    });
    // $('#fileupload').fileupload({
    //     dataType: 'json',
    //     error: function (e, data) {
    //     	document.write(e.responseText)
    //     	console.log(e);
    //     },
    //     done: function (e, data) {
    //     	console.log(data);

    //     	var results = $('.results')

    //     	$.ajax({
    //     		url: siteurl + 'media/uploadsingle/' + data.result.id,
    //     		success: function (response) {
    //     			results.append(response)
    //     		}
    //     	});
    //     }
    // });
});