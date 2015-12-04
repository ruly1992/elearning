
<!-- start:content sidebar -->
<div class="content-sidebar">
    <div class="widget">
        <div class="widget-heading">
            <ul class="nav nav-tabs" id="myTabSidebar" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="popular-post-tab" data-toggle="tab" href="#popular-post" role="tab" aria-controls="popular-post" aria-expanded="true">Popular Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="latest-post-tab" data-toggle="tab" href="#latest-post" role="tab" aria-controls="latest-post" aria-expanded="false">Latest Post</a>
                </li>
            </ul>
        </div>
        <div class="widget-content news4">
            <div class="tab-content" id="myTabSidebarContent">
                <div role="tabpanel" class="tab-pane fade active in" id="popular-post" aria-labelledby="popular-post-tab" aria-expanded="true">
                    <?php foreach (Model\Article::popular()->take(5)->get() as $article): ?>
                    <div class="box-articles-widget">
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="box-articles-widget-img">
                                    <a href="<?php echo $article->link ?>"><img src="<?php echo $article->featured_image ?>" alt=""></a>
                                </div>
                            </div>
                            <div class="col-sm-8 col-xs-6">
                                <div class="box-articles-widget-meta">
                                    <ul>
                                        <li><i class="fa fa-calendar"></i> <?php echo $article->date->format('d F Y') ?></li>
                                    </ul>
                                </div>
                                <div class="box-articles-widget-title">
                                    <h4><a href="<?php echo $article->link ?>"><?php echo $article->title ?></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="latest-post" role="tabpanel" aria-labelledby="latest-post-tab" aria-expanded="false">
                    <?php foreach (Model\Article::latest('date')->limit(5)->get() as $article): ?>
                    <div class="box-articles-widget">
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="box-articles-widget-img">
                                    <a href="<?php echo $article->link ?>"><img src="<?php echo $article->featured_image ?>" alt=""></a>
                                </div>
                            </div>
                            <div class="col-sm-8 col-xs-6">
                                <div class="box-articles-widget-meta">
                                    <ul>
                                        <li><i class="fa fa-calendar"></i> <?php echo $article->date->format('d F Y') ?></li>
                                    </ul>
                                </div>
                                <div class="box-articles-widget-title">
                                    <h4><a href="<?php echo $article->link ?>"><?php echo $article->title ?></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

    <div class="widget">
        <div class="widget-heading">
            <h3>LATEST KOMENTAR</h3>
        </div>
        <div class="widget-content">
            <div class="row">
                <?php foreach (Model\Comment::latest('date')->get() as $comment): ?>
                <div class="box-komentar-widget">
                    <div class="col-sm-3 col-xs-4">
                        <div class="box-komentar-widget-img">
                            <img src="<?php echo $comment->avatar ?>" alt="">
                        </div>
                    </div>
                    <div class="col-sm-9 col-xs-8">
                        <div class="box-komentar-widget-title">
                            <p><strong><a href="#"><?php echo $comment->nama ?></a></strong></p>
                        </div>
                        <div class="box-komentar-widget-content">
                            <p><?php echo $comment->content ?> <strong>ON</strong> <a href="<?php echo $comment->article->link ?>"><?php echo $comment->article->title ?></a></p>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- end:content sidebar -->