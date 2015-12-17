<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="elib-content-left">
            <div class="elib-content-left-heading">
                <h4>Library <?php echo $category->name ?></h4>
            </div>
            <div class="elib-content-left-main">
                <ul>
                    <?php if ($media->count()): ?>
                    	<?php $medias = $media; foreach ($medias as $media): ?>
                        	<li><a href="<?php echo $media->link ?>"><?php echo $media->name ?></a> <small><i class="fa fa-calendar"></i> <?php echo $media->created_at->format('d/m/Y') ?> - <?php echo $media->icon ?> <?php echo $media->type ?></small></li>
                    	<?php endforeach; ?>
                    <?php else: ?>
                    	<p class="alert alert-danger">Tidak ada library tersedia.</p>
                    <?php endif; ?>
                </ul>
            </div>

			<?php if ($media->count()): ?>
            	<?php echo $medias->render() ?>
        	<?php endif ?>
        </div>
    </div>
</div>