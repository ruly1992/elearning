<?php echo form_open('forum/category/edit/'.$category->id); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Create Category</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name" class="control-label">Nama</label>
                    <?php echo form_input('name', set_value('name', $category->name), ['class' => 'form-control']); ?>
                </div>

                <div class="form-group">
                    <label for="parent" class="control-label">Tenaga Ahli</label>
                    <?php echo form_multiselect('tenagaahli[]', $users, $category->users->pluck('id')->toArray(), array('class' => 'form-control select2')); ?>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo button_save() ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
