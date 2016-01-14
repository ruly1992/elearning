<?php echo form_open('contributor/submit-article'); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Identitas Kontributor</h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <?php echo form_input('name', set_value('name'), array('class' => 'form-control')); ?>
            </div>
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <?php echo form_input('email', set_value('email'), array('class' => 'form-control')); ?>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Artikel</h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo form_input('title', set_value('title'), array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan judul artikel')); ?>
            </div>

            <div class="form-group">
                <?php echo form_textarea('content', set_value('content'), array('class' => 'form-control editor')); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim Artikel</button>
        </div>
    </div>
<?php echo form_close(); ?>