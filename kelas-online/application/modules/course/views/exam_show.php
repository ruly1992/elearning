<div class="content-left">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="content-title">
            <h1><?php echo $exam->name ?></h1>
        </div>
    </div>
    <?php echo form_open('course/submitexam/'.$course->slug, 'id="form-exam"'); ?>
    <div class="content-main">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Start: Exam -->
            <?php $numb = 1; foreach ($exam->questions as $question): ?>
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
            <!-- End: Exam -->
            <button type="submit" class="btn btn-block btn-exam btn-primary">FINISH</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>