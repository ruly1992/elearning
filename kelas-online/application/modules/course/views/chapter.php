
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
