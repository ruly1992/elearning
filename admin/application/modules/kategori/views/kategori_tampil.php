<div class="row">
    <div class="col-md-4">
        <?php echo form_open('kategori/add'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Create Category</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <?php echo form_input('name', '', array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <?php // echo form_input('description', '', array('class' => 'form-control')); ?>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="parent">Parent</label>
                    <?php echo form_dropdown('parent', $parent, 0, array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <label for="parent">Editor</label>
                    <?php echo form_multiselect('editor[]', $users, '', array('class' => 'form-control select2')); ?>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo button_save() ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>List Category</strong></h2>
            </div>
            <div class="panel-body">
                <div class="dd" id="nestable-category">
                    <?php echo $this->model->generateNested() ?>
                </div>
                <?php if (empty($this->model->generateNested())): ?>
                    <p class="alert alert-warning">Tidak ada kategori yang ditampilkan.</p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<?php custom_script() ?>
    <script>
    $(document).ready(function () {
        $('.select2').select2();
    })
    </script>
<?php endcustom_script() ?>
