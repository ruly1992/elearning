
<!-- start:footer -->
<footer>
    <div class="container">
        <!-- start:footer top -->
        <div class="footer-top">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="footer-top-left">
                        <ul>
                            <li><i class="fa fa-clock-o"></i><?php echo Carbon\Carbon::today()->format('l, d F Y') ?></li>
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
                <a href="<?php echo site_url() ?>"><img src="<?php echo config('site_logo', asset('images/portal/logo_portal_bottom.png')) ?>" alt=""></a>
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