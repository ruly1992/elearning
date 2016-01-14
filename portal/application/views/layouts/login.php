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
        <link rel="stylesheet" href="<?php echo asset('stylesheets/app.css') ?>">
        <!-- end:stylesheet -->
    </head>
    <body id="page-top" data-spy="scroll" data-target="#navbar-main">

        <!-- start:header -->
        <header id="header">

            <?php $this->load->view('template/navbar') ?>
            
        </header>
        <!-- end:header -->

        <!-- start:main content -->
        <div class="container content <?php echo $single ? 'content-single' : '' ?>">
            <section id="content">

                <?php echo $template['body'] ?>

            </section>
        </div>
        <!-- end:main content -->

        <?php $this->load->view('template/footer') ?>

        <!-- start:javascript -->
        <script src="<?php echo asset('node_modules/jquery/dist/jquery.min.js') ?>"></script>
        <script src="<?php echo asset('node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo asset('javascript/jquery.sticky.js') ?>"></script>
        <script src="<?php echo asset('javascript/app.js') ?>"></script>
        <!-- end:javascript -->
    </body>
</html>
