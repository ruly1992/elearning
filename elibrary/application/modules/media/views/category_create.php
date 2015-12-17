<?php echo show_message() ?>

<?php echo form_open('media/category/create'); ?>
	<div class="form-group">
		<label for="">Nama Kategori</label>
		<?php echo form_input('name', set_value('name'), ['class' => 'form-control']); ?>
	</div>

	<div class="form-group">
		<label for="">Description</label>
		<?php echo form_textarea('description', set_value('description'), ['class' => 'form-control']); ?>
	</div>	

	<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>