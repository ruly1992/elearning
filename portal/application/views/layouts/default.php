<?php get_header('default', compact('slider')) ?>

        <!-- start:main content -->
        <div class="container content <?php echo $single ? 'content-single' : '' ?>">
            <section id="content">

                <?php $railnews ? $this->load->view('template/railnews') : '' ?>
                
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

                        <?php $this->load->view('template/sidebar') ?>

                    </div>
                </div>
                <!-- end:content -->

            </section>
        </div>
        <!-- end:main content -->

<?php get_footer('default') ?>