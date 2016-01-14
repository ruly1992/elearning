<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-body">
			   	<div class="alert alert-warning">
			   		<strong>Anda akan nenghapus kategori <?php echo $category->name ?></strong>
			   	</div>
			   	<p>Artikel yang berada di kategori :</p>
			   	<ul>
			   		<?php foreach ($category->articles as $article): ?>
			   			<li><?php echo $article->title ?></li>
			   		<?php endforeach ?>
			   	</ul>
			</div>
			<div class="panel-footer">
				<?php echo form_open('kategori/delete/'.$category->id, null, ['delete' => 1]); ?>
				<button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Konfirmasi Hapus</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>