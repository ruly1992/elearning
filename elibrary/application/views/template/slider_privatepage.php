<!-- start:section content main articles -->
<section class="content-articles">
    <div class="content-articles-heading">
        <div class="text-center">
            <h3><?php echo $privatepage_slider_title ?></h3>
        </div>
    </div>
    <div class="content-articles-main">
        <div id="carousel-news" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php $i = 1; ?>
                <?php foreach ($privatepage_slider->chunk(3) as $chunk): ?>                                                
                <div class="carousel-item <?php echo $i == 1 ? 'active' : '' ?>">
                    <div class="row">
                        <?php foreach ($chunk as $article): ?>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="news-box">
                                <div class="news-box-img">
                                    <a href="<?php echo $article->link ?>"><img src="<?php echo $article->featured_image ?>" alt=""></a>
                                </div>
                                <div class="news-box-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> <?php echo $article->contributor->full_name ?></li>
                                        <li>/</li>
                                        <li><i class="fa fa-calendar-check-o"></i> <?php echo $article->date->format('d F Y') ?></li>
                                    </ul>
                                </div>
                                <div class="news-box-title">
                                    <h3><a href="<?php echo $article->link ?>"><?php echo $article->title ?></a></h3>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php $i++; endforeach ?>
            </div>
            <a class="left carousel-control" href="#carousel-news" role="button" data-slide="prev">
                <span class="icon-prev" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-news" role="button" data-slide="next">
                <span class="icon-next" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
<!-- end:section content main articles -->