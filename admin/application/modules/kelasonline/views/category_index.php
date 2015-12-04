 <div class="row">
    <div class="col-md-4">
        <?php echo form_open('kelasonline/category/add'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Create Category</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <?php echo form_input('name', '', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo button_save() ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>List Category</strong></h2>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered">
                	<thead>
                		<tr>
                			<th>Nama Kategori</th>
                            <th>&nbsp;</th>
                		</tr>
                	</thead>
                	<tbody>
                		<?php foreach ($categories as $category): ?>                			
	                		<tr>
	                			<td><?php echo anchor('kelasonline/category/edit/' . $category->id, $category->name); ?></td>
                                <td><?php echo button_edit('kelasonline/category/edit/' . $category->id) ?>
                                <?php echo button_delete('kelasonline/category/delete/' . $category->id) ?></td>
	                		</tr>
                		<?php endforeach ?>
                	</tbody>
                </table>
            </div>
        </div>
    </div>
</div>
