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
                                <?php $numb = 1; foreach ($chapter->attachments as $attachment): ?>
                                    <tr>
                                        <th scope="row"><?php echo str_pad($numb, 3, '0', STR_PAD_LEFT) ?></th>
                                        <td><?php echo $attachment->filename ?></td>
                                        <td><?php echo $attachment->filesize ?></td>
                                        <td>
                                            <a href="<?php echo $attachment->link_download ?>" target="_blank" class="btn btn-sm btn-primary" title="Download"><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                <?php $numb++; endforeach ?>
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
                    <?php if ($repository->memberHasFinishedChapter($chapter)): ?>
                        <p class="alert alert-info">
                            <i class="fa fa-check"></i> Anda telah menyelesaikan quiz ini
                        </p>
                        
                        <!-- Start Button Trigger Modal-->
                        <button type="button" chapter-id="<?php echo $chapter->id ?>" class="btn btn-primary btn-quiz-score-learner" data-toggle="modal" data-target="#quiz-scores-learner"><i class="fa fa-list"></i> Lihat Skor</button>
                        <!-- End Button Trigger Modal -->
                    
                    <?php else: ?>
                        <p class="alert alert-info">
                            <i class="fa fa-question-mark"></i> Anda mempunyai waktu <?php echo $chapter->quiz->time ?> menit
                        </p>
                        <a href="<?php echo site_url('course/showquiz/'.$course->slug.'/chapter-'.$chapter->order) ?>" class="btn btn-block btn-exam btn-primary">START QUIZ</a>
                    <?php endif ?>                    
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
                            <div class="card-block">
                                <span>CHAPTER <?php echo $nextChapter->order ?></span>
                                <h4><?php echo $nextChapter->name ?></h4>
                            </div>
                        </div>
                    </a>
                <?php else: ?>
                    <div class="has-attention">
                        <div class="attention pull-right">
                            <button class="btn btn-danger btn-konsul" data-toggle="tooltip" data-placement="top" title="Anda harus menyelesaikan Quiz Chapter <?php echo $chapter->order ?> terlebih dahulu"><i class="fa fa-warning"></i></button>
                        </div>
                        <a href="#" class="btn btn-block disabled text-xs-left">
                            <div class="card card-gray">
                                <div class="card-block">
                                    <span>CHAPTER <?php echo $nextChapter->order ?></span>
                                    <h4><?php echo $nextChapter->name ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        <?php else: ?>
            <div class="card content-lesson">
                
                <?php if ($repository->memberAllowExam($course)): ?>
                        <?php if ($course_member_status->first()->status !== 'finished'): ?>
                            <div class="card-header">
                                <p>Next Exam</p>
                            </div>
                            <a href="<?php echo site_url('course/showexam/'.$course->slug) ?>" class="btn btn-block text-xs-left">
                                <div class="card card-success">
                                    <div class="card-block">
                                        <span>START EXAM</span>
                                        <h4><?php echo $chapter->name ?></h4>
                                    </div>
                                </div>
                            </a>
                        <?php endif ?>
                    
                <?php else: ?>
                    <div class="card-header">
                        <p>Next Exam</p>
                    </div>
                    <a href="#" class="btn btn-block disabled text-xs-left">
                        <div class="card card-success">
                            <div class="card-gray">
                                <span>START EXAM</span>
                                <h4><?php echo $chapter->name ?></h4>
                            </div>
                        </div>
                    </a>                    
                <?php endif ?>
            </div>
        <?php endif ?>
    </div>
    <br><br>
    <div class="content-course-forum">
        <div class="content-course-forum-title">
            <h3>COURSE FORUM</h3>
        </div>
        <div class="content-course-forum-main" id="comments">
            <p>There are <?php echo $chapter->comments->count() ?> reviews on this course</p>
            <ul class="list-course-forum">
                <?php if ($chapter->comments->count()): foreach ($chapter->comments()->parentOnly()->get() as $comment): ?>
                <li>
                    <div class="row" id="comment-<?php echo $comment->id ?>">
                        <div class="col-sm-2 col-xs-12">
                            <div class="text-center">
                                <img src="<?php echo $comment->avatar ?>" alt="">
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <div class="meta">
                                <p><strong><?php echo $comment->name ?></strong></p>
                                <p><i class="fa fa-calendar"></i> <em><?php echo $comment->created_at->format('d F Y') ?></em></p>
                            </div>
                            <div class="list-content-forum">
                                <h4 class="media-heading"><?php echo $comment->nama ?> <a href="#comment-reply" class="pull-right btn btn-sm btn-reply" v-on:click="reply('<?php echo $comment->id ?>', '<?php echo $comment->name ?>')">Reply</a></h4>
                                <p><?php echo $comment->content ?></p>

                                <?php foreach ($comment->replies as $reply): ?>
                                <div class="media" id="comment-<?php echo $reply->id ?>">
                                    <a class="media-left" href="#">
                                        <img class="media-object" src="<?php echo $reply->avatar ?>">
                                    </a>
                                    <div class="media-body">
                                        <div class="media-body-bg">
                                            <h4 class="media-heading"><?php echo $reply->nama ?></h4>
                                            <p><?php echo $reply->content ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; else: ?>
                <li><p class="alert alert-info">Belum ada komentar.</p></li>
            <?php endif ?>
            </ul>

            <p id="comment-reply">Add your reviews</p>
            <div class="form-review">
                <?php $this->load->view('course/chapter_comment', compact('chapter')); ?>                
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="quiz-scores-learner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Skor Quiz</h4>
      </div>
      <div class="modal-body">
            <div class="response-data"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
    </div>
  </div>
</div>



<?php custom_script() ?>
<script type="text/javascript">
    var scores=function(){

        var url     = "<?php echo site_url('course/') ?>";
         
        return{
            init:function(){
                scores.setData();
                
            },
            setData:function(){
                
               
                $('.btn-quiz-score-learner').click(function(){
                   
                    var chapterid = $(this).attr('chapter-id');
                  
                    $.ajax({
                        type: "GET",
                        url: url+'/quizscores/'+chapterid,
                        success: function(response){
                            
                            $('.response-data').html(response);

                        }
                    });
                });
               
            },

        } 
        }();
        scores.init();


 </script>

 <?php endcustom_script() ?>
