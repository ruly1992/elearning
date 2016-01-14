
<div id="app-cropit">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Featured Image</h4>
        </div>
        <div class="panel-body text-xs-center">
            <cropit-preview
                name="featured"
                width="623px"
                height="290px"
                image-empty="<?php echo asset('images/kelas_online/thumbnails-lg.jpg') ?>"
                image-src="<?php echo $course->featured_image ?>"></cropit-preview>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="card-title">Thumbnail</h4>
        </div>
        <div class="panel-body text-xs-center">
            <cropit-preview
                name="thumbnail"
                width="215px"
                height="180px"
                image-empty="<?php echo asset('images/kelas_online/thumbnails-md.jpg') ?>"
                image-src="<?php echo $course->thumbnail_image ?>"></cropit-preview>
        </div>
        <div class="panel-footer">
            <?php echo form_open('dashboard/course/edit/'.$course->id.'/image'); ?>
                <cropit-result name="featured"></cropit-result>
                <cropit-result name="thumbnail"></cropit-result>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <?php echo form_close(); ?>
        </div>
    </div>

    <?php $this->load->view('modal/featured'); ?>
    <?php $this->load->view('modal/thumbnail'); ?>

    <?php $this->load->view('template/vue_cropit.php'); ?>
</div>

<?php custom_stylesheet() ?>
    <link rel="stylesheet" href="<?php echo asset('stylesheets/cropit.css') ?>">
<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/cropit/dist/jquery.cropit.js') ?>"></script>
    <script src="<?php echo asset('javascript/cropit.vue.js') ?>"></script>
<?php endcustom_script() ?>
