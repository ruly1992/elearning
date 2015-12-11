<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>FAQ - Kemendesa</title>
        <!-- start:stylesheet -->
        <link rel="stylesheet" href="<?php echo asset('node_modules/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/tether/dist/css/tether.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/scrolling-nav.css'); ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/app.css'); ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/responsive.css'); ?>">
        <!-- end:stylesheet -->
    </head>
    <body id="page-top" data-spy="scroll" data-target="#navbar-main">

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
                                    <li><i class="fa fa-clock"></i> Senin, 9 December 2015</li>
                                    <li><a href="@mailto:support@kaderdesa.go.id"><i class="fa fa-envelope"></i> support@kaderdesa.go.id</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="header-top-right">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
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
                            <a class="navbar-brand" href="#">
                                <img src="<?php echo asset('images/portal/logo_kader.png'); ?>" alt="">
                            </a>
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">KADER</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">OPINI DAN ANALISA</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">GELIAT DESA</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">SIASAT</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">KEARIFAN LOKAL</a>
                                </li>
                                <li class="nav-item active">
                                    <a href="#" class="nav-link">FAQ</a>
                                </li>
                            </ul>
                        </div>    
                    </div>
                </nav>
            </section>
            <!-- end:navbar main -->
            <!-- start:header main -->
            <section id="header-main">
                <div class="container">
                    <div class="row">
                        <div class="dashboard-faq">
                            <h3><em>FAQ (Frequently Asked Question)</em></h3>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end:header main -->
        </header>
        <!-- end:header -->

        <!-- start:main content -->
        <div class="container content-faq">
            <section id="content">

                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- start:content main -->
                        <div class="content-main-faq">
							<div class="form-group">
                                <?php echo anchor('faq/create','<i class="fa fa-plus"></i> FAQ Baru','class="btn btn-primary btn-sm"'); ?>
                            </div>
                            <?php 
                                if(isset($failed)){
                                    echo '<div class="alert alert-danger">';
                                        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                        echo '<strong>Warning!</strong> '.$failed;
                                    echo '</div>';
                                }elseif(isset($success)){
                                    echo '<div class="alert alert-info">';
                                        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                        echo '<strong>Success!</strong> '.$success;
                                    echo '</div>';
                                }
                            ?>
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Title</th>
                                  <th>Pertanyaan</th>
                                  <th>Jawaban</th>
                                  <th>Time Create</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no=1;
                                    foreach($faq as $f){
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $no; ?></th>
                                        <th><?php echo $f->title; ?></th>
                                        <td><p><?php echo $f->question; ?></p></td>
                                        <td><p><?php echo $f->answer; ?></p></td>
                                        <td><p><?php echo $f->created_at; ?></p></td>
                                        <td align="center">
                                            <?php echo anchor('faq/edit/'.$f->id, 'Edit', 'class="btn btn-info btn-konsul" data-toggle="tooltip" data-placement="top" title="Edit"'); ?>
                                            <?php echo anchor('faq/delete/'.$f->id, 'Delete', 'class="btn btn-danger btn-konsul" data-toggle="tooltip" data-placement="top" title="Hapus"'); ?>
                                        </td>
                                    </tr>
                                <?php
                                        $no+=1;
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                        </div>
                        <!-- end:content main -->
                    </div>
                </div>
                <!-- end:content -->

            </section>
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
                                    <li><i class="fa fa-clock-o"></i> Senin, 09 December 2015</li>
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
                        <a href="#"><img src="<?php echo asset('images/portal/logo_portal_bottom.png'); ?>" alt=""></a>
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
        <script src="<?php echo asset('node_modules/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo asset('node_modules/bootstrap/dist/js/bootstrap.js'); ?>"></script>
        <script src="<?php echo asset('javascript/jquery.easing.min.js'); ?>"></script>
        <script src="<?php echo asset('javascript/scrolling-nav.js'); ?>"></script>
        <script src="<?php echo asset('javascript/jquery.sticky.js'); ?>"></script>
        <script src="<?php echo asset('javascript/app.js'); ?>"></script>
    </body>
</html>
