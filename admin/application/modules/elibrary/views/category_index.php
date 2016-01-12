 <div class="row">
    <div class="col-md-4">
        <?php echo form_open('elibrary/category/add'); ?>
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
                    <?php echo form_input('description', '', array('class' => 'form-control')); ?>
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
                <h2><strong>Kategori Elibrary</strong></h2>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="elibtable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Jumlah Media</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($categories as $category): ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo anchor('elibrary/category/edit/' . $category->id, $category->name); ?></td>
                                    <td><?php echo $category->getMediaCount() ?></td>
                                    <td>
                                        <?php echo button_edit('elibrary/category/edit/' . $category->id) ?>
                                        <a href="<?php echo site_url('elibrary/category/delete/' . $category->id) ?>" class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php $no++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#elibtable').DataTable({
                responsive: true,
                "sDom": '<"row"<"col-lg-6"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
            });
        } );
    </script>
