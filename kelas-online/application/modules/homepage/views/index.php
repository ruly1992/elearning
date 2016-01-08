<div class="row">
    <!-- start:search course -->
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
        <div class="search-course">
            <div class="text-center">
                <h4>Search Course</h4>
                <p>Untuk melakukan pencarian course, silahkan menggunakan form search dibawah ini:</p>
            </div>
            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <select class="c-select form-control">
                        <option selected>Course Category</option>
                        <option value="1">Category One</option>
                        <option value="2">Category Two</option>
                        <option value="3">Category Three</option>
                    </select>
                </div>
                <div class="col-md-5 col-xs-12">
                    <input type="text" class="form-control" placeholder="Search Text">
                </div>
                <div class="col-md-2 col-xs-12">
                    <a href="#" class="btn btn-search btn-block">SEARCH</a>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <!-- start:popular course -->
    <div class="col-lg-12">
        <section id="popular-course">
            <div class="popular-course-title">
                <div class="text-center">
                    <h4>POPULAR KELAS ONLINE</h4>
                </div>
            </div>
            <div class="row">
                <?php foreach ($popular as $course): ?>
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
<hr>
<div class="row">
    <!-- start:popular course -->
    <div class="col-lg-12">
        <section id="popular-course">
            <div class="popular-course-title">
                <div class="text-center">
                    <h4>KELAS ONLINE TERBARU</h4>
                </div>
            </div>
            <?php foreach ($latest->chunk(4) as $chunk): ?>
                <div class="row">
                    <?php foreach ($chunk as $course): ?>
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
            <?php endforeach ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="#" class="btn btn-link btn-lihat-semua">Lihat Semua Kelas</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end:popular course -->
</div>