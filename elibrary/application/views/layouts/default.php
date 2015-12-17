<?php custom_stylesheet() ?>
    <link rel="stylesheet" href="<?php echo asset('node_modules/awesomplete/awesomplete.css') ?>">
<?php endcustom_stylesheet() ?>

<?php get_header('private', array('active' => 'elibrary')) ?>

<!-- start:content -->
<div class="container content content-single content-dashboard content-elib">
    <section id="content">

        <!-- start:navbar main -->
        <?php $this->load->view('template/navbar'); ?>
        <!-- end:navbar main -->

        <!-- start:content -->
        <div class="content-elib-main">
            <?php $this->load->view('template/search'); ?>
            <hr>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 co-xs-12">
                    <?php $this->load->view('template/sidebar'); ?>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="elib-content">
                        <?php echo $template['body']; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:content -->

    </section>
</div>
<!-- emd:content -->

<?php custom_script() ?>
    <script src="<?php echo asset('node_modules/awesomplete/awesomplete.min.js') ?>"></script>
    <script src="<?php echo asset('javascript/elib.js') ?>"></script>
<?php endcustom_script() ?>

<?php get_footer('private') ?>