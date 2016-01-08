
<div class="row">
    <!-- start:popular course -->
    <div class="col-lg-12">
        <section id="popular-course">
            <div class="popular-course-title">
                <div class="text-center">
                    <h4>SYARAT YANG HARUS DIPENUHI</h4>
                </div>
            </div>
            <div class="row">
                <?php foreach ($requirements as $course): ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="box-course">
                            <div class="box-course-img">
                                <img src="<?php echo $course->thumbnail_image ?>" alt="">
                            </div>
                            <div class="box-course-title">
                                <h4><a href="<?php echo $course->link ?>"><?php echo $course->name ?></a></h4>
                                <a href="<?php echo $course->link_join ?>" class="btn btn-start btn-sm btn-block">Mulai Kelas</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
    </div>
    <!-- end:popular course -->
</div>