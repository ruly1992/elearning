<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Save or Publish</h4>
    </div>
    <div class="panel-body">
        <button class="btn btn-primary">Save</button>
        <button class="btn btn-primary">Save and Publish</button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Course Setting</h4>
    </div>
    <div class="panel-body">        
        <div class="list-group">
            <a href="<?php echo site_url('kelasonline/course/edit/'.$course->id) ?>" class="list-group-item <?php echo $sidebar_active == 'basic' ? 'active' : '' ?>">
                Basic Information
            </a>
            <a href="<?php echo site_url('kelasonline/course/edit/'.$course->id.'/requirement') ?>" class="list-group-item <?php echo $sidebar_active == 'requirement' ? 'active' : '' ?>">
                <span class="label label-default label-pill pull-xs-right"><?php echo $repository->countRequirements() ?></span>
                Requirement
            </a>
            <a href="<?php echo site_url('kelasonline/course/edit/'.$course->id.'/image') ?>" class="list-group-item <?php echo $sidebar_active == 'image' ? 'active' : '' ?>">
                <?php if (!$repository->hasFeaturedImage()): ?>
                    <span class="text-danger pull-xs-right"><i class="fa fa-fw fa-warning"></i></span>
                <?php endif ?>
                Image
            </a>
            <a href="<?php echo site_url('kelasonline/course/edit/'.$course->id.'/chapter') ?>" class="list-group-item <?php echo $sidebar_active == 'chapter' ? 'active' : '' ?>">Chapter and Quiz</a>
            <a href="<?php echo site_url('kelasonline/course/edit/'.$course->id.'/exam') ?>" class="list-group-item <?php echo $sidebar_active == 'exam' ? 'active' : '' ?>">Exam</a>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <a href="<?php echo site_url('kelasonline/course/delete/'.$course->id) ?>" class="btn btn-delete btn-danger"><i class="fa fa-trash-o"></i> Delete this course</a>
    </div>
</div>
