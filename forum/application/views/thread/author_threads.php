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
                                <li class="active">
                                    <?php if(isset($category)){ echo anchor( 'author/', 'Your Threads'); }else{ echo 'Your Threads'; } ?>
                                </li>
                                <?php if(isset($category)){ echo '<li class="active"> '.$category.'</li>'; } ?>
                            </ol>
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
                            <div class="form-group">
                                <?php echo anchor('thread/create', '<i class="fa fa-plus"></i> Thread Baru','class="btn btn-primary btn-sm"'); ?>
                                <?php 
                                    if(isset($tenagaAhli)){
                                        echo $addTopic.' '.$dashTopic;
                                    }
                                ?>
                            </div>
                            <?php 
                                foreach($categoriesHead as $cat){
                            ?>
                                    <div class="forum-heading">
                                        <h3><?php if(isset($category)){echo $category;}else{echo $cat->category_name;} ?></h3>
                                    </div>
                                    <div class="forum-main">
                                        <div class="forum-list">
                                            <?php 
                                                foreach($topics as $top){
                                                    if($top->category == $cat->id){
                                            ?>
                                                    <table class="table table-striped">
                                                        <thead class="thead-inverse">
                                                            <tr>
                                                              <th colspan="2">Topic : <?php echo $top->topic ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $isThread = false;
                                                                foreach($threads as $thr){
                                                                    if($cat->id == $thr->category AND $top->id == $thr->topic){
                                                                        $isThread = true;
                                                                        if($thr->type == 'close'){
                                                                            showThread($thr, $visitors, $comments, $threadMembers, $thr->id, $userID);
                                                                        }else{
                                                            ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="thread-list-title">
                                                                                        <h4><?php echo anchor('author/view/'.$thr->id, $thr->title); ?> 
                                                                                            <?php if($thr->type=='close'){echo '<small class="label label-default"><i class="fa fa-lock"></i> Close Group</small>';} ?>
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="thread-list-meta">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <?php echo countViewer($visitors, $thr->id); ?> Views
                                                                                            </li>
                                                                                            <li>
                                                                                                <?php echo countComments($comments, $thr->id); ?> Comments
                                                                                            </li>
                                                                                            <li>
                                                                                                Started by <a href="#"><?php echo user($thr->author)->full_name; ?></a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <?php echo $thr->created_at; ?>
                                                                                            </li>
                                                                                            <li>
                                                                                                in <a href="#"><?php echo $thr->category_name; ?></a>
                                                                                            </li>
                                                                                            <li>
                                                                                                Status 
                                                                                                <?php if($thr->status=='0'){ echo anchor('#', 'Waiting'); }else{ echo anchor('#', 'Approved'); } ?>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </td>
                                                                                <td align="center" width="80px">   
                                                                                    <?php echo anchor('author/edit/'.$thr->id, '<i class="fa fa-pencil-square-o"></i>', 'class="btn btn-primary-outline btn-thread" data-toggle="tooltip" data-placement="top" title="Edit"'); ?>
                                                                                    <?php echo anchor('author/delete/'.$thr->id, '<i class="fa fa-trash-o"></i>', 'class="btn btn-danger-outline btn-thread" data-toggle="tooltip" data-placement="top" title="Delete"'); ?>
                                                                                </td>
                                                                            </tr>
                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                                if($isThread == false){
                                                            ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="thread-list-title">
                                                                                <h4>Belum ada thread</h4>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                            <div class="forum-pagination">
                                <nav>
                                    <?php echo $threads->render() ?>
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
                                            <?php if(isset($category)){$activeSide='';}else{ $activeSide='active';} ?>
                                            <?php echo anchor('author/', '<span class="label label-default label-pill pull-right"> '.count($authorSide).'</span> All Categories', 'class="list-group-item '.$activeSide.'"'); ?>
                                            <?php 
                                                foreach($categoriesSide as $c){
                                                    if(isset($category) AND $category == $c->category_name){$active='active';}else{$active='';}
                                                    echo anchor('author/category/'.$c->id, '<span class="label label-default label-pill pull-right">'.countThreadCategories($authorSide, $c->id).'</span> '.$c->category_name, 'class="list-group-item '.$active.'"');
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
                                                echo anchor('author/', '<span class="label label-default label-pill pull-right">'.count($authorSide).'</span> Your Threads', 'class="list-group-item active"');
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