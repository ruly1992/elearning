<div class="row">
    <div class="col-md-8">
        <?php $this->load->view('course/'.$page); ?>
    </div>
    <div class="col-md-4">
        <?php $this->load->view('template/sidebar_course', compact('sidebar_active', 'repository')); ?>
    </div>
</div>

<?php custom_script() ?>
<script src="<?php echo asset('plugins/tinymce/tinymce.jquery.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '.editor'
        })
    })
</script>
<?php endcustom_script() ?>
