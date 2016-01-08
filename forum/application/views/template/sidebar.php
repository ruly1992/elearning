
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
                                                $c              = $categoriesSide;
                                                $limitCat       = 3; //Jumlah yang ditampilkan
                                                $jumlahPageCat  = ceil(count($c)/$limitCat); //menghitung jumlah halaman/tab
                                                $cat            = 0;
                                                echo '<div class="tab-content">';
                                                for($page=1; $page<=$jumlahPageCat; $page++){
                                            ?>
                                                <div class="tab-pane fade <?php if($page==1){echo'active in';}?>" id="cat<?php echo $page; ?>">
                                            <?php
                                                    for($cat; $cat<($limitCat*$page); $cat++){
                                                        if(!empty($c[$cat])){
                                                            if(isset($category) AND $category == $c[$cat]->category_name){$active='active';}else{$active='';}
                                                            echo anchor('thread/category/'.$c[$cat]->id, '<span class="label label-default label-pill pull-right">'.countThreadsCategory($threadSide, $c[$cat]->id, $closeThreads).'</span> '.$c[$cat]->category_name, 'class="list-group-item '.$active.'"');
                                                        }
                                                    }
                                            ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <?php if($page != 1){ ?>
                                                            <ul class="pagination pagination-sm pull-left" role="tablist">
                                                                <li class="page-item">
                                                                    <a class="page-link cat-link" data-toggle="tab" role="tab" href="#cat<?php if($page != 1){ echo $page-1; } ?>" aria-label="Previous">
                                                                        <span aria-hidden="true">Prev &laquo;</span>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <?php if($page !=  $jumlahPageCat){ ?>
                                                            <ul class="pagination pagination-sm pull-right" role="tablist">
                                                                <li class="page-item">
                                                                  <a class="page-link cat-link" data-toggle="tab" role="tab" href="#cat<?php if($page != $jumlahPageCat){ echo $page+1; } ?>" aria-label="Next">
                                                                    <span aria-hidden="true">Next &raquo;</span>
                                                                    <span class="sr-only">Next</span>
                                                                  </a>
                                                                </li>
                                                            </ul>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                </div>
                                            <?php  
                                                }
                                                echo '</div>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if(isset($sideTopics)){ ?>
                                <div class="widget">
                                    <div class="widget-categories">
                                        <div class="widget-categories-heading">
                                            <h4>Your Topics</h4>
                                        </div>
                                        <div class="widget-categories-content">
                                            <div class="list-group">
                                                <?php 
                                                $t              = $sideTopics;
                                                $limitTop       = 3; //Jumlah yang ditampilkan
                                                $jumlahPageTop  = ceil(count($t)/$limitTop); //menghitung jumlah halaman/tab
                                                $top            = 0;
                                                echo '<div class="tab-content">';
                                                for($page=1; $page<=$jumlahPageTop; $page++){
                                            ?>
                                                <div class="tab-pane fade <?php if($page==1){echo'active in';}?>" id="top<?php echo $page; ?>">
                                                <?php 
                                                    for($top; $top<($limitTop*$page); $top++){
                                                        if(!empty($t[$top])){
                                                            if(isset($idTopic) AND $t[$top]->id == $idTopic){ $a='active'; }else{ $a=''; }
                                                            echo anchor('#', $t[$top]->topic, 'class="list-group-item '.$a.'"');
                                                        }
                                                    }
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <?php if($page != 1){ ?>
                                                            <ul class="pagination pagination-sm pull-left" role="tablist">
                                                                <li class="page-item">
                                                                    <a class="page-link top-link" data-toggle="tab" role="tab" href="#top<?php if($page != 1){ echo $page-1; } ?>" aria-label="Previous">
                                                                        <span aria-hidden="true">Prev &laquo;</span>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <?php if($page !=  $jumlahPageTop){ ?>
                                                            <ul class="pagination pagination-sm pull-right" role="tablist">
                                                                <li class="page-item">
                                                                  <a class="page-link top-link" data-toggle="tab" role="tab" href="#top<?php if($page != $jumlahPageTop){ echo $page+1; } ?>" aria-label="Next">
                                                                    <span aria-hidden="true">Next &raquo;</span>
                                                                    <span class="sr-only">Next</span>
                                                                  </a>
                                                                </li>
                                                            </ul>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                </div>
                                            <?php  
                                                }
                                                echo '</div>';
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

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

                            

                            <?php custom_script(); ?>
                                <script type="text/javascript">
                                    $(".cat-link").click(function(){
                                        $(".cat-link").removeClass("active");
                                    });
                                    $(".top-link").click(function(){
                                        $(".top-link").removeClass("active");
                                    });
                                </script>
                            <?php endcustom_script(); ?>