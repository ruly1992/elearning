<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Elibrary</h3>
	</div>
	<div class="panel-body">
	 <?php echo button_create('elibrary/upload/', 'Upload Media') ?>
	  	<table class="table table-hover table-bordered">
	  		<thead>
	  			<tr>
	  				<th>Nama Kategori</th>
	  				<th>Jumlah Media Publish</th>
	  				<th>Menunggu Konfirmasi</th>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			<?php if ($categories->count()): ?>
	  				<?php foreach ($categories as $category): ?>	  					
			  			<tr>
			  				<td><?php echo anchor('elibrary/show/' . $category->id. '?status=all', $category->name); ?></td>
			  				<td><a href="<?php echo site_url('elibrary/show/' . $category->id) ?>" class="label label-primary">Lihat</a> <span class="label label-primary"><?php echo $category->getMediaCount() ?></span></td>
			  				<td><a href="<?php echo site_url('elibrary/show/' . $category->id) ?>?status=draft" class="label label-warning">Review</a> <span class="label label-warning"><?php echo $category->getMediaDraftCount() ?></span></td>
			  			</tr>
	  				<?php endforeach ?>
	  			<?php else: ?>
	  				<tr class="warning">
	  					<td colspan="3">Tidak ada kategori</td>
	  				</tr>
	  			<?php endif ?>
	  		</tbody>
	  	</table>
	</div>
</div>