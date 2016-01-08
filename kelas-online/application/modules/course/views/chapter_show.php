<div class="content-left">
    <div class="content-title">
        <h1>Chapter <?php echo $chapter->order ?> - <?php echo $chapter->name ?></h1>
    </div>
    <div class="content-main">
        <div class="card">
            <div class="card-header">
                 <p>Attachment</p>
            </div>
            <div class="card-block">
                <!-- Start: Table Attachment -->                                                   
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Size File</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($chapter->attachments as $attachment): ?>
                                    <tr>
                                        <th scope="row">001</th>
                                        <td><?php echo $attachment->filename ?></td>
                                        <td><?php echo $attachment->filesize ?></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary" title="Download"><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <?php if ($chapter->attachments->count() == 0): ?>
                                    <tr>
                                        <td colspan="4">Tidak ada attachment</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                <!-- End: Table Attachment -->
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                 <p>Quiz</p>
            </div>
            <div class="card-block">
                <?php if ($chapter->hasQuiz()): ?>
                    <button class="btn btn-block btn-exam btn-primary">START QUIZ</button>
                <?php else: ?>
                    <p>Tidak ada quiz</p>
                <?php endif ?>
            </div>
        </div>
        <?php if ($nextChapter = $chapter->getNext()): ?>
            <div class="card content-lesson">
                <div class="card-header">
                    <p>Next Chapter</p>
                </div>
                <?php if ($repository->memberAllowChapter($nextChapter)): ?>
                    <a href="<?php echo site_url('course/showchapter/'.$course->slug.'/chapter-'.$nextChapter->order) ?>" class="btn btn-block text-xs-left">
                        <div class="card card-success">
                <?php else: ?>
                    <a href="#" class="btn btn-block disabled text-xs-left">
                        <div class="card card-gray">
                <?php endif ?>
                            <div class="card-block">
                                <span>CHAPTER <?php echo $nextChapter->order ?></span>
                                <h4><?php echo $nextChapter->name ?></h4>
                            </div>
                        </div>
                    </a>
            </div>
        <?php endif ?>
    </div>
    <br><br>
    <div class="content-course-forum">
        <div class="content-course-forum-title">
            <h3>COURSE FORUM</h3>
        </div>
        <div class="content-course-forum-main">
            <p>There are 3 reviews on this course</p>
            <ul class="list-course-forum">
                <li>
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <div class="text-center">
                                <img src="../images/portal/people-1.png" alt="">
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <div class="meta">
                                <p><strong>Chanchandrue</strong></p>
                                <p><i class="fa fa-calendar"></i> <em>09 December 2015</em></p>
                            </div>
                            <div class="list-content-forum">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit labore, aspernatur nostrum amet, officia ipsa quos maiores dolores repudiandae modi perferendis</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <div class="text-center">
                                <img src="../images/portal/people-1.png" alt="">
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <div class="meta">
                                <p><strong>Chanchandrue</strong></p>
                                <p><i class="fa fa-calendar"></i> <em>09 December 2015</em></p>
                            </div>
                            <div class="list-content-forum">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit labore, aspernatur nostrum amet, officia ipsa quos maiores dolores repudiandae modi perferendis</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <div class="text-center">
                                <img src="../images/portal/people-1.png" alt="">
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <div class="meta">
                                <p><strong>Chanchandrue</strong></p>
                                <p><i class="fa fa-calendar"></i> <em>09 December 2015</em></p>
                            </div>
                            <div class="list-content-forum">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit labore, aspernatur nostrum amet, officia ipsa quos maiores dolores repudiandae modi perferendis</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <p>Add your reviews</p>
            <div class="form-review">
                <form action="">
                    <div class="form-group">
                        <label for="">Your review messages :</label>
                        <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-submit">SUBMIT</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
