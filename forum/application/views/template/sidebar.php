
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

                            <?php if(isset($sideTopics)){ ?>
                                <div class="widget">
                                    <div class="widget-categories">
                                        <div class="widget-categories-heading">
                                            <h4>Your Topics</h4>
                                        </div>
                                        <div class="widget-categories-content">
                                            <div class="list-group">
                                                <?php 
                                                    foreach($sideTopics as $top){
                                                        if($top->id == $idTopic){ $a='active'; }else{ $a=''; }
                                                        echo anchor('#', $top->topic, 'class="list-group-item '.$a.'"');
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>