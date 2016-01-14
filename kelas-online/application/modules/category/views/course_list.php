<div class="row">
    <div class="col-lg-12">
        <div class="text-center">
            <h4><strong>Kategori :</strong> <small><?php echo $category->name ?></small></h4>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php foreach ($courses as $course): ?>
            <div class="box-course-list">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="box-course-list-img">
                            <a href="<?php echo $course->link ?>"><img src="<?php echo $course->thumbnail_image ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="box-course-list-title">
                            <h4><a href="<?php echo $course->link ?>"><?php echo $course->name ?></a></h4>
                            <?php echo $course->getExcerpt(120) ?>
                        </div>
                        <div class="box-course-list-button">
                            <a href="<?php echo $course->link_join ?>" class="btn btn-sm btn-course-list">MULAI KELAS</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

        <nav>
            <?php echo $courses->render() ?>
        </nav>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="course-kategori">
            <div class="course-kategori-title">
                <h4><strong>Kategori</strong></h4>
            </div>
            <ul class="nav nav-pills nav-stacked">
                <?php foreach ($categories as $cat): ?>
                    <li class="nav-item">
                        <?php if ($category->slug === $cat->slug): ?>
                            <a class="nav-link active" href="#"><?php echo $cat->name ?></a>
                        <?php else: ?>
                            <a class="nav-link" href="<?php echo site_url('category/show/'.$cat->slug) ?>"><?php echo $cat->name ?></a>
                        <?php endif ?>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>