<?php 
	if(isset($success)){
        echo '<div class="alert alert-info">';
            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<strong>Success!</strong> '.$success;
        echo '</div>';
    }
?>

<div class="form-group">
    <a href="<?php echo site_url('media/upload/') ?>" class="btn btn-primary"><i class="fa fa-upload"></i> Upload Media</a>
</div>

    <hr>

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