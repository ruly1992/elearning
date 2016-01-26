<div class="content-left">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="content-title">
            <h1><?php echo $chapter->name ?></h1>
        </div>
    </div>
    <?php echo form_open('course/submitquiz/'.$course->slug.'/chapter-'.$chapter->order, 'id="form-quiz"'); ?>
    <div class="content-main">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Start: Quiz -->
            <?php $numb = 1; foreach ($quiz->questions as $question): ?>
                <div class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-1">
                                <span class="text-right"><?php echo $numb ?>.</span>
                            </div>
                            <div class="col-sm-11">
                                <?php echo $question->question ?>
                                <label for="">Jawaban :</label>
                                <div class="row">
                                    <?php foreach (collect(range('a', 'd'))->chunk(2) as $choices): ?>
                                        <div class="col-xs-6 col-sm-6">
                                            <div class="c-inputs-stacked">
                                                <?php foreach ($choices as $choice): ?>
                                                    <label class="c-input c-radio">
                                                        <input name="answers[<?php echo $question->id ?>]" value="<?php echo $choice ?>" type="radio">
                                                        <span class="c-indicator"></span>
                                                        <div class="question">
                                                            <?php echo strtoupper($choice) ?>. <?php echo $question->{'option_'.$choice} ?>
                                                        </div>
                                                    </label><hr>
                                                <?php endforeach ?>
                                            </div>
                                        </div>               
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            <?php $numb++; endforeach ?>
            <!-- End: Quiz -->
            <button type="button" class="btn btn-block btn-exam btn-primary" data-toggle="modal" data-target=".quiz-confirmation">FINISH</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<div class="modal fade quiz-confirmation" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Konfirmasi Jawaban</h4>
            </div>
            <div class="modal-body">
                Anda masih punya <span class="quiz-countdown">00:00</span> menit untuk melakukan revisi jawaban.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Revisi Jawaban</button>
                <button type="button" class="btn btn-primary btn-quiz-submit">Kirim Jawaban</button>
            </div>
        </div>
    </div>
</div>

<?php custom_script() ?>
    <script type="text/javascript">
    $(document).ready(function () {
        $('.btn-quiz-submit').on('click', function () {
            $('#form-quiz').submit();
        })
    })
    </script>
<?php endcustom_script() ?>
