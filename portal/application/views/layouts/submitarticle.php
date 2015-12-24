<?php get_header('default') ?>

    <!-- start:main content -->
    <div class="container content-dashboard-user articles-dashboard content-single" id="app-cropit">
        <!-- start:content -->
        <div class="row content-submit">
            <?php echo form_open('submitarticle'); ?>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <!-- start:content main -->
                    <div class="content-main">
                        
                        <?php echo $template['body'] ?>

                    </div>
                    <!-- end:content main -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                    <?php $this->load->view('template/sidebar_submitarticle', compact('category_lists')); ?>

                </div>
            <?php echo form_close(); ?>
        </div>
        <!-- end:content -->
    </div>
    <!-- end:main content -->

    <?php custom_script() ?>
    <template id="cropit-preview">
        <div class="image-preview image-{{ name }}">
            <img src="{{ imageSrc }}" width="{{ width }}" height="{{ height }}" class="img img-responsive img-thumbnail">
        </div>
        <slot name="button-select">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cropit-{{ name }}">Select Image</button>
        </slot>
        <slot name="button-remove">
            <button type="button" class="btn btn-danger" v-on:click="remove">Remove</button>
        </slot>
    </template>

    <template id="cropit-result">
        <input type="hidden" name="{{ name }}[src]" value="{{ imageSrc }}">
        <input type="hidden" name="{{ name }}[action]" value="{{ action }}">
    </template>

    <template id="cropit-cropper">
        <div class="cropit-{{ name }}">
            <div class="cropit-image-preview-container">
                <div class="cropit-image-preview" style="width: {{ width }}px; height: {{ height }}px;"></div>
            </div>

            <div class="image-size-label">
                Resize image
            </div>
            <input type="range" class="cropit-image-zoom-input">

            <br>

            <input type="hidden" name="{{ name }}" class="cropit-{{ name }}-imagedata">        
            <button type="button" class="btn btn-primary file-btn">
                <span>Browse</span>
                <input type="file" class="cropit-image-input">
            </button>
        </div>
    </template>

    <script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
    <script src="<?php echo asset('javascript/cropit.vue.js') ?>"></script>
    <?php endcustom_script() ?>

<?php get_footer('default') ?>