<br>
<?php echo form_open_multipart('submitarticle'); ?>
<?php echo show_message() ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Kirim Artikel</h4><p></p>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <?php echo form_input('nama', set_value('nama'), array('class' => 'form-control')); ?>
            </div>
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <?php echo form_input('email', set_value('email'), array('class' => 'form-control')); ?>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="form-group">
            <label for="title">Judul Artikel</label>
                <?php echo form_input('title', set_value('title'), array('class' => 'form-control input-lg')); ?>
            </div>

            <div class="form-group">
                <label for="email">Featured Image</label><br>
                <input type="file" name="featured">
            </div>

            <div class="form-group">
                <label for="content">Konten Artikel</label>            
                <?php echo form_textarea('content', set_value('content'), array('class' => 'form-control editor')); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim Artikel</button>
        </div>
    </div>
<?php echo form_close(); ?>