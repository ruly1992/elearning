<?php custom_stylesheet() ?>
    <link rel="stylesheet" href="<?php echo asset('node_modules/datatables/media/css/jquery.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('stylesheets/cropit.css') ?>">
<?php endcustom_stylesheet() ?>

<!-- start: content atas -->
<div class="row" id="app-cropit">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section class="content-articles">
            <div class="content-articles-heading">
                <h3>Dashboard Create Articles</h3>
            </div>
        </section>
        <div class="container content-submit">
            <div class="widget">
                <div class="widget-heading">
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
                    <div class="widget-content">
                        <div class="tab-content" id="myTabSubmitContent">
                            <div role="tabpanel" class="tab-pane fade active in" id="submit-article" aria-labelledby="article-post" aria-expanded="true">
                                <?php echo form_open('dashboard/sendArticle'); ?>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                        <fieldset class="form-group">
                                            <label for="title">Judul Artikel</label>
                                            <input name="title" type="text" class="form-control" id="title" placeholder="">
                                            <small class="text-muted">Masukkan judul artikel disini</small>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <textarea name="content" class="editor"></textarea>
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
                                                <cropit-preview name="featured"></cropit-preview>
                                                <cropit-result name="featured"></cropit-result>
                                            </div>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="submit-elibrary" aria-labelledby="" aria-expanded="false">
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
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
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <!-- begin: category -->
                                    <div class="widget">
                                        <div class="widget-sidebar-heading">
                                            <h3>Category</h3>
                                        </div>
                                        <div class="widget-sidebar-content">
                                            <div class="list-group-item">
                                                <label class="c-input c-checkbox">
                                                    <input type="checkbox">
                                                    <span class="c-indicator"></span>
                                                    Desa membangun
                                                </label>
                                            </div>
                                            <div class="list-group-item">
                                                <label class="c-input c-checkbox">
                                                    <input type="checkbox">
                                                    <span class="c-indicator"></span>
                                                    Desa membangun 1
                                                </label>
                                                <div class="child">
                                                    <label class="c-input c-checkbox">
                                                        <input type="checkbox">
                                                        <span class="c-indicator"></span>
                                                        Desa membangun a
                                                    </label>
                                                </div>
                                                <div class="child">
                                                    <label class="c-input c-checkbox">
                                                        <input type="checkbox">
                                                        <span class="c-indicator"></span>
                                                        Desa membangun b
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <label class="c-input c-checkbox">
                                                    <input type="checkbox">
                                                    <span class="c-indicator"></span>
                                                    Desa membangun 3
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: category -->
                                    <!-- begin: image preview -->
                                    <div class="widget">
                                        <div class="widget-sidebar-heading">
                                            <h3>Category</h3>
                                        </div>
                                        <div class="widget-sidebar-content">
                                            <div class="image-preview">
                                                <img src="../images/portal/img-carousel.jpg" alt="">
                                            </div>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#image-preview-1">submit image</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: image preview -->
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
            </div>
        </div>
    </div>

    <?php $this->load->view('modal/featured'); ?>
</div> 
<!-- end: content atas -->

<?php custom_script() ?>
<?php $this->load->view('template/vue_cropit'); ?>

<script src="<?php echo asset('plugins/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo asset('node_modules/cropit/dist/jquery.cropit.js') ?>"></script>
<script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
<script src="<?php echo asset('javascript/cropit.vue.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        tinymce.init({
            selector: '.editor'
        })
    });
</script>
<?php endcustom_script() ?>
