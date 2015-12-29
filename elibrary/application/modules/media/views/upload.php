<div class="elib-content-single">
    <div class="elib-single-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Media</a></li>
            <li class="active">Upload</li>
        </ol>
    </div>
    <div class="title">
        <?php echo form_open_multipart('media/submit'); ?>
            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" name="kategori">
                    <?php 
                        foreach($categories AS $cat){
                            echo '<option value="'.$cat->id.'">'.$cat->name.'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="file" name="filemedia[]" id="filer_input_media" multiple="multiple">
            </div>
            <button class="btn btn-danger" id="extrabutton">Start</button>
        <?php echo form_close(); ?>
    </div>
    <div class="description-meta">
        <!-- <div id="fileuploader" data-url="<?php echo site_url('media/submit/') ?>" data-category-id="<?php //echo $category->id ?>">Upload</div> -->
    
    </div>
</div>

<!-- emd:content -->
<?php custom_stylesheet() ?>

    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/jquery.filer.css') ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/themes/jquery.filer-dragdropbox-theme.css') ?>" type="text/css" rel="stylesheet" />

<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <!--jQuery-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="<?php echo asset('/plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js?v=1.0.5') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/javascript/jquery.filer.custom.js') ?>"></script>
<?php endcustom_script() ?>
