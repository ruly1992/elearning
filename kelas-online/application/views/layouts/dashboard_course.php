<?php get_header('private', array('active' => 'kelas')) ?>

    <!-- start:main content -->
    <div class="container content content-single">
        <section id="content">
                           
            <!-- start:content -->
            <div class="row">
                <div class="col-md-3">
                    <?php $this->load->view('template/sidebar_course', compact('sidebar_active', 'course')); ?>
                </div>

                <div class="col-lg-9">
                    <!-- start:content main -->
                    <div class="content-main">
                        
                        <?php echo $template['body'] ?>

                    </div>
                    <!-- end:content main -->
                </div>
            </div>
            <!-- end:content -->

        </section>
    </div>
    <!-- end:main content -->

<?php get_footer('private') ?>
