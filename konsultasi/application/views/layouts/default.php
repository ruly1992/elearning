<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Portal - Kemendesa</title>
        <!-- start:stylesheet -->
        <link rel="stylesheet" href="<?php echo asset('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/font-awesome/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/tether/dist/css/tether.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/scrolling-nav.css') ?>">
        <?php echo isset($template['partials']['stylesheet']) ? $template['partials']['stylesheet'] : '' ?>
        <link rel="stylesheet" href="<?php echo asset('stylesheets/app.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/responsive.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('plugins/bootstrap-switch/css/bootstrap-switch.css') ?>">
        <!-- end:stylesheet -->
    </head>
    <body id="page-top" data-spy="scroll" data-target="#navbar-main">

        <!-- start:header -->
        <header id="header">

            <?php $this->load->view('template/navbar') ?>

            <!-- start:header main -->

                <?php $slider ? $this->load->view('template/slider') : '' ?>

            <!-- end:header main -->
        </header>
        <!-- end:header -->

        <!-- start:main content -->
        <div class="container content content-single">
            <section id="content">
                               
                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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

        <?php $this->load->view('template/footer') ?>

        <!-- start:javascript -->
        <script>
            var baseurl = '<?php echo base_url(); ?>';
            var siteurl = '<?php echo site_url(); ?>';
            var homeurl = '<?php echo home_url(); ?>';
        </script>

        <script src="<?php echo asset('node_modules/jquery/dist/jquery.min.js') ?>"></script>
        <script src="<?php echo asset('node_modules/bootstrap/dist/js/bootstrap.js') ?>"></script>
        <script src="<?php echo asset('javascript/jquery.easing.min.js"') ?>"></script>
        <script src="<?php echo asset('javascript/scrolling-nav.js') ?>"></script>
        <script src="<?php echo asset('javascript/jquery.sticky.js"') ?>"></script>
        <?php echo isset($template['partials']['script']) ? $template['partials']['script'] : '' ?>
        <script src="<?php echo asset('javascript/app.js') ?>"></script>
        <!-- end:javascript -->
        <!-- start:switch -->
        <script src="<?php echo asset('plugins/bootstrap-switch/js/highlight.js') ?>"></script>
        <script src="<?php echo asset('plugins/bootstrap-switch/js/bootstrap-switch.js') ?>"></script>
        <script src="<?php echo asset('plugins/bootstrap-switch/js/main.js') ?>"></script>
        <!-- end:switch -->

    </body>
</html>
