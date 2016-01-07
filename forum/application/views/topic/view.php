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
                                                                <?php echo anchor('topic/delete/'.$t->id,'<i class="fa fa-trash"></i>','class="btn btn-danger btn-konsul" data-toggle="tooltip" data-placement="top" title="Delete"'); ?>
                                                            </p>
                                                        </td>
                                                    </tr>
                                            <?php 
                                                    //$no++;
                                                } 
                                            ?>
                                            </tbody>
                                        </table>
                                        <nav>
                                            <ul class="pager">
                                                <?php echo $topics->render() ?>
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
                                            <?php if(isset($category)){$activeSide='';}else{ $activeSide='active';} ?>
                                            <?php echo anchor('thread/', '<span class="label label-default label-pill pull-right"> '.countThreads($threadSide, $closeThreads).'</span> All Categories', 'class="list-group-item '.$activeSide.'"'); ?>
                                            <?php 
                                                foreach($categoriesSide as $c){
                                                    if(isset($category) AND $category == $c->category_name){$active='active';}else{$active='';}
                                                    echo anchor('thread/category/'.$c->id, '<span class="label label-default label-pill pull-right">'.countThreadsCategory($threadSide, $c->id, $closeThreads).'</span> '.$c->category_name, 'class="list-group-item '.$active.'"');
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget">
                                <div class="widget-categories">
                                    <div class="widget-categories-heading">
                                        <h4>Threads</h4>
                                    </div>
                                    <div class="widget-categories-content">
                                        <div class="list-group">
                                            <?php 
                                                if(isset($tenagaAhli)){ 
                                                    echo anchor('draft/', '<span class="label label-default label-pill pull-right">'.count($draftSide).'</span> Draft Threads', 'class="list-group-item"');
                                                }
                                            ?>
                                            <?php 
                                                echo anchor('author/', '<span class="label label-default label-pill pull-right">'.count($authorSide).'</span> Your Threads', 'class="list-group-item"');
                                            ?>
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