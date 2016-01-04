    <!-- start:footer -->
    <footer>
        <div class="container">
            <!-- start:footer top -->
            <div class="footer-top">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="footer-top-left">
                            <ul>
                                <li><i class="fa fa-clock"></i> <?php echo Carbon\Carbon::today()->format('d F Y') ?></li>
                                <li><a href="mailto:<?php echo config('email', 'support@desamembangun.go.id') ?>"></a><i class="fa fa-envelope"></i> <?php echo config('email', 'support@desamembangun.go.id') ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="footer-top-right">
                            <ul>
                                <li>Follow Me:</li>
                                <?php if (config('facebook')): ?>
                                    <li><a href="<?php echo config('facebook') ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <?php endif ?>

                                <?php if (config('twitter')): ?>
                                    <li><a href="<?php echo config('twitter') ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <?php endif ?>

                                <?php if (config('youtube')): ?>
                                    <li><a href="<?php echo config('youtube') ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                                <?php endif ?>

                                <?php if (config('rss')): ?>
                                    <li><a href="<?php echo config('rss') ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
                                <?php endif ?>

                                <li><a href="mailto:<?php echo config('email', 'support@desamembangun.go.id') ?>"><i class="fa fa-send-o"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end:footer top -->
            <!-- start:footer logo -->
            <div class="footer-logo">
                <div class="text-center">
                    <a href="<?php echo home_url() ?>"><img src="<?php echo asset('images/logo-bottom.png') ?>" alt=""></a>
                </div>
            </div>
            <!-- end:footer logo -->
            <!-- start:footer bottom -->
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="footer-bottom-left">
                            <p>Copyright 2015 &copy; <?php echo config('domain', 'DesaMembangun.go.id') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="footer-bottom-right">
                            <ul>
                                <li><a href="<?php echo home_url() ?>">Home</a></li>
                                <li><a href="<?php echo home_url('about-us') ?>">About Us</a></li>
                                <li><a href="<?php echo home_url('contact-us') ?>">Contact Us</a></li>
                                <li><a href="<?php echo home_url('faq') ?>">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end:footer bottom -->
        </div>
    </footer>
    <!-- end:footer --> 

    <!-- start:javascript -->
    <script>
        var baseurl = '<?php echo base_url(); ?>';
        var siteurl = '<?php echo site_url(); ?>';
        var homeurl = '<?php echo home_url(); ?>';
    </script>

    <script src="<?php echo asset('node_modules/jquery/dist/jquery.min.js') ?>"></script>   
    <script src="<?php echo asset('node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/jquery-chained/jquery.chained.remote.js') ?>"></script>
    <script src="<?php echo asset('node_modules/moment/moment.js') ?>"></script>
    <script src="<?php echo asset('node_modules/select2/dist/js/select2.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/fancybox/dist/js/jquery.fancybox.pack.js') ?>"></script>
    <script src="<?php echo asset('node_modules/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

    <script src="<?php echo asset('javascript/jquery.easing.min.js') ?>"></script>
    <script src="<?php echo asset('javascript/scrolling-nav.js') ?>"></script>
    <script src="<?php echo asset('javascript/jquery.nestable.js') ?>"></script>
    <script src="<?php echo asset('javascript/jquery.sticky.js') ?>"></script>
    <script src="<?php echo asset('javascript/app.js') ?>"></script>
    <script src="<?php echo asset('javascript/analytic.js') ?>"></script>

    <script src="<?php echo asset('admin/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo asset('plugins/datatables/js/dataTables.bootstrap.min.js') ?>"></script>

    <?php echo $custom_script ?>
    
    <script src="<?php echo asset('javascript/custom.js') ?>"></script>
    <!-- end:javascript -->
</body>
</html>