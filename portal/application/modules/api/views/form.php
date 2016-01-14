<form action="<?php echo site_url('api/user') ?>" method="POST" role="form">
	<legend>Form title</legend>

	<div class="form-group">
		<label for="">label</label>
		<?php echo form_input('email', ''); ?>
	</div>
	<div class="form-group">
		<label for="">label</label>
		<?php echo form_input('password', ''); ?>
	</div>

	

	<button type="submit" class="btn btn-primary">Submit</button>
</form>