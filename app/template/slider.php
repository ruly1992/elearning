<?php
$sliders = Model\Portal\Article::latest('date')->slider()->take(3)->get();
?>
<section id="header-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <div id="carousel-slider-top" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php if ($sliders->count() > 0): ?>
                                <?php $i = 0; foreach ($sliders as $slider): ?>
                                    <li data-target="#carousel-slider-top" data-slide-to="<?php echo $i ?>"<?php echo $i == 0 ? ' class="active"' : '' ?>></li>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                                <li data-target="#carousel-slider-top" data-slide-to="0" class="active"></li>
                            <?php endif ?>
                        </ol>
                        <div class="carousel-inner" role="listbox">

                            <?php if ($sliders->count() > 0): ?>
                                <?php $i = 1; foreach ($sliders as $slider): ?>                            
                                    <div class="carousel-item <?php echo $i == 1 ? 'active' : '' ?>">
                                        <a href="<?php echo $slider->link ?>">
                                            <img src="<?php echo $slider->slider_image ?>">
                                        </a>
                                        <div class="carousel-caption">
                                            <span class="btn btn-sm btn-category"><?php echo $slider->category_name_first ?></span>
                                            <a href="<?php echo $slider->link ?>"><h3><?php echo $slider->title ?></h3></a>
                                        </div>
                                    </div>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                                <div class="carousel-item active">
                                    <img src="<?php echo asset('images/portal/img-carousel-default.jpg') ?>">
                                    <div class="carousel-caption">
                                        <a href="#" class="btn btn-sm btn-category">NO CATEGORY</a>
                                        <a href=""><h3>Belum Ada Artikel Yang Ditampilkan</h3></a>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                        <a class="left carousel-control" href="#carousel-slider-top" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-slider-top" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="header-main-box">
                        <div class="header-main-box-content">
                            <p>Silahkan masukkan username dan password untuk Login.</p>
                            <form class="form-login" method="POST" action="<?php echo login_url() ?>">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Username / Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <label class="c-input c-checkbox">
                                    <input type="checkbox" name="remember">
                                    <span class="c-indicator"></span>
                                    Remember me
                                </label>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-login btn-block">LOGIN</button>
                                </div>
                                <div class="form group">
                                    <label for=""><a href="<?php echo site_url('auth/reset') ?>">Lupa password?</a></label>
                                </div>
                            </form>
                            <p>Kirimkan artikel anda ke redaksi kami :</p>
                            <form action="">
                                <div class="form-group">
                                    <a href="<?php echo site_url('submitarticle/') ?>" class="btn btn-sm btn-submit-artikel btn-block">SUBMIT ARTIKEL</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
