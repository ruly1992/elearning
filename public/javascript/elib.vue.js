new Vue({
    el: '#app-meta',
    data: {
        metadata: []
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
        addMeta: function () {
            var key = this.key;

            this.metadata.push({
                key: key,
                value: ''
            })

            this.key = '';

            return false
        },
        removeMeta: function (index) {
            this.metadata.splice(index, 1)
        }
    }
})