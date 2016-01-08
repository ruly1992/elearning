<div class="content-left">
    <div class="content-title">
        <h1><?php echo $course->name ?></h1>
    </div>
    <?php if ($course->hasFeatured()): ?>
        <div class="content-featured-img">
            <img src="<?php echo $course->featured_image ?>" alt="">
        </div>
    <?php endif ?>
    <div class="content-main">
        <?php echo $course->description ?>
        <div class="bookmark">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="bookmark-social">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="bookmark-button">
                        <?php if ($repository->isMember('pending')): ?>
                            <a href="#" class="btn btn-sm btn-bookmark">WAITING APPROVE INSTRUCTOR</a>
                        <?php elseif ($repository->isMember('active')): ?>
                            <a href="<?php echo site_url('course/chapter/'.$course->slug) ?>" class="btn btn-sm btn-bookmark">START COURSE</a>
                        <?php else: ?>
                            <a href="<?php echo site_url('course/join/'.$course->slug) ?>" class="btn btn-sm btn-bookmark">JOIN THIS COURSE</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-lesson">
        <div class="content-lesson-title">
            <h3>CHAPTERS</h3>
        </div>
        <?php $numb = 1; foreach ($course->chapters as $chapter): ?>
            <a href="#" class="btn btn-block disabled text-xs-left">
                <div class="card card-grey">
                    <div class="card-block">
                        <span>CHAPTER <?php echo $numb ?></span>
                        <h4><?php echo $chapter->name ?></h4>
                    </div>
                </div>
            </a>
        <?php $numb++; endforeach ?>
    </div>
    <br><br>
    <div class="content-course-forum">
        <div class="content-course-forum-title">
            <h3>COURSE FORUM</h3>
        </div>
        <div class="content-course-forum-main">
            <p>There are 3 reviews on this course</p>
            <ul class="list-course-forum">
                <li>
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <div class="text-center">
                                <img src="<?php echo asset('images/portal/people-1.png') ?>" alt="">
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <div class="meta">
                                <p><strong>Chanchandrue</strong></p>
                                <p><i class="fa fa-calendar"></i> <em>09 December 2015</em></p>
                            </div>
                            <div class="list-content-forum">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit labore, aspernatur nostrum amet, officia ipsa quos maiores dolores repudiandae modi perferendis</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <div class="text-center">
                                <img src="<?php echo asset('images/portal/people-1.png') ?>" alt="">
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <div class="meta">
                                <p><strong>Chanchandrue</strong></p>
                                <p><i class="fa fa-calendar"></i> <em>09 December 2015</em></p>
                            </div>
                            <div class="list-content-forum">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit labore, aspernatur nostrum amet, officia ipsa quos maiores dolores repudiandae modi perferendis</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <div class="text-center">
                                <img src="<?php echo asset('images/portal/people-1.png') ?>" alt="">
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <div class="meta">
                                <p><strong>Chanchandrue</strong></p>
                                <p><i class="fa fa-calendar"></i> <em>09 December 2015</em></p>
                            </div>
                            <div class="list-content-forum">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit labore, aspernatur nostrum amet, officia ipsa quos maiores dolores repudiandae modi perferendis</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="related-course">
        <div class="related-course-title">
            <h3>KELAS TERKAIT</h3>
        </div>
        <div class="related-course-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="box-course">
                        <div class="box-course-img">
                            <img src="../images/kelas_online/thumbnails-sm.jpg" alt="">
                        </div>
                        <div class="box-course-title">
                            <h4><a href="#">Basic Nature Of Photography</a></h4>
                            <a href="#" class="btn btn-start btn-sm btn-block">Mulai Kelas</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="box-course">
                        <div class="box-course-img">
                            <img src="../images/kelas_online/thumbnails-sm.jpg" alt="">
                        </div>
                        <div class="box-course-title">
                            <h4><a href="#">Basic Nature Of Photography</a></h4>
                            <a href="#" class="btn btn-start btn-sm btn-block">Mulai Kelas</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="box-course">
                        <div class="box-course-img">
                            <img src="../images/kelas_online/thumbnails-sm.jpg" alt="">
                        </div>
                        <div class="box-course-title">
                            <h4><a href="#">Basic Nature Of Photography</a></h4>
                            <a href="#" class="btn btn-start btn-sm btn-block">Mulai Kelas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
