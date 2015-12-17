<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>App - Kemendesa</title>
    <!-- start:stylesheet -->
    <link rel="stylesheet" href="<?php echo asset('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('node_modules/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('node_modules/awesomplete/awesomplete.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('stylesheets/app.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('stylesheets/responsive.css') ?>">
    <?php echo isset($template['partials']['stylesheet']) ? $template['partials']['stylesheet'] : '' ?>
    <!-- end:stylesheet -->
</head>
<body id="page-top" data-spy="scroll" data-target="#navbar-main">

<!-- start:header -->
<?php $this->load->view('template/header'); ?>
<!-- end:header -->

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

<?php $this->load->view('template/footer'); ?>

    <!-- start:javascript -->
    <script>
        var baseurl = '<?php echo base_url(); ?>';
        var siteurl = '<?php echo site_url(); ?>';
        var homeurl = '<?php echo home_url(); ?>';
    </script>

    <script src="<?php echo asset('node_modules/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/awesomplete/awesomplete.min.js') ?>"></script>
    <script src="<?php echo asset('javascript/jquery.sticky.js') ?>"></script>
    <script src="<?php echo asset('javascript/app.js') ?>"></script>
    <?php echo isset($template['partials']['script']) ? $template['partials']['script'] : '' ?>
    <script src="<?php echo asset('javascript/elib.js') ?>"></script>
    <!-- end:javascript -->

</body>
</html>