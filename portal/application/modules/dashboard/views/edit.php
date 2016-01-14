<?php custom_stylesheet() ?>
    <link rel="stylesheet" href="<?php echo asset('stylesheets/cropit.css') ?>">
<?php endcustom_stylesheet() ?>

<?php echo form_open('dashboard/editArticle/' . $artikel->id); ?>
<?php echo show_message() ?>
<div class="row" id="app-cropit">
    <div class="container content-submit">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <fieldset class="form-group">
                <label for="title">Judul Artikel</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="" value="<?php echo $artikel->title ?>">
                <small class="text-muted">Masukkan judul artikel disini</small>
            </fieldset>
            <fieldset class="form-group">
                <textarea name="content" class="editor-simple"><?php echo $artikel->content ?></textarea>
            </fieldset>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- begin: category -->
            <div class="widget">
                <div class="widget-sidebar-heading">
                    <h3>Category</h3>
                </div>
                <div class="widget-sidebar-content">
                    <?php echo $categories_checkbox ?>
                </div>
            </div>
            <!-- end: category -->
            <!-- begin: image preview -->
            <div class="widget">
                <div class="widget-sidebar-heading">
                    <h3>Gambar Fitur</h3>
                </div>
                <div class="widget-sidebar-content">
                    <cropit-preview name="featured" image-src="<?php echo $artikel->featured_image ?>"></cropit-preview>
                    <cropit-result name="featured"></cropit-result>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('modal/featured'); ?>
</div>
<?php echo form_close(); ?>

<?php custom_script() ?>
    <?php $this->load->view('template/vue_cropit'); ?>

    <script src="<?php echo asset('plugins/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/cropit/dist/jquery.cropit.js') ?>"></script>
    <script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
    <script src="<?php echo asset('javascript/cropit.vue.js') ?>"></script>
    <script src="<?php echo asset('javascript/editor.js') ?>"></script>
<?php endcustom_script() ?>
