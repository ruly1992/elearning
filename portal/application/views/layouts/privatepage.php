<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Portal - Kemendesa</title>

        <link rel="stylesheet" href="<?php echo asset('node_modules/select2/dist/css/select2.min.css') ?>">
        <!-- start:stylesheet -->        

        <link rel="stylesheet" href="<?php echo asset('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/font-awesome/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/tether/dist/css/tether.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker-standalone.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/glyphicon/css/glyphicon.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/app.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/fancybox/dist/css/jquery.fancybox.css') ?>">
        <link href="<?php echo asset('admin/plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('admin/plugins/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">


        <!-- end:stylesheet -->
    </head>
    <body>

     <?php $this->load->view('template/header_privatepage') ?>

        <!-- start:main content -->
        <div class="container content content-dashboard content-single">
        
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

        <!-- start:footer -->
        <footer>
            <div class="container">
                <!-- start:footer top -->
                <div class="footer-top">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="footer-top-left">
                                <ul>
                                    <li><i class="fa fa-clock-o"></i><?php echo date('l, d M Y') ?></li>
                                    <li><a href="mailto:support@kaderdesa.go.id"></a><i class="fa fa-envelope"></i> support@kaderdesa.go.id</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="footer-top-right">
                                <ul>
                                    <li>Follow Me:</li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                    <li><a href="#"><i class="fa fa-send-o"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:footer top -->
                <!-- start:footer logo -->
                <div class="footer-logo">
                    <div class="text-center">
                        <a href="#"><img src="<?php echo asset('images/portal/logo_portal_bottom.png') ?>" alt=""></a>
                    </div>
                </div>
                <!-- end:footer logo -->
                <!-- start:footer bottom -->
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="footer-bottom-left">
                                <p>Copyright 2015 &copy;. KaderDesa.go.id</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="footer-bottom-right">
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">FAQ</a></li>
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

        <script src="<?php echo asset('plugins/tinymce/tinymce.jquery.min.js') ?>"></script>
        <script src="<?php echo asset('javascript/jquery.nestable.js') ?>"></script>
        <script src="<?php echo asset('javascript/jquery.sticky.js') ?>"></script>
        <script src="<?php echo asset('javascript/app.js') ?>"></script>
        <script src="<?php echo asset('javascript/analytic.js') ?>"></script>

        <script src="<?php echo asset('admin/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/datatables/js/dataTables.bootstrap.min.js') ?>"></script>
        <script src="<?php echo asset('javascript/custom.js') ?>"></script>

        <!-- end:javascript -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#article').DataTable();
            } );

            $(document).ready(function() {
                $('#publish').DataTable();
            } );
        </script>   
    </body>
</html>
