<div class="elib-content-single">
    <div class="elib-single-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="<?php echo dashboard_url() ?>">Dashboard</a></li>
            <li class="active"><?php echo $category->name ?></li>
        </ol>
    </div>

    <a href="<?php echo site_url('media/upload/' . $category->id) ?>" class="btn btn-primary"><i class="fa fa-upload"></i> Upload Media</a>

    <hr>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>File Type</th>
                    <th>File Size</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($medias->count()): ?>
                    <?php foreach ($medias as $media): ?>
                        <tr>
                            <td><?php echo anchor('media/edit/' . $media->id, $media->name) ?></td>
                            <td><?php echo $media->file_type ?></td>
                            <td><?php echo $media->file_size_format ?></td>
                            <td><?php echo $media->status_format ?></td>
                            <td><?php echo button_delete('media/delete/' . $media->id) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr class="warning">
                        <td colspan="5">Tidak ada media.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo $medias->render() ?>
</div>
