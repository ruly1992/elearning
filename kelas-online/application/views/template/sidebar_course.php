<div class="sidebar-kelas-online">
    <div class="widget">
        <div class="widget-categories">
            <div class="widget-categories-heading">
                <h4>SETTING</h4>
            </div>
            <div class="widget-categories-content">
                <div class="list-group">
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id) ?>" class="list-group-item <?php echo $sidebar_active == 'basic' ? 'active' : '' ?>">
                        Basic Information
                    </a>
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/requirement') ?>" class="list-group-item <?php echo $sidebar_active == 'requirement' ? 'active' : '' ?>">
                        <span class="label label-default label-pill pull-xs-right"><?php echo $repository->countRequirements() ?></span>
                        Requirement
                    </a>
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/image') ?>" class="list-group-item <?php echo $sidebar_active == 'image' ? 'active' : '' ?>">
                        <?php if (!$repository->hasFeaturedImage()): ?>
                            <span class="text-danger pull-xs-right"><i class="fa fa-fw fa-warning"></i></span>
                        <?php endif ?>
                        Image
                    </a>
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/chapter') ?>" class="list-group-item <?php echo $sidebar_active == 'chapter' ? 'active' : '' ?>">Chapter and Quiz</a>
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/exam') ?>" class="list-group-item <?php echo $sidebar_active == 'exam' ? 'active' : '' ?>">Exam</a>
                </div>
            </div>
        </div>
    </div>
    <?php if ($course->status == 'draft'): ?>
        <div class="widget">
            <div class="widget-categories">
                <div class="widget-categories-heading">
                    <h4>MEMBER</h4>
                </div>
                <div class="widget-categories-content">
                    <div class="alert alert-warning">
                        <p>This course is still in moderation</p>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="widget">
            <div class="widget-categories">
                <div class="widget-categories-heading">
                    <h4>MEMBER</h4>
                </div>
                <div class="widget-categories-content">
                    <div class="list-group">
                        <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/member?status=active') ?>" class="list-group-item">
                            <span class="label label-info label-pill pull-xs-right"><?php echo $repository->countMemberActive() ?></span>
                            Active
                        </a>
                        <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/member?status=finished') ?>" class="list-group-item">
                            <span class="label label-success label-pill pull-xs-right"><?php echo $repository->countMemberFinished() ?></span>
                            Finished
                        </a>
                        <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/member?status=pending') ?>" class="list-group-item list-group-item-warning">
                            <span class="label label-warning label-pill pull-xs-right"><?php echo $repository->countMemberPending() ?></span>
                            Pending
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

    <div class="widget">
        <div class="widget-categories">
            <div class="widget-categories-heading">
                <h4>DELETE</h4>
            </div>
            <div class="widget-categories-content">
                <p><a href="<?php echo site_url('dashboard/course/delete/' . $course->id) ?>" class="btn-delete text-danger">Delete this course</a></p>
            </div>
        </div>
    </div>
</div>