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
                                <li><a href="#">Home</a></li>
                                <li class="active">
                                    <?php 
                                        if(isset($category)){
                                            echo $category;
                                        }else{
                                            echo 'General';
                                        } 
                                    ?>
                                </li>
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
                                    $countTopicsCategory = checkTopicsCategory($topics, $threads, $cat->id);
                                    if($countTopicsCategory > 0){
                            ?>
                                        <div class="forum-heading">
                                            <h3><?php if(isset($category)){echo $category;}else{echo $cat->category_name;} ?></h3>
                                        </div>
                                        <div class="forum-main">
                                            <div class="forum-list">
                                                <?php 
                                                    foreach($topics as $top){
                                                        if($top->category == $cat->id){
                                                            $countThreadsTopic = checkThreadsTopic($threads, $top->id);
                                                            if($countThreadsTopic > 0){
                                                ?>
                                                                <table class="table table-striped">
                                                                    <thead class="thead-inverse">
                                                                        <tr>
                                                                          <th>Topic : <?php echo $top->topic ?></th>
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
                                                                                                    <h4><?php echo anchor('thread/view/'.$thr->id, $thr->title); ?> 
                                                                                                        <?php 
                                                                                                            if($thr->type=='close'){
                                                                                                                echo '<small class="label label-default"><i class="fa fa-lock"></i> Close Group</small>';
                                                                                                            } 
                                                                                                        ?>
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
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            ?>
                            <center>
                                <div class="forum-pagination">
                                    <nav>
                                        <?php echo $threads->render() ?>
                                    </nav>
                                </div>
                            </center>
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