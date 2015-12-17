<div class="row">
    <div class="col-md-6">
        <?php echo form_open('elibrary/category/edit/' . $category->id); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Edit Category</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <?php echo form_input('name', set_value('name', $category->name), array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <?php echo form_textarea('description', set_value('description', $category->description), array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo button_save() ?>
                <a href="<?php echo site_url('elibrary/category/delete/' . $category->id) ?>" class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i> Hapus</a>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>