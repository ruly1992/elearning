<?php echo form_open_multipart('dashboard/sendArticle'); ?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section class="content-articles">
            <div class="content-articles-heading">
                <h3>Kirim Artikel</h3>
            </div>
        </section>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <div class="content-articles-content">
                <div class="form-group">
                    <?php echo form_input('title', set_value('title'), array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan judul artikel')); ?>
                </div>
                
                <div class="form-group">
                    <?php echo form_textarea('content', set_value('content', '', FALSE), array('class' => 'editor-article')); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="sidebar-article">
                

                <div class="widget">
                    <div class="widget-categories">
                        <div class="widget-categories-heading">
                            <h4>Categories</h4>
                        </div>
                        <div class="widget-categories-content">
                            <?php echo $categories_checkbox ?>
                        </div>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-categories">
                        <div class="widget-categories-heading">
                            <h4>Featured Image</h4>
                        </div>
                        <div class="widget-categories-content">
                            <input type="file" name="featured" value=""></input>
                        </div>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-categories">
                        <div class="widget-categories-heading">
                            <h4>Kirim</h4>
                        </div>
                        <div class="widget-categories-content">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim Artikel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>

<?php custom_script() ?>
<script src="<?php echo asset('plugins/tinymce/tinymce.jquery.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '.editor-article',
            height: 600,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        });
    })
</script>
<?php endcustom_script() ?>
