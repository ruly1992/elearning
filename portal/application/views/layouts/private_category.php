<?php get_header('private', ['active' => 'artikel']) ?>

    <!-- start:main content -->
    <div class="container content content-single">
        <section id="content">
            <!-- start:content -->
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <!-- start:content main -->
                    <div class="content-main">
                        <?php echo $template['body'] ?>
                    </div>
                    <!-- end:content main -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!-- start:content sidebar -->
                    <?php $this->load->view('template/sidebar_privatepage') ?>
                    <!-- end:content sidebar -->    

                </div>
            </div>
            <!-- end:content -->
        </section>
    </div>
    <!-- end:main content -->

<?php get_footer('private') ?>