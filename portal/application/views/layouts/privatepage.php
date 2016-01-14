<?php get_header('private') ?>

    <!-- start:main content -->
    <div class="container content-dashboard-user articles-dashboard content-single">
        <!-- start:content -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- start:content main -->
                <div class="content-main">
                    <?php echo $template['body'] ?>
                </div>
                <!-- end:content main -->
                    
                <!-- start:content sidebar -->
                <?php $sidebar ? $this->load->view('template/sidebar_privatepage') : ''?>
                <!-- end:content sidebar -->    

            </div>
        </div>
        <!-- end:content -->
    </div>
    <!-- end:main content -->

<?php get_footer('private') ?>
