
<ol class="breadcrumb">
    <li><a href="<?php echo dashboard_url() ?>">Dashboard</a></li>
    <li><a href="<?php echo site_url('dashboard') ?>">Kelas Online</a></li>
    <li class="active"><?php echo $course->name ?></li>
</ol>

<div class="kelas-main">
    <div class="card">
        <div class="card-block">
            <?php echo show_message() ?>
            <?php echo form_open('dashboard/course/edit/'.$course->id); ?>
                <div class="form-group">
                    <label for="">Code :</label>
                    <p class="form-static"><span class="label label-primary"><?php echo $course->code ?></span></p>
                </div>
                <div class="form-group">
                    <label>Name :</label>
                    <?php echo form_input('name', set_value('name', $course->name), ['class' => 'form-control']); ?>
                </div>
                <div class="form-group">
                    <label for="">Kategori :</label>
                    <?php echo form_dropdown('category_id', $category_lists, set_value('category_id', $course->category_id), ['class' => 'c-select form-control']); ?>
                </div>
                <div class="form-group">
                    <label>Deskripsi :</label>
                    <?php echo form_textarea('description', set_value('description', $course->description, FALSE), ['class' => 'form-control editor']); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php custom_script() ?>
<script src="<?php echo asset('plugins/tinymce/tinymce.jquery.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '.editor'
        })
    })
</script>
<?php endcustom_script() ?>
