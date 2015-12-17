<p class="alert alert-info">Silahkan memilih kategori terlebih dahulu.</p>

<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Category Name</th>
			<th>Jumlah Berkas</th>
			<th>File Size</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $category): ?>
			<tr>
				<td><?php echo anchor('media/show/' . $category->id, $category->name) ?></td>
				<td><?php echo $category->getMediaCount() ?></td>
				<td><?php echo $category->getTotalSize() ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
</ul>