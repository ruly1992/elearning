<?php get_header('faq'); ?>

        <!-- start:main content -->
        <div class="container content-faq">
            <section id="content">

                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- start:content main -->
                        <div class="content-main-faq">
                            <div class="content-forum">
                                <div class="content-main">
                                    <ol class="breadcrumb">
                                        <li><?php echo anchor(home_url('/dashboard'), 'Dashboard'); ?></li>
                                        <li><?php echo anchor(home_url('/konsultasi'), 'Konsultasi'); ?></li>
                                        <li class="active">FAQ</li>
                                    </ol>
                                </div>
                            </div>
							<div class="form-group">
                                <?php echo anchor('dashboard/create','<i class="fa fa-plus"></i> FAQ Baru','class="btn btn-primary btn-sm"'); ?>
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
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Title</th>
                                  <th>Pertanyaan</th>
                                  <th>Jawaban</th>
                                  <th>Time Create</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $noPage = $faq->currentPage();
                                    $no = $noPage + ($noPage - 1) * ($perPage - 1);
                                    foreach($faq as $f){
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $no; ?></th>
                                        <th><?php echo $f->title; ?></th>
                                        <td><p><?php echo $f->question; ?></p></td>
                                        <td><?php echo $f->answer; ?></td>
                                        <td><p><?php echo $f->created_at; ?></p></td>
                                        <td align="center">
                                            <?php echo anchor('dashboard/edit/'.$f->id, 'Edit', 'class="btn btn-info btn-konsul" data-toggle="tooltip" data-placement="top" title="Edit"'); ?>
                                            <?php echo anchor('dashboard/delete/'.$f->id, 'Delete', 'class="btn btn-danger btn-konsul" data-toggle="tooltip" data-placement="top" title="Hapus"'); ?>
                                        </td>
                                    </tr>
                                <?php
                                        $no+=1;
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                        </div>
                        <!-- end:content main -->
                    </div>
                </div>
                <!-- end:content -->

                <center>
                    <?php echo $faq->render(); ?>
                </center>
            </section>
        </div>
        <!-- end:main content -->
<?php get_footer('private'); ?>