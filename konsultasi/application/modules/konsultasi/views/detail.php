<!-- start:content -->
<div class="container content content-single content-dashboard content-konsultasi">
    <section id="content">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li>Konsulitasi</li>
            <li class="active"><?php echo $konsultasi->subjek ?></li>
        </ol>
        <?php 
            if(isset($failed)){
                echo '<div class="alert alert-danger">';
                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo '<strong>Warning!</strong> '.$failed;
                echo '</div>';
            }elseif(isset($success)){
                echo '<div class="alert alert-info">';
                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo '<strong>Success!</strong> '.$success;
                echo '</div>';
            }
        ?>
        <!-- start:content -->
        <div class="content-konsultasi-main">
            <div class="content-konsultasi-title">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Lihat Konsultasi #<?php echo $konsultasi->id ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="content-konsultasi-table">
                
                    <!-- Begin for content konsultasi -->
                    <div class="konsultasi-content">
                        <div class="container">
                            <div class="row">
                                <div class="title">
                                    <div class="col-md-2 col-lg-2">
                                        <h3>Title</h3>
                                    </div>
                                    <div class="col-md-10 col-lg-10">
                                        <h3><?php echo $konsultasi->subjek ?></h3>
                                    </div>
                                </div>
                                <div class="description">
                                    <div class="col-md-2 col-lg-2">
                                        <h3>Description</h3>
                                    </div>
                                    <div class="col-md-10 col-lg-10">
                                       <h3><?php echo $konsultasi->pesan ?></h3>   
                                    </div>
                                </div>
                                <div class="image">
                                    <div class="col-md-2 col-lg-2">
                                        <h3>Attachment</h3>
                                    </div>
                                    <div class="col-md-10 col-lg-10">
                                        <a href="<?php echo home_url('app/files/konsultasi-attachment/'.$konsultasi->attachment) ?>"><?php echo $konsultasi->attachment ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End for content konsultasi -->

                    <!-- begin for content detail -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="container">
                            <div class="row">
                                <div class="konsultasi-detail">
                                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
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
                                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
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
                                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
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
                                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
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
                            </div>
                        </div>
                    </div>
                    <!-- End for content detail -->

                    <!-- Begin Content Balas -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content-konsultasi-table-details">
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
                                    <?php 
                                        $userId = sentinel()->getUser()->id;
                                        if ($userId == $data->id_user): 
                                    ?>
                                        <a href="#forCollapse<?php echo $data->id; ?>" class="btn btn-primary" data-toggle="collapse"><i class="fa fa-pencil"> Edit</i></a>
                                        <div class="card collapse custom-card" id="forCollapse<?php echo $data->id; ?>">
                                            <div class="card-header">
                                                Edit Reply
                                            </div>
                                            <div class="card-block">
                                                <form method="POST" action="<?php echo site_url('konsultasi/updateReply/'.$data->id . '/' . $konsultasi->id) ?>">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <label for="">Pesan Anda</label>
                                                                <textarea name="isi" id="" cols="30" rows="5" class="editor"><?php echo $data->isi ?></textarea>
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
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>                                                    
                                        </div>
                                    <?php else: ?>                                                
                                    <?php endif ?>
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
                                                    <form method="POST" action="<?php echo site_url('konsultasi/detail/'.$konsultasi->id) ?>" enctype="multipart/form-data">
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
                            <?php else: ?>
                                <p class="alert alert-warning">Konsultasi telah di tutup anda tidak dapat mengirim kan balasan.</p>
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- End Content Balas -->
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

<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <!--jQuery-->
    <script type="text/javascript" src="<?php echo asset('/plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js?v=1.0.5') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/javascript/jquery.filer.custom.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/plugins/tinymce/tinymce.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/javascript/custom-tiny.js') ?>"></script>
<?php endcustom_script() ?>