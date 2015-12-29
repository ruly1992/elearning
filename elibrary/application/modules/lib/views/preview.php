<div class="elib-content-single">
    <div class="elib-single-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li><a href="<?php echo $category->link ?>"><?php echo $category->name ?></a></li>
            <li><a href="<?php echo $media->link ?>"><?php echo $media->title ?></a></li>
            <li class="active">Preview</li>
        </ol>
    </div>
    <div class="title">
        <h1><?php echo $media->title ?></h1>
        <span><small>
            <ul>
                <li><i class="fa fa-calendar"></i> <?php echo $media->created_at->format('d/m/Y') ?></li>
                <li><i class="fa fa-user"></i> <?php echo $media->user->full_name ?></li>
            </ul>
        </small></span>
    </div>
    <div class="preview-media">
    	<?php echo $media->getPreview() ?>
    </div>
</div>
