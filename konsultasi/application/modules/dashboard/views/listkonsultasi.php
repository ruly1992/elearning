<!-- start:content -->
<div class="container content content-single content-dashboard content-forum">
    <section id="content">
        <div class="row">
            <div class="col-lg-12">
                <small>Anda bisa menambahkan hasil konsultasi pada <a href="<?php echo home_url('faq/dashboard'); ?>" class="btn btn-danger">FAQ </a></small>
            </div>
        </div>
        <!-- start:content -->
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <!-- start:content main -->
                <div class="content-main">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url() ?>">Dashboard</a></li>
                        <li>Konsultasi</li>
                        <li class="active"><?php echo $kategoriById->name ?></li>
                    </ol>
                    <div class="btn-group btn-konsultasi">
                        <a href="<?php echo site_url('dashboard/kategori/'.$id_kategori) ?>" class="btn btn-secondary btn-sm <?php echo $prioritas == '' ? 'active' : '' ?>">Semua</a>
                        <a href="<?php echo site_url('dashboard/kategori/'.$id_kategori.'/High') ?>" class="btn btn-secondary btn-sm <?php echo $prioritas == 'High' ? 'active' : '' ?>">High</a>
                        <a href="<?php echo site_url('dashboard/kategori/'.$id_kategori.'/Medium') ?>" class="btn btn-secondary btn-sm <?php echo $prioritas == 'Medium' ? 'active' : '' ?>">Medium</a>
                        <a href="<?php echo site_url('dashboard/kategori/'.$id_kategori.'/Low') ?>" class="btn btn-secondary btn-sm <?php echo $prioritas == 'Low' ? 'active' : '' ?>">Low</a>
                    </div>
                    <div class="table-responsive">
                    <?php if ($konsultasi->count()): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Tanggal Konsultasi</th>
                                  <th>Nama Konsultasi</th>
                                  <th>Nama Kader</th>
                                  <th>Prioritas</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php
                                        $noPage = $konsultasi->currentPage();
                                        $no = $noPage + ($noPage - 1) * ($perPage - 1); 
                                        foreach ($konsultasi as $row) : 
                                    ?>
                                    <?php if ($row->prioritas == "High") {
                                            $class="table-danger"; 
                                            $label="label label-danger";
                                        }  elseif ($row->prioritas == "Medium") { 
                                            $class="table-warning"; 
                                            $label="label label-warning";
                                        }  elseif ($row->prioritas == "Low") { 
                                            $class="table-success"; 
                                            $label="label label-success";
                                        } 
                                    ?>
                                        <tr class="<?php echo $class ?>">
                                            <th scope="row"><?php echo $no ?></th>
                                            <td><?php echo $row->created_at ?></td>
                                            <td><a href="<?php echo site_url('dashboard/detail/'.$row->id) ?>"><?php echo $row->subjek ?></a></td>
                                            <td><?php echo user($row->user_id)->full_name ?></td>
                                            <td><span class="<?php echo $label ; ?>"><?php echo $row->prioritas ?></span></td>
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
                                    <?php $no+=1; endforeach; ?> 
                                </tbody>                                
                        </table>
                        <?php else: ?>                       
                            <p class="alert alert-warning">Tidak ada Konsultasi yang ditampilkan.</p>
                        <?php endif ?>
                    </div>
                </div>
                <center>
                    <nav>
                        <ul class="#">
                            <?php echo $konsultasi->render() ?>
                        </ul>
                    </nav>                
                </center>
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
                                    <a class="list-group-item active">
                                        <span class="label label-default label-pill pull-right"><?php echo count($allKonsultasi); ?></span> All Categories
                                    </a>
                                    <?php foreach ($listKategori as $cat): ?>                                        
                                        <a class="list-group-item"><span class="label label-default label-pill pull-right"><?php echo countKonsultasiKategori($allKonsultasi, $cat->id); ?></span><?php echo $cat->name ?></a>
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