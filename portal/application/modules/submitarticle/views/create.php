
<?php echo form_open_multipart('submitarticle'); ?>
    <?php echo show_message() ?>

    <section class="content-articles">
        <div class="content-articles-heading">
            <h3>Kirim Artikel</h3>
        </div>
    </section>

    <div class="content-articles-content">
        <fieldset class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <div class="cropit-custom-avatar">
                        <label for="custom-avatar">Foto Pengirim</label>
                        
                        <div class="cropit-image-preview" style="width: 100px; height: 100px;">
                        </div>
                        <div class="image-size-label">
                            Resize image
                        </div>
                        <input type="range" class="cropit-image-zoom-input">

                        <button class="btn btn-primary file-btn">
                            <span>Browse</span>
                            <input type="file" class="cropit-image-input">
                        </button>
                        <?php echo form_input([
                            'type'  => 'hidden',
                            'name'  => 'custom_avatar',
                            'class' => 'cropit-custom-avatar-imagedata'
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <?php echo form_input('nama', set_value('nama'), ['class' => 'form-control', 'id' => 'nama']) ?>
                    </fieldset>
                    
                    <fieldset class="form-group">
                        <label for="email">Email</label>
                        <?php echo form_input('email', set_value('email'), ['class' => 'form-control', 'id' => 'email']) ?>
                    </fieldset>
                    
                    <fieldset class="form-group">
                        <label for="desa">Desa</label>
                        <?php echo form_dropdown('desa', $desa_lists, [], ['class' => 'form-control', 'id' => 'desa']) ?>
                    </fieldset>
                </div>
            </div>   
        </fieldset>
        
        <fieldset class="form-group">
            <label for="title">Judul Artikel</label>
            <input type="text" name="title" class="form-control" id="title">
        </fieldset>
        <fieldset class="form-group">
            <textarea name="content" class="editor"></textarea>
        </fieldset>

        <fieldset class="form-group">
            <label for="exampleInputFile">Featured Image</label>

            <div class="cropit-featured">
                <div class="cropit-image-preview-container">
                    <div class="cropit-image-preview"
                        style="width: 261px; height: 120px;"
                        data-cropit-preload="<?php echo asset('images/portal/img-carousel-default.jpg') ?>">
                    </div>
                </div>

                <div class="image-size-label">
                    Resize image
                </div>
                <input type="range" class="cropit-image-zoom-input">

                <br>

                <button class="btn btn-primary file-btn">
                    <span>Browse</span>
                    <input type="file" class="cropit-image-input">
                </button>
                <?php echo form_input([
                    'type'  => 'hidden',
                    'name'  => 'featured',
                    'class' => 'cropit-featured-imagedata'
                ]) ?>
            </div>
        </fieldset>
    </div>

    <section class="content-articles">
        <div class="content-articles-heading">
            <h3>Tahap Moderasi</h3>
        </div>
    </section>

    <div class="content-articles-content">
        <p>Setiap artikel yang Anda kirim akan masuk ke tahap moderasi terlebih dahulu.</p>
        <fieldset class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim Artikel</button>
        </fieldset>
    </div>
<?php echo form_close(); ?>