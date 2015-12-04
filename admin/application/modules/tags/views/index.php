<a href="<?php echo site_url('tags/create') ?>" class="btn btn-default">Add Tags</a>
<hr>
	<table  class="table table-hover table-bordered">
		<tr>
			<th>Tags</th>
			<th>Action</th>
		</tr>
		<?php
			foreach ($result as $tags){
		?>
		<tr>
			<td><?=$tags->tag?></td>
           	<td><a href="<?=site_url('tags/update/'.$tags->id);?>" class="btn btn-primary">Ubah</a> <a href="<?=site_url('tags/delete/'.$tags->id);?>" class="btn btn-danger">Hapus</a></td>

		</tr>
		<?php } ?>
	</table>
