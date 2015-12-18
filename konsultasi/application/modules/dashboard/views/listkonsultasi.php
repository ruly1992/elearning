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
                        <?php $no = 1; foreach ($konsultasi as $row) : ?>
                        <tr>
                            <th scope="row"><?php echo $no ?></th>
                            <td><?php echo $row->created_at ?></td>
                            <td><a href="<?php echo site_url('dashboard/detail/'.$row->id) ?>"><?php echo $row->subjek ?></a></td>
                            <td><?php echo user($row->user_id)->full_name ?></td>
                            <td>
                            <?php if ($row->status == "open"): ?>
                                <p class="label label-primary">Active</p>
                            <?php else :?>
                                <p class="label label-default">Close</p>
                            <?php endif ?>
                            </td>
                            <td align="center">
                                <p>                                   
                                    <?php if ($row->status == "open"): ?>
                                        <a href="<?php echo site_url('dashboard/detail/'. $row->id) ?>" class="btn btn-info btn-konsul" data-toggle="tooltip" data-placement="top" title="Reply">Reply</a>
                                        <a href="<?php echo site_url('dashboard/status/open/'.$id_kategori.'/'.$row->id) ?>" class="btn btn-danger btn-konsul" data-toggle="tooltip" data-placement="top" title="Close">Close</a>
                                    <?php else : ?>
                                        <a href="<?php echo site_url('dashboard/status/close/'.$id_kategori.'/'. $row->id) ?>" class="btn btn-success btn-konsul" data-toggle="tooltip" data-placement="top" title="Reopen">Reopen</a>
                                    <?php endif ?>    

                                </p>
                            </td>
                        </tr>
                        <?php $no++; endforeach; ?>                        
                    </tbody>
                </table>
                <nav>
                    <ul class="pager">
                        <?php echo $konsultasi->render() ?>
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
                                        <span class="label label-default label-pill pull-right"><?php echo count($allKonsultasi); ?></span> All Categories
                                    </a>
                                    <?php foreach ($listKategori as $cat): ?>                                        
                                        <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right"><?php echo countKonsultasiKategori($allKonsultasi, $cat->id); ?></span><?php echo $cat->name ?></a>
                                    <?php endforeach ?>
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