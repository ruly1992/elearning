<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
	    <meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Forum - Kemendesa</title>
		<!-- start:stylesheet -->
	    <link rel="stylesheet" href="<?php echo asset('node_modules/bootstrap/dist/css/bootstrap.min.css'); ?>">
	    <link rel="stylesheet" href="<?php echo asset('node_modules/font-awesome/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/app.css'); ?>">
        <link rel="stylesheet" href="<?php echo asset('stylesheets/responsive.css'); ?>">
        <link rel="stylesheet" href="<?php echo asset('plugins/sceditor/minified/themes/default.min.css'); ?>" type="text/css" media="all" />
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
                                    <a class="nav-link" href="#">DASHBOARD <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">PORTAL</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">KELAS ONLINE</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">FORUM</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">KONSULTASI</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">VIRTUAL CONFERENCE</a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav pull-right">
                                <div class="dropdown dropdown-people">
                                    <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo asset('images/portal/people-2.png'); ?>" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </nav>
            </section>
            <!-- end:navbar main -->
        </header>
        <!-- end:header -->

        <!-- start:content -->
        <div class="container content content-single content-dashboard content-forum">
            <section id="content">

                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <!-- start:content main -->
                        <div class="content-main">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                                <li><a href="#"><?php echo $category; ?></a></li>
                                <li class="active"><?php echo $title; ?></li>
                            </ol>

                            <div class="forum-main">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="card-header-img">
                                                    <img src="<?php echo asset('images/portal/people-1.png'); ?>" alt="">
                                                    <p><small><a href="#">@chanchandrue <?php echo $user; ?></a></small></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="card-header-meta pull-right">
                                                    <p><?php echo $tanggal; ?> <i class="fa fa-calendar"></i></p>
                                                    <p><?php echo $countReply; ?> <i class="fa fa-comments"></i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="card-block-title">
                                            <h4><?php echo $title; ?></h4>
                                        </div>
											<img src="<?php echo asset('images/portal/img-carousel.jpg');?>" class="img-fluid" alt="">
											<p>
                                                <?php echo $message; ?>
                                            </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-sm btn-reply">Reply Post</a>
                                    </div>
                                </div>
                                <?php 
                                    foreach($reply as $r){
                                ?>
                                <div class="card" id="<?php echo $r->id; ?>">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="card-header-img">
                                                    <img src="<?php echo asset('images/portal/people-1.png');?>" alt="">
                                                    <p><small><a href="#">@chanchandrue</a></small></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="card-header-meta pull-right">
                                                    <p><?php echo $r->created_at; ?> <i class="fa fa-calendar"></i></p>
                                                    <!--<p>201 <i class="fa fa-comments"></i></p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <p><?php echo $r->message ;?></p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-sm btn-reply">Quote Reply</a>
                                    </div>
                                </div>
                                <?php      
                                    }
                                ?>
                                <div class="card">
                                    <div class="card-header">
                                         <p>in reply to : <a href="#"><?php echo $title; ?></a></p>
                                    </div>
                                    <div class="card-block">
                                       
                                        <?php echo form_open('thread/replyThread/'.$id); ?>
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" class="form-control" required name="title" required placeholder="type your title">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Message</label>
                                                <textarea name="message" required id="" cols="30" rows="10" class="form-control" placeholder="type your message"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-post">POST REPLY</button>
                                            </div>
                                        <?php echo form_close(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:content main -->
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="sidebar-forum">
                            <div class="widget">
                                <div class="widget-categories">
                                    <div class="widget-categories-heading">
                                        <h4>Categories</h4>
                                    </div>
                                    <div class="widget-categories-content">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item active">
                                                <span class="label label-default label-pill pull-right">14</span> All Categories
                                            </a>
                                            <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> Video Conferences</a>
                                            <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> Kelas Online</a>
                                            <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> E-Library</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:content -->

            </section>
        </div>
        <!-- emd:content -->

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
	    <script src="<?php echo asset('node_modules/bootstrap/dist/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo asset('javascript/jquery.sticky.js');?>"></script>
        <script src="<?php echo asset('javascript/app.js');?>"></script>
        <script src="<?php echo asset('plugins/sceditor/development/jquery.sceditor.bbcode.js'); ?>"></script>
        <script>
            $(function() {
                $("textarea").sceditor({
                    plugins: "bbcode",
                    style: "<?php echo asset('plugins/sceditor/minified/jquery.sceditor.default.min.css'); ?>" ,
                    emoticonsCompat: true,
                    emoticonsRoot : "<?php echo asset('plugins/sceditor//'); ?>"
                });
            });
        </script>
	    <!-- end:javascript -->

	</body>
</html>