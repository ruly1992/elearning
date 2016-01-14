<?php echo form_open('faq/update/' . $data->id); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>FAQ</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="">Title</label>
                    <?php echo form_input('title', set_value('title', $data->title), array('class' => 'form-control')); ?>
               </div>
                <div class="form-group">
                    <label for="">Pertanyaan</label>
                    <?php echo form_input('question', set_value('question', $data->question), array('class' => 'form-control')); ?>
               </div>
               <div class="form-group">
                    <label for="">Jawaban</label>
                    <?php echo form_textarea('answer', set_value('answer', $data->answer, FALSE), array('class' => 'form-control editor')); ?>
               </div>
            </div>
            <div class="panel-footer">
                <?php echo button_save() ?>
            </div>
        </div>
    </div>
</div>
<?php
echo form_close();

?>