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

        <table class="table table-hover table-bordered" id="article">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Pengirim</th>
                    <th>Dikirim</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artikel as $row): ?>
                <tr>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo $row->title ?></td>
                    <td><?php echo $row->author_name ?><br><small><?php echo $row->author_email ?></small></td>
                    <td><?php echo $row->date ?></td>
                    <td>
                        <a href="<?php echo site_url('article/edit/' . $row->id) ?>" class="btn btn-info btn-editadmin"><i class="fa fa-edit"></i> Moderasi</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#article').DataTable({
            'order': [[4, 'desc']]
        });
    } );
</script>
