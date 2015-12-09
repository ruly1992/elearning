<div class="row">
    <div class="col-md-4">
        <?php echo form_open('forum/category/create'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Create Category</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name" class="control-label">Nama</label>
                    <?php echo form_input('name', set_value('name'), ['class' => 'form-control']); ?>
                </div>

                <div class="form-group">
                    <label for="parent" class="control-label">Tenaga Ahli</label>
                    <?php echo form_multiselect('tenagaahli[]', $users, '', array('class' => 'form-control select2')); ?>
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
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Jumlah Tenaga Ahli</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($categories->count()): ?>
                            <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo $category->name ?></td>
                                <td><?php echo $category->users->count() ?></td>
                                <td><?php echo button_edit('forum/category/edit/'.$category->id) ?> <?php echo button_delete('forum/category/delete/'.$category->id) ?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="warning">
                                <td colspan="3">Tidak ada kategori yang ditampilkan</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>