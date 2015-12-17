<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Portal - <?php echo config('site_title', 'Desa Membangun') ?></title>

        <!-- start:stylesheet -->
        <link rel="stylesheet" href="<?php echo asset('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/font-awesome/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/select2/dist/css/select2.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/tether/dist/css/tether.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker-standalone.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/fancybox/dist/css/jquery.fancybox.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/glyphicon/css/glyphicon.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/app.css') ?>">
        <?php echo $custom_stylesheet ?>
        <!-- end:stylesheet -->
    </head>
    <body>

        <!-- start:header -->
        <header id="header">
            <!-- start:header top -->
            <section id="header-top">
                <!-- start:header top -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="header-top-left">
                                <ul>
                                    <li><i class="fa fa-clock"></i><?php echo Carbon\Carbon::today()->format('d F Y') ?></li>
                                    <li><a href="mailto:<?php echo config('email', 'support@desamembangun.go.id') ?>"><i class="fa fa-envelope"></i> <?php echo config('email', 'support@desamembangun.go.id') ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="header-top-right">
                                <form action="<?php echo home_url('search') ?>" method="GET">
                                    <div class="input-group">
                                        <input name="term" type="text" class="form-control" placeholder="Search for...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:header top -->
            </section>
            <!-- end:header top -->
            <!-- start:navbar main -->
            <section id="navbar-main">
                <nav class="navbar navbar-light">
                    <div class="container">
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                            &#9776;
                        </button>
                        <div class="collapse navbar-toggleable-md" id="navbarCollapse">
                            <a class="navbar-brand" href="<?php echo site_url() ?>">
                                <img src="<?php echo config('site_logo', asset('images/logo.png')) ?>" alt="">
                            </a>
                            <ul class="nav navbar-nav">
                                <li class="nav-item <?php echo $active == 'home' || empty($active) ? 'active' : '' ?>">
                                    <a class="nav-link" href="<?php echo home_url() ?>">HOME <span class="sr-only">(current)</span></a>
                                </li>
                                <?php
                                $categories = Model\Portal\Category::ordered()->parentOnly()->get();

                                foreach ($categories as $category): ?>
                                    <li class="nav-item <?php echo $active == $category->id ? 'active' : '' ?>">
                                        <a class="nav-link" href="<?php echo $category->link ?>"><?php echo strtoupper($category->name) ?></a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>    
                    </div>
                </nav>
            </section>
            <!-- end:navbar main -->

            <?php $slider ? get_view('slider') : '' ?>
        </header>
        <!-- end:header -->