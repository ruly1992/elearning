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
    <?php $this->load->view('template/vue_cropit'); ?>

    <script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
    <script src="<?php echo asset('javascript/cropit.vue.js') ?>"></script>
    <?php endcustom_script() ?>

<?php get_footer('default') ?>