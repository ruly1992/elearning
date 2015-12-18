<?php echo form_open('faq/create'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Pertanyaan</label>
                    <input type="text" name="question" value="<?php echo set_value('question') ?>" class="form-control"><?php echo form_error('question') ?>
                </div>

                <div class="form-group">
                    <label>Jawaban</label>
                    <textarea name="answer" rows="4" class="form-control"><?php echo set_value('answer') ?></textarea><?php echo form_error('answer') ?> 
                </div>                
                <div class="panel-body">
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-save"></i> Save FAQ</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>

<?php echo form_close(); ?>