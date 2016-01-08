
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
            <?php else: ?>
            <a href="#" class="btn btn-block disabled text-xs-left">
                <div class="card card-grey">
            <?php endif ?>
                    <div class="card-block">
                        <span>CHAPTER <?php echo $chapter->order ?></span>
                        <h4><?php echo $chapter->name ?></h4>
                    </div>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</div>
