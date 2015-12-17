<?php echo form_open_multipart('dashboard/editArticle/' . $artikel->id); ?>

<?php echo show_message() ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">        
            <div class="panel-heading">
                <h4 class="panel-title">Artikel</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo form_input('title', set_value('title', $artikel->title), array('class' => 'form-control input-lg', 'placeholder' => 'Title')); ?>
                </div>

                <div class="form-group">
                    <p class="text-static">
                        Link : <a href="<?php echo getLinkArticle($artikel) ?>" target="_blank"><?php echo getLinkArticle($artikel) ?></a>
                    </p>
                </div>
                <div class="form-group">
                    <?php echo form_textarea('content', set_value('content', $artikel->content, FALSE), array('class' => 'form-control editor')); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Category</h4>
            </div>
            <div class="panel-body">
                <?php echo $categories_checkbox ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Featured Image</h4>
            </div>
            <div class="panel-body">
                <div class="featured thumbnail" style="max-width: 200px;">
                    <?php if ($artikel->featured_image): ?>
                        <img class="featured-preview" src="<?php echo base_url("portal/assets/upload/featured/"."$artikel->featured_image") ?>" width="100%">
                        <img class="featured-preview-default" src="<?php echo base_url('assets/admin/img/default_avatar_male.jpg') ?>" style="display: none;">
                    <?php else: ?>
                        <img class="featured-preview" src="" width="100%" style="display: none;">
                        <img class="featured-preview-default" src="<?php echo base_url('index.php/assets/admin/img/default_avatar_male.jpg') ?>">
                    <?php endif ?>
                    <input type="hidden" name="featured" value="<?php echo $artikel->featured_image ?>">
                </div> 
            </div>
            <div class="form-group">
                <input type="file" name="featured" value=""></input>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Update</button>
        <?php echo button_delete('dashboard/delete/'.$artikel->id, 'sm') ?>
    </div>
    
</div>

<?php echo form_close(); ?>