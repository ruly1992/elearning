<?php get_header('private'); ?>

        <!-- start:content -->
        <div class="container content content-single content-dashboard content-forum">
            <section id="content">

                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <!-- start:content main -->
                        <div class="content-main">
                            <ol class="breadcrumb">
                                <li class="active">Your Topics</li>
                            </ol>
                            <div class="form-group">
                                <?php echo anchor('topic/create','<i class="fa fa-plus"></i> Topic Baru','class="btn btn-primary btn-sm"'); ?>
                            </div>
                            <?php 
                                if(isset($failed)){
                                    echo '<div class="alert alert-danger">';
                                        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                        echo '<strong>Warning!</strong> '.$failed;
                                    echo '</div>';
                                }elseif(isset($success)){
                                    echo '<div class="alert alert-info">';
                                        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                        echo '<strong>Success!</strong> '.$success;
                                    echo '</div>';
                                }
                            ?>
                            <div class="forum-main">
                                <div class="card">
                                    <div class="card-block">
                                       <table class="table table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Topic</th>
                                                  <th>Category</th>
                                                  <th>Daerah</th>
                                                  <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no=1;
                                                foreach($topics as $t){
                                            ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $no; ?></th>
                                                        <td><?php echo $t->topic ?></td>
                                                        <td><?php echo $t->category_name; ?></td>
                                                        <td>
                                                            <?php 
                                                                foreach($provinsi as $kode=>$nama){
                                                                    if($t->daerah==$kode){
                                                                        echo $nama;
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <p>
                                                              <?php echo anchor('topic/edit/'.$t->id,'Edit','class="btn btn-info btn-konsul" data-toggle="tooltip" data-placement="top" title="Edit"'); ?>
                                                              <?php echo anchor('topic/delete/'.$t->id,'Delete','class="btn btn-danger btn-konsul" data-toggle="tooltip" data-placement="top" title="Delete"'); ?>
                                                            </p>
                                                        </td>
                                                    </tr>
                                            <?php 
                                                    $no++;
                                                } 
                                            ?>
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

<?php get_footer('private'); ?>