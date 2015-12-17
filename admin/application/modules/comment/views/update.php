<?php echo form_open('comment/edit/' . $data->id); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Comment</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="">Nama</label>
                    <?php echo form_input('nama', set_value('nama', $data->nama), array('class' => 'form-control', 'placeholder' => 'Nama')); ?>
               </div>
               <div class="form-group">
                    <label for="">Email</label>
                    <?php echo form_input('email', set_value('email', $data->email), array('class' => 'form-control', 'placeholder' => 'Email')); ?>
               </div>
               <div class="form-group">
                    <label for="">Isi Komentar</label>
                    <?php echo form_textarea('content', set_value('content', $data->content), array('class' => 'form-control', 'placeholder' => 'content')); ?>
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