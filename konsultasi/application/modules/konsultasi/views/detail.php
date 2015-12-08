<!-- start:content -->
<div class="container content content-single content-dashboard content-konsultasi">
    <section id="content">

        <!-- start:content -->
        <div class="content-konsultasi-main">
            <div class="content-konsultasi-title">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Lihat Konsultasi #<?php echo $konsultasi->id ?></h2>
                    </div>
                </div>
            </div>
            <div class="content-konsultasi-table">
                <h5><?php echo $konsultasi->subjek ?></h5>
                <hr>
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
                            <div class="card">
                                <?php foreach ($reply as $data) { ?>
                                <div class="card-block">
                                    <p><strong>From : <?php echo $data->first_name.''.$data->last_name ?></strong> <span class="pull-right"><?php echo $data->created_at ?></span></p>
                                </div>
                                <hr>
                                <div class="card-block">
                                    <p class="card-text">
                                       <?php echo $data->isi ?>
                                    </p>
                                </div>
                                <?php } ?>
                                <div class="card-block">
                                    <div id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Bales
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <form method="POST" action="<?php echo base_url('konsultasi/index.php/konsultasi/detail/'.$konsultasi->id) ?>" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="hidden" id="" name="id_konsultasi" value="<?php echo $konsultasi->id ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <label for="">Pesan Anda</label>
                                                                <textarea name="isi" id="" cols="30" rows="5" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                                <label for="">Attachments</label>
                                                                <label class="file">
                                                                    <input type="file" id="file" name="file">
                                                                    <span class="file-custom"></span>
                                                                </label>
                                                                <small>(Allowed File Extensions: .jpg, .gif, .jpeg, .png, .pdf, .zip, .doc, .xls, .xlsx, .docx, .txt) </small>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- end:content -->

    </section>
</div>
<!-- emd:content -->