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
                    <div class="card-header">
                        <?php echo $numb ?>. <?php echo $question->question ?>
                    </div>
                    <div class="card-block">
                        <div class="col-sm-12">
                            <label for="">Jawaban :</label>
                            <div class="row">
                                <?php foreach (collect(range('a', 'd'))->chunk(2) as $choices): ?>
                                    <div class="col-xs-6 col-sm-6">
                                        <div class="c-inputs-stacked">
                                            <?php foreach ($choices as $choice): ?>
                                                <label class="c-input c-radio">
                                                    <input name="answers[<?php echo $question->id ?>]" value="<?php echo $choice ?>" type="radio">
                                                    <span class="c-indicator"></span>
                                                    <?php echo strtoupper($choice) ?>. <?php echo $question->{'option_'.$choice} ?>
                                                </label>
                                            <?php endforeach ?>
                                        </div>
                                    </div>               
                                <?php endforeach ?>
                          </div>
                        </div>
                    </div>
                </div>                
            <?php $numb++; endforeach ?>
            <!-- End: Quiz -->
            <button type="submit" class="btn btn-block btn-exam btn-primary">FINISH</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>