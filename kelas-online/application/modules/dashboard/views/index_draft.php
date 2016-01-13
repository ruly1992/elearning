<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <section class="content-articles">
                <div class="content-articles-heading">
                    <h3>Dashboard Kelas Online</h3>
                </div>
            </section>
        
        <div class="container content-dashboard-kelas-online">
            <div class="row">
                <div class="alert alert-secondary" role="alert">
                    <strong><a href="<?php echo site_url('dashboard') ?>" class="btn btn-sm btn-warning"><i class="fa fa-arrow-circle-left"></i> Kembali</a></strong>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Materi</h3>
                    </div>
                    <div class="card-block">
                        <div class="button-add">
                            <a href="<?php echo site_url('dashboard/course/create') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus fa-fw"></i>Tambah kelas baru</a>   
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
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
                                        <td><a href="<?php echo site_url('dashboard/course/edit/'.$course->id) ?>" class="btn btn-konsul btn-update-custom">Update</a></td>
                                    </tr>                                    
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>