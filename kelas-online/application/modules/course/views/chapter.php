
<div class="content-left">
    <div class="content-title">
        <h1><?php echo $course->name ?></h1>
    </div>
    <div class="content-lesson">
        <div class="content-lesson-title">
            <h3>CHAPTERS</h3>
        </div>
        <?php foreach ($course->chapters as $chapter): ?>
            <?php if ($repository->memberAllowChapter($chapter)): ?>
                <a href="<?php echo site_url('course/showchapter/'.$course->slug.'/chapter-'.$chapter->order) ?>" class="btn btn-block text-xs-left">
                    <div class="card card-success">
                        <div class="card-block">
                            <span>CHAPTER <?php echo $chapter->order ?></span>
                            <h4><?php echo $chapter->name ?></h4>
                        </div>
                    </div>
                </a>
            <?php else: ?>
                <div class="has-attention">
                    <div class="attention pull-right">
                        <button class="btn btn-danger btn-konsul" data-toggle="tooltip" data-placement="top" title="Anda harus menyelesaikan Chapter <?php echo $chapter->order-1 ?> terlebih dahulu"><i class="fa fa-warning"></i></button>
                    </div>
                    <a href="#" class="btn btn-block disabled text-xs-left">
                        <div class="card card-grey">
                            <div class="card-block">
                                <span>CHAPTER <?php echo $chapter->order ?></span>
                                <h4><?php echo $chapter->name ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<!-- START EXAM -->
<div class="content-exam">
    <h4>EXAM</h4>
    <hr>
    <?php if ($repository->memberAllowExam($course)): ?>
        <?php if ($course->hasExam()): ?>
            <?php if ($course_member_status->first()->status !== 'finished'): ?>
                <a href="<?php echo site_url('course/showexam/'.$course->slug) ?>" class="btn btn-block btn-exam btn-primary">START EXAM</a>
            <?php else: ?>
                <p class="alert alert-success">Anda sudah menyelesaikan ujian</p>
            <?php endif ?>
        <?php else: ?>
            <p>Tidak ada ujian</p>
        <?php endif ?>
    <?php else: ?>
        <p class="alert alert-warning">Anda harus menyelesaikan semua chapter terlebih dahulu untuk memulai ujian.</p>
    <?php endif ?>
</div>
<!-- END EXAM -->

<br><br>
<!-- SERTIFIKAT -->
<div class="content-setifikat">
    <h4>SERTIFIKAT</h4>
    <hr>

    <?php foreach ($course_member_status as $key => $value): ?>

        <?php if ($value->status == 'finished'): ?>
            
            <a href="<?php echo site_url('course/printedcertificate/'.$course->slug) ?>" class="btn btn-block btn-sertifikat btn-info">CETAK SERTIFIKAT</a>
        
        <?php else: ?>

                <div class="alert alert-warning">Anda belum menyelesaikan exam.</div>

        <?php endif ?> 
        

    <?php endforeach ?>

</div>
<!-- END SERTIFIKAT -->
