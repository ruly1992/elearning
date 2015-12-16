<div class="panel panel-default">
    <div class="panel-body">
        Daftar Konsultasi
        <hr>
        <table class="table table-hover table-bordered" id="article">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subjek</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1; 
                    foreach ($konsultasi as $row): ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $row->subjek ?></td>
                    <td>
                        <?php if ($row->status == 'open'){?>
                            <a href="<?php echo site_url('konsultasi/status/open/'.$row->id) ?>" class="label label-primary"><?php echo 'Open' ?></a>   
                        <?php } else { ?>
                            <a href="<?php echo site_url('konsultasi/status/close/'.$row->id) ?>" class="label label-default"><?php echo 'Close' ?></a>
                        <?php } ?>
                    </td>
                    <td>
                       <a class="btn btn-sm btn-success" href="<?php echo site_url('konsultasi/detail/'. $row->id) ?>">Lihat selengkapnya</a>
                    </td>
                </tr>
            <?php $no++; endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#article').DataTable();
    } );
</script>
