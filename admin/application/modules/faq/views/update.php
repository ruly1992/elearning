<?php echo form_open('faq/update/' . $data->id); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>FAQ</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="">Pertanyaan</label>
                    <?php echo form_input('pertanyaan', set_value('pertanyaan', $data->pertanyaan), array('class' => 'form-control')); ?>
               </div>
               <div class="form-group">
                    <label for="">Jawaban</label>
                    <?php echo form_textarea('jawaban', set_value('jawaban', $data->jawaban), array('class' => 'form-control')); ?>
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