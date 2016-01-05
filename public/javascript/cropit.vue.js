$(document).ready(function () {
    Vue.component('cropit-preview', {
        template: '#cropit-preview',
        props: {
            name: {
                type: String,
                required: true
            },
            width: {
                default: 0
            },
            height: {
                default: 0
            },
            imageEmpty: {
                type: String,
                default: '/public/images/portal/img-carousel-default.jpg'
            },
            imageSrc: {
                type: String,
                default: function () {
                    return this.imageEmpty;
                }
            },
            action: {
                default: 'none'
            }
        },
        watch: {
            'action': {
                handler: function (action, lastAction) {
                    this.$parent.$broadcast('actioning', {
                        name: this.name,
                        action: action
                    });
                }
            }
        },
        methods: {
            setImage: function (imageSrc) {
                this.imageSrc = imageSrc;
                this.action = 'upload';
            },
            remove: function () {
                this.imageSrc = this.imageEmpty;
                this.action = 'remove';

                this.$parent.$broadcast('removed', this.name);
            }
        },
        events: {
            'cropped': function (imageEvent) {
                if (this.name == imageEvent.name)
                    this.setImage(imageEvent.src)
            },
            'removing': function (name) {
                if (this.name == name)
                    this.remove();
            }
        },
        ready: function () {
            if (this.imageSrc == "")
                this.imageSrc = this.imageEmpty;
        }
    })

    Vue.component('cropit-result', {
        template: '#cropit-result',
        props: {
            name: {
                type: String,
                required: true
            },
            imageSrc: {
                default: ''
            },
            action: {
                default: 'none'
            }
        },
        events: {
            'cropped': function (imageEvent) {
                if (this.name == imageEvent.name)
                    this.imageSrc = imageEvent.src;
            },
            'actioning': function (actionEvent) {
                if (this.name == actionEvent.name)
                    this.action = actionEvent.action;
            },
            'removed': function (imageName) {
                if (this.name == imageName)
                    this.imageSrc = '';
            }
        }
    })

    Vue.component('cropit-cropper', {
        template: '#cropit-cropper',
        props: {
            name: {
                type: String,
                required: true
            },
            width: {
                type: Number,
                default: 632
            },
            height: {
                type: Number,
                default: 302
            },
            imageSrc: {
                type: String,
                default: ''
            }
        },
        methods: {
            setImagePreview: function () {
                var imageEvent = {
                    name: this.name,
                    src: this.imageSrc
                }

                this.$parent.$broadcast('cropped', imageEvent);
            },
            clearCropper: function () {
                var $cropitEl = $(this.$el);
                
                $cropitEl.find('.cropit-image-preview').css('background-image', '')
            }
        },
        events: {
            'cropping': function (name) {
                if (this.name == name)
                    this.setImagePreview()
            },
            'clear': function (name) {
                if (this.name == name)
                    this.clearCropper()
            }
        },
        ready: function () {
            var that = this;
            var $cropitEl = $(this.$el);
            
            $cropitEl.cropit({
                onOffsetChange: function (offset) {
                    var imageData = $cropitEl.cropit('export');
                    that.imageSrc = imageData;
                }
            })
        }
    })

    new Vue({
        el: '#app-cropit',
        methods: {
            save: function (name) {
                this.$broadcast('cropping', name)
            },
            remove: function (name) {
                this.$broadcast('removing', name)
            },
            cancel: function (name) {
                this.$broadcast('clear', name)
            }
        }
    })

    $('.file-btn').on('click', function() {
        $(this).prev('input[type=file]').trigger('click');
    })
})
