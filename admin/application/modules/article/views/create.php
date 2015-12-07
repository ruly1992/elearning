<?php echo form_open_multipart('article/add'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <?php echo form_input('title', set_value('title'), array('class' => 'form-control input-lg', 'placeholder' => 'Title')); ?>
                </div>

                <div class="form-group">
                    <?php echo form_textarea('content', set_value('content', '', FALSE), array('class' => 'form-control editor')); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Publish</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="type">Status</label>
                    <?php echo form_dropdown('status', $status, 'publish', array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <label for="type">Only Registered?</label>
                    <div class="form-group">
                        <label class="switch switch-danger">
                            <?php echo form_checkbox('private', 1, FALSE, array('class' => 'switch-input')); ?>
                            <span class="switch-label" data-on="Yes" data-off="No"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>                    
                </div>
                <div class="form-group">
                    <label for="published">Set Publish Datetime</label>
                    <a href="#" class="text-primary open-schedule">Set Schedule</a>
                    <div class="input-group input-schedule" style="display: none;">
                        <?php echo form_input('published', date('Y-m-d H:i:s'), array('class' => 'form-control input-sm datetimepicker', 'id' => 'published')); ?>
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-sm close-schedule">No schedule</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>

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
                <h4 class="panel-title">Tags</h4>
            </div>
            <div class="panel-body">
                <?php echo form_dropdown('tags[]', array(), array(), array('class' => 'form-control input-tags', 'multiple' => true)) ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Carousel Slider</h4>
            </div>
            <div class="panel-body">
                <div class="slidercarousel thumbnail" style="max-width: 200px; ">
                    <img class="featured-preview" src="" width="100%" style="display: none;">
                    <img class="featured-preview-default" src="<?php echo asset('images/portal/img-carousel-default.jpg') ?>">
                </div>
                <div>
                    <a href="<?php echo base_url('filemanager/dialog.php?type=0&field_id=slidercarousel_url') ?>" class="btn btn-default iframe-btn" type="button">Open Filemanager</a>
                    <a href="#" class="btn btn-default btn-remove" data-dismiss="fileinput">Remove</a>
                    <input type="hidden" name="slidercarousel" id="slidercarousel_url" value="">
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Featured Image</h4>
            </div>
            <div class="panel-body">
                <div class="featured thumbnail" style="max-width: 200px;">
                    <img class="featured-preview" src="" width="100%" style="display: none;">
                    <img class="featured-preview-default" src="<?php echo asset('images/portal/img-default.jpg') ?>">
                </div>
                <div>
                    <a href="<?php echo base_url('filemanager/dialog.php?type=0&field_id=featured_url') ?>" class="btn btn-default iframe-btn" type="button">Open Filemanager</a>
                    <a href="#" class="btn btn-default btn-remove">Remove</a>
                    <input type="hidden" name="featured" id="featured_url" value="">
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>


<script>
    function responsive_filemanager_callback (field_id) {
        var field   = jQuery('#'+field_id);
        var url     = field.val();
        var img     = jQuery('<img>', {id: 'featured-preview', width: '100%', src: url});

        var featured_default  = field.parents('.panel-body').find('.featured-preview-default');
        var featured          = field.parents('.panel-body').find('.featured-preview');
        
        featured_default.hide()
        featured.attr('src', url).show()
    }

    jQuery('.btn-remove').on('click', function () {
        field = $(this).parent().find('[type=hidden]')
        field.val('')

        var featured_default  = field.parents('.panel-body').find('.featured-preview-default');
        var featured          = field.parents('.panel-body').find('.featured-preview');

        featured.hide()
        featured_default.show()
    })
</script>