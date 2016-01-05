<style>
    .single-article-content img {
        width: 100%;
    }
</style>

<article>
    <div class="single-article-title">
        <h1><?php echo $article->title ?></h1>
    </div>
    <div class="single-article-share col-md-4 col-md-offset-8">
        <div class="row">
            <ul class="rrssb-buttons">
                <li class="rrssb-facebook">
                    <!--  Replace with your URL. For best results, make sure you page has the proper FB Open Graph tags in header:
                          https://developers.facebook.com/docs/opengraph/howtos/maximizing-distribution-media-content/ -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $article->link ?>" class="popup">
                        <span class="rrssb-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29"><path d="M26.4 0H2.6C1.714 0 0 1.715 0 2.6v23.8c0 .884 1.715 2.6 2.6 2.6h12.393V17.988h-3.996v-3.98h3.997v-3.062c0-3.746 2.835-5.97 6.177-5.97 1.6 0 2.444.173 2.845.226v3.792H21.18c-1.817 0-2.156.9-2.156 2.168v2.847h5.045l-.66 3.978h-4.386V29H26.4c.884 0 2.6-1.716 2.6-2.6V2.6c0-.885-1.716-2.6-2.6-2.6z"/></svg></span>
                        <span class="rrssb-text">Facebook</span>
                    </a>
                </li>
                <li class="rrssb-twitter">
                <!-- Replace href with your Meta and URL information  -->
                    <a href="https://twitter.com/intent/tweet?text=<?php echo $article->link ?>"
                    class="popup">
                        <span class="rrssb-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                              <path d="M24.253 8.756C24.69 17.08 18.297 24.182 9.97 24.62c-3.122.162-6.22-.646-8.86-2.32 2.702.18 5.375-.648 7.507-2.32-2.072-.248-3.818-1.662-4.49-3.64.802.13 1.62.077 2.4-.154-2.482-.466-4.312-2.586-4.412-5.11.688.276 1.426.408 2.168.387-2.135-1.65-2.73-4.62-1.394-6.965C5.574 7.816 9.54 9.84 13.802 10.07c-.842-2.738.694-5.64 3.434-6.48 2.018-.624 4.212.043 5.546 1.682 1.186-.213 2.318-.662 3.33-1.317-.386 1.256-1.248 2.312-2.4 2.942 1.048-.106 2.07-.394 3.02-.85-.458 1.182-1.343 2.15-2.48 2.71z"
                              />
                            </svg>
                        </span>
                        <span class="rrssb-text">twitter</span>
                    </a>
                </li>
                <li class="rrssb-googleplus">
                    <!-- Replace href with your meta and URL information.  -->
                    <a href="https://plus.google.com/share?url=<?php echo $article->link ?>" class="popup">
                      <span class="rrssb-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 8.29h-1.95v2.6h-2.6v1.82h2.6v2.6H21v-2.6h2.6v-1.885H21V8.29zM7.614 10.306v2.925h3.9c-.26 1.69-1.755 2.925-3.9 2.925-2.34 0-4.29-2.016-4.29-4.354s1.885-4.353 4.29-4.353c1.104 0 2.014.326 2.794 1.105l2.08-2.08c-1.3-1.17-2.924-1.883-4.874-1.883C3.65 4.586.4 7.835.4 11.8s3.25 7.212 7.214 7.212c4.224 0 6.953-2.988 6.953-7.082 0-.52-.065-1.104-.13-1.624H7.614z"/></svg></span>
                      <span class="rrssb-text">google+</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php if ($article->hasFeaturedImage()): ?>
        <div class="single-article-img">
            <img src="<?php echo $article->featured_image ?>" alt="">
        </div>
    <?php endif ?>
    <div class="single-article-meta">
        <ul>
            <li><i class="fa fa-calendar-check-o"></i> <?php echo $article->date->format('d F Y') ?></li>
            <li><i class="fa fa-folder-open-o"></i> <?php echo $article->categories->implode('name', ', ') ?></li>
            <li><i class="fa fa-comments-o"></i> <?php echo $article->comments->count() ?> Komentar</li>
        </ul>
    </div>
    <div class="single-article-content">
        <?php echo $article->content ?>
    </div>
    <div class="single-article-author">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-12">
                <div class="single-article-author-img">
                    <img src="<?php echo $article->author_avatar ?>" alt="">
                </div>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12">
                <div class="single-article-author-title">
                    <p><a href="#"><?php echo $article->author_name ?></a></p>
                </div>
                <div class="single-article-author-role">
                    <p><em>Editor: <?php echo $article->editor->full_name?></em></p>
                </div>
                <div class="single-article-author-description">

                </div>
            </div>
        </div>
    </div>
</article>

<!-- start:section comments -->
<section id="comments">
    <div class="comments-form">
        <div class="comments-title">
            <h3>Leave a Comments</h3>
        </div>
        <div class="comments-form-main">
            <?php echo $this->load->view('comment/create', array(
                'article'   => $article,
                'parent'    => 0,
            )); ?>
        </div>
        <div class="comments-title">
            <h3>Latest Comments</h3>
        </div>
        <div class="comments-content">
            <?php if ($article->comments->count()): foreach ($article->comments as $comment): ?>
            <div class="media" id="comment-<?php echo $comment->id ?>">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="<?php echo $comment->avatar ?>">
                    </a>
                </div>
                <div class="media-body">
                    <div class="media-body-bg">
                        <h4 class="media-heading"><?php echo $comment->nama ?> <a href="#comments" class="pull-right btn btn-sm btn-reply" data-parent="<?php echo $comment->id ?>">Reply</a></h4>
                        <p><?php echo $comment->content ?></p>
                    </div>

                    <?php foreach ($comment->replies as $reply): ?>
                    <div class="media" id="comment-<?php echo $reply->id ?>">
                        <a class="media-left" href="#">
                            <img class="media-object" src="<?php echo $reply->avatar ?>">
                        </a>
                        <div class="media-body">
                            <div class="media-body-bg">
                                <h4 class="media-heading"><?php echo $reply->nama ?></h4>
                                <p><?php echo $reply->content ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>

                </div>
            </div>            
            <?php endforeach; else: ?>
            <p class="alert alert-info">Belum ada komentar.</p>
            <?php endif ?>
        </div>
    </div>
</section>
<!-- end:section comments -->


<!-- start:section content main articles -->
<section class="content-articles">
    <div class="content-articles-heading">
        <h3><?php echo $relevance_title ?></h3>
    </div>
    <div class="content-articles-main news3">
            <div class="row">
            <?php foreach ($relevance->chunk(3) as $chunk): ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php foreach ($chunk as $artikel): ?>                        
                        <div class="box-articles-sm">
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="box-articles-sm-img">
                                        <a href="<?php echo $artikel->link ?>"><img src="<?php echo $artikel->featured_image ?>" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-xs-12">
                                    <div class="box-articles-sm-meta">
                                        <p><i class="fa fa-calendar"></i> <?php echo $artikel->date->format('d F Y') ?></p>
                                    </div>
                                    <div class="box-articles-sm-title">
                                        <h4><a href="<?php echo $artikel->link ?>"><?php echo $artikel->title ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>  
            </div>
        </div>
</section>
<!-- end:section content main articles -->

<?php custom_stylesheet() ?>
    <link rel="stylesheet" type="text/css" href="<?php echo asset('plugins/rrssb-master/css/rrssb.css') ?>">
<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <script src="<?php echo asset('plugins/rrssb-master/js/rrssb.min.js') ?>"></script>
<?php endcustom_script() ?>
