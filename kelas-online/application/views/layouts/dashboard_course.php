<?php get_header('private', array('active' => 'kelas')) ?>

    <!-- start:main content -->
    <div class="container content content-single content-dashboard content-kelas-online">
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
                    <?php $this->load->view('template/sidebar_course', compact('sidebar_active', 'course')); ?>
                </div>

            </div>
            <!-- end:content -->

        </section>
    </div>
    <!-- end:main content -->

<?php get_footer('private') ?>
