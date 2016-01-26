<style>
    div.awesomplete {
        display: block;
    }
    div.awesomplete > ul {
        margin-top: 45px;
    }
</style>

<?php echo form_open('elibrary/update/' . $media->id, 'name = elibEdit'); ?>
<div class="panel panel-default" id="app-meta" data-media-id="<?php echo $media->id ?>">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $media->name ?> <?php echo $media->status_format ?></h3>
	</div>
	<div class="panel-body">
	   	<div class="row">
	   		<div class="col-md-4 col-sm-4 col-xs-12">
                <center>
                    <div class="description-meta-left">
                        <div style="text-align:center;" class="img-thumbnail">
                            <div class="preview-media" style="width:100%; height:auto; border-radius:10px;">
                                <?php echo $media->getPreview(200, 200) ?>
                            </div>
                            <span><?php echo $media->icon ?> <?php echo $media->type ?></span>
                        </div><br><br>
                        <div class="description-meta-button">
                            <a href="<?php echo $media->getLinkDownload() ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-download"></i> Download</a>
                            <a class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#myModal-1"><i class="fa fa-eye"></i> Preview</a>
                        </div>
                    </div><br>
                </center>
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
                            <td><input type="text" name="meta[{{ meta.key.split(' ').join('_')  }}]" value="{{ meta.value }}" class="form-control"></td>
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
                    <textarea name="meta[full_description]" class="form-control" rows="5"><?php echo $media->full_description ?></textarea>  
                </div>   
                <a href="<?php echo site_url('elibrary/approve/' . $media->id . '/draft') ?>" v-on:click="saveToDraft(<?php echo $media->id ?>, $event)"  onClick="document.forms['elibEdit'].submit(); return true;" class="btn btn-sm btn-warning btn-margin-btm"><i class="fa fa-check"></i> Set to DRAFT</a>
                <a href="<?php echo site_url('elibrary/approve/' . $media->id . '/publish') ?>" v-on:click="saveToDraft(<?php echo $media->id ?>, $event)"  onClick="document.forms['elibEdit'].submit(); return true;" class="btn btn-sm btn-success btn-margin-btm"><i class="fa fa-check"></i> Save to Publish</a>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Preview Media</h4>
                </div>
                <div class="modal-body">
                    <div class="text-xs-center" id="modal-content">
                        <center>                            
                            <?php echo $media->getPreview(700, 500) ?>
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<?php custom_script() ?>>
    <script src="<?php echo asset('admin/plugins/modal/js/jquery.modalEffects.js') ?>"></script>
    <script src="<?php echo asset('admin/js/pages/ui-modals.js') ?>"></script>
    <script type="text/javascript">
        $('#myModal-1').on('hidden.bs.modal', function (e) {
            if ( $('#modal-content video').length ) {
                $('#modal-content video').get(0).pause();
            }
            if ( $('#modal-content audio').length ) {
                $('#modal-content audio').get(0).pause();
            }
        });
    </script>
<?php endcustom_script() ?>
