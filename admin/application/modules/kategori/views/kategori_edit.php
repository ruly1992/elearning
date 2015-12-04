<?php echo form_open('kategori/update/' . $kategori->id); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" value="<?php echo set_value('name', $kategori->name) ?>" class="form-control"><?php echo form_error('name') ?>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control"><?php echo set_value('description', $kategori->description) ?></textarea><?php echo form_error('description') ?> 
                </div>
                
                <div class="form-group">
                    <label>Parent Kategori</label>
                    <?php echo form_dropdown('parent', $kategori_lists, $kategori->parent, array('class' => 'form-control')); ?>
                    <?php echo form_error('parent') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-save"></i> Update</button>
                </div>
                <div class="form-group">
                    <a href="<?php echo site_url('kategori/delete/' . $kategori->id) ?>" class="btn btn-danger btn-sm btn-block btn-delete"><i class="fa fa-trash-o"></i> Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>