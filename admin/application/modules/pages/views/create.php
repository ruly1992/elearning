<?php echo form_open('pages/add'); ?>

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
            <div class="panel-footer">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
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