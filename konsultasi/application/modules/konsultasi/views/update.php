<!-- start:content -->
<div class="container content content-single content-dashboard content-konsultasi">
    <section id="content">
        <!-- start:content -->
        <div class="content-konsultasi-main">
            <div class="content-konsultasi-title">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Mulai Konsultasi</h2>
                    </div>
                </div>
            </div>
            <div class="content-konsultasi-table">
                <form method="POST" action="<?php echo site_url('konsultasi/update/'. $konsultasi->id) ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <label for="">Subjek</label>
                                <?php echo form_input('subjek', set_value('subjek', $konsultasi->subjek), array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan subjek Konsultasi')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="">Kategori</label><br>
                                <select class="form-control" name="id_konsultasi_kategori">
                                    <?php 
                                        foreach($categories as $row){
                                            if($row->id == $konsultasi->id_kategori) {
                                                $selected='selected';
                                            } else {
                                                $selected='';
                                            }
                                            echo '<option value="'.$row->id.'" '.$selected.'>'.$row->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="">Prioritas</label><br>
                                <select class="form-control" name="prioritas">
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
                                <?php echo form_textarea('pesan', set_value('pesan', $konsultasi->pesan, FALSE), array('class' => 'editor')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="">Attachments</label>
                                <?php if (!empty($konsultasi->attachment)): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $konsultasi->attachment ?>
                                        <?php echo anchor('konsultasi/deleteAttachment/'. $konsultasi->id . '/' . $konsultasi->attachment, '<i class="fa fa-trash-o"></i>', 'class="btn btn-danger-outline btn-thread" data-toggle="tooltip" data-placement="top" title="Delete"'); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo "Tidak ada Attachments" ?>
                                    </div>
                                <?php endif ?>
                                <input type="file" name="files" id="filer_konsultasi" idkonsultasi="<?php echo $konsultasi->id ?>">
                                <small>(Allowed File Extensions: .jpg, .gif, .jpeg, .png, .pdf, .zip, .doc, .xls, .xlsx, .docx, .txt | Max Size Upload : 10MB) </small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-kirim">Kirim</button>
                        <a href="#" class="btn btn-sm btn-default">Batal</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- end:content -->
    </section>
</div>
<!-- emd:content -->
<?php custom_stylesheet() ?>

    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/jquery.filer.css') ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/themes/jquery.filer-dragdropbox-theme.css') ?>" type="text/css" rel="stylesheet" />

<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <!--jQuery-->
    <script type="text/javascript" src="<?php echo asset('/plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js?v=1.0.5') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/javascript/jquery.filer.custom.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/plugins/tinymce/tinymce.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/javascript/custom-tiny.js') ?>"></script>
<?php endcustom_script() ?>
