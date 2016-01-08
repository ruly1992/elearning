<?php get_header('private', array('active' => 'kelas')) ?>

    <!-- start:main content -->
    <div class="container content content-single content-dashboard content-kelas-online">
        <section id="content">
            <div class="content-kelas-online-main">
                <!-- start:breadcrumb -->
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo dashboard_url() ?>">Dashboard</a></li>
                        <li><a href="<?php echo site_url() ?>">Kelas Online</a></li>
                        <?php if (!isset($chapter)): ?>
                            <li class="active"><?php echo $course->name ?></li>
                        <?php else: ?>
                            <li><a href="<?php echo site_url('course/show/'.$course->slug) ?>"><?php echo $course->name ?></a></li>
                            <li class="active">Chapter <?php echo $chapter->order ?></li>
                        <?php endif ?>
                    </ol>
                </div>
                <!-- end:breadcrumb -->
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <!-- start:content -->
                        <?php echo $template['body'] ?>
                        <!-- end:content -->
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <?php $this->load->view('template/sidebar_instructor', compact('course', 'repository')); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end:main content -->

<?php get_footer('private') ?>
