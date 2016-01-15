<div class="row">
    <div class="container">
        <!-- start:search course -->
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <?php echo form_open('search', 'method="get"'); ?>
            <div class="search-course">
                <div class="text-center">
                    <h4>Search Course</h4>
                    <p>Untuk melakukan pencarian course, silahkan menggunakan form search dibawah ini:</p>
                </div>
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <?php echo form_dropdown('category_id', $category_lists, null, 'class="c-select form-control"'); ?><br>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input name="term" type="text" class="form-control" placeholder="Search Text"><br>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <button type="submit" class="btn btn-search btn-block"><i class="fa fa-search"></i> SEARCH</button><br>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- end:search course -->
    </div>
</div>
<hr>
<div class="row">
    <div class="container">
        <!-- start:popular course -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <section id="popular-course">
                <div class="popular-course-title">
                    <div class="text-xs-center">
                        <h3><span class="label label-info"><i class="fa fa-info-circle"></i> KELAS TERPOPULER</span></h3>
                    </div>
                </div><br>
                <div class="row">
                    <div class="container">
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
                </div>
            </section>
        </div>
        <!-- end:popular course -->
    </div>
</div>
<hr>
<div class="row">
    <div class="container">
        <!-- start:popular course -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <section id="popular-course"> 
                <div class="popular-course-title">
                    <div class="text-xs-center">
                        <h3><span class="label label-warning"><i class="fa fa-info-circle"></i> KELAS TERBARU</span></h3>
                    </div>
                </div><br>
                <?php foreach ($latest->chunk(4) as $chunk): ?>
                    <div class="row">
                        <div class="container">
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
                    </div>
                <?php endforeach ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-xs-center">
                            <a href="#" class="btn btn-link btn-lihat-semua">Lihat Semua Kelas</a>
                        </div>
                    </div>
                </div><br><br>
            </section>
        </div>
        <!-- end:popular course -->
    </div>
</div>