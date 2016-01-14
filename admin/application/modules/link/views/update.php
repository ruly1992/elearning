<?php echo form_open('link/update/' . $data->id); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Link Informasi Desa</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="">URL Website</label>
                    <?php echo form_input('url', set_value('url', $data->url), array('class' => 'form-control', 'placeholder' => 'http//')); ?>
               </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <?php echo form_input('name', set_value('name', $data->name), array('class' => 'form-control')); ?>
               </div>
               <div class="form-group">
                    <label for="">Deskripsi</label>
                    <?php echo form_textarea('description', set_value('description', $data->description), array('class' => 'form-control')); ?>
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