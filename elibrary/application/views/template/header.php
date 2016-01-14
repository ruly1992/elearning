
<header id="header">
    <!-- start:header top -->
    <section id="header-top">
        <!-- start:header top -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="header-top-left">
                        <ul>
                            <li><i class="fa fa-clock"></i> <?php echo Carbon\Carbon::today()->format('d F Y') ?></li>
                            <li><a href="mailto:<?php echo config('email', 'support@desamembangun.go.id') ?>"><i class="fa fa-envelope"></i> <?php echo config('email', 'support@desamembangun.go.id') ?></a></li>
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
                <div class="navbar-logo-mobile pull-right hidden-md-up">
                    <img src="<?php echo config('site_logo', asset('images/logo.png')) ?>" alt="">
                </div>
                <div class="collapse navbar-toggleable-md" id="navbarCollapse">
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo asset('images/logo.png') ?>" alt="">
                    </a>
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo dashboard_url() ?>">DASHBOARD <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo dashboard_url('article') ?>">PORTAL</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo elib_url() ?>">ELIBRARY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo virtualclass_url() ?>">KELAS ONLINE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo forum_url() ?>">FORUM</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo konsultasi_url() ?>" class="nav-link">KONSULTASI</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo vicon_url() ?>" class="nav-link">VIRTUAL CONFERENCE</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <div class="dropdown dropdown-people">
                            <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo auth()->user()->avatar ?>" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                <a href="<?php echo dashboard_url('profile') ?>" class="dropdown-item">Profile</a>
                                <a href="<?php echo dashboard_url('sendArticle') ?>" class="dropdown-item">Artikel</a>
                                <a href="<?php echo logout_url() ?>" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <!-- end:navbar main -->
</header>