<!-- start:content -->
<div class="container content content-single content-dashboard content-konsultasi">
    <section id="content">

        <!-- start:content -->
        <div class="content-konsultasi-main">
            <div class="content-konsultasi-title">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Lihat Konsultasi #<?php echo $konsultasi->id ?></h3>
                    </div>
                </div>
            </div>
            <div class="content-konsultasi-table">
                <!-- Start for content description -->
                <div class="konsultasi-content">
                    <div class="title">
                        <div class="row">
                            <div class="col-md-2">
                                <h3>Title</h3>
                            </div>
                            <div class="col-md-10">
                                <p><?php echo $konsultasi->subjek ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="description">
                        <div class="row">
                            <div class="col-md-2">
                                <h3>Decription</h3>
                            </div>
                            <div class="col-md-10">
                                <?php echo $konsultasi->pesan ?>
                            </div>
                        </div>
                    </div>
                    <div class="attachment">
                        <div class="row">
                            <div class="col-md-2">
                                <h3>Attachment</h3>
                            </div>
                            <div class="col-md-10">
                                <a href="<?php echo home_url('app/files/konsultasi-attachment/'.$konsultasi->attachment) ?>"><?php echo $konsultasi->attachment ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End for content decription -->

                <div class="content-konsultasi-table-details">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="card card-inverse card-info text-center">
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        <p><strong>Tanggal Posting</strong></p>
                                        <hr>
                                        <p><?php echo $konsultasi->created_at ?></p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="card card-inverse card-info text-center">
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        <p><strong>Kategori</strong></p>
                                        <hr>
                                        <p><?php foreach ($kategori as $kat) {echo $kat->name;}
                                        ?></p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="card card-inverse card-info text-center">
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        <p><strong>Prioritas</strong></p>
                                        <hr>
                                        <p><?php echo $konsultasi->prioritas ?></p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="card card-inverse card-info text-center">
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        <p><strong>Status</strong></p>
                                        <hr>
                                        <p><?php echo $konsultasi->status ?></p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php if ($reply->count()): ?>
                            <?php foreach ($reply as $data) { ?>
                            <div class="card">    
                                <div class="card-header">
                                    <p><strong>From : <?php echo user($data->id_user)->full_name ?></strong> <span class="pull-right"><?php echo $data->created_at ?></span></p>
                                </div>
                                <div class="card-block">
                                    <p class="card-text">
                                       <?php echo $data->isi ?>
                                    </p>
                                </div>
                                <div class="card-block">
                                    <p class="card-text">
                                       <a href="<?php echo home_url('app/files/konsultasi-attachment/'.$data->attachment) ?>"><?php echo $data->attachment ?></a>
                                    </p>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                            <?php } ?>
                            <nav>
                                <ul class="#">
                                    <?php echo $reply->render() ?>
                                </ul>
                            </nav>
                        <?php else: ?>                       
                            <p class="alert alert-warning">Belum ada balasan</p>
                        <?php endif ?>                             
                            
                            <?php if ($konsultasi->status == 'open'): ?>
                                <div class="card-block">
                                    <div class="row">
                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h4>
                                                        <a class="btn btn-reply-outline" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Balas
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="container">
                                                        <form method="POST" action="<?php echo site_url('dashboard/detail/'.$konsultasi->id) ?>" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="hidden" id="" name="id_konsultasi" value="<?php echo $konsultasi->id ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label for="">Pesan Anda</label>
                                                                        <textarea name="isi" id="" cols="30" rows="5" class="editor"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                        <label for="">Attachments</label>
                                                                        <input type="file" name="files" id="filer_konsultasi">
                                                                        <small>(Allowed File Extensions: .jpg, .gif, .jpeg, .png, .pdf, .zip, .doc, .xls, .xlsx, .docx, .txt | Max Size Upload : 10MB) </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-sm btn-kirim">Kirim</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            <?php else: ?>
                                <p class="alert alert-warning">Konsultasi telah di tutup anda tidak dapat mengirim kan balasan.</p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:content -->

    </section>
</div>
<!-- emd:content -->
<?php custom_stylesheet() ?>

    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/jquery.filer.css') ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/themes/jquery.filer-dragdropbox-theme.css') ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo asset('/stylesheets/custom-jquery-filer.css') ?>" type="text/css" rel="stylesheet" >

<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <!--jQuery-->
    <script type="text/javascript" src="<?php echo asset('/plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js?v=1.0.5') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/javascript/jquery.filer.custom.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/plugins/tinymce/tinymce.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/javascript/custom-tiny.js') ?>"></script>
<?php endcustom_script() ?>