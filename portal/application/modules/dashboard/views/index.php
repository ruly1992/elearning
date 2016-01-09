
<!-- start: content atas -->
<div class="row" id="app-cropit">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section class="content-articles">
            <div class="content-articles-heading">
                <h3>Dashboard Submit</h3>
            </div>
        </section>
        <div class="container content-submit">
            <div class="widget">
                <div class="widget-heading">
                    <ul class="nav nav-tabs" id="myTabSubmit" role="tablist">
                        <li class="nav-item">
                             <a class="nav-link active" data-toggle="tab" href="#submit-article" role="tab" aria-controls="article-post" aria-expanded="true"><label for="" class="title">Artikel</label></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#submit-elibrary" role="tab" aria-controls="library-post" aria-expanded="false"><label for="" class="title">Elibrary</label></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#submit-konsultasi" role="tab" aria-controls="konsultasis-post" aria-expanded="false"><label for="" class="title">Konsultasi</label></a>
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
                                            <fieldset class="form-group">
                                                <label for="">Keterangan Gambar</label>
                                                <input type="text" name="caption-img" class="form-control">
                                            </fieldset>
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
                                    <?php echo form_open_multipart('elibrary/media/submit', array('id'=>'formMedia')); ?>
                                        <fieldset class="form-group">
                                            <label>Kategori</label>
                                            <select class="form-control" name="kategori">
                                                <?php 
                                                    foreach($categories AS $cat){
                                                        echo '<option value="'.$cat->id.'">'.$cat->name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </fieldset>
                                        <fieldset class="form-group">
                                           <p class="label label-info">Maximum Files 20MB</p>
                                            <input type="file" name="filemedia[]" id="filer_input_media" multiple="multiple">
                                        </fieldset>
                                        <button type="submit" onclick="checkInput(); return false;" class="btn btn-primary">Submit</button>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="submit-konsultasi" aria-labelledby="" aria-expanded="false">
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">   
                                    <form method="POST" action="<?php echo site_url('konsultasi/konsultasi/create') ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <label for="">Subjek</label>
                                                    <?php echo form_input('subjek', set_value('subjek'), array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan subjek Konsultasi')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <label for="">Kategori</label><br>
                                                    <select class="c-select" name="id_konsultasi_kategori">
                                                        <?php 
                                                            foreach ($konsultasiCat as $row) {
                                                        ?>
                                                            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <label for="">Prioritas</label><br>
                                                    <select class="c-select" name="prioritas">
                                                        <option value="High" selected>High</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="Low">Low</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <label for="">Pesan Anda</label>
                                                    <?php echo form_textarea('pesan', set_value('pesan', '', FALSE), array('class' => 'editor')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <label for="">Attachments</label>
                                                    <input type="file" name="files" id="filer_konsultasi">
                                                    <small>(Allowed File Extensions: .jpg, .gif, .jpeg, .png, .pdf, .zip, .doc, .xls, .xlsx, .docx, .txt) </small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

<?php custom_stylesheet() ?>

    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/jquery.filer.css') ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/themes/jquery.filer-dragdropbox-theme.css') ?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo asset('stylesheets/custom-jquery-filer.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('node_modules/datatables/media/css/jquery.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('stylesheets/cropit.css') ?>">

<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
<?php $this->load->view('template/vue_cropit'); ?>
 <!--jQuery-->

<script src="<?php echo asset('plugins/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo asset('node_modules/cropit/dist/jquery.cropit.js') ?>"></script>
<script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>

<script src="<?php echo asset('javascript/cropit.vue.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('/plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js?v=1.0.5') ?>"></script>
<script type="text/javascript" src="<?php echo asset('/javascript/jquery.filer.custom.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        tinymce.init({
            selector: '.editor'
        })
    });
</script>

<script type="text/javascript">
function checkInput(){
    if(document.getElementById('filer_input_media').value == ''){  
        alert('Anda harus memilih file untuk diunggah terlebih dahulu!');  
        document.getElementById('filer_input_media').focus();  
        return false;  
    }else{
        var count   = document.getElementsByClassName('fileName');
        var id      = '';
        for(var i=0;i<count.length;i++){
            if(i>0){
                id = i;
            }
            if(document.getElementById('fileName'+id).value == ''){  
                alert('Nama file harus diisi terlebih dahulu!');  
                document.getElementById('fileName'+id).focus();  
                return false;  
            }
        }
    }
    document.getElementById('formMedia').submit();
}
</script>
<?php endcustom_script() ?>
