<div class="content-right">
    <div class="widget">
        <div class="widget-course">
            <div class="list-details">
                <ul>
                    <li><i class="fa fa-clock-o"></i> <?php echo $course->days ?> Hours</li>
                    <li><i class="fa fa-file-text"></i> <?php echo $course->chapters->count() ?> Lessons</li>
                    <li><i class="fa fa-tag"></i> <?php echo $course->category->name ?></li
                </ul>
            </div>
        </div>
    </div>

    <div class="widget">
        <div class="widget-instructor">
            <div class="widget-instructor-title">
                <h3>INSTRUCTOR</h3>
            </div>
            <div class="widget-instructor-profile">
                <div class="text-xs-center">
                    <img src="<?php echo $course->instructor->avatar ?>" alt="">
                    <p><strong><a href="#"><?php echo $course->instructor->full_name ?></a></strong></p>
                </div>
            </div>
            <div class="list-details">
                <ul>
                    <li><?php echo $course->instructor->email ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>