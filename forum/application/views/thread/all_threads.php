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
                                <li><a href="#">Home</a></li>
                                <li class="active">General</li>
                            </ol>
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
                            <div class="forum-heading">
                                <h3>General</h3>
                            </div>

                            <div class="forum-main">
                                <div class="forum-list">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                              <th>Thread</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
												foreach($threads as $t){
											?>
											<tr>
                                                <td>
                                                    <div class="thread-list-title">
                                                        <h4><?php echo anchor('thread/view/'.$t->id,$t->title); ?> 
															<?php if($t->type=='close'){echo '<small class="label label-default"><i class="fa fa-lock"></i> Close Group</small>';} ?>
														</h4>
                                                    </div>
                                                    <div class="thread-list-meta">
                                                        <ul>
                                                            <li>
                                                                <?php echo countViewer($visitors, $t->id); ?> Views
                                                            </li>
                                                            <li>
                                                                <?php echo countComments($comments, $t->id); ?> Comments
                                                            </li>
                                                            <li>
                                                                Started by <a href="#"><?php echo user($t->author)->full_name; ?></a>
                                                            </li>
                                                            <li>
                                                                <?php echo $t->created_at; ?>
                                                            </li>
                                                            <li>
                                                                in <a href="#"><?php echo $t->category_name; ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
											<?php
												}
											?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="forum-pagination">
                                    <nav>
                                      <ul class="pagination">
                                        <li class="page-item disabled">
                                          <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                        </li>
                                        <li class="page-item active">
                                          <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                          <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                          </a>
                                        </li>
                                      </ul>
                                    </nav>
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