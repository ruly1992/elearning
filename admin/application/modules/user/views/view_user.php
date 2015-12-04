<div class="panel panel-default">
	<div class="panel-body">
		<?php echo button_create('user/create', 'Tambah Pengguna')?>
		<hr>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Email</th>
					<th>Address</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				
				foreach ($list_user as $prof) { ?>
					<tr>
						<td><?php echo $no ?></td>
						<td><?php echo $prof->first_name." ".$prof->last_name ?></td>
						<td><?php echo $prof->gender ?></td>
						<td><?php echo $prof->email?></td>
						<td><?php echo $prof->address?></td>
		            	<td>
	                        <?php echo button_edit('user/updateProfile/' . $prof->user_id) ?>
	                        <?php echo button_delete('user/delete/' . $prof->user_id) ?>
	                    </td>
					</tr>
					<?php
					$no++;
				}
				?>
			</tbody>		
		</table>
	</div>

</div>