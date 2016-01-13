<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $category->name ?></h3>
	</div>
	<div class="panel-body">
        <?php echo button_create('elibrary/upload/', 'Upload Media') ?>

        <div class="btn-group">
            <a href="<?php echo site_url('elibrary/show/'.$category->id.'?status=all') ?>" class="btn btn-default btn-sm <?php echo $status == 'all' ? 'active' : '' ?>">Semua</a>
            <a href="<?php echo site_url('elibrary/show/'.$category->id.'?status=publish') ?>" class="btn btn-default btn-sm <?php echo $status == 'publish' ? 'active' : '' ?>">Publish</a>
            <a href="<?php echo site_url('elibrary/show/'.$category->id.'?status=draft') ?>" class="btn btn-default btn-sm <?php echo $status == 'draft' ? 'active' : '' ?>">Draft</a>
        </div>

        <hr>

	  	<table class="table table-hover table-bordered">
	  		<thead>
	  			<tr>
	  				<th>Judul File</th>
	  				<th>Ukuran File</th>
	  				<th>Jenis File</th>
	  				<th>Status</th>
	  				<th>Waktu</th>
	  				<th>&nbsp;</th>
	  				<th>&nbsp;</th>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			<?php if ($filemedia->count()): ?>
	  				<?php foreach ($filemedia as $media): ?>	  					
			  			<tr>
			  				<td><?php echo $media->title ?></td>
			  				<td><?php echo $media->file_size_format ?></td>
			  				<td><?php echo $media->type ?></td>
			  				<td><?php echo $media->status_format ?></td>
			  				<td><?php echo $media->created_at->format('d-m-Y H:i:s') ?></td>
			  				<td><a href="<?php echo site_url('elibrary/edit/' . $media->id) ?>" class="label label-primary">Review</a></td>
			  				<td><?php echo button_delete('elibrary/delete/' . $media->id . '?status=' . $media->status  ) ?></td>
			  			</tr>
	  				<?php endforeach ?>
	  			<?php else: ?>
	  				<tr class="warning">
	  					<td colspan="5">Tidak ada media</td>
	  				</tr>
	  			<?php endif ?>
	  		</tbody>
	  	</table>

	  	<?php echo $filemedia->render() ?>
	</div>
</div>