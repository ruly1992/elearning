<?php get_header('private', array('active' => 'forum')); ?>

        <!-- start:content -->
        <div class="container content content-single content-dashboard content-forum">
            <section id="content">

                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <!-- start:content main -->
                        <div class="content-main">
                            <ol class="breadcrumb">
                                <li><?php echo anchor('thread/', 'Home'); ?></li>
                                <li class="active">Topics</li>
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
                                    echo '<div class="alert alert-ytopic">';
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
                                                  <th>Created</th>
                                                  <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                //$no=1;
                                                foreach($topics as $t){
                                            ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $t->id; ?></th>
                                                        <td>
                                                            <?php echo $t->topic ?>
                                                            <?php
                                                                if($t->status=='1'){
                                                                    echo '<span class="label label-primary">Approved</span>';
                                                                }else{
                                                                    echo '<span class="label label-warning">Waiting</span>';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $t->category_name; ?></td>
                                                        <td>
                                                            <?php 
                                                                foreach($provinsi as $kode=>$nama){
                                                                    $prov = explode('.', $kode);
                                                                    $daerah   = explode('.', $t->daerah);
                                                                    if($prov[0]==$daerah[0]){
                                                                        echo $nama;
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo user($t->tenaga_ahli)->full_name; ?>
                                                        </td>
                                                        <td align="center">
                                                            <p>
                                                                <?php 
                                                                    if($t->tenaga_ahli!=$tenagaAhli AND $t->status=='0'){
                                                                        echo anchor('topic/approve/'.$t->id, 'Approve', 'class="btn btn-primary btn-konsul" data-toggle="tooltip" data-placement="top" title="Approve"').'<br>';
                                                                    }
                                                                ?>
                                                                <?php echo anchor('topic/edit/'.$t->id,'<i class="fa fa-pencil"></i>','class="btn btn-info btn-konsul" data-toggle="tooltip" data-placement="top" title="Edit"'); ?>
                                                                <a href="#" class="btn btn-danger btn-konsul"  data-toggle="modal" data-target=".confirm<?php echo $t->id ?>" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                            </p>
                                                        </td>
                                                    </tr>
                                            <?php 
                                                    //$no++;
                                                } 
                                            ?>
                                            </tbody>
                                        </table>

                                        <?php foreach($topics as $top): ?>
                                            <!-- Start:modal preview -->
                                            <div class="modal fade confirm<?php echo $top->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myLargeModalLabel">Konfirmasi</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-xs-center">
                                                            <h5>Apakah anda akan menghapus topic <?php echo $top->topic ?> ?</h5>
                                                            <?php echo anchor('topic/delete/'.$top->id,'Ya','class="btn btn-danger btn-sm" title="Delete"'); ?>
                                                            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Tidak</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- End:modal preview -->
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            
                                <div class="forum-pagination">
                                    <nav>
                                        <?php echo $topics->render() ?>
                                    </nav>
                                </div>
                        </div>
                        <!-- end:content main -->
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="sidebar-forum">
                            <?php $this->load->view('template/sidebar'); ?>
                        </div>
                    </div>
                </div>
                <!-- end:content -->

            </section>
        </div>
        <!-- emd:content -->

<?php get_footer('private'); ?>