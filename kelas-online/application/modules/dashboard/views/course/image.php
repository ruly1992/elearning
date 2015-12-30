<div class="card">
	<div class="card-block">
		<h4 class="card-title">Featured Image</h4>
	</div>
	<div class="card-img-block text-xs-center">
		<div id="image-featured-cropper">
			<div class="cropit-image-preview" style="width: <?php echo getenv('SIZE_KELAS_FEATURED_WIDTH') ?>; height: <?php echo getenv('SIZE_KELAS_FEATURED_HEIGHT') ?>;" data-preload="<?php echo asset('images/kelas_online/thumbnails-lg.jpg') ?>"></div>
			<input type="range" class="cropit-image-zoom-input">
			<input type="file" class="cropit-image-input">
		</div>
	</div>
	<div class="card-block">
		<a href="#" class="btn btn-primary">Set Featured Image</a>
	</div>
</div>

<div class="card">
	<div class="card-block">
		<h4 class="card-title">Image</h4>
	</div>
	<div class="card-img-block">
		<img src="<?php echo asset('images/kelas_online/thumbnails-lg.jpg') ?>" class="img-fluid" alt="Image">
	</div>
	<div class="card-block">
		<a href="#" class="btn btn-primary">Set Thumb Image</a>
	</div>
</div>

<?php custom_script() ?>
<script src="<?php echo asset('node_modules/cropit/dist/jquery.cropit.js') ?>"></script>
<script>
	$(document).ready(function () {
		$('#image-featured-cropper').cropit();
	})
</script>
<?php endcustom_script() ?>
