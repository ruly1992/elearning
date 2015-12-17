<?php echo form_open('kategori/add'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" value="<?php echo set_value('name') ?>" class="form-control"><?php echo form_error('name') ?>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control"><?php echo set_value('description') ?></textarea><?php echo form_error('description') ?> 
                </div>
                
                <div class="form-group">
                    <label>Parent Kategori</label>
                    <?php echo form_dropdown('parent', $kategori, 0, array('class' => 'form-control')); ?>
                    <?php echo form_error('parent') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>