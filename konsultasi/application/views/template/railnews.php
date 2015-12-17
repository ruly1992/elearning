<!-- start:rails news -->
<div class="rails-news">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                <button type="button" class="btn btn-secondary" href="#carousel-rails-news" role="button" data-slide="prev"><i class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-secondary" href="#carousel-rails-news" role="button" data-slide="next"><i class="fa fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <div id="carousel-rails-news" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php
                    $i = 0;
                    $railnews = Model\Portal\Article::latest('date')->take(3)->get();

                    foreach ($railnews as $article): ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : '' ?>">
                            <p><a href="<?php echo $article->link ?>"><?php echo $article->title ?></a> - <?php echo $article->date->format('d M Y') ?></p>
                        </div>
                    <?php $i++; endforeach; ?>
                </div>
                
            </div>
        </div>
    </div>
    
</div>
<!-- end:rails news -->