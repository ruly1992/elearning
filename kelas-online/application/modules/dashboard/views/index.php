<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <section class="content-articles">
                <div class="content-articles-heading">
                    <h3>Dashboard Kelas Online</h3>
                </div>
            </section>
        
        <div class="container content-dashboard-kelas-online">
            <div class="row">
                <div class="alert alert-warning" role="alert">
                    <strong>2 kelas</strong> masih di moderasi. <a href="#" class="btn btn-sm btn-warning">Lihat</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Materi</h3>
                    </div>
                    <div class="card-block">
                        <div class="button-add">
                            <a href="<?php echo site_url('dashboard/course/create') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus fa-fw"></i>Tambah kelas baru</a>   
                        </div>
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
                                <tr>
                                  <th scope="row">001</th>
                                  <td>Kategori 1</td>
                                  <td>Kependudukan</td>
                                  <td><div class="label label-success">publish</div></td>
                                  <td><a href="#" class="btn btn-sm btn-update-custom">Update</a></td>
                                </tr>
                                <tr>
                                  <th scope="row">002</th>
                                  <td>Kategori 2</td>
                                  <td>Pemerintahan desa</td>
                                  <td><div class="label label-success">publish</div></td>
                                  <td><a href="#" class="btn btn-sm btn-update-custom">Update</a></td>
                                </tr>
                                <tr>
                                  <th scope="row">003</th>
                                  <td>Kategori 3</td>
                                  <td>Kebudayaan Masyarkat di pedesaan</td>
                                  <td><div class="label label-success">publish</div></td>
                                  <td><a href="#" class="btn btn-sm btn-update-custom">Update</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>