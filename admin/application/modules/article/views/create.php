<?php echo form_open_multipart('article/add'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <?php echo form_input('title', set_value('title'), array('class' => 'form-control input-lg', 'placeholder' => 'Title')); ?>
                </div>

                <div class="form-group">
                    <?php echo form_textarea('content', set_value('content', '', FALSE), array('class' => 'form-control editor-portal')); ?>
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
                <button style="margin-bottom:10px;" class="btn btn-default md-trigger-slider" data-modal="modal-1">Pengaturan Slider</button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Featured Image</h4>
            </div>
            <div class="panel-body">
                <button style="margin-bottom:10px;" class="btn btn-default md-trigger-featured" data-modal="modal-2">Pengaturan Featured</button>
            </div>
        </div>
    </div>
</div>

<div class="md-modal md-effect-2" id="modal-1">
    <div class="modal-dialog md-content modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Pengaturan Gambar Slider</h4>
            </div>
            <div class="modal-body">
                <p>Jika pengaturan ini diaktifkan, makan artikel ini akan ditampilkan pada tayangan artikel bergerak di halaman utama.</p>             
                <div class="cropit-slider cropit-disabled">
                    <div class="cropit-image-preview-container">
                        <div class="cropit-image-preview"
                            style="width: <?php echo getenv('SIZE_SLIDER_WIDTH') ?>; height: <?php echo getenv('SIZE_SLIDER_HEIGHT') ?>;"
                            data-cropit-preload="<?php echo asset('images/portal/img-carousel-default.jpg') ?>">
                        </div>
                    </div>

                    <div class="image-size-label">
                        Resize image
                    </div>
                    <input type="range" class="cropit-image-zoom-input">

                    <br>

                    <?php echo form_input([
                        'type'  => 'hidden',
                        'name'  => 'slidercarousel',
                        'id'    => 'slider',
                        'class' => 'cropit-slider-imagedata'
                    ]) ?>
                </div>
                <div>
                    <a href="<?php echo base_url('filemanager/portal-content/dialog.php?type=0&field_id=slider') ?>" class="btn btn-default iframe-btn" type="button">Open Filemanager</a>
                    <a href="#" class="btn btn-default btn-remove-slider" data-dismiss="fileinput">Remove</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal">Simpan</button>
            </div>
        </div>  
    </div>  
</div>

<div class="md-modal md-effect-2" id="modal-2">
    <div class="modal-dialog md-content modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Pengaturan Gambar Featured</h4>
            </div>
            <div class="modal-body">
                <p>Pengaturan ini akan menampilkan gambar atau foto fitur utama yang mewakili pada setiap artikel.</p>             
                <div class="cropit-featured cropit-disabled">
                    <div class="cropit-image-preview-container">
                        <div class="cropit-image-preview"
                            style="width: <?php echo getenv('SIZE_FEATURED_WIDTH') ?>; height: <?php echo getenv('SIZE_FEATURED_HEIGHT') ?>;"
                            data-cropit-preload="<?php echo asset('images/portal/img-carousel-default.jpg') ?>">
                        </div>
                    </div>

                    <div class="image-size-label">
                        Resize image
                    </div>
                    <input type="range" class="cropit-image-zoom-input">

                    <br>

                    <?php echo form_input([
                        'type'  => 'hidden',
                        'name'  => 'featured',
                        'id'    => 'featured',
                        'class' => 'cropit-featured-imagedata'
                    ]) ?>
                    <?php echo form_input([
                        'type'  => 'hidden',
                        'name'  => 'featured_action',
                        'id'    => 'featured_action',
                        'value' => 'keep',
                    ]) ?>
                </div>
                <div>
                    <a href="<?php echo base_url('filemanager/portal-content/dialog.php?type=0&field_id=featured') ?>" class="btn btn-default iframe-btn" type="button">Open Filemanager</a>
                    <a href="#" class="btn btn-default btn-remove-featured" data-dismiss="fileinput">Remove</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal">Simpan</button>
            </div>
        </div>  
    </div>  
</div>

<?php echo form_close(); ?>

<?php custom_script() ?>
<script>
    function responsive_filemanager_callback (field_id) {
        var field   = jQuery('#'+field_id);
        var url     = field.val();
        var fpath   = url.replace(/\\/g, '/');
        var fname   = fpath.substr(fpath.lastIndexOf('/')+1)

        field.trigger('change')
    }
</script>
<?php endcustom_script() ?>
