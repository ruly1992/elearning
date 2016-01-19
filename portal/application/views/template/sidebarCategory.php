
<!-- start:content sidebar -->
<div class="content-sidebar">
    <!-- Begin Article Pilihan -->
    <div class="favorit favorit-single">
        <div class="widget-heading">
            <h3>ARTIKEL PILIHAN</h3>
        </div>
        <div class="widget-content">
            <ul class="article">
            <?php
            $choices = Model\Portal\Article::editorChoice()->onlyRegistered()->latest('date')->get();
            $no = 1;

            foreach ($choices->slice(0, 10) as $article): ?>
                <li class="list-article">
                    <a href="<?php echo $article->link ?>">
                        <div class="list-numb"><?php echo str_pad($no, 2, '0', STR_PAD_LEFT) ?></div>
                        <div class="list-title">
                            <h3><span><?php echo $article->title ?></span></h3>
                        </div>
                    </a>
                </li>
            <?php $no++; endforeach ?>
            </ul>
        </div>
    </div>
    <!-- End Article Pilihan -->
    <div class="widget">
        <div class="widget-heading">
            <ul class="nav nav-tabs" id="myTabSidebar" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="popular-post-tab" data-toggle="tab" href="#popular-post" role="tab" aria-controls="popular-post" aria-expanded="true">Terpopuler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="latest-post-tab" data-toggle="tab" href="#latest-post" role="tab" aria-controls="latest-post" aria-expanded="false">Terkini</a>
                </li>
            </ul>
        </div>
        <div class="widget-content news4">
            <div class="tab-content" id="myTabSidebarContent">
                <div role="tabpanel" class="tab-pane fade active in" id="popular-post" aria-labelledby="popular-post-tab" aria-expanded="true">
                    <?php foreach (Model\Portal\Article::onlyRegistered()->popular()->take(5)->get() as $article): ?>
                    <div class="box-articles-widget">
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="box-articles-widget-img">
                                    <a href="<?php echo $article->link ?>"><img src="<?php echo $article->featured_image ?>" alt=""></a>
                                </div>
                            </div>
                            <div class="col-sm-8 col-xs-6">
                                <div class="box-articles-widget-meta">
                                    <p><i class="fa fa-calendar"></i> <?php echo $article->date->format('d F Y') ?></p>
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
                    <?php foreach (Model\Portal\Article::onlyRegistered()->latest('date')->limit(5)->get() as $article): ?>
                    <div class="box-articles-widget">
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="box-articles-widget-img">
                                    <a href="<?php echo $article->link ?>"><img src="<?php echo $article->featured_image ?>" alt=""></a>
                                </div>
                            </div>
                            <div class="col-sm-8 col-xs-6">
                                <div class="box-articles-widget-meta">
                                    <p><i class="fa fa-calendar"></i> <?php echo $article->date->format('d F Y') ?></p>
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
            <h3>KOMENTAR TERKINI</h3>
        </div>
        <div class="widget-content">
            <?php foreach (Model\Portal\Comment::whereHas('article', function ($query) {
                return $query->where('type', 'private');
            })->latest('date')->get() as $comment): ?>
            <div class="row">
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
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!-- end:content sidebar -->