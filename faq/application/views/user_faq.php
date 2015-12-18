<?php get_header('faq'); ?>

        <!-- start:main content -->
        <div class="container landing-content-faq">
            <section id="content">
                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- start:content main -->
                        <?php 
                            foreach($faq as $f){
                        ?>
                            <div class="faq-content">
                                <div class="faq-content-question">
                                    <h3><em><?php echo $f->question; ?></em></h3>
                                </div>
                                <div class="faq-content-answer">
                                    <?php echo $f->answer; ?>
                                </div>
                            </div>
                        <?php
                            } 
                        ?>
                        <!-- end:content main -->
                    </div>
                </div>
                <!-- end:content -->

            </section>
        </div>
        <!-- end:main content -->
<?php get_footer('private'); ?>