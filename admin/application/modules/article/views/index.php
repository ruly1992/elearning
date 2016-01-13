<div class="panel panel-default">
    <div class="panel-body">
        <?php echo button_create('article/add', 'Artikel Baru') ?>

        <div class="btn-group">
            <a href="<?php echo site_url('article?status=all') ?>" class="btn btn-default btn-sm <?php echo $status == 'all' ? 'active' : '' ?>">Semua</a>
            <a href="<?php echo site_url('article?status=publish') ?>" class="btn btn-default btn-sm <?php echo $status == 'publish' ? 'active' : '' ?>">Terbit</a>
            <a href="<?php echo site_url('article?status=schedule') ?>" class="btn btn-default btn-sm <?php echo $status == 'schedule' ? 'active' : '' ?>">Terjadwal</a>
            <a href="<?php echo site_url('article?status=draft') ?>" class="btn btn-default btn-sm <?php echo $status == 'draft' ? 'active' : '' ?>">Naskah</a>
        </div>

        <hr>
        <div class="table-responsive">
            <table class="table table-hover table table-striped dt-responsive nowrap" id="article">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Only Registered</th>
                        <th>Status</th>
                        <th>Waktu Terbit</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artikel as $row): ?>
                    <tr>
                        <td><?php echo $row->id ?></td>
                        <td><?php echo $row->title ?></td>
                        <td>
                            <label class="switch switch-danger">
                                <?php echo form_checkbox('status['.$row->id.']', $row->id, $row->type == 'private', array('class' => 'switch-input ajax')); ?>
                                <span class="switch-label" data-on="Yes" data-off="No"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </td>
                        <td><?php echo $row->getStatusLabel() ?></td>
                        <td><?php echo $row->date ?></td>
                        <td>
                            <?php echo button_edit('article/edit/' . $row->id) ?>
                            <?php echo button_delete('article/delete/' . $row->id) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php custom_script() ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#article').DataTable({
            responsive: true,
            "sDom": '<"row"<"col-lg-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
            'order': [[4, 'desc']]
        });

        $('.switch-input.ajax').on('change', function () {
            var id      = $(this).val();
            var type    = this.checked ? 'private' : 'public';

            $.ajax({
                url: siteurl + '/article/json/type',
                data: {
                    id: id,
                    type: type,
                },
                success: function (response) {
                    alert('Artikel telah diperbarui visibilitas menjadi '+type)
                },
                error: function (response) {
                    //
                }
            })
        })
    });
</script>
<?php endcustom_script() ?>
