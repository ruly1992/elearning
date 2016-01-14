<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="elib-content-left">
            <div class="elib-content-left-heading">
                <h4>Library Terbaru</h4>
            </div>
            <div class="elib-content-left-main">
                <ul>
                <?php if ($media_latest->count()): ?>
                    <?php foreach ($media_latest as $media): ?>
                        <li><a href="<?php echo $media->link ?>"><?php echo $media->title ?></a> <small><i class="fa fa-calendar"></i> <?php echo $media->created_at->format('d/m/Y') ?> - <?php echo $media->icon ?> <?php echo $media->type ?></small></li>
                    <?php endforeach ?>
                <?php else: ?>
                    <li><p class="alert alert-warning">Media tidak tersedia.</p></li>
                <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="elib-content-right">
            <div class="elib-content-right-heading">
                <h4>Library Terpopular</h4>
            </div>
            <div class="elib-content-right-main">
                <ul>
                <?php if ($media_popular->count()): ?>
                    <?php foreach ($media_popular as $media): ?>
                        <li><a href="<?php echo $media->link ?>"><?php echo $media->title ?></a> <small><i class="fa fa-calendar"></i> <?php echo $media->created_at->format('d/m/Y') ?> - <?php echo $media->icon ?> <?php echo $media->type ?></small></li>
                    <?php endforeach ?>
                <?php else: ?>
                    <li><p class="alert alert-warning">Media tidak tersedia.</p></li>
                <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php foreach ($categories->take(6)->chunk(3) as $chunk): ?>
    <div class="row">
        <?php foreach ($chunk as $category): ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="box-elib">
                    <div class="box-elib-heading">
                        <h4><?php echo $category->name ?> <a href="<?php echo elib_url('category/'.$category->name) ?>"><span class="pull-right">Lihat Semua <i class="fa fa-arrow-right"></i></span></a></h4>
                    </div>
                    <div class="box-elib-content">
                        <ul>
                            <?php if ($category->media->count()): ?>
                                <?php foreach ($category->media->take(3) as $media): ?>
                                    <li><a href="<?php echo $media->link ?>"><?php echo $media->title ?></a> <small><i class="fa fa-calendar"></i> <?php echo $media->created_at->format('d-m-Y') ?> - <?php echo $media->icon ?> <?php echo $media->type ?></small></li>
                                <?php endforeach ?>
                            <?php else: ?>
                                <li><p class="alert alert-warning">Tidak ada media</p></li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>