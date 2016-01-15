 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="btn-group">
                    <a href="<?php echo site_url('kelasonline/course?status=all') ?>" class="btn btn-default btn-sm <?php echo $status == 'all' ? 'active' : '' ?>">All</a>
                    <a href="<?php echo site_url('kelasonline/course?status=publish') ?>" class="btn btn-default btn-sm <?php echo $status == 'publish' ? 'active' : '' ?>">Publish</a>
                    <a href="<?php echo site_url('kelasonline/course?status=draft') ?>" class="btn btn-default btn-sm <?php echo $status == 'draft' ? 'active' : '' ?>">Draft</a>
                </div>

                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Materi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                        <tr>
                            <th scope="row"><?php echo $course->code ?></th>
                            <td><?php echo $course->category->name ?></td>
                            <td><?php echo $course->name ?></td>
                            <td><?php echo $course->status_label ?></td>
                            <td>
                                <?php if ($course->status == 'draft'): ?>                                    
                                    <a href="<?php echo site_url('kelasonline/course/edit/'.$course->id) ?>" class="btn btn-sm btn-info">Moderasi</a>
                                    <a href="<?php echo site_url('kelasonline/course/delete/'.$course->id) ?>" class="btn btn-sm btn-danger">Reject</a>
                                <?php else: ?>
                                    <a href="<?php echo site_url('kelasonline/course/edit/'.$course->id) ?>" class="btn btn-sm btn-update-custom">Update</a>
                                <?php endif ?>
                            </td>
                        </tr>                                    
                        <?php endforeach ?>
                    </tbody>
                </table>

                <?php echo $courses->render() ?>
            </div>
        </div>
    </div>
</div>