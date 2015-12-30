<h3>Kelas Baru</h3>

<?php echo form_open('dashboard/course/create'); ?>

<fieldset class="form-group row">
    <label for="name" class="col-sm-2">Name</label>
    <div class="col-sm-5">
        <?php echo form_input('name', set_value('name', $course->name), ['class' => 'form-control', 'placeholder' => 'Masukkan nama kelas']); ?>
    </div>
</fieldset>

<fieldset class="form-group row">
    <label for="name" class="col-sm-2">Kategori</label>
    <div class="col-sm-5">
        <?php echo form_dropdown('category', $category_lists, set_value('category', $course->category_id), ['class' => 'form-control']); ?>
    </div>
</fieldset>

<fieldset class="form-group row">
    <div class="col-sm-8 col-sm-offset-2">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
</fieldset>

<?php echo form_close(); ?>
