<div class="row">
    <div class="col-md-4">
        <?php echo form_open('kelasonline/category/edit/' . $category->id); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Create Category</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <?php echo form_input('name', set_value('name', $category->name), array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo button_save() ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>