<style>
    div.awesomplete {
        display: block;
    }
    div.awesomplete > ul {
        margin-top: 45px;
    }
</style>

<?php echo form_open('elibrary/update/' . $media->id); ?>
<div class="panel panel-default" id="app-meta" data-media-id="<?php echo $media->id ?>">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $media->name ?> <?php echo $media->status_format ?></h3>
	</div>
	<div class="panel-body">
	   	<div class="row">
	   		<div class="col-md-4">
                <div class="description-meta-left">
                    <div class="text-center">
                        <div class="preview-media" style="width: 200px; height: 200px;">
                            <?php echo $media->getPreview(200, 200) ?>
                        </div>
                        <br>
                        <br>
                        <span><?php echo $media->icon ?> <?php echo $media->type ?></span>
                    </div>
                    <div class="description-meta-button">
                        <a href="<?php echo $media->getLinkDownload() ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-download"></i> Download</a>
                        <a href="<?php echo $media->getLinkPreview() ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-eye"></i> Preview</a>
                    </div>
                </div>
	   		</div>
	   		<div class="col-md-8">
   				<table class="table table-bordered table-striped table-sm" id="list-meta">
                    <thead class="thead-inverse">
                        <tr>
                            <th width="25%">Meta Name</th>
                            <th>Meta Value</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Judul</td>
                            <td><input type="text" name="meta[title]" value="<?php echo $media->title ?>" class="form-control"></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>File Size</td>
                            <td><p class="form-static"><?php echo $media->file_size_format ?></p></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td><textarea name="meta[description]" class="form-control"><?php echo $media->description ?></textarea></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr v-for="meta in metadata">
                            <td>{{ meta.key }}</td>
                            <td><input type="text" name="meta[{{ meta.key }}]" value="{{ meta.value }}" class="form-control"></td>
                            <td><a href="#" onclick="return false" class="btn btn-danger btn-sm" v-on:click="removeMeta($index)"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-10   ">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control awesomplete" v-model="key">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-info" v-on:click="addMeta">Tambahkan meta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	   		</div>
	   	</div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="description-full-title">
                    <p><strong>Deskripsi selengkapnya :</strong></p>
                </div>
                <div class="form-group">
                    <textarea name="meta[full_description]" class="form-control" rows="5"><?php echo set_value('meta[full_description]', $media->getMetadata('full_description')) ?></textarea>  
                </div>              
            </div>

            <?php //if ($media->status == 'draft'): ?>
                <a href="<?php echo site_url('elibrary/approve/' . $media->id) ?>" v-on:click="saveToPublish(<?php echo $media->id ?>, $event)" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Save to Publish</a>
            <?php //else: ?>
                <a href="<?php echo site_url('elibrary/approve/' . $media->id . '/draft') ?>" v-on:click="saveToDraft(<?php echo $media->id ?>, $event)" class="btn btn-sm btn-warning"><i class="fa fa-check"></i> Set to DRAFT</a>
            <?php //endif ?>
            <?php echo button_save() ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
