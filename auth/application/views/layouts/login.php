<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login - Kemendesa</title>
        <!-- start:stylesheet -->
        <link rel="stylesheet" href="<?php echo asset('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/font-awesome/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/app.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/responsive.css') ?>">
        <?php echo isset($template['partials']['stylesheet']) ? $template['partials']['stylesheet'] : '' ?>
        <!-- end:stylesheet -->
    </head>
    <body>
        
        <!-- start:header -->
        <?php $this->load->view('template/header'); ?>
        <!-- end:header -->

        <!-- start:main content -->
        <div class="container content content-single">
            <section id="content">
                
                <div class="login">
                    <div class="login-logo">
                        <div class="text-center">
                            <a href="#"><img src="<?php echo asset('images/portal/logo-login.png') ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="login-form">
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs12">
                                <?php echo show_message() ?>
                                <?php echo form_open(login_url()); ?>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                            <input type="text" name="email" class="form-control input-lg" placeholder="Input your email" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
                                            <input type="password" name="password" class="form-control input-lg" placeholder="Input your password" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" href="#" class="btn btn-block btn-lg btn-login">LOGIN</button>
                                    </div>
                                    <div class="form-group">
                                        <p><small>Lost your pasword? <a href="<?php echo site_url('reset') ?>">Reset Password</a></small></p>  
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>

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
                                    <li><a href="mailto:<?php echo config('email', 'support@kaderdesa.go.id') ?>"></a><i class="fa fa-envelope"></i> <?php echo config('email', 'support@kaderdesa.go.id') ?></li>
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
        <script src="<?php echo asset('node_modules/jquery/dist/jquery.min.js') ?>"></script>
        <script src="<?php echo asset('node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
        <!-- end:javascript -->
    </body>
</html>
