<div class="panel panel-default">
    <div class="panel-body">

        <table class="table table-hover table-bordered" id="article">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Isi Komentar</th>
                    <th>Respons Artikel</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo $row->nama ?> <p><?php echo $row->email ?></td>
                    <td><h5> tanggal : <?php echo $row->date ?></h5><p><?php echo $row->content ?></td>
                    <td><a href="<?php echo $row->article->link ?>" target="_blank"><?php echo $row->article->title ?></a></td>
                    <td>
                        <?php echo button_edit('comment/edit/' . $row->id) ?>
                        <?php echo button_delete('comment/delete/' . $row->id) ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#article').DataTable();
    } );
</script>
