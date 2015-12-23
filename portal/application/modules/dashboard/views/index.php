<?php custom_stylesheet() ?>
<link rel="stylesheet" href="<?php echo asset('node_modules/datatables/media/css/jquery.dataTables.min.css') ?>">
<link rel="stylesheet" href="<?php echo asset('stylesheets/cropit.css') ?>">
<style>
    .cropit-featured-image .cropit-image-preview {
        width: <?php echo getenv('SIZE_FEATURED_WIDTH') ?>;
        height: <?php echo getenv('SIZE_FEATURED_HEIGHT') ?>;
    }
</style>
<?php endcustom_stylesheet() ?>

<!-- start: content atas -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section class="content-articles">
            <div class="content-articles-heading">
                <h3>Dashboard Create Articles</h3>
            </div>
        </section>
        <div class="container content-submit">
            <div class="submit">
                <div class="submit-heading">
                    <ul class="nav nav-tabs" id="myTabSubmit" role="tablist">
                        <li class="nav-item">
                             <a class="nav-link active" data-toggle="tab" href="#submit-article" role="tab" aria-controls="article-post" aria-expanded="true">Submit article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#submit-elibrary" role="tab" aria-controls="library-post" aria-expanded="false">Submit Elibrary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#submit-konsultasi" role="tab" aria-controls="konsultasis-post" aria-expanded="false">Submit Konsultasi</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="submit-content">
                                <div class="tab-content" id="myTabSubmitContent">
                                    <div role="tabpanel" class="tab-pane fade active in" id="submit-article" aria-labelledby="article-post" aria-expanded="true">
                                        <?php echo form_open('dashboard/sendArticle'); ?>
                                            <fieldset class="form-group">
                                                <label for="article-title">Judul Artikel</label>
                                                <input name="title" type="text" class="form-control" id="article-title" placeholder="">
                                                <small class="text-muted">Masukkan judul artikel disini</small>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label for="article-featured">Featured Image</label>
                                                <div class="cropit-featured-image">
                                                    <div class="cropit-image-preview"></div>
                                                    <input type="range" class="cropit-image-zoom-input" />
                                                    <input type="file" class="cropit-image-input" />
                                                    <input type="hidden" name="featured" class="cropit-featured-image-imagedata">
                                                    <a href="#" class="cropit-remove">Remove</a>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label for="article-content">Konten Artikel</label>
                                                <textarea name="content" class="editor" id="article-content"></textarea>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        <?php echo form_close(); ?>
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="submit-elibrary" aria-labelledby="" aria-expanded="false">
                                        <form>
                                            <fieldset class="form-group">
                                                <label for="exampleInputArtikel">Judul Elibrary</label>
                                                <input type="email" class="form-control" id="exampleInputArtikel" placeholder="">
                                                <small class="text-muted">Masukkan judul elibrary disini</small>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label for="exampleInputKonten">Konten Artikel</label>
                                                <textarea class="editor"></textarea>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="submit-konsultasi" aria-labelledby="" aria-expanded="false">
                                        <form>
                                            <fieldset class="form-group">
                                                <label for="exampleInputArtikel">Judul Konsultasi</label>
                                                <input type="email" class="form-control" id="exampleInputArtikel" placeholder="">
                                                <small class="text-muted">Masukkan judul konsultasi disini</small>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label for="exampleInputKonten">Konten Artikel</label>
                                                <textarea class="editor"></textarea>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                     </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="submit">
                            <div class="submit-sidebar-heading">
                                <h3>Category</h3>
                            </div>
                            <div class="submit-sidebar-content">
                                <a href="#" class="list-group-item active">
                                    <span class="label label-default label-pill pull-right">14</span> All Categories
                                </a>
                                <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> Video Conferences</a>
                                <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> Kelas Online</a>
                                <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> E-Library</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<!-- end: content atas -->

<?php custom_script() ?>
<script src="<?php echo asset('plugins/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo asset('node_modules/cropit/dist/jquery.cropit.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        tinymce.init({
            selector: '.editor',
            min_height: 600
        })

        var $cropitFeaturedLoaded = false;

        var cropitExport = function (el) {
            var imagedataEl = $(el + '-imagedata');
            var imagedata   = $(el).cropit('export')

            if (imagedataEl.length)
                imagedataEl.val(imagedata)

            return imagedata;
        }

        var cropitRemove = function (el) {
            var $imagedataEl    = $(el + '-imagedata');
            var $cropitEl       = $(el)

            $imagedataEl.val('')
            $cropitFeaturedLoaded = false;

            $cropitEl.find('.cropit-image-input').val('')
            $cropitEl.find('.cropit-image-preview').css('background-image', 'none')
        }

        var $cropitFeatured = $('.cropit-featured-image').cropit({
            exportZoom: 2,
            onImageLoaded: function () {
                $cropitFeaturedLoaded = true;
                cropitExport('.cropit-featured-image')
            },
            onOffsetChange: function (offset) {
                if ($cropitFeaturedLoaded)
                    cropitExport('.cropit-featured-image')
            }
        })

        $('.cropit-featured-image').find('.cropit-remove').on('click', function () {
            cropitRemove('.cropit-featured-image')

            return false
        })
    });
</script>
<?php endcustom_script() ?>
