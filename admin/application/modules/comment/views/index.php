<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="article">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pengirim</th>
                        <th>Komentar</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo $row->id ?></td>
                        <td>
                            <?php echo $row->nama ?><br>
                            <small><?php echo $row->email ?></small>
                        </td>
                        <td><?php echo $row->content ?><br>
                        <small>on <a href="<?php echo $row->article->link ?>" target="_blank"><?php echo $row->article->title ?></a></small></td>
                        <td><?php echo $row->status_label ?></td>
                        <td><?php echo $row->date->format('d M Y H:i') ?></td>
                        <td>
                            <?php if ($row->status == 'draft'): ?>
                                <a href="<?php echo site_url('comment/edit/' . $row->id) ?>" class="label label-info"><i class="fa fa-edit"></i> Moderasi</a>
                                <?php echo button_delete('comment/delete/' . $row->id) ?>
                            <?php else: ?>
                                <?php echo button_edit('comment/edit/' . $row->id, 'sm') ?>
                                <?php echo button_delete('comment/delete/' . $row->id) ?>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#article').DataTable({
            responsive: true,
            "sDom": '<"row"<"col-lg-6"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
        });
    } );
</script>
