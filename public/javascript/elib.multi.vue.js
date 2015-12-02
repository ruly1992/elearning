new Vue({
    el: '#app-meta-multi',
    data: {
        metadata: [],
        media: []
    },
    ready: function () {
        var self = this;
        var app = this.$el;

        $.ajax({
            url: siteurl + 'media/getmetadata',
            data: {
                media_id: $(app).data('media-id')
            },
            success: function (response) {
                self.metadata = response
            }
        })
    },
    methods: {
        addMeta: function (media_id) {
            var key = this['key' + media_id];
            var metadata = this.metadata['media' + media_id]

            this.metadata['media' + media_id].push({
                key: key,
                value: ''
            })

            this['key' + media_id] = '';

            return false
        },
        removeMeta: function (media_id, index) {
            this.metadata['media' + media_id].splice(index, 1)
        },
        saveToPublish: function (media_id, event) {
            var parent = this
            var target = $(event.target);
            var panel = target.parent().parent('.panel')

            var form = $('#form-media-' + media_id).ajaxSubmit({
                success: function (responseText, statusText, xhr, $form) {
                    $.ajax({
                        url: target.attr('href'),
                        success: function (response) {
                            panel.find('.btn-minimize').trigger('click')

                            // panel = '<span class="label label-success">publish</span>'
                        }
                    })
                }
            })

            return false
        },
        saveToDraft: function (media_id, event) {
            var target = $(event.target);
            var panel = target.parent().parent('.panel')

            var form = $('#form-media-' + media_id).ajaxSubmit({
                success: function (responseText, statusText, xhr, $form) {
                    $.ajax({
                        url: target.attr('href'),
                        success: function (response) {
                            panel.find('.btn-minimize').trigger('click')
                        }
                    })
                }
            })

            return false
        }
    }
})