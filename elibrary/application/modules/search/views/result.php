<div class="elib-content-single">
    <div class="elib-single-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li class="active">Search</li>
        </ol>
    </div>

    <div class="elib-content-single-list">
        <div class="elib-content-single-list-title">
            <h4><strong>Search in :</strong> <em>"<?php echo $term ?>"</em></h4>
        </div>
        <div class="elib-content-single-list-main">
            <ul>
                <?php if ($results->count()): ?>
                <?php foreach ($results as $media): ?>
                    <li><a href="<?php echo $media->link ?>"><?php echo $media->title ?></a> <small><i class="fa fa-calendar"></i> <?php echo $media->created_at->format('d/m/Y') ?> - <?php echo $media->icon ?> <?php echo $media->type ?></small></li>
                <?php endforeach ?>
                <?php else: ?>
                    <p class="alert alert-warning">Hasil pencarian tidak ditemukan.</p>
                <?php endif ?>
            </ul>
        </div>
        
        <div class="elib-content-single-list-pagination">
            <nav>
                <?php echo (new Library\Media\BootstrapThreeSmallPresenter($results))->render() ?>
            </nav>
        </div>
    </div>
</div>