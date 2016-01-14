<div class="panel panel-default">
    <div class="panel-body">
        <?php echo button_create('link/create', 'Tambah Link')?>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="article">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($link as $row): ?>
                    <tr>
                        <td><?php echo $row->id ?></td>
                        <td><a href="<?php echo $row->url ?>"><?php echo $row->name ?></a></td>
                        <td><?php echo $row->description ?></td>
                        <td>
                            <?php echo button_edit('link/update/' . $row->id) ?>
                            <?php echo button_delete('link/delete/' . $row->id) ?>
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
            "sDom": '<"row"<"col-lg-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
        });
    } );
</script>
