<!-- start:content -->
<div class="container content content-single content-dashboard content-forum">
    <section id="content">

        <!-- start:content -->
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <!-- start:content main -->
                <div class="content-main">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Konsultasi</a></li>
                        <li class="active">Tenaga Ahli</li>
                    </ol>

                    <div class="content-konsultasi-table">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Tanggal Konsultasi</th>
                          <th>Nama Konsultasi</th>
                          <th>Nama Learner</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($konsultasi as $row) : ?>
                        <tr>
                            <th scope="row"><?php echo $row->id ?></th>
                            <td><?php echo $row->created_at ?></td>
                            <td><?php echo $row->subjek ?></td>
                            <td><?php echo $row->user_id ?></td>
                            <td><?php echo $row->status ?></td>
                            <td align="center">
                                <p>
                                  <a href="<?php echo site_url('dashboard/detail/'. $row->id) ?>" class="btn btn-info btn-konsul" data-toggle="tooltip" data-placement="top" title="Reply">Reply</a>
                                  <a href="<?php echo site_url('dashboard/detail/'. $row->id) ?>" class="btn btn-danger btn-konsul" data-toggle="tooltip" data-placement="top" title="Close">Close</a>
                                </p>
                            </td>
                        </tr>
                        <?php endforeach ?>                        
                    </tbody>
                </table>
                <select class="c-select">
                    <option selected>Hasil perhalaman</option>
                    <option value="1">5</option>
                    <option value="2">10</option>
                    <option value="3">50</option>
                    <option value="4">100</option>
                    <option value="5">Tidak terbatas</option>
                </select>
                <nav>
                    <ul class="pager">
                        <li><a href="#">Sebelumnya</a></li>
                        <li><a href="#">Berikutnya</a></li>
                    </ul>
                </nav>
            </div>
                </div>
                <!-- end:content main -->
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="sidebar-forum">
                    <div class="widget">
                        <div class="widget-categories">
                            <div class="widget-categories-heading">
                                <h4>Categories</h4>
                            </div>
                            <div class="widget-categories-content">
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        <span class="label label-default label-pill pull-right">14</span> All Categories
                                    </a>
                                    <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> Video Conferences</a>
                                    <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> Kelas Online</a>
                                    <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> E-Library</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:content -->

    </section>
</div>
<!-- emd:content -->